<?php

/**
 * Achievement authoring metadata and fail-closed validation.
 *
 * This file intentionally has no database or template dependencies.  The
 * procedural API keeps it usable by the legacy PEQ editor, JSON endpoints,
 * command-line checks, and the small test harness in tests/.
 *
 * Public validation context keys (all optional):
 *   category_ids          list/map of known category IDs
 *   category_parent_map   category_id => parent_id
 *   achievement_ids       list/map of known achievement IDs
 *   dependency_edges      achievement_id => prerequisite achievement IDs
 *   existing_reward_ids   reward IDs already owned by the edited achievement
 *   existing_reward_set_id stable reward-set ID already owned by it
 *   known_reward_set_ids  list/map of IDs already used by any definition
 *   known_restriction_ids list/map of valid spell restriction IDs
 */

define('ACHIEVEMENT_UINT8_MAX', '255');
define('ACHIEVEMENT_UINT32_MAX', '4294967295');
define('ACHIEVEMENT_UINT64_MAX', '18446744073709551615');
define('ACHIEVEMENT_INT32_MAX', '2147483647');
define('ACHIEVEMENT_INT64_MAX', '9223372036854775807');
define('ACHIEVEMENT_ITEM_REWARD_AMOUNT_MAX', '32767');
define('ACHIEVEMENT_COPPER_REWARD_AMOUNT_MAX', '2147483647999');
define('ACHIEVEMENT_SKILL_WILDCARD', '4294967295');
define('ACHIEVEMENT_UPDATE_LEASE_SECONDS', 60);

/**
 * Runtime delivery limits from the final source grant implementations.
 * Decimal strings avoid platform/JSON precision loss in the legacy editor.
 */
function achievement_reward_type_metadata()
{
    return array(
        0 => array(
            'label' => 'Item',
            'data_label' => 'Item ID',
            'help' => 'Grant copies of one items.id row.',
            'data_help' => 'Required nonzero items.id value.',
            'amount_help' => 'Item quantity from 1 through 32,767.',
            'data_min' => '1', 'data_max' => ACHIEVEMENT_UINT32_MAX,
            'amount_min' => '1', 'amount_max' => ACHIEVEMENT_ITEM_REWARD_AMOUNT_MAX,
        ),
        1 => array(
            'label' => 'Experience',
            'data_label' => 'Experience mode',
            'help' => 'Grant an unsigned 32-bit XP quantity.',
            'data_help' => 'Mode 0 uses normal handling; mode 1 is normal-only raw XP.',
            'amount_help' => 'Experience quantity from 1 through 4,294,967,295.',
            'data_values' => array('0', '1'),
            'amount_min' => '1', 'amount_max' => ACHIEVEMENT_UINT32_MAX,
        ),
        2 => array(
            'label' => 'Alternate Advancement',
            'data_label' => 'Data (must be 0)',
            'help' => 'Grant whole Alternate Advancement points.',
            'data_help' => 'Reserved runtime field; it must be 0.',
            'amount_help' => 'AA point quantity from 1 through 2,147,483,647.',
            'data_values' => array('0'),
            'amount_min' => '1', 'amount_max' => ACHIEVEMENT_INT32_MAX,
        ),
        3 => array(
            'label' => 'Copper',
            'data_label' => 'Data (must be 0)',
            'help' => 'Grant coin expressed as one copper total.',
            'data_help' => 'Reserved runtime field; it must be 0.',
            'amount_help' => 'Copper quantity from 1 through 2,147,483,647,999.',
            'data_values' => array('0'),
            'amount_min' => '1', 'amount_max' => ACHIEVEMENT_COPPER_REWARD_AMOUNT_MAX,
        ),
        4 => array(
            'label' => 'Alternate Currency',
            'data_label' => 'Currency ID',
            'help' => 'Grant one alternate-currency denomination.',
            'data_help' => 'Required nonzero alternate_currency.id value.',
            'amount_help' => 'Alternate-currency quantity from 1 through 2,147,483,647.',
            'data_min' => '1', 'data_max' => ACHIEVEMENT_UINT32_MAX,
            'amount_min' => '1', 'amount_max' => ACHIEVEMENT_INT32_MAX,
        ),
        5 => array(
            'label' => 'Title',
            'data_label' => 'Title-set ID',
            'help' => 'Grant one title-set entry.',
            'data_help' => 'Required title-set ID from 1 through 2,147,483,647.',
            'amount_help' => 'Title delivery is singular; Amount must be exactly 1.',
            'data_min' => '1', 'data_max' => ACHIEVEMENT_INT32_MAX,
            'amount_values' => array('1'),
        ),
    );
}

/** Return the complete editor-facing metadata catalog. */
function achievement_metadata()
{
    static $metadata = null;
    if ($metadata !== null) {
        return $metadata;
    }

    $metadata = array(
        'limits' => array(
            'uint8_max' => ACHIEVEMENT_UINT8_MAX,
            'uint32_max' => ACHIEVEMENT_UINT32_MAX,
            'uint64_max' => ACHIEVEMENT_UINT64_MAX,
            'int32_max' => ACHIEVEMENT_INT32_MAX,
            'int64_max' => ACHIEVEMENT_INT64_MAX,
            'item_reward_amount_max' => ACHIEVEMENT_ITEM_REWARD_AMOUNT_MAX,
            'copper_reward_amount_max' => ACHIEVEMENT_COPPER_REWARD_AMOUNT_MAX,
            'skill_wildcard' => ACHIEVEMENT_SKILL_WILDCARD,
            'update_processing_lease_seconds' => ACHIEVEMENT_UPDATE_LEASE_SECONDS,
        ),
        'component_types' => array(
            0 => array('label' => 'Type 0 (state-bearing)', 'help' => 'RoF2 state bucket 0. It can persist progress and participate in evaluation.'),
            1 => array('label' => 'Type 1 (state-bearing)', 'help' => 'RoF2 state bucket 1. It can persist progress and participate in evaluation.'),
            2 => array('label' => 'Type 2 (state-bearing)', 'help' => 'RoF2 state bucket 2. It can persist progress and participate in evaluation.'),
            3 => array('label' => 'Type 3 (presentation only)', 'help' => 'Visible client text only. RoF2 has no state channel for this type, so it cannot have an enabled criterion.'),
        ),
        'events' => achievement_event_metadata(),
        'progress_modes' => array(
            0 => array('label' => 'Increment', 'help' => 'Add each observed value. Use only for non-replayed events such as kills, loot, and successful combines.'),
            1 => array('label' => 'Highest', 'help' => 'Keep the greatest observed value. Useful for durable milestones that should never decrease.'),
            2 => array('label' => 'Set', 'help' => 'Replace progress with the current observed value. Use when an absolute fact may decrease, such as item ownership.'),
            3 => array('label' => 'Boolean', 'help' => 'Set progress to the full required count when the threshold passes, or zero when a reconciled absolute fact no longer passes.'),
        ),
        'behaviors' => array(
            0 => array('label' => 'Required', 'help' => 'Every Required component must pass before the achievement completes.'),
            1 => array('label' => 'Optional', 'help' => 'Track and display this component without affecting completion.'),
            2 => array('label' => 'Unlock', 'help' => 'Keep the achievement Locked until this component passes.'),
            3 => array('label' => 'Visibility', 'help' => 'Keep the achievement Hidden until this component passes.'),
            4 => array('label' => 'Display Only', 'help' => 'Track presentation state without affecting completion, locking, or visibility.'),
            5 => array('label' => 'Blocker', 'help' => 'Lock the achievement while this component is satisfied.'),
        ),
        'reward_types' => achievement_reward_type_metadata(),
        'reward_delivery' => array(
            'automatic' => array('label' => 'Automatic on completion', 'help' => 'An enabled reward with no option mapping is delivered automatically when completion is persisted.'),
            'common' => array('label' => 'Common to every choice', 'help' => 'A reward mapped to an enabled common option is delivered with whichever selectable option the player chooses.'),
            'selectable' => array('label' => 'Selected by player', 'help' => 'A reward mapped to an enabled non-common option is delivered only when that option is chosen.'),
        ),
        'achievement_statuses' => array(
            0 => array('label' => 'Completed', 'help' => 'The character has a durable completion row.'),
            1 => array('label' => 'Open', 'help' => 'The achievement is visible and currently available.'),
            2 => array('label' => 'Locked', 'help' => 'An Unlock component is unmet or a Blocker component is met.'),
            3 => array('label' => 'Hidden', 'help' => 'A Visibility or class-applicability rule hides the definition from this character.'),
        ),
        'character_reward_statuses' => array(
            0 => array('label' => 'Claimed / In Flight', 'help' => 'Delivery began but durable success is not known. Retrying can duplicate a reward and requires explicit review.'),
            1 => array('label' => 'Durably Granted', 'help' => 'Delivery completed and must not be repeated.'),
            2 => array('label' => 'Retryable Failure', 'help' => 'The delivery API explicitly failed before a durable grant and may be retried.'),
        ),
        'character_selection_statuses' => array(
            0 => array('label' => 'Pending / In Progress', 'help' => 'The reward choice is outstanding or delivery is currently in progress.'),
            1 => array('label' => 'Fully Granted', 'help' => 'Every grant for the locked choice completed durably.'),
            2 => array('label' => 'Retryable Failure', 'help' => 'The selection failed explicitly and may be reviewed for retry.'),
            3 => array('label' => 'Ambiguous Delivery', 'help' => 'The server cannot prove whether delivery completed. Never retry without checking duplicate risk.'),
        ),
        'update_target_types' => array(
            0 => array('label' => 'Character', 'help' => 'The request originally targeted one character.'),
            1 => array('label' => 'Group', 'help' => 'World expanded a group request into per-character durable rows.'),
            2 => array('label' => 'Raid', 'help' => 'World expanded a raid request into per-character durable rows.'),
            3 => array('label' => 'Dynamic Zone', 'help' => 'World expanded a dynamic-zone roster into per-character durable rows.'),
            4 => array('label' => 'Shared Task', 'help' => 'World expanded a shared-task roster into per-character durable rows.'),
        ),
        'update_operations' => array(
            0 => array('label' => 'Advance', 'help' => 'Raise one component to at least requested_value.'),
            1 => array('label' => 'Complete', 'help' => 'Complete the whole achievement idempotently.'),
        ),
        'character_update_statuses' => array(
            0 => array('label' => 'Pending', 'help' => 'Waiting for a target zone to apply the request.'),
            1 => array('label' => 'Blocked', 'help' => 'Invalid or incompatible content prevented application. The row remains for diagnosis.'),
            2 => array('label' => 'Processing', 'help' => 'A zone holds a claim lease. A stopped process can be recovered after 60 seconds.'),
        ),
        'classes' => array(
            1 => 'Warrior', 2 => 'Cleric', 3 => 'Paladin', 4 => 'Ranger',
            5 => 'Shadowknight', 6 => 'Druid', 7 => 'Monk', 8 => 'Bard',
            9 => 'Rogue', 10 => 'Shaman', 11 => 'Necromancer', 12 => 'Wizard',
            13 => 'Magician', 14 => 'Enchanter', 15 => 'Beastlord', 16 => 'Berserker',
        ),
        'skills' => achievement_skill_types(),
        'fields' => achievement_field_metadata(),
    );

    return $metadata;
}

