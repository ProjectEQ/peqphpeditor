<?php

require_once dirname(__DIR__) . '/lib/achievement_metadata.php';

$achievement_test_assertions = 0;

function achievement_test_assert($condition, $message)
{
    global $achievement_test_assertions;
    ++$achievement_test_assertions;
    if (!$condition) {
        fwrite(STDERR, "FAIL: " . $message . PHP_EOL);
        exit(1);
    }
}

function achievement_test_same($expected, $actual, $message)
{
    achievement_test_assert(
        $expected === $actual,
        $message . ' (expected ' . var_export($expected, true) . ', got ' . var_export($actual, true) . ')'
    );
}

function achievement_test_has_finding($findings, $path, $contains = null, $severity = 'error')
{
    foreach ($findings as $finding) {
        if (
            isset($finding['path'], $finding['message'], $finding['severity'])
            && $finding['path'] === $path
            && $finding['severity'] === $severity
            && ($contains === null || stripos($finding['message'], $contains) !== false)
        ) {
            return true;
        }
    }
    return false;
}

$metadata = achievement_metadata();
achievement_test_same(
    array(
        'limits', 'component_types', 'events', 'progress_modes', 'behaviors',
        'reward_types', 'reward_delivery', 'achievement_statuses',
        'character_reward_statuses', 'character_selection_statuses',
        'mutation_target_types', 'mutation_operations', 'character_mutation_statuses',
        'classes', 'skills', 'fields',
    ),
    array_keys($metadata),
    'metadata top-level contract remains stable'
);
achievement_test_same(range(0, 3), array_keys($metadata['component_types']), 'all component wire types are documented');
achievement_test_same(range(0, 13), array_keys($metadata['events']), 'all achievement events are documented');
achievement_test_same(range(0, 3), array_keys($metadata['progress_modes']), 'all progress modes are documented');
achievement_test_same(range(0, 5), array_keys($metadata['behaviors']), 'all component behaviors are documented');
achievement_test_same(range(0, 5), array_keys($metadata['reward_types']), 'all reward types are documented');

$skills = achievement_skill_types();
achievement_test_same(range(0, 77), array_keys($skills), 'skill IDs are canonical zero-based values 0 through 77');
achievement_test_same('1H Blunt', $skills[0], 'skill 0 is 1H Blunt');
achievement_test_same('Dual Wield', $skills[22], 'skill 22 is Dual Wield');
achievement_test_same('Offense', $skills[33], 'skill 33 is Offense');
achievement_test_same('Specialize Divination', $skills[46], 'skill 46 is Specialize Divination');
achievement_test_same('Remove Trap', $skills[75], 'skill 75 is Remove Trap');
achievement_test_same('Triple Attack', $skills[76], 'skill 76 is Triple Attack');
achievement_test_same('2H Piercing', $skills[77], 'skill 77 is 2H Piercing');

foreach (range(0, 13) as $event_id) {
    $event = $metadata['events'][$event_id];
    foreach (array('label', 'help', 'target_id_label', 'target_id_help', 'target_id2_label', 'target_id2_help', 'target_value_label', 'target_value_help', 'replay', 'lookup', 'allowed_progress_modes') as $field) {
        achievement_test_assert(array_key_exists($field, $event), 'event ' . $event_id . ' documents ' . $field);
    }
}
$helped_enum_groups = array(
    'component_types', 'progress_modes', 'behaviors', 'reward_types',
    'reward_delivery', 'achievement_statuses', 'character_reward_statuses',
    'character_selection_statuses', 'mutation_target_types',
    'mutation_operations', 'character_mutation_statuses',
);
foreach ($helped_enum_groups as $group) {
    foreach ($metadata[$group] as $value => $option) {
        achievement_test_assert(
            isset($option['label']) && trim((string) $option['label']) !== '',
            $group . ' option ' . $value . ' has an editor label'
        );
        achievement_test_assert(
            isset($option['help']) && trim((string) $option['help']) !== '',
            $group . ' option ' . $value . ' explains its authoring meaning'
        );
    }
}
foreach ($metadata['fields'] as $table => $fields) {
    foreach ($fields as $field => $field_metadata) {
        achievement_test_assert(
            isset($field_metadata['label']) && trim((string) $field_metadata['label']) !== '',
            $table . '.' . $field . ' has a visible editor label'
        );
        achievement_test_assert(
            isset($field_metadata['help']) && trim((string) $field_metadata['help']) !== '',
            $table . '.' . $field . ' has contextual editor help'
        );
    }
}
foreach (array(1, 4, 7, 9, 10, 11, 13) as $event_id) {
    achievement_test_assert(!achievement_is_progress_mode_allowed($event_id, 0), 'replayed/absolute event ' . $event_id . ' rejects Increment');
}
foreach (array(0, 2, 3, 5, 6, 8, 12) as $event_id) {
    achievement_test_assert(achievement_is_progress_mode_allowed($event_id, 0), 'event ' . $event_id . ' permits Increment');
}