/** EQEmu SkillUseTypes. IDs are deliberately zero-based and must not be shifted. */
function achievement_skill_types()
{
    return array(
        0 => '1H Blunt', 1 => '1H Slashing', 2 => '2H Blunt', 3 => '2H Slashing',
        4 => 'Abjuration', 5 => 'Alteration', 6 => 'Apply Poison', 7 => 'Archery',
        8 => 'Backstab', 9 => 'Bind Wound', 10 => 'Bash', 11 => 'Block',
        12 => 'Brass Instruments', 13 => 'Channeling', 14 => 'Conjuration', 15 => 'Defense',
        16 => 'Disarm', 17 => 'Disarm Traps', 18 => 'Divination', 19 => 'Dodge',
        20 => 'Double Attack', 21 => 'Dragon Punch', 22 => 'Dual Wield', 23 => 'Eagle Strike',
        24 => 'Evocation', 25 => 'Feign Death', 26 => 'Flying Kick', 27 => 'Forage',
        28 => 'Hand to Hand', 29 => 'Hide', 30 => 'Kick', 31 => 'Meditate',
        32 => 'Mend', 33 => 'Offense', 34 => 'Parry', 35 => 'Pick Lock',
        36 => '1H Piercing', 37 => 'Riposte', 38 => 'Round Kick', 39 => 'Safe Fall',
        40 => 'Sense Heading', 41 => 'Singing', 42 => 'Sneak', 43 => 'Specialize Abjure',
        44 => 'Specialize Alteration', 45 => 'Specialize Conjuration', 46 => 'Specialize Divination',
        47 => 'Specialize Evocation', 48 => 'Pick Pockets', 49 => 'Stringed Instruments',
        50 => 'Swimming', 51 => 'Throwing', 52 => 'Tiger Claw', 53 => 'Tracking',
        54 => 'Wind Instruments', 55 => 'Fishing', 56 => 'Make Poison', 57 => 'Tinkering',
        58 => 'Research', 59 => 'Alchemy', 60 => 'Baking', 61 => 'Tailoring',
        62 => 'Sense Traps', 63 => 'Blacksmithing', 64 => 'Fletching', 65 => 'Brewing',
        66 => 'Alcohol Tolerance', 67 => 'Begging', 68 => 'Jewelry Making', 69 => 'Pottery',
        70 => 'Percussion Instruments', 71 => 'Intimidation', 72 => 'Berserking', 73 => 'Taunt',
        74 => 'Frenzy', 75 => 'Remove Trap', 76 => 'Triple Attack', 77 => '2H Piercing',
    );
}

/** Event-specific labels, filters, threshold meaning, lookup hint, and replay policy. */
function achievement_event_metadata()
{
    $all = array(0, 1, 2, 3);
    $absolute = array(1, 2, 3);

    return array(
        0 => array('label' => 'Manual', 'help' => 'No engine event is emitted; quest or administration APIs advance the component.', 'target_id_label' => 'Target ID', 'target_id_help' => 'Normally 0. Manual progress calls identify the component directly.', 'target_id2_label' => 'Secondary Target', 'target_id2_help' => 'Must be 0.', 'target_value_label' => 'Target Value', 'target_value_help' => 'Normally 0; a direct progress call supplies the observed value.', 'replay' => 'No engine replay.', 'lookup' => null, 'allowed_progress_modes' => $all),
        1 => array('label' => 'Level', 'help' => 'Compare against the character\'s current level.', 'target_id_label' => 'Target ID', 'target_id_help' => 'Must be 0.', 'target_id2_label' => 'Secondary Target', 'target_id2_help' => 'Must be 0.', 'target_value_label' => 'Minimum Level', 'target_value_help' => 'Use a positive level threshold, especially for Boolean mode.', 'replay' => 'Current level is reconciled on login and zone load.', 'lookup' => null, 'allowed_progress_modes' => $absolute),
        2 => array('label' => 'NPC Type Kill', 'help' => 'Advance after a credited kill of an exact npc_types row.', 'target_id_label' => 'NPC Type ID', 'target_id_help' => 'npc_types.id, or 0 to match any NPC type.', 'target_id2_label' => 'Secondary Target', 'target_id2_help' => 'Must be 0.', 'target_value_label' => 'Minimum Event Value', 'target_value_help' => 'A credited kill observes 1; normally use 0 or 1.', 'replay' => 'No historical replay.', 'lookup' => 'npc', 'allowed_progress_modes' => $all),
        3 => array('label' => 'NPC Race Kill', 'help' => 'Advance after a credited kill of an NPC with the selected base race.', 'target_id_label' => 'NPC Race ID', 'target_id_help' => 'npc_types.race, or 0 to match any base race.', 'target_id2_label' => 'Secondary Target', 'target_id2_help' => 'Must be 0.', 'target_value_label' => 'Minimum Event Value', 'target_value_help' => 'A credited kill observes 1; normally use 0 or 1.', 'replay' => 'No historical replay.', 'lookup' => 'race', 'allowed_progress_modes' => $all),
        4 => array('label' => 'Task Complete', 'help' => 'Pass after a specific task is durably recorded complete.', 'target_id_label' => 'Task ID', 'target_id_help' => 'An exact nonzero tasks.id is required; wildcard completion cannot be reconciled safely.', 'target_id2_label' => 'Secondary Target', 'target_id2_help' => 'Must be 0.', 'target_value_label' => 'Minimum Event Value', 'target_value_help' => 'Task completion observes 1; normally use 0 or 1.', 'replay' => 'Replayed from completed-task history.', 'lookup' => 'task', 'allowed_progress_modes' => $absolute),
        5 => array('label' => 'Zone Enter', 'help' => 'Advance when the character enters the selected zone.', 'target_id_label' => 'Zone ID', 'target_id_help' => 'Use zone.zoneidnumber, or 0 to match any destination zone.', 'target_id2_label' => 'Secondary Target', 'target_id2_help' => 'Must be 0.', 'target_value_label' => 'Minimum Event Value', 'target_value_help' => 'Zone entry observes 1; normally use 0 or 1.', 'replay' => 'Only the current zone is reconciled, so Increment is unsafe.', 'lookup' => 'zone', 'allowed_progress_modes' => $absolute),
        6 => array('label' => 'Loot Item', 'help' => 'Advance for item quantity transferred successfully from an NPC corpse.', 'target_id_label' => 'Item ID', 'target_id_help' => 'items.id, or 0 to match any looted item.', 'target_id2_label' => 'Secondary Target', 'target_id2_help' => 'Must be 0.', 'target_value_label' => 'Minimum Transfer Quantity', 'target_value_help' => 'The observed value is the successfully transferred quantity.', 'replay' => 'No historical replay.', 'lookup' => 'item', 'allowed_progress_modes' => $all),
        7 => array('label' => 'Own Item', 'help' => 'Compare against authoritative persisted inventory, bank, shared bank, keyring, bags, augments, and cursor storage.', 'target_id_label' => 'Item ID', 'target_id_help' => 'items.id, or 0 for the greatest quantity held of any one item ID.', 'target_id2_label' => 'Required Class', 'target_id2_help' => 'Optional EQ class ID 1 through 16; use 0 for class-neutral content.', 'target_value_label' => 'Minimum Owned Count', 'target_value_help' => 'Use a positive threshold for Boolean mode.', 'replay' => 'Authoritative persisted ownership is reconciled.', 'lookup' => 'item', 'allowed_progress_modes' => $absolute),
        8 => array('label' => 'Tradeskill Success', 'help' => 'Advance after a successful combine.', 'target_id_label' => 'Recipe ID', 'target_id_help' => 'tradeskill_recipe.id, or 0 to match any successful recipe.', 'target_id2_label' => 'Secondary Target', 'target_id2_help' => 'Must be 0.', 'target_value_label' => 'Minimum Event Value', 'target_value_help' => 'A successful combine observes 1; normally use 0 or 1.', 'replay' => 'No historical replay.', 'lookup' => 'recipe', 'allowed_progress_modes' => $all),
        9 => array('label' => 'Skill Value', 'help' => 'Compare against the persisted raw value of one skill.', 'target_id_label' => 'Skill ID', 'target_id_help' => 'Use exact skill ID 0 through 77. The wildcard is 4294967295 because skill 0 is 1H Blunt.', 'target_id2_label' => 'Secondary Target', 'target_id2_help' => 'Must be 0.', 'target_value_label' => 'Minimum Skill Value', 'target_value_help' => 'Use a positive threshold for Boolean mode.', 'replay' => 'Persisted raw skill value is reconciled.', 'lookup' => 'skill', 'allowed_progress_modes' => $absolute),
        10 => array('label' => 'Alternate Advancement', 'help' => 'Compare against purchased-rank cost plus durable expended AA.', 'target_id_label' => 'Target ID', 'target_id_help' => 'Must be 0.', 'target_id2_label' => 'Secondary Target', 'target_id2_help' => 'Must be 0.', 'target_value_label' => 'Minimum Spent AA', 'target_value_help' => 'Use a positive threshold for Boolean mode.', 'replay' => 'Spent AA is reconciled.', 'lookup' => null, 'allowed_progress_modes' => $absolute),
        11 => array('label' => 'Achievement Complete', 'help' => 'Depend on another durable achievement completion.', 'target_id_label' => 'Prerequisite Achievement ID', 'target_id_help' => 'Use an exact achievements.id, or 0 to match any completed achievement. Exact dependencies must not form a cycle.', 'target_id2_label' => 'Secondary Target', 'target_id2_help' => 'Must be 0.', 'target_value_label' => 'Minimum Event Value', 'target_value_help' => 'Completion observes 1; normally use 0 or 1.', 'replay' => 'Replayed from durable achievement completion state.', 'lookup' => 'achievement', 'allowed_progress_modes' => $absolute),
        12 => array('label' => 'NPC Name Kill', 'help' => 'Advance after a credited kill matching EQEmu\'s canonical NPC-name hash.', 'target_id_label' => 'Canonical NPC Name Hash', 'target_id_help' => 'A nonzero unsigned 32-bit FNV-1a identity is required. Generate it from the NPC name helper.', 'target_id2_label' => 'Zone ID', 'target_id2_help' => 'Use a zone ID to scope collision risk, or 0 to match the name in any zone.', 'target_value_label' => 'Minimum Event Value', 'target_value_help' => 'A credited kill observes 1; normally use 0 or 1.', 'replay' => 'No historical replay; audit hash collisions in the target zone.', 'lookup' => 'npc_name', 'allowed_progress_modes' => $all),
        13 => array('label' => 'Skill Cap', 'help' => 'Compare a class and skill against the DB-backed cap at a milestone level.', 'target_id_label' => 'Skill ID', 'target_id_help' => 'Use exact skill ID 0 through 77; 0 validly means 1H Blunt.', 'target_id2_label' => 'Required Class', 'target_id2_help' => 'A class ID from Warrior (1) through Berserker (16) is required.', 'target_value_label' => 'Milestone Level', 'target_value_help' => 'A level from 1 through 255 used to resolve skill_caps.', 'replay' => 'Class, level, and DB-backed cap attainment are reconciled.', 'lookup' => 'skill', 'allowed_progress_modes' => $absolute),
    );
}

/** Help text for every content and character-state field surfaced by the editor. */
function achievement_field_metadata()
{
    return array(
        'achievement_categories' => array(
            'id' => array('label' => 'Category ID', 'help' => 'Stable nonzero category identity. Do not change it after creation.'),
            'parent_id' => array('label' => 'Parent category', 'help' => 'Use 0 for a root. Parent chains must exist and must not contain a cycle.'),
            'sequence' => array('label' => 'Order', 'help' => 'Sort order among siblings; ties are ordered by category ID.'),
            'name' => array('label' => 'Name', 'help' => 'Category name shown in the left side of the achievement window.'),
            'description' => array('label' => 'Description', 'help' => 'Category description sent to the client.'),
            'icon' => array('label' => 'Icon resource', 'help' => 'Optional client texture/resource name such as A_Hunter. Empty produces text-only presentation.'),
        ),
        'achievements' => array(
            'id' => array('label' => 'Achievement ID', 'help' => 'Stable nonzero definition identity used by character state, links, scripts, and dependencies. Immutable after creation.'),
            'name' => array('label' => 'Name', 'help' => 'Visible achievement name and default clickable-link text.'),
            'description' => array('label' => 'Description', 'help' => 'Visible achievement description sent to the client.'),
            'icon_id' => array('label' => 'Icon ID', 'help' => 'Unsigned client icon number. Use 0 when no reviewed icon is known.'),
            'points' => array('label' => 'Points', 'help' => 'Achievement score awarded on completion.'),
            'has_reward' => array('label' => 'Imported reward hint', 'help' => 'Untrusted client reward-button hint. Runtime derives the effective state from source_type=1 automatic and selectable mappings.'),
            'client_flag' => array('label' => 'Client flag', 'help' => 'Uninterpreted field 7 from AchievementsClient.txt, retained for lossless import/export and not sent to RoF2.'),
            'version' => array('label' => 'Definition version', 'help' => 'Durable definition version. Zero is the valid initial version. Increment it when deployed semantics change incompatibly.'),
            'reset_on_version_change' => array('label' => 'Reset on version change', 'help' => 'When enabled, a mismatch removes old completion, progress, reward ledger, and selection ledger before rebuilding state.'),
            'enabled' => array('label' => 'Enabled', 'help' => 'Only enabled definitions enter the active snapshot. Invalid enabled content makes an achievement reload fail closed.'),
        ),
        'achievement_category_associations' => array(
            'category_id' => array('label' => 'Category', 'help' => 'Existing category where this achievement will appear.'),
            'sequence' => array('label' => 'Order', 'help' => 'Achievement order inside this category.'),
            'achievement_id' => array('label' => 'Achievement ID', 'help' => 'Owning definition; supplied automatically by this editor.'),
            'display_text' => array('label' => 'Display override', 'help' => 'Optional association-specific client text. Empty uses the normal definition presentation.'),
        ),
        'achievement_components' => array(
            'achievement_id' => array('label' => 'Achievement ID', 'help' => 'Owning definition; supplied automatically by this editor.'),
            'component_type' => array('label' => 'Wire type', 'help' => 'RoF2 state bucket 0 through 3. Type 3 is presentation-only.'),
            'sequence' => array('label' => 'Client order', 'help' => 'Display order within the wire type. RoF2 clamps this display value to 255.'),
            'component_id' => array('label' => 'Component ID', 'help' => 'Stable component identity together with achievement ID and wire type. Zero is valid.'),
            'name' => array('label' => 'Primary name', 'help' => 'Main client-facing component text stored in achievement_components.name.'),
            'description' => array('label' => 'Secondary description', 'help' => 'Optional second client text stored in achievement_components.description.'),
            'presentation_count' => array('label' => 'Presentation count', 'help' => 'Default displayed count from achievement_associations. Enabled criteria override it with their explicit required count.'),
        ),
        'achievement_associations' => array(
            'component_id' => array('label' => 'Component ID', 'help' => 'Global presentation-count identity. Components in any definition sharing this ID also share this imported default.'),
            'required_count' => array('label' => 'Presentation count', 'help' => 'Default displayed count. Enabled criteria replace it with their explicit nonzero required count.'),
        ),
        'achievement_criteria' => array(
            'id' => array('label' => 'Criterion row ID', 'help' => 'Database-generated diagnostic identity. It is not the criterion\'s logical identity.'),
            'achievement_id' => array('label' => 'Achievement ID', 'help' => 'Owning definition; supplied automatically from the editor graph.'),
            'component_type' => array('label' => 'Component type', 'help' => 'Must match a state-bearing component type 0 through 2 in the owning definition.'),
            'component_sequence' => array('label' => 'Component order copy', 'help' => 'Authoring copy of component sequence for readable exports; runtime identity does not use it.'),
            'component_id' => array('label' => 'Component ID', 'help' => 'Must match the stable component identity in the owning definition.'),
            'event_type' => array('label' => 'Event', 'help' => 'Game event or reconciled fact that evaluates this criterion.'),
            'progress_mode' => array('label' => 'Progress mode', 'help' => 'How each observed value changes durable progress.'),
            'behavior' => array('label' => 'Behavior', 'help' => 'How this component affects completion, locking, and visibility.'),
            'target_id' => array('label' => 'Primary target', 'help' => 'Event-specific primary filter. Read the event help before using zero as a wildcard.'),
            'target_id2' => array('label' => 'Secondary target', 'help' => 'Only Own Item, NPC Name Kill, and Skill Cap support this value.'),
            'target_value' => array('label' => 'Target value', 'help' => 'Nonnegative qualifying threshold; Skill Cap uses it as milestone level.'),
            'required_count' => array('label' => 'Required count', 'help' => 'Explicit nonzero count needed to satisfy the component and sent to RoF2.'),
            'enabled' => array('label' => 'Enabled', 'help' => 'Only enabled rows become server policy. Disabled rows remain stored for later review.'),
        ),
        'rewards' => array(
            'reward_id' => array('label' => 'Reward ID', 'help' => 'Reusable catalog identity from rewards. Shared catalog rows cannot be changed from one provider editor.'),
            'sequence' => array('label' => 'Mapping order', 'help' => 'Automatic delivery order in reward_source_entries, or option delivery order in reward_option_entries.'),
            'reward_type' => array('label' => 'Type', 'help' => 'Kind of grant. It changes the meaning of Referenced data and Amount.'),
            'reward_data_id' => array('label' => 'Referenced data', 'help' => 'Type-specific item, currency, title-set, or experience-mode value.'),
            'amount' => array('label' => 'Amount', 'help' => 'Positive type-specific quantity.'),
            'description' => array('label' => 'Client description', 'help' => 'Text shown in reward preview; runtime supplies a fallback when empty.'),
            'enabled' => array('label' => 'Catalog enabled', 'help' => 'Global rewards.enabled state. Disabling a shared grant affects every provider mapping and is therefore blocked here.'),
            'option_id' => array('label' => 'Delivery option', 'help' => 'Leave empty for automatic delivery, or map this grant to one option in this achievement\'s reward set.'),
        ),
        'reward_sets' => array(
            'reward_set_id' => array('label' => 'Stable set ID', 'help' => 'Stable nonzero selectable-set identity. It may be allocated on first save and is immutable afterward.'),
            'title' => array('label' => 'Prompt / title', 'help' => 'Shared Select Reward window title stored in reward_sets.'),
            'enabled' => array('label' => 'Catalog set enabled', 'help' => 'Global reward_sets.enabled state. Shared set content is read-only from one provider editor.'),
        ),
        'reward_sources' => array(
            'source_type' => array('label' => 'Source type', 'help' => 'Provider type. This editor always scopes achievement mappings to source_type 1.'),
            'source_id' => array('label' => 'Source ID', 'help' => 'Provider-owned identity. For source_type 1 this is achievements.id.'),
            'reward_set_id' => array('label' => 'Reward set ID', 'help' => 'Reusable reward set referenced by this provider source.'),
            'enabled' => array('label' => 'Achievement mapping enabled', 'help' => 'Enables only this achievement-to-set mapping; it is distinct from the shared reward_sets.enabled flag.'),
        ),
        'reward_options' => array(
            'reward_set_id' => array('label' => 'Reward set ID', 'help' => 'Owning selectable reward set; supplied automatically by this editor.'),
            'option_id' => array('label' => 'Option ID', 'help' => 'Stable nonzero identity inside the reward set.'),
            'sequence' => array('label' => 'Order', 'help' => 'Display order inside the Select Reward window.'),
            'label' => array('label' => 'Label', 'help' => 'Text shown in the reward choices list.'),
            'common_to_all' => array('label' => 'Common', 'help' => 'Common options grant with every selected non-common option; they are not choices themselves.'),
            'flags' => array('label' => 'Flags', 'help' => 'Unsigned RoF2 option flags. Use 0 unless a verified client behavior requires another value.'),
            'enabled' => array('label' => 'Enabled', 'help' => 'Only enabled options load. Each enabled option must contain at least one enabled grant.'),
        ),
        'reward_option_entries' => array(
            'reward_set_id' => array('label' => 'Reward set ID', 'help' => 'Set containing the mapped option.'),
            'option_id' => array('label' => 'Option ID', 'help' => 'Common or selectable option receiving this canonical grant.'),
            'sequence' => array('label' => 'Grant order', 'help' => 'Display and delivery order inside this option.'),
            'reward_id' => array('label' => 'Reward ID', 'help' => 'Reusable catalog grant. A grant may appear only once within a set.'),
        ),
        'achievement_cast_requirements' => array(
            'restriction_id' => array('label' => 'Restriction ID', 'help' => 'Existing spell restriction number. Every row sharing a restriction ID must pass.'),
            'achievement_id' => array('label' => 'Achievement ID', 'help' => 'The edited achievement is required by this restriction.'),
            'requires_completed' => array('label' => 'Required state', 'help' => 'Enabled requires achievement completion; disabled requires it to remain incomplete.'),
        ),
        'character_achievements' => array(
            'character_id' => array('label' => 'Character ID', 'help' => 'Character that owns this durable completion.'),
            'achievement_id' => array('label' => 'Achievement ID', 'help' => 'Completed stable definition identity.'),
            'version' => array('label' => 'Saved version', 'help' => 'Definition version active when completion was persisted.'),
            'completed_at' => array('label' => 'Completed at', 'help' => 'Unix timestamp of durable completion.'),
        ),
        'character_achievement_progress' => array(
            'character_id' => array('label' => 'Character ID', 'help' => 'Character that owns this durable progress.'),
            'achievement_id' => array('label' => 'Achievement ID', 'help' => 'Stable owning definition.'),
            'component_type' => array('label' => 'Wire type', 'help' => 'State-bearing component bucket.'),
            'component_sequence' => array('label' => 'Current order', 'help' => 'Presentation sequence copied for diagnostics; it is not identity.'),
            'component_id' => array('label' => 'Component ID', 'help' => 'Stable authored component identity.'),
            'current_count' => array('label' => 'Current count', 'help' => 'Durable progress clamped to the component requirement.'),
            'completed' => array('label' => 'Completed', 'help' => 'Materialized component-satisfied flag.'),
            'version' => array('label' => 'Saved version', 'help' => 'Definition version under which this progress was written.'),
            'updated_at' => array('label' => 'Updated at', 'help' => 'Unix timestamp of the last durable progress update.'),
        ),
        'character_achievement_rewards' => array(
            'character_id' => array('label' => 'Character ID', 'help' => 'Character receiving the grant.'),
            'achievement_id' => array('label' => 'Achievement ID', 'help' => 'Completed definition that produced this grant.'),
            'reward_id' => array('label' => 'Reward ID', 'help' => 'Canonical at-most-once grant identity from rewards.'),
            'status' => array('label' => 'Delivery status', 'help' => 'At-most-once ledger state. In-flight/ambiguous rows require duplicate-risk review.'),
            'attempt_count' => array('label' => 'Attempts', 'help' => 'Number of delivery claims started.'),
            'granted_at' => array('label' => 'Granted at', 'help' => 'Unix timestamp of successful delivery, otherwise 0.'),
            'last_attempt_at' => array('label' => 'Last attempt', 'help' => 'Unix timestamp of the latest delivery attempt.'),
            'last_error' => array('label' => 'Last error', 'help' => 'Latest delivery or persistence diagnostic.'),
        ),
        'character_achievement_reward_selections' => array(
            'character_id' => array('label' => 'Character ID', 'help' => 'Character that owns the selectable claim.'),
            'achievement_id' => array('label' => 'Achievement ID', 'help' => 'Completed definition that produced the set.'),
            'reward_set_id' => array('label' => 'Reward set ID', 'help' => 'Stable authored selectable reward set.'),
            'selected_option_id' => array('label' => 'Selected option', 'help' => 'Zero before a choice; otherwise the locked option identity.'),
            'status' => array('label' => 'Selection status', 'help' => 'Whole-selection delivery state. Ambiguous rows must not be retried casually.'),
            'attempt_count' => array('label' => 'Attempts', 'help' => 'Number of whole-selection attempts.'),
            'claimed_at' => array('label' => 'Claimed at', 'help' => 'Unix timestamp when every entry finalized.'),
            'last_attempt_at' => array('label' => 'Last attempt', 'help' => 'Unix timestamp of the latest selection attempt.'),
            'last_error' => array('label' => 'Last error', 'help' => 'Latest selection-level diagnostic.'),
        ),
        'character_achievement_pending_updates' => array(
            'update_id' => array('label' => 'Update ID', 'help' => 'Durable state-update queue identity.'),
            'character_id' => array('label' => 'Character ID', 'help' => 'Target character that must consume this durable state update.'),
            'source_target_type' => array('label' => 'Original scope', 'help' => 'Character, group, raid, dynamic-zone, or shared-task request that created this row.'),
            'source_target_id' => array('label' => 'Original target ID', 'help' => 'Scope-specific diagnostic identity retained by world.'),
            'operation' => array('label' => 'Operation', 'help' => 'Advance one component or complete the whole achievement.'),
            'achievement_id' => array('label' => 'Achievement ID', 'help' => 'Stable target definition identity.'),
            'component_type' => array('label' => 'Component type', 'help' => 'State-bearing target type for Advance; zero for whole completion.'),
            'component_id' => array('label' => 'Component ID', 'help' => 'Target component identity for Advance; zero is valid.'),
            'requested_value' => array('label' => 'Requested value', 'help' => 'Monotonic progress floor, clamped to required count; zero for whole completion.'),
            'version' => array('label' => 'Source version', 'help' => 'Must exactly match target-zone content or the row blocks.'),
            'status' => array('label' => 'Queue status', 'help' => 'Pending, blocked for diagnosis, or processing under a lease.'),
            'attempt_count' => array('label' => 'Attempts', 'help' => 'Application claim count and compare-and-swap token.'),
            'created_at' => array('label' => 'Created at', 'help' => 'Unix timestamp when world committed this character row.'),
            'last_attempt_at' => array('label' => 'Last attempt', 'help' => 'Unix timestamp when the latest claim began.'),
            'last_error' => array('label' => 'Last error', 'help' => 'Latest blocked or retryable diagnostic.'),
        ),
    );
}