achievement_test_same('orc warlord', achievement_canonical_npc_name('  ORC__Warlord_01!!  '), 'NPC names follow EQEmu ASCII canonicalization');
achievement_test_same('orcwarlord', achievement_canonical_npc_name('orc-warlord'), 'punctuation is discarded rather than made a separator');
achievement_test_same(1660326528, achievement_npc_name_hash('orc warlord'), 'NPC name hash matches documented FNV-1a identity');
achievement_test_same(3826002220, achievement_npc_name_hash('a'), 'single-letter FNV-1a identity is stable');
achievement_test_same(0, achievement_npc_name_hash('1234_--'), 'empty canonical names hash to zero');
achievement_test_assert(achievement_uint_in_range(ACHIEVEMENT_UINT64_MAX, '1', ACHIEVEMENT_UINT64_MAX), 'uint64 maximum validates without float conversion');
achievement_test_assert(!achievement_uint_in_range('18446744073709551616', '1', ACHIEVEMENT_UINT64_MAX), 'values above uint64 maximum are rejected');

$definition = array(
    'id' => 100,
    'name' => 'Reach Level 50',
    'description' => 'Reach level 50 on this character.',
    'icon_id' => 0,
    'points' => 10,
    'reward_display' => 0,
    'world_display_flag' => 0,
    'definition_version' => 1,
    'reset_on_version_change' => 0,
    'enabled' => 1,
    'associations' => array(
        array('category_id' => 10, 'sequence' => 1, 'display_text' => ''),
    ),
    'components' => array(
        array(
            'component_type' => 1,
            'sequence' => 1,
            'component_id' => 100,
            'description' => 'Reach level 50.',
            'description_2' => '',
            'presentation_count' => 1,
            'criteria' => array(
                array(
                    'id' => null,
                    'event_type' => 1,
                    'progress_mode' => 3,
                    'behavior' => 0,
                    'target_id' => 0,
                    'target_id2' => 0,
                    'target_value' => 50,
                    'required_count' => 1,
                    'enabled' => 1,
                ),
            ),
        ),
    ),
    'rewards' => array(),
    'reward_set' => null,
    'restrictions' => array(),
);
$context = array(
    'category_ids' => array(10),
    'category_parent_map' => array(10 => 0),
    'achievement_ids' => array(100, 200),
    'dependency_edges' => array(200 => array()),
);
$valid_findings = achievement_validate_definition($definition, 100, $context);
achievement_test_same(array(), $valid_findings, 'a complete level definition validates cleanly');
achievement_test_assert(!achievement_validation_has_errors($valid_findings), 'empty findings means valid');

$invalid = unserialize(serialize($definition));
$invalid['id'] = 101;
$invalid['associations'] = array();
$invalid['components'][0]['component_type'] = 3;
$invalid['components'][0]['criteria'][0]['event_type'] = 13;
$invalid['components'][0]['criteria'][0]['target_id'] = 78;
$invalid['components'][0]['criteria'][0]['target_id2'] = 22;
$invalid['components'][0]['criteria'][0]['target_value'] = 0;
$invalid_findings = achievement_validate_definition($invalid, 100, $context);
achievement_test_assert(achievement_test_has_finding($invalid_findings, 'id', 'cannot be changed'), 'stable achievement IDs are immutable');
achievement_test_assert(achievement_test_has_finding($invalid_findings, 'associations', 'at least one'), 'enabled definitions require a category');
achievement_test_assert(achievement_test_has_finding($invalid_findings, 'components.0.criteria.0.enabled', 'presentation-only'), 'type 3 cannot evaluate criteria');
achievement_test_assert(achievement_test_has_finding($invalid_findings, 'components.0.criteria.0.target_id', '0 through 77'), 'Skill Cap validates canonical skill range');
achievement_test_assert(achievement_test_has_finding($invalid_findings, 'components.0.criteria.0.target_id2', '1 through 16'), 'Skill Cap validates EQ class range');
achievement_test_assert(achievement_test_has_finding($invalid_findings, 'components.0.criteria.0.target_value', '1 through 255'), 'Skill Cap validates milestone level');