function achievement_enum_labels($group)
{
    $metadata = achievement_metadata();
    if (!isset($metadata[$group]) || !is_array($metadata[$group])) {
        return array();
    }
    $labels = array();
    foreach ($metadata[$group] as $key => $entry) {
        $labels[$key] = is_array($entry) && isset($entry['label']) ? $entry['label'] : (string) $entry;
    }
    return $labels;
}

function achievement_enum_label($group, $value)
{
    $labels = achievement_enum_labels($group);
    return isset($labels[$value]) ? $labels[$value] : 'Unknown (' . $value . ')';
}

function achievement_target_guidance($event_type)
{
    $events = achievement_event_metadata();
    if (!isset($events[$event_type])) {
        return array(
            'target_id_label' => 'Target ID', 'target_id_help' => 'Unknown event type.',
            'target_id2_label' => 'Secondary Target', 'target_id2_help' => 'Unknown event type.',
            'target_value_label' => 'Target Value', 'target_value_help' => 'Unknown event type.',
            'replay' => 'Unknown event type.', 'lookup' => null,
        );
    }
    $event = $events[$event_type];
    return array(
        'target_id_label' => $event['target_id_label'], 'target_id_help' => $event['target_id_help'],
        'target_id2_label' => $event['target_id2_label'], 'target_id2_help' => $event['target_id2_help'],
        'target_value_label' => $event['target_value_label'], 'target_value_help' => $event['target_value_help'],
        'replay' => $event['replay'], 'lookup' => $event['lookup'],
    );
}

function achievement_allowed_progress_modes($event_type)
{
    $events = achievement_event_metadata();
    return isset($events[$event_type]) ? $events[$event_type]['allowed_progress_modes'] : array();
}

function achievement_is_progress_mode_allowed($event_type, $progress_mode)
{
    return in_array((int) $progress_mode, achievement_allowed_progress_modes((int) $event_type), true);
}

function achievement_is_state_bearing_component_type($component_type)
{
    return in_array((int) $component_type, array(0, 1, 2), true);
}

function achievement_boolean_mode_requires_positive_target($event_type)
{
    return in_array((int) $event_type, array(1, 7, 9, 10, 13), true);
}

/** Normalize an NPC name exactly as EQEmu does before hashing it. */
function achievement_canonical_npc_name($name)
{
    $name = (string) $name;
    $canonical = '';
    $has_letter = false;
    $separator_pending = false;
    $length = strlen($name);
    for ($i = 0; $i < $length; ++$i) {
        $byte = ord($name[$i]);
        if ($byte === 32 || $byte === 95) {
            $separator_pending = $has_letter;
            continue;
        }
        if ($byte >= 65 && $byte <= 90) {
            $byte += 32;
        }
        if ($byte < 97 || $byte > 122) {
            continue;
        }
        if ($separator_pending) {
            $canonical .= ' ';
            $separator_pending = false;
        }
        $canonical .= chr($byte);
        $has_letter = true;
    }
    return $canonical;
}

/** Return EQEmu's unsigned 32-bit canonical NPC-name FNV-1a identity. */
function achievement_npc_name_hash($name)
{
    $canonical = achievement_canonical_npc_name($name);
    if ($canonical === '') {
        return 0;
    }
    $hash = 2166136261;
    $length = strlen($canonical);
    for ($i = 0; $i < $length; ++$i) {
        $hash ^= ord($canonical[$i]);
        $hash = ($hash * 16777619) & 0xFFFFFFFF;
    }
    return $hash ? $hash : 0;
}

function achievement_html($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function achievement_field_help($table, $field, $fallback = '')
{
    $fields = achievement_field_metadata();
    return isset($fields[$table][$field]['help']) ? $fields[$table][$field]['help'] : $fallback;
}

/** Add one field-addressable validation finding. */
function achievement_validation_add(&$findings, $path, $message, $severity = 'error')
{
    $findings[] = array(
        'path' => (string) $path,
        'message' => (string) $message,
        'severity' => $severity === 'warning' ? 'warning' : 'error',
    );
}

function achievement_validation_has_errors($findings)
{
    foreach ((array) $findings as $finding) {
        if (!isset($finding['severity']) || $finding['severity'] === 'error') {
            return true;
        }
    }
    return false;
}

/** Flatten findings for flash messages or logs. Set errors_only false to include warnings. */
function achievement_validation_messages($findings, $errors_only = true)
{
    $messages = array();
    foreach ((array) $findings as $finding) {
        $severity = isset($finding['severity']) ? $finding['severity'] : 'error';
        if ($errors_only && $severity !== 'error') {
            continue;
        }
        $path = isset($finding['path']) ? trim((string) $finding['path']) : '';
        $message = isset($finding['message']) ? (string) $finding['message'] : 'Invalid achievement data.';
        $messages[] = ($path === '' ? '' : $path . ': ') . $message;
    }
    return $messages;
}

function achievement_validation_by_path($findings)
{
    $grouped = array();
    foreach ((array) $findings as $finding) {
        $path = isset($finding['path']) ? (string) $finding['path'] : '';
        if (!isset($grouped[$path])) {
            $grouped[$path] = array();
        }
        $grouped[$path][] = $finding;
    }
    return $grouped;
}

/** Return a normalized nonnegative decimal string, or false. */
function achievement_unsigned_string($value)
{
    if (is_bool($value) || is_float($value) || is_array($value) || is_object($value) || $value === null) {
        return false;
    }
    $value = trim((string) $value);
    if ($value === '' || !preg_match('/^[0-9]+$/D', $value)) {
        return false;
    }
    $value = ltrim($value, '0');
    return $value === '' ? '0' : $value;
}

function achievement_decimal_compare($left, $right)
{
    $left = ltrim((string) $left, '0');
    $right = ltrim((string) $right, '0');
    $left = $left === '' ? '0' : $left;
    $right = $right === '' ? '0' : $right;
    if (strlen($left) !== strlen($right)) {
        return strlen($left) < strlen($right) ? -1 : 1;
    }
    return strcmp($left, $right);
}

function achievement_uint_in_range($value, $minimum, $maximum)
{
    $normalized = achievement_unsigned_string($value);
    if ($normalized === false) {
        return false;
    }
    return achievement_decimal_compare($normalized, (string) $minimum) >= 0
        && achievement_decimal_compare($normalized, (string) $maximum) <= 0;
}

function achievement_boolean_value($value, &$valid)
{
    $valid = true;
    if ($value === true || $value === 1 || $value === '1' || $value === 'on' || $value === 'yes' || $value === 'true') {
        return 1;
    }
    if ($value === false || $value === 0 || $value === '0' || $value === 'off' || $value === 'no' || $value === 'false' || $value === '') {
        return 0;
    }
    $valid = false;
    return 0;
}

function achievement_text_length($value)
{
    if (function_exists('mb_strlen')) {
        return mb_strlen((string) $value, 'UTF-8');
    }
    return strlen((string) $value);
}

function achievement_validate_uint_field($data, $field, $path, $minimum, $maximum, &$findings, $required = true)
{
    if (!is_array($data) || !array_key_exists($field, $data) || $data[$field] === '') {
        if ($required) {
            achievement_validation_add($findings, $path, 'This field is required.');
        }
        return null;
    }
    if (!achievement_uint_in_range($data[$field], $minimum, $maximum)) {
        achievement_validation_add(
            $findings,
            $path,
            'Enter a whole number from ' . $minimum . ' through ' . $maximum . '.'
        );
        return null;
    }
    return achievement_unsigned_string($data[$field]);
}

function achievement_validate_boolean_field($data, $field, $path, &$findings, $default = null)
{
    if (!is_array($data) || !array_key_exists($field, $data)) {
        if ($default === null) {
            achievement_validation_add($findings, $path, 'Choose enabled or disabled.');
            return null;
        }
        return (int) $default;
    }
    $valid = false;
    $value = achievement_boolean_value($data[$field], $valid);
    if (!$valid) {
        achievement_validation_add($findings, $path, 'Choose enabled or disabled.');
        return null;
    }
    return $value;
}

function achievement_validate_text_field($data, $field, $path, &$findings, $required, $maximum = null)
{
    if (!is_array($data) || !array_key_exists($field, $data) || is_array($data[$field]) || is_object($data[$field])) {
        if ($required) {
            achievement_validation_add($findings, $path, 'This text field is required.');
        }
        return '';
    }
    $value = (string) $data[$field];
    if ($required && trim($value) === '') {
        achievement_validation_add($findings, $path, 'Enter a value; whitespace alone is not a usable label.');
    }
    if ($maximum !== null && achievement_text_length($value) > $maximum) {
        achievement_validation_add($findings, $path, 'Use no more than ' . $maximum . ' characters.');
    }
    return $value;
}

function achievement_context_id_set($context, $key)
{
    if (!isset($context[$key]) || !is_array($context[$key])) {
        return null;
    }
    $values = $context[$key];
    $is_list = count($values) === 0 || array_keys($values) === range(0, count($values) - 1);
    $set = array();
    foreach ($values as $index => $value) {
        $id = $is_list ? $value : $index;
        $normalized = achievement_unsigned_string($id);
        if ($normalized !== false) {
            $set[$normalized] = true;
        }
    }
    return $set;
}

function achievement_validate_category_lineage($parent_map, $category_id, $path, &$findings)
{
    if (!is_array($parent_map)) {
        return;
    }
    $parents = array();
    foreach ($parent_map as $id => $parent_id) {
        $normalized_id = achievement_unsigned_string($id);
        $normalized_parent = achievement_unsigned_string($parent_id);
        if ($normalized_id !== false && $normalized_parent !== false) {
            $parents[$normalized_id] = $normalized_parent;
        }
    }
    $cursor = achievement_unsigned_string($category_id);
    $seen = array();
    while ($cursor !== false && $cursor !== '0') {
        if (isset($seen[$cursor])) {
            achievement_validation_add($findings, $path, 'The selected category hierarchy contains a parent cycle.');
            return;
        }
        $seen[$cursor] = true;
        if (!array_key_exists($cursor, $parents)) {
            achievement_validation_add($findings, $path, 'The selected category hierarchy references missing category ' . $cursor . '.');
            return;
        }
        $cursor = $parents[$cursor];
    }
}

/**
 * Validate a complete achievement aggregate.
 *
 * Empty return means valid. Warnings are advisory; only severity=error blocks
 * a save. The expected graph uses associations[], components[].criteria[],
 * rewards[] (with optional option_id), reward_set.options[], and restrictions[].
 */
function achievement_validate_definition($definition, $existing_id = null, $context = array())
{
    $findings = array();
    if (!is_array($definition)) {
        achievement_validation_add($findings, '', 'The achievement definition must be an object/array.');
        return $findings;
    }

    $id = achievement_validate_uint_field($definition, 'id', 'id', '1', ACHIEVEMENT_UINT32_MAX, $findings);
    achievement_validate_text_field($definition, 'name', 'name', $findings, true, 255);
    achievement_validate_text_field($definition, 'description', 'description', $findings, false, null);
    achievement_validate_uint_field($definition, 'icon_id', 'icon_id', '0', ACHIEVEMENT_UINT32_MAX, $findings);
    achievement_validate_uint_field($definition, 'points', 'points', '0', ACHIEVEMENT_UINT32_MAX, $findings);
    achievement_validate_boolean_field($definition, 'has_reward', 'has_reward', $findings);
    achievement_validate_uint_field($definition, 'client_flag', 'client_flag', '0', ACHIEVEMENT_UINT8_MAX, $findings);
    achievement_validate_uint_field($definition, 'version', 'version', '0', ACHIEVEMENT_UINT32_MAX, $findings);
    achievement_validate_boolean_field($definition, 'reset_on_version_change', 'reset_on_version_change', $findings);
    $definition_enabled = achievement_validate_boolean_field($definition, 'enabled', 'enabled', $findings);

    if ($existing_id !== null && $id !== null) {
        $stable_id = achievement_unsigned_string($existing_id);
        if ($stable_id === false || $stable_id !== $id) {
            achievement_validation_add($findings, 'id', 'The stable achievement ID cannot be changed after creation.');
        }
    }

    $associations = isset($definition['associations']) && is_array($definition['associations'])
        ? $definition['associations'] : array();
    if (!array_key_exists('associations', $definition) || !is_array($definition['associations'])) {
        achievement_validation_add($findings, 'associations', 'Category associations must be supplied as a list.');
    }
    $known_categories = achievement_context_id_set($context, 'category_ids');
    $seen_categories = array();
    foreach ($associations as $index => $association) {
        $path = 'associations.' . $index;
        if (!is_array($association)) {
            achievement_validation_add($findings, $path, 'This category association is not a valid row.');
            continue;
        }
        $category_id = achievement_validate_uint_field($association, 'category_id', $path . '.category_id', '1', ACHIEVEMENT_UINT32_MAX, $findings);
        achievement_validate_uint_field($association, 'sequence', $path . '.sequence', '0', ACHIEVEMENT_UINT32_MAX, $findings);
        achievement_validate_text_field($association, 'display_text', $path . '.display_text', $findings, false, 255);
        if ($category_id === null) {
            continue;
        }
        if (isset($seen_categories[$category_id])) {
            achievement_validation_add($findings, $path . '.category_id', 'An achievement may be associated with a category only once.');
        }
        $seen_categories[$category_id] = true;
        if ($known_categories !== null && !isset($known_categories[$category_id])) {
            achievement_validation_add($findings, $path . '.category_id', 'Category ' . $category_id . ' does not exist.');
        }
        if (isset($context['category_parent_map'])) {
            achievement_validate_category_lineage($context['category_parent_map'], $category_id, $path . '.category_id', $findings);
        }
    }
    if ($definition_enabled === 1 && count($seen_categories) === 0) {
        achievement_validation_add($findings, 'associations', 'An enabled achievement must have at least one valid category association.');
    }

    $components = isset($definition['components']) && is_array($definition['components'])
        ? $definition['components'] : array();
    if (!array_key_exists('components', $definition) || !is_array($definition['components'])) {
        achievement_validation_add($findings, 'components', 'Components must be supplied as a list.');
    }
    $component_keys = array();
    $component_sequences = array();
    $presentation_counts = array();
    $criterion_row_ids = array();
    $required_classes = array();
    $dependency_targets = array();
    $has_enabled_criterion = false;
    $has_required_criterion = false;

    foreach ($components as $component_index => $component) {
        $path = 'components.' . $component_index;
        if (!is_array($component)) {
            achievement_validation_add($findings, $path, 'This component is not a valid row.');
            continue;
        }
        $component_type_text = achievement_validate_uint_field($component, 'component_type', $path . '.component_type', '0', '3', $findings);
        $component_sequence = achievement_validate_uint_field($component, 'sequence', $path . '.sequence', '0', ACHIEVEMENT_UINT32_MAX, $findings);
        $component_id = achievement_validate_uint_field($component, 'component_id', $path . '.component_id', '0', ACHIEVEMENT_UINT32_MAX, $findings);
        achievement_validate_text_field($component, 'name', $path . '.name', $findings, false, null);
        achievement_validate_text_field($component, 'description', $path . '.description', $findings, false, null);
        $count_field = array_key_exists('presentation_count', $component) ? 'presentation_count' : 'required_count';
        $presentation_count = achievement_validate_uint_field($component, $count_field, $path . '.presentation_count', '1', ACHIEVEMENT_UINT32_MAX, $findings);

        $component_type = $component_type_text === null ? null : (int) $component_type_text;
        if ($component_type !== null && $component_id !== null) {
            $component_key = $component_type . ':' . $component_id;
            if (isset($component_keys[$component_key])) {
                achievement_validation_add($findings, $path . '.component_id', 'Component identity (wire type plus component ID) must be unique within the achievement.');
            }
            $component_keys[$component_key] = true;
        }
        if ($component_type !== null && $component_sequence !== null) {
            $sequence_key = $component_type . ':' . $component_sequence;
            if (isset($component_sequences[$sequence_key])) {
                achievement_validation_add($findings, $path . '.sequence', 'Another component in this wire type uses the same display order; RoF2 will break the tie by component ID.', 'warning');
            }
            $component_sequences[$sequence_key] = true;
            if (achievement_decimal_compare($component_sequence, '255') > 0) {
                achievement_validation_add($findings, $path . '.sequence', 'RoF2 clamps component display order above 255. Use 0 through 255 when exact client order matters.', 'warning');
            }
        }
        if ($component_id !== null && $presentation_count !== null) {
            if (isset($presentation_counts[$component_id]) && $presentation_counts[$component_id] !== $presentation_count) {
                achievement_validation_add($findings, $path . '.presentation_count', 'Components sharing a component ID must share one global presentation count.');
            }
            $presentation_counts[$component_id] = $presentation_count;
        }

        $criteria = isset($component['criteria']) && is_array($component['criteria']) ? $component['criteria'] : array();
        if (!array_key_exists('criteria', $component) || !is_array($component['criteria'])) {
            achievement_validation_add($findings, $path . '.criteria', 'Criteria must be supplied as a list, even when it is empty.');
        }
        $criterion_identities = array();
        $enabled_policy = null;

        foreach ($criteria as $criterion_index => $criterion) {
            $criterion_path = $path . '.criteria.' . $criterion_index;
            if (!is_array($criterion)) {
                achievement_validation_add($findings, $criterion_path, 'This criterion is not a valid row.');
                continue;
            }
            $criterion_id = null;
            if (array_key_exists('id', $criterion) && $criterion['id'] !== '' && $criterion['id'] !== null) {
                $criterion_id = achievement_validate_uint_field($criterion, 'id', $criterion_path . '.id', '1', ACHIEVEMENT_UINT64_MAX, $findings);
                if ($criterion_id !== null) {
                    if (isset($criterion_row_ids[$criterion_id])) {
                        achievement_validation_add($findings, $criterion_path . '.id', 'A criterion database row ID may appear only once in the submitted graph.');
                    }
                    $criterion_row_ids[$criterion_id] = true;
                }
            }
            $event_text = achievement_validate_uint_field($criterion, 'event_type', $criterion_path . '.event_type', '0', '13', $findings);
            $mode_text = achievement_validate_uint_field($criterion, 'progress_mode', $criterion_path . '.progress_mode', '0', '3', $findings);
            $behavior_text = achievement_validate_uint_field($criterion, 'behavior', $criterion_path . '.behavior', '0', '5', $findings);
            $target_id = achievement_validate_uint_field($criterion, 'target_id', $criterion_path . '.target_id', '0', ACHIEVEMENT_UINT32_MAX, $findings);
            $target_id2 = achievement_validate_uint_field($criterion, 'target_id2', $criterion_path . '.target_id2', '0', ACHIEVEMENT_UINT32_MAX, $findings);
            $target_value = achievement_validate_uint_field($criterion, 'target_value', $criterion_path . '.target_value', '0', ACHIEVEMENT_INT64_MAX, $findings);
            $required_count = achievement_validate_uint_field($criterion, 'required_count', $criterion_path . '.required_count', '1', ACHIEVEMENT_UINT32_MAX, $findings);
            $criterion_enabled = achievement_validate_boolean_field($criterion, 'enabled', $criterion_path . '.enabled', $findings);

            if (array_key_exists('achievement_id', $criterion) && $id !== null && achievement_unsigned_string($criterion['achievement_id']) !== $id) {
                achievement_validation_add($findings, $criterion_path . '.achievement_id', 'The criterion must belong to the achievement being edited.');
            }
            if (array_key_exists('component_type', $criterion) && $component_type_text !== null && achievement_unsigned_string($criterion['component_type']) !== $component_type_text) {
                achievement_validation_add($findings, $criterion_path . '.component_type', 'The criterion wire type must match its containing component.');
            }
            if (array_key_exists('component_id', $criterion) && $component_id !== null && achievement_unsigned_string($criterion['component_id']) !== $component_id) {
                achievement_validation_add($findings, $criterion_path . '.component_id', 'The criterion component ID must match its containing component.');
            }
            if (array_key_exists('component_sequence', $criterion) && $component_sequence !== null && achievement_unsigned_string($criterion['component_sequence']) !== $component_sequence) {
                achievement_validation_add($findings, $criterion_path . '.component_sequence', 'Keep the criterion component-order copy synchronized with the containing component.', 'warning');
            }

            if ($event_text === null || $mode_text === null || $behavior_text === null || $target_id === null || $target_id2 === null || $target_value === null || $required_count === null) {
                continue;
            }
            $event = (int) $event_text;
            $mode = (int) $mode_text;
            $behavior = (int) $behavior_text;
            $identity = $event . ':' . $target_id . ':' . $target_id2;
            if (isset($criterion_identities[$identity])) {
                achievement_validation_add($findings, $criterion_path . '.target_id', 'Criterion event and target identity must be unique for this component.');
            }
            $criterion_identities[$identity] = true;

            if (!achievement_is_progress_mode_allowed($event, $mode)) {
                achievement_validation_add($findings, $criterion_path . '.progress_mode', 'This progress mode is unsafe for the selected replayed or absolute event. Choose Highest, Set, or Boolean.');
            }
            if ($target_id2 !== '0' && !in_array($event, array(7, 12, 13), true)) {
                achievement_validation_add($findings, $criterion_path . '.target_id2', 'This event does not support a secondary target; use 0.');
            }
            if (in_array($event, array(1, 10), true) && $target_id !== '0') {
                achievement_validation_add($findings, $criterion_path . '.target_id', 'Level and Alternate Advancement criteria must use target ID 0.');
            }
            if ($event === 4 && $target_id === '0') {
                achievement_validation_add($findings, $criterion_path . '.target_id', 'Task Complete requires a specific nonzero task ID so one-time completion can be reconciled.');
            }
            if ($event === 7 && $target_id2 !== '0' && !achievement_uint_in_range($target_id2, '1', '16')) {
                achievement_validation_add($findings, $criterion_path . '.target_id2', 'Own Item class must be 0 (any class) or an EQ class ID from 1 through 16.');
            }
            if ($event === 9 && $target_id !== ACHIEVEMENT_SKILL_WILDCARD && !achievement_uint_in_range($target_id, '0', '77')) {
                achievement_validation_add($findings, $criterion_path . '.target_id', 'Skill Value requires skill ID 0 through 77, or 4294967295 for the wildcard.');
            }
            if ($event === 12 && $target_id === '0') {
                achievement_validation_add($findings, $criterion_path . '.target_id', 'NPC Name Kill requires a nonzero canonical-name hash.');
            }
            if ($event === 13) {
                if (!achievement_uint_in_range($target_id, '0', '77')) {
                    achievement_validation_add($findings, $criterion_path . '.target_id', 'Skill Cap requires a canonical skill ID from 0 through 77.');
                }
                if (!achievement_uint_in_range($target_id2, '1', '16')) {
                    achievement_validation_add($findings, $criterion_path . '.target_id2', 'Skill Cap requires an EQ class ID from 1 through 16.');
                }
                if (!achievement_uint_in_range($target_value, '1', '255')) {
                    achievement_validation_add($findings, $criterion_path . '.target_value', 'Skill Cap milestone level must be from 1 through 255.');
                }
            }
            if ($mode === 3 && achievement_boolean_mode_requires_positive_target($event) && $target_value === '0') {
                achievement_validation_add($findings, $criterion_path . '.target_value', 'Boolean mode requires a positive target value for this absolute event.');
            }

            if ($criterion_enabled === 1) {
                $has_enabled_criterion = true;
                if ($component_type === 3) {
                    achievement_validation_add($findings, $criterion_path . '.enabled', 'RoF2 component type 3 is presentation-only and cannot have an enabled criterion.');
                }
                $policy = $event . ':' . $mode . ':' . $behavior . ':' . $required_count;
                if ($enabled_policy !== null && $enabled_policy !== $policy) {
                    achievement_validation_add($findings, $criterion_path, 'Enabled alternative criteria for one component must agree on event, progress mode, behavior, and required count.');
                }
                $enabled_policy = $policy;
                if ($behavior === 0) {
                    $has_required_criterion = true;
                }
                if (in_array($behavior, array(0, 2, 3), true) && in_array($event, array(7, 13), true) && achievement_uint_in_range($target_id2, '1', '16')) {
                    $required_classes[$target_id2] = true;
                }
                if ($event === 11 && $target_id !== '0') {
                    $dependency_targets[$target_id] = true;
                    if ($id !== null && $target_id === $id) {
                        achievement_validation_add($findings, $criterion_path . '.target_id', 'An enabled achievement cannot depend on its own completion.');
                    }
                }
            }
        }
    }

    if (count($required_classes) > 1) {
        achievement_validation_add($findings, 'components', 'Required, Unlock, and Visibility class criteria must agree on one EQ class.');
    }
    if ($definition_enabled === 1 && count($components) === 0) {
        achievement_validation_add($findings, 'components', 'This enabled definition has no visible components. Direct completion can still work, but the client will have no authored steps.', 'warning');
    }
    if ($definition_enabled === 1 && $has_enabled_criterion && !$has_required_criterion) {
        achievement_validation_add($findings, 'components', 'No enabled criterion uses Required behavior, so criteria alone cannot complete this achievement. Unlock and Visibility rows are gates, not completion requirements.', 'warning');
    }

    $known_achievements = achievement_context_id_set($context, 'achievement_ids');
    if ($known_achievements !== null) {
        foreach ($dependency_targets as $target_id => $unused) {
            if (($id === null || $target_id !== $id) && !isset($known_achievements[$target_id])) {
                achievement_validation_add($findings, 'components', 'Achievement Complete criterion references missing achievement ' . $target_id . '.');
            }
        }
    }
    if ($id !== null && count($dependency_targets) > 0 && isset($context['dependency_edges']) && is_array($context['dependency_edges'])) {
        $edges = achievement_normalize_dependency_edges($context['dependency_edges']);
        $edges[$id] = array_keys($dependency_targets);
        if (achievement_dependency_has_cycle_from($edges, $id)) {
            achievement_validation_add($findings, 'components', 'Enabled achievement-completion criteria would create a dependency cycle.');
        }
    }

    achievement_validate_definition_rewards(
        $definition,
        $existing_id,
        $context,
        $definition_enabled,
        $findings
    );
    achievement_validate_definition_restrictions($definition, $context, $definition_enabled, $findings);

    return $findings;
}

function achievement_normalize_dependency_edges($raw_edges)
{
    $edges = array();
    foreach ((array) $raw_edges as $source => $targets) {
        $source_id = achievement_unsigned_string($source);
        if ($source_id === false) {
            continue;
        }
        $edges[$source_id] = array();
        foreach ((array) $targets as $target) {
            $target_id = achievement_unsigned_string($target);
            if ($target_id !== false && $target_id !== '0') {
                $edges[$source_id][] = $target_id;
            }
        }
    }
    return $edges;
}

function achievement_dependency_has_cycle_from($edges, $start)
{
    $visiting = array();
    $visited = array();
    return achievement_dependency_walk($edges, (string) $start, $visiting, $visited);
}

function achievement_dependency_walk($edges, $node, &$visiting, &$visited)
{
    if (isset($visiting[$node])) {
        return true;
    }
    if (isset($visited[$node])) {
        return false;
    }
    $visiting[$node] = true;
    $targets = isset($edges[$node]) ? $edges[$node] : array();
    foreach ($targets as $target) {
        if (achievement_dependency_walk($edges, (string) $target, $visiting, $visited)) {
            return true;
        }
    }
    unset($visiting[$node]);
    $visited[$node] = true;
    return false;
}

/** Validate only a grant that the active runtime could currently deliver. */
function achievement_validate_runtime_reward_semantics(
    $reward_type,
    $data_id,
    $amount,
    $path,
    &$findings
) {
    $types = achievement_reward_type_metadata();
    $type = (int) $reward_type;
    if (!isset($types[$type])) {
        return;
    }
    $constraints = $types[$type];
    if (isset($constraints['data_values'])) {
        $valid_data = false;
        foreach ($constraints['data_values'] as $allowed) {
            if (achievement_uint_in_range($data_id, $allowed, $allowed)) {
                $valid_data = true;
                break;
            }
        }
        if (!$valid_data) {
            achievement_validation_add(
                $findings,
                $path . '.reward_data_id',
                $constraints['data_help']
            );
        }
    } elseif (isset($constraints['data_min'], $constraints['data_max'])
        && !achievement_uint_in_range($data_id, $constraints['data_min'], $constraints['data_max'])) {
        achievement_validation_add(
            $findings,
            $path . '.reward_data_id',
            $constraints['data_help']
        );
    }

    if (isset($constraints['amount_values'])) {
        $valid_amount = false;
        foreach ($constraints['amount_values'] as $allowed) {
            if (achievement_uint_in_range($amount, $allowed, $allowed)) {
                $valid_amount = true;
                break;
            }
        }
        if (!$valid_amount) {
            achievement_validation_add($findings, $path . '.amount', $constraints['amount_help']);
        }
    } elseif (isset($constraints['amount_min'], $constraints['amount_max'])
        && !achievement_uint_in_range($amount, $constraints['amount_min'], $constraints['amount_max'])) {
        achievement_validation_add($findings, $path . '.amount', $constraints['amount_help']);
    }
}

function achievement_validate_definition_rewards($definition, $existing_id, $context, $definition_enabled, &$findings)
{
    $rewards = isset($definition['rewards']) && is_array($definition['rewards'])
        ? $definition['rewards'] : array();
    if (!array_key_exists('rewards', $definition) || !is_array($definition['rewards'])) {
        achievement_validation_add($findings, 'rewards', 'Rewards must be supplied as a list, even when it is empty.');
    }

    $reward_set = null;
    if (array_key_exists('reward_set', $definition) && $definition['reward_set'] !== null && $definition['reward_set'] !== '') {
        if (!is_array($definition['reward_set'])) {
            achievement_validation_add($findings, 'reward_set', 'The selectable reward set must be an object/array.');
        } else {
            $reward_set = $definition['reward_set'];
            if (array_key_exists('present', $reward_set)) {
                $valid = false;
                $present = achievement_boolean_value($reward_set['present'], $valid);
                if (!$valid) {
                    achievement_validation_add($findings, 'reward_set.present', 'Choose whether a selectable reward set is present.');
                } elseif ($present === 0) {
                    $reward_set = null;
                }
            }
        }
    }

    $option_ids = array();
    $option_enabled = array();
    $option_common = array();
    $option_paths = array();
    $explicit_grants = array();
    $set_enabled = 0;
    $source_enabled = 0;
    $reward_set_id = null;
    if ($reward_set !== null) {
        if (array_key_exists('reward_set_id', $reward_set) && $reward_set['reward_set_id'] !== '' && $reward_set['reward_set_id'] !== null) {
            $reward_set_id = achievement_validate_uint_field($reward_set, 'reward_set_id', 'reward_set.reward_set_id', '1', ACHIEVEMENT_UINT32_MAX, $findings);
        }
        achievement_validate_text_field($reward_set, 'title', 'reward_set.title', $findings, false, 255);
        $set_enabled_value = achievement_validate_boolean_field($reward_set, 'enabled', 'reward_set.enabled', $findings);
        $set_enabled = $set_enabled_value === null ? 0 : $set_enabled_value;
        $source_enabled_value = achievement_validate_boolean_field(
            $reward_set,
            'source_enabled',
            'reward_set.source_enabled',
            $findings
        );
        $source_enabled = $source_enabled_value === null ? 0 : $source_enabled_value;

        $existing_set_id = isset($context['existing_reward_set_id'])
            ? achievement_unsigned_string($context['existing_reward_set_id']) : false;
        if ($existing_set_id !== false) {
            if ($reward_set_id === null || $reward_set_id !== $existing_set_id) {
                achievement_validation_add($findings, 'reward_set.reward_set_id', 'The stable reward-set ID cannot be changed or cleared after creation.');
            }
        } elseif ($reward_set_id !== null) {
            $known_sets = achievement_context_id_set($context, 'known_reward_set_ids');
            if ($known_sets !== null && isset($known_sets[$reward_set_id])) {
                achievement_validation_add($findings, 'reward_set.reward_set_id', 'Reward-set ID ' . $reward_set_id . ' is already used by another definition.');
            }
        }

        $options = isset($reward_set['options']) && is_array($reward_set['options'])
            ? $reward_set['options'] : array();
        if (!array_key_exists('options', $reward_set) || !is_array($reward_set['options'])) {
            achievement_validation_add($findings, 'reward_set.options', 'Reward options must be supplied as a list.');
        }
        $option_sequences = array();
        foreach ($options as $option_index => $option) {
            $path = 'reward_set.options.' . $option_index;
            if (!is_array($option)) {
                achievement_validation_add($findings, $path, 'This reward option is not a valid row.');
                continue;
            }
            $option_id = achievement_validate_uint_field($option, 'option_id', $path . '.option_id', '1', ACHIEVEMENT_UINT32_MAX, $findings);
            $sequence = achievement_validate_uint_field($option, 'sequence', $path . '.sequence', '0', ACHIEVEMENT_UINT32_MAX, $findings);
            achievement_validate_text_field($option, 'label', $path . '.label', $findings, false, 255);
            $common = achievement_validate_boolean_field($option, 'common_to_all', $path . '.common_to_all', $findings);
            achievement_validate_uint_field($option, 'flags', $path . '.flags', '0', ACHIEVEMENT_UINT8_MAX, $findings);
            $enabled = achievement_validate_boolean_field($option, 'enabled', $path . '.enabled', $findings);

            if ($option_id !== null) {
                if (isset($option_ids[$option_id])) {
                    achievement_validation_add($findings, $path . '.option_id', 'Option IDs must be unique within a reward set.');
                }
                $option_ids[$option_id] = true;
                $option_enabled[$option_id] = $enabled === 1;
                $option_common[$option_id] = $common === 1;
                $option_paths[$option_id] = $path;
            }
            if ($sequence !== null) {
                if (isset($option_sequences[$sequence])) {
                    achievement_validation_add($findings, $path . '.sequence', 'Another option uses this display order; the client will break the tie by option ID.', 'warning');
                }
                $option_sequences[$sequence] = true;
            }

            foreach (array('reward_ids', 'grants') as $grant_key) {
                if (!isset($option[$grant_key])) {
                    continue;
                }
                if (!is_array($option[$grant_key])) {
                    achievement_validation_add($findings, $path . '.' . $grant_key, 'Option grants must be supplied as a list of reward IDs.');
                    continue;
                }
                foreach ($option[$grant_key] as $grant_index => $grant) {
                    $grant_value = is_array($grant) && isset($grant['reward_id']) ? $grant['reward_id'] : $grant;
                    $grant_id = achievement_unsigned_string($grant_value);
                    if ($grant_id === false || $grant_id === '0') {
                        achievement_validation_add($findings, $path . '.' . $grant_key . '.' . $grant_index, 'Select a valid nonzero reward ID.');
                        continue;
                    }
                    if (isset($explicit_grants[$grant_id]) && $explicit_grants[$grant_id] !== $option_id) {
                        achievement_validation_add($findings, $path . '.' . $grant_key . '.' . $grant_index, 'A canonical reward may belong to only one selectable option.');
                    }
                    $explicit_grants[$grant_id] = $option_id;
                }
            }
        }
    }

    $reward_ids = array();
    $reward_enabled_by_id = array();
    $automatic_sequences = array();
    $option_sequences = array();
    $reward_mappings = array();
    $enabled_grants_by_option = array();
    $existing_reward_ids = achievement_context_id_set($context, 'existing_reward_ids');
    foreach ($rewards as $index => $reward) {
        $path = 'rewards.' . $index;
        if (!is_array($reward)) {
            achievement_validation_add($findings, $path, 'This reward is not a valid row.');
            continue;
        }
        $reward_id = null;
        if (array_key_exists('reward_id', $reward) && $reward['reward_id'] !== '' && $reward['reward_id'] !== null) {
            $reward_id = achievement_validate_uint_field($reward, 'reward_id', $path . '.reward_id', '1', ACHIEVEMENT_UINT64_MAX, $findings);
        }
        $sequence = achievement_validate_uint_field($reward, 'sequence', $path . '.sequence', '0', ACHIEVEMENT_UINT32_MAX, $findings);
        $type_text = achievement_validate_uint_field($reward, 'reward_type', $path . '.reward_type', '0', '5', $findings);
        $data_id = achievement_validate_uint_field($reward, 'reward_data_id', $path . '.reward_data_id', '0', ACHIEVEMENT_UINT32_MAX, $findings);
        $amount = achievement_validate_uint_field($reward, 'amount', $path . '.amount', '1', ACHIEVEMENT_UINT64_MAX, $findings);
        achievement_validate_text_field($reward, 'description', $path . '.description', $findings, false, 255);
        $enabled_value = achievement_validate_boolean_field($reward, 'enabled', $path . '.enabled', $findings);
        $enabled = $enabled_value === 1;
        $option_id = null;
        if (array_key_exists('option_id', $reward) && $reward['option_id'] !== '' && $reward['option_id'] !== null) {
            $option_id = achievement_validate_uint_field($reward, 'option_id', $path . '.option_id', '1', ACHIEVEMENT_UINT32_MAX, $findings);
        }

        if ($reward_id !== null) {
            if (isset($reward_ids[$reward_id])) {
                achievement_validation_add($findings, $path . '.reward_id', 'A canonical reward ID may appear only once in this definition.');
            }
            $reward_ids[$reward_id] = $path;
            $reward_enabled_by_id[$reward_id] = $enabled;
            if ($existing_id !== null && $existing_reward_ids !== null && !isset($existing_reward_ids[$reward_id])) {
                achievement_validation_add($findings, $path . '.reward_id', 'Existing reward IDs are immutable and cannot be adopted from another achievement. Add a new reward without supplying an ID.');
            }
            if ($enabled && !achievement_uint_in_range($reward_id, '1', ACHIEVEMENT_UINT32_MAX)) {
                achievement_validation_add($findings, $path . '.reward_id', 'Enabled reward IDs must fit the unsigned 32-bit RoF2 wire field.');
            }
        }
        $runtime_reachable = $definition_enabled === 1 && $enabled;
        if ($option_id !== null) {
            $runtime_reachable = $runtime_reachable
                && $reward_set !== null
                && $source_enabled === 1
                && $set_enabled === 1
                && isset($option_enabled[$option_id])
                && $option_enabled[$option_id];
        }
        if ($runtime_reachable && $type_text !== null && $data_id !== null && $amount !== null) {
            achievement_validate_runtime_reward_semantics(
                $type_text,
                $data_id,
                $amount,
                $path,
                $findings
            );
        }
        if ($option_id !== null) {
            if ($reward_set === null) {
                achievement_validation_add($findings, $path . '.option_id', 'A reward mapping requires a selectable reward set. Clear the option for automatic delivery or add the set.');
            } elseif (!isset($option_ids[$option_id])) {
                achievement_validation_add($findings, $path . '.option_id', 'The mapped reward option does not exist in this reward set.');
            } else {
                if ($reward_id !== null) {
                    $reward_mappings[$reward_id] = $option_id;
                }
                if ($enabled) {
                    $enabled_grants_by_option[$option_id] = isset($enabled_grants_by_option[$option_id])
                        ? $enabled_grants_by_option[$option_id] + 1 : 1;
                }
                if ($enabled && !$option_enabled[$option_id]) {
                    achievement_validation_add($findings, $path . '.option_id', 'This enabled reward is mapped to a disabled option. It remains mapped and will not fall back to automatic delivery.', 'warning');
                }
                if ($sequence !== null) {
                    $option_sequence_key = $option_id . ':' . $sequence;
                    if (isset($option_sequences[$option_sequence_key])) {
                        achievement_validation_add($findings, $path . '.sequence', 'Another grant in this option uses the same display order; the client will break the tie by reward ID.', 'warning');
                    }
                    $option_sequences[$option_sequence_key] = true;
                }
            }
        } elseif ($sequence !== null) {
            if (isset($automatic_sequences[$sequence])) {
                achievement_validation_add($findings, $path . '.sequence', 'Automatic reward order must be unique within this achievement source.');
            }
            $automatic_sequences[$sequence] = true;
        }
    }

    foreach ($explicit_grants as $reward_id => $option_id) {
        if (!isset($reward_ids[$reward_id])) {
            achievement_validation_add($findings, isset($option_paths[$option_id]) ? $option_paths[$option_id] : 'reward_set.options', 'Mapped reward ' . $reward_id . ' does not exist in this achievement.');
            continue;
        }
        if (isset($reward_mappings[$reward_id]) && $reward_mappings[$reward_id] !== $option_id) {
            achievement_validation_add($findings, $reward_ids[$reward_id] . '.option_id', 'This reward is mapped to two different selectable options.');
            continue;
        }
        $reward_mappings[$reward_id] = $option_id;
        if (isset($reward_enabled_by_id[$reward_id]) && $reward_enabled_by_id[$reward_id] && isset($option_ids[$option_id])) {
            $enabled_grants_by_option[$option_id] = isset($enabled_grants_by_option[$option_id])
                ? $enabled_grants_by_option[$option_id] + 1 : 1;
        }
    }

    if ($reward_set !== null && $set_enabled === 1 && $source_enabled !== 1) {
        achievement_validation_add(
            $findings,
            'reward_set.source_enabled',
            'This achievement-to-set source is disabled. The selectable catalog remains staged but cannot be previewed or claimed from this achievement.',
            'warning'
        );
    }
    if ($reward_set !== null && $source_enabled === 1 && $set_enabled !== 1) {
        achievement_validation_add(
            $findings,
            'reward_set.enabled',
            'This source is enabled but the shared reward-set catalog row is disabled. The selectable rewards remain staged and inactive.',
            'warning'
        );
    }
    if ($reward_set !== null && $definition_enabled !== 1 && $source_enabled === 1 && $set_enabled === 1) {
        achievement_validation_add(
            $findings,
            'enabled',
            'The selectable reward path is authored and enabled, but it is unreachable while this achievement definition is disabled.',
            'warning'
        );
    }

    if ($reward_set !== null
        && $definition_enabled === 1
        && $source_enabled === 1
        && $set_enabled === 1) {
        $has_enabled_option = false;
        $has_selectable_option = false;
        foreach ($option_ids as $option_id => $unused) {
            if (!$option_enabled[$option_id]) {
                continue;
            }
            $has_enabled_option = true;
            if (!$option_common[$option_id]) {
                $has_selectable_option = true;
            }
            if (empty($enabled_grants_by_option[$option_id])) {
                achievement_validation_add($findings, $option_paths[$option_id], 'Every enabled reward option must contain at least one enabled grant.');
            }
        }
        if (!$has_enabled_option || !$has_selectable_option) {
            achievement_validation_add($findings, 'reward_set.options', 'An enabled reward set requires at least one enabled, non-common selectable option. Common rows are combined with a choice but are not choices themselves.');
        }
    }
}

function achievement_validate_definition_restrictions($definition, $context, $definition_enabled, &$findings)
{
    $restrictions = isset($definition['restrictions']) && is_array($definition['restrictions'])
        ? $definition['restrictions'] : array();
    if (!array_key_exists('restrictions', $definition) || !is_array($definition['restrictions'])) {
        achievement_validation_add($findings, 'restrictions', 'Cast restrictions must be supplied as a list, even when it is empty.');
    }
    $known = achievement_context_id_set($context, 'known_restriction_ids');
    $seen = array();
    foreach ($restrictions as $index => $restriction) {
        $path = 'restrictions.' . $index;
        if (!is_array($restriction)) {
            achievement_validation_add($findings, $path, 'This cast restriction is not a valid row.');
            continue;
        }
        $restriction_id = achievement_validate_uint_field($restriction, 'restriction_id', $path . '.restriction_id', '1', ACHIEVEMENT_UINT32_MAX, $findings);
        achievement_validate_boolean_field($restriction, 'requires_completed', $path . '.requires_completed', $findings);
        if ($restriction_id === null) {
            continue;
        }
        if (isset($seen[$restriction_id])) {
            achievement_validation_add($findings, $path . '.restriction_id', 'A restriction ID may be attached to this achievement only once. All rows sharing an ID are ANDed, so duplicate or contradictory rows are unsafe.');
        }
        $seen[$restriction_id] = true;
        if ($known !== null && !isset($known[$restriction_id])) {
            achievement_validation_add($findings, $path . '.restriction_id', 'Spell restriction ' . $restriction_id . ' is not present in the supplied restriction catalog.');
        }
    }
    if ($definition_enabled === 0 && count($restrictions) > 0) {
        achievement_validation_add($findings, 'restrictions', 'Cast-restriction rows for a disabled achievement are inactive until the definition is enabled.', 'warning');
    }
}

/** Validate a category record plus its proposed parent lineage. */
function achievement_validate_category($category, $existing_id = null, $context = array())
{
    $findings = array();
    if (!is_array($category)) {
        achievement_validation_add($findings, '', 'The achievement category must be an object/array.');
        return $findings;
    }
    $id = achievement_validate_uint_field($category, 'id', 'id', '1', ACHIEVEMENT_UINT32_MAX, $findings);
    $parent_id = achievement_validate_uint_field($category, 'parent_id', 'parent_id', '0', ACHIEVEMENT_UINT32_MAX, $findings);
    achievement_validate_uint_field($category, 'sequence', 'sequence', '0', ACHIEVEMENT_UINT32_MAX, $findings);
    achievement_validate_text_field($category, 'name', 'name', $findings, true, 255);
    achievement_validate_text_field($category, 'description', 'description', $findings, false, null);
    achievement_validate_text_field($category, 'icon', 'icon', $findings, false, 255);

    if ($existing_id !== null && $id !== null && achievement_unsigned_string($existing_id) !== $id) {
        achievement_validation_add($findings, 'id', 'The stable category ID cannot be changed after creation.');
    }
    $known_categories = achievement_context_id_set($context, 'category_ids');
    if ($existing_id === null && $id !== null && $known_categories !== null && isset($known_categories[$id])) {
        achievement_validation_add($findings, 'id', 'Category ID ' . $id . ' is already in use.');
    }
    if ($id !== null && $parent_id !== null && $id === $parent_id) {
        achievement_validation_add($findings, 'parent_id', 'A category cannot be its own parent.');
    }
    if ($parent_id !== null && $parent_id !== '0' && $known_categories !== null && !isset($known_categories[$parent_id])) {
        achievement_validation_add($findings, 'parent_id', 'The selected parent category does not exist.');
    }
    if ($id !== null && $parent_id !== null) {
        $parents = isset($context['category_parent_map']) && is_array($context['category_parent_map'])
            ? $context['category_parent_map'] : array();
        $parents[$id] = $parent_id;
        achievement_validate_category_lineage($parents, $id, 'parent_id', $findings);
    }
    return $findings;
}

function achievement_component_type_label($value) { return achievement_enum_label('component_types', $value); }
function achievement_event_label($value) { return achievement_enum_label('events', $value); }
function achievement_progress_mode_label($value) { return achievement_enum_label('progress_modes', $value); }
function achievement_behavior_label($value) { return achievement_enum_label('behaviors', $value); }
function achievement_reward_type_label($value) { return achievement_enum_label('reward_types', $value); }
function achievement_status_label($value) { return achievement_enum_label('achievement_statuses', $value); }
function achievement_character_reward_status_label($value) { return achievement_enum_label('character_reward_statuses', $value); }
function achievement_character_selection_status_label($value) { return achievement_enum_label('character_selection_statuses', $value); }
function achievement_character_update_status_label($value) { return achievement_enum_label('character_update_statuses', $value); }