$duplicate = unserialize(serialize($definition));
$duplicate['components'][] = $duplicate['components'][0];
$duplicate['restrictions'] = array(
    array('restriction_id' => 900, 'requires_completed' => 1),
    array('restriction_id' => 900, 'requires_completed' => 0),
);
$duplicate_findings = achievement_validate_definition($duplicate, 100, $context);
achievement_test_assert(achievement_test_has_finding($duplicate_findings, 'components.1.component_id', 'must be unique'), 'duplicate component identities are rejected');
achievement_test_assert(achievement_test_has_finding($duplicate_findings, 'restrictions.1.restriction_id', 'only once'), 'duplicate/contradictory cast restrictions are rejected');

$reward_definition = unserialize(serialize($definition));
$reward_definition['reward_set'] = array(
    'reward_set_id' => 500,
    'title' => 'Choose one',
    'enabled' => 1,
    'options' => array(
        array('option_id' => 1, 'sequence' => 1, 'label' => 'Sword', 'common_to_all' => 0, 'flags' => 0, 'enabled' => 1),
    ),
);
$reward_findings = achievement_validate_definition($reward_definition, null, $context);
achievement_test_assert(achievement_test_has_finding($reward_findings, 'reward_set.options.0', 'enabled grant'), 'enabled options without enabled grants are rejected');

$reward_definition['rewards'][] = array(
    'reward_id' => null,
    'sequence' => 1,
    'reward_type' => 0,
    'reward_data_id' => 1001,
    'amount' => 1,
    'description' => 'A test sword',
    'enabled' => 1,
    'option_id' => 1,
);
$reward_valid = achievement_validate_definition($reward_definition, null, $context);
achievement_test_assert(!achievement_validation_has_errors($reward_valid), 'a selectable option with an enabled grant is valid');

$dependency = unserialize(serialize($definition));
$dependency['components'][0]['criteria'][0] = array(
    'event_type' => 11, 'progress_mode' => 3, 'behavior' => 0,
    'target_id' => 200, 'target_id2' => 0, 'target_value' => 1,
    'required_count' => 1, 'enabled' => 1,
);
$dependency_context = $context;
$dependency_context['dependency_edges'] = array(200 => array(100));
$dependency_findings = achievement_validate_definition($dependency, 100, $dependency_context);
achievement_test_assert(achievement_test_has_finding($dependency_findings, 'components', 'dependency cycle'), 'cross-definition dependency cycles are rejected');

$self_dependency = unserialize(serialize($dependency));
$self_dependency['components'][0]['criteria'][0]['target_id'] = 100;
$self_findings = achievement_validate_definition($self_dependency, 100, $context);
achievement_test_assert(achievement_test_has_finding($self_findings, 'components.0.criteria.0.target_id', 'own completion'), 'self dependencies are rejected');

$category = array('id' => 10, 'parent_id' => 20, 'sequence' => 1, 'name' => 'Child', 'description' => '', 'icon' => '');
$category_findings = achievement_validate_category(
    $category,
    10,
    array('category_ids' => array(10, 20), 'category_parent_map' => array(10 => 0, 20 => 10))
);
achievement_test_assert(achievement_test_has_finding($category_findings, 'parent_id', 'cycle'), 'category parent cycles are rejected');

$category['parent_id'] = 0;
achievement_test_same(array(), achievement_validate_category($category, 10, array('category_ids' => array(10, 20), 'category_parent_map' => array(10 => 0, 20 => 10))), 'a root category validates cleanly');

achievement_test_same('Unknown (99)', achievement_event_label(99), 'unknown enums remain visible instead of silently mislabeling data');
achievement_test_assert(strpos(achievement_field_help('achievements', 'definition_version'), 'Increment') !== false, 'definition-version help explains editor action');

fwrite(STDOUT, 'achievement_metadata_test: ' . $achievement_test_assertions . " assertions passed" . PHP_EOL);
