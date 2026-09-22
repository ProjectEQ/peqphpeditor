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
        'update_target_types', 'update_operations', 'character_update_statuses',
        'classes', 'skills', 'fields',
    ),
    array_keys($metadata),
    'metadata top-level contract remains stable'
);
achievement_test_same(range(0, 3), array_keys($metadata['component_types']), 'all component wire types are documented');
achievement_test_same(range(0, 13), array_keys($metadata['events']), 'all achievement events are documented');
achievement_test_same(range(0, 3), array_keys($metadata['progress_modes']), 'all progress modes are documented');
achievement_test_same(range(0, 5), array_keys($metadata['behaviors']), 'all component behaviors are documented');
achievement_test_same(range(0, 7), array_keys($metadata['reward_types']), 'all reward types are documented');
foreach ($metadata['reward_types'] as $reward_type => $reward_metadata) {
    achievement_test_assert(
        isset($reward_metadata['data_help']) && trim((string) $reward_metadata['data_help']) !== '',
        'reward type ' . $reward_type . ' explains its referenced-data runtime contract'
    );
    achievement_test_assert(
        isset($reward_metadata['amount_help']) && trim((string) $reward_metadata['amount_help']) !== '',
        'reward type ' . $reward_type . ' explains its delivery-amount runtime contract'
    );
}
achievement_test_same('32767', $metadata['reward_types'][0]['amount_max'], 'item quantity exposes the signed-short runtime maximum');
achievement_test_same(array('0', '1'), $metadata['reward_types'][1]['data_values'], 'experience metadata exposes both supported runtime modes');
achievement_test_same('4294967295', $metadata['reward_types'][1]['amount_max'], 'experience metadata preserves the unsigned 32-bit maximum as a decimal string');
achievement_test_same(array('0'), $metadata['reward_types'][2]['data_values'], 'AA data is documented as reserved zero');
achievement_test_same('2147483647', $metadata['reward_types'][2]['amount_max'], 'AA quantity exposes the signed-int runtime maximum');
achievement_test_same('2147483647999', $metadata['reward_types'][3]['amount_max'], 'copper exposes the runtime platinum conversion ceiling');
achievement_test_same(array('0'), $metadata['reward_types'][3]['data_values'], 'copper data is documented as reserved zero');
achievement_test_same('1', $metadata['reward_types'][4]['data_min'], 'alternate currency requires a nonzero catalog ID');
achievement_test_same('2147483647', $metadata['reward_types'][4]['amount_max'], 'alternate currency exposes the signed-int runtime maximum');
achievement_test_same('2147483647', $metadata['reward_types'][5]['data_max'], 'title-set IDs expose their signed-int runtime maximum');
achievement_test_same(array('1'), $metadata['reward_types'][5]['amount_values'], 'title grants expose singular-delivery semantics');
achievement_test_same('1', $metadata['reward_types'][6]['data_min'], 'specific AA rewards require a nonzero ability ID');
achievement_test_same('2147483647', $metadata['reward_types'][6]['amount_max'], 'specific AA desired rank exposes the signed-int runtime maximum');
achievement_test_same('1', $metadata['reward_types'][7]['data_min'], 'class-ineligible AA fallbacks require a nonzero paired ability ID');
achievement_test_same('2147483647', $metadata['reward_types'][7]['amount_max'], 'class-ineligible fallback AA points expose the signed-int runtime maximum');

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
    'character_selection_statuses', 'update_target_types',
    'update_operations', 'character_update_statuses',
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
foreach (array(1, 4, 5, 7, 9, 10, 11, 13) as $event_id) {
    achievement_test_assert(!achievement_is_progress_mode_allowed($event_id, 0), 'replayed/absolute event ' . $event_id . ' rejects Increment');
}
foreach (array(0, 2, 3, 6, 8, 12) as $event_id) {
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
    'has_reward' => 0,
    'client_flag' => 0,
    'version' => 1,
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
            'name' => 'Reach level 50.',
            'description' => '',
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
$version_zero = unserialize(serialize($definition));
$version_zero['version'] = 0;
achievement_test_assert(
    !achievement_validation_has_errors(achievement_validate_definition($version_zero, 100, $context)),
    'definition version zero is an ordinary valid exact version'
);

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
    'source_enabled' => 1,
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

$staged_reward_definition = unserialize(serialize($reward_definition));
$staged_reward_definition['rewards'] = array();
$staged_reward_definition['reward_set']['source_enabled'] = 0;
$staged_findings = achievement_validate_definition($staged_reward_definition, null, $context);
achievement_test_assert(
    !achievement_validation_has_errors($staged_findings),
    'a disabled achievement reward source may safely stage an incomplete enabled catalog set'
);
achievement_test_assert(
    achievement_test_has_finding($staged_findings, 'reward_set.source_enabled', 'staged', 'warning'),
    'disabled source staging is explained to the editor'
);
$disabled_set_definition = unserialize(serialize($staged_reward_definition));
$disabled_set_definition['reward_set']['source_enabled'] = 1;
$disabled_set_definition['reward_set']['enabled'] = 0;
$disabled_set_findings = achievement_validate_definition($disabled_set_definition, null, $context);
achievement_test_assert(
    !achievement_validation_has_errors($disabled_set_findings),
    'a disabled shared catalog set may stage incomplete selectable content'
);
achievement_test_assert(
    achievement_test_has_finding($disabled_set_findings, 'reward_set.enabled', 'staged', 'warning'),
    'disabled catalog staging explains the distinct source/set enable flags'
);
$disabled_definition = unserialize(serialize($staged_reward_definition));
$disabled_definition['enabled'] = 0;
$disabled_definition['reward_set']['source_enabled'] = 1;
achievement_test_assert(
    !achievement_validation_has_errors(achievement_validate_definition($disabled_definition, null, $context)),
    'an inactive definition does not fail selectable-path reachability validation'
);

$runtime_reward_boundaries = array(
    array(0, '1001', '32767', 'item'),
    array(1, '1', '4294967295', 'experience'),
    array(2, '0', '2147483647', 'AA'),
    array(3, '0', '2147483647999', 'copper'),
    array(4, '7', '2147483647', 'alternate currency'),
    array(5, '2147483647', '1', 'title'),
    array(6, '30300', '2147483647', 'specific AA ability'),
);
foreach ($runtime_reward_boundaries as $boundary) {
    $runtime_definition = unserialize(serialize($definition));
    $runtime_definition['rewards'] = array(array(
        'reward_id' => null,
        'sequence' => 1,
        'reward_type' => $boundary[0],
        'reward_data_id' => $boundary[1],
        'amount' => $boundary[2],
        'description' => 'Runtime boundary grant',
        'enabled' => 1,
        'option_id' => null,
    ));
    achievement_test_assert(
        !achievement_validation_has_errors(achievement_validate_definition($runtime_definition, null, $context)),
        $boundary[3] . ' runtime maximum and referenced-data semantics validate exactly'
    );
}

$paired_aa_definition = unserialize(serialize($definition));
$paired_aa_definition['rewards'] = array(
    array(
        'reward_id' => null, 'sequence' => 1, 'reward_type' => 6,
        'reward_data_id' => '30300', 'amount' => '3',
        'description' => 'Desired AA rank', 'enabled' => 1, 'option_id' => null,
    ),
    array(
        'reward_id' => null, 'sequence' => 2, 'reward_type' => 7,
        'reward_data_id' => '30300', 'amount' => '2147483647',
        'description' => 'Ineligible-class points', 'enabled' => 1, 'option_id' => null,
    ),
);
achievement_test_assert(
    !achievement_validation_has_errors(achievement_validate_definition($paired_aa_definition, null, $context)),
    'one automatic type 6 primary and one type 7 fallback with the same ability ID validate'
);

$runtime_reward_failures = array(
    array(0, '1001', '32768', 'amount', '32,767', 'item quantity above signed-short maximum'),
    array(1, '2', '1', 'reward_data_id', 'mode 0', 'unsupported experience mode'),
    array(1, '0', '4294967296', 'amount', '4,294,967,295', 'experience above unsigned 32-bit maximum'),
    array(2, '1', '1', 'reward_data_id', 'must be 0', 'nonzero reserved AA data'),
    array(2, '0', '2147483648', 'amount', '2,147,483,647', 'AA above signed-int maximum'),
    array(3, '1', '1', 'reward_data_id', 'must be 0', 'nonzero reserved copper data'),
    array(3, '0', '2147483648000', 'amount', '2,147,483,647,999', 'copper above its runtime conversion ceiling'),
    array(4, '0', '1', 'reward_data_id', 'nonzero', 'zero alternate-currency ID'),
    array(4, '1', '2147483648', 'amount', '2,147,483,647', 'alternate currency above signed-int maximum'),
    array(5, '2147483648', '1', 'reward_data_id', '2,147,483,647', 'title-set ID above signed-int maximum'),
    array(5, '1', '2', 'amount', 'exactly 1', 'nonsingular title amount'),
    array(6, '0', '1', 'reward_data_id', 'nonzero', 'zero specific-AA ability ID'),
    array(6, '30300', '2147483648', 'amount', '2,147,483,647', 'specific-AA desired rank above signed-int maximum'),
    array(7, '0', '1', 'reward_data_id', 'nonzero', 'zero fallback ability ID'),
    array(7, '30300', '2147483648', 'amount', '2,147,483,647', 'fallback AA points above signed-int maximum'),
);
foreach ($runtime_reward_failures as $failure) {
    $runtime_definition = unserialize(serialize($definition));
    $runtime_definition['rewards'] = array(array(
        'reward_id' => null,
        'sequence' => 1,
        'reward_type' => $failure[0],
        'reward_data_id' => $failure[1],
        'amount' => $failure[2],
        'description' => 'Invalid active runtime grant',
        'enabled' => 1,
        'option_id' => null,
    ));
    $runtime_findings = achievement_validate_definition($runtime_definition, null, $context);
    achievement_test_assert(
        achievement_test_has_finding($runtime_findings, 'rewards.0.' . $failure[3], $failure[4]),
        'reachable ' . $failure[5] . ' is rejected with field-addressable guidance'
    );
}

$unpaired_aa_definition = unserialize(serialize($definition));
$unpaired_aa_definition['rewards'] = array($paired_aa_definition['rewards'][1]);
$unpaired_findings = achievement_validate_definition($unpaired_aa_definition, null, $context);
achievement_test_assert(
    achievement_test_has_finding($unpaired_findings, 'rewards.0.reward_data_id', 'exactly one enabled automatic type 6'),
    'an enabled automatic fallback without its primary is rejected'
);
$duplicate_primary_definition = unserialize(serialize($paired_aa_definition));
$duplicate_primary_definition['rewards'][] = $paired_aa_definition['rewards'][0];
$duplicate_primary_definition['rewards'][2]['sequence'] = 3;
achievement_test_assert(
    achievement_test_has_finding(
        achievement_validate_definition($duplicate_primary_definition, null, $context),
        'rewards.1.reward_data_id',
        'exactly one enabled automatic type 6'
    ),
    'a fallback with duplicate same-ability primaries is rejected'
);
$selectable_fallback_definition = unserialize(serialize($reward_definition));
$selectable_fallback_definition['rewards'][0]['reward_type'] = 7;
$selectable_fallback_definition['rewards'][0]['reward_data_id'] = 30300;
$selectable_fallback_findings = achievement_validate_definition($selectable_fallback_definition, null, $context);
achievement_test_assert(
    achievement_test_has_finding($selectable_fallback_findings, 'rewards.0.option_id', 'direct automatic'),
    'a reachable selectable type 7 fallback is rejected'
);
$staged_fallback_definition = unserialize(serialize($selectable_fallback_definition));
$staged_fallback_definition['reward_set']['source_enabled'] = 0;
achievement_test_assert(
    !achievement_validation_has_errors(achievement_validate_definition($staged_fallback_definition, null, $context)),
    'a type 7 row behind a disabled selectable source remains an inert draft'
);

$staged_invalid_reward = unserialize(serialize($definition));
$staged_invalid_reward['rewards'] = array(array(
    'reward_id' => null,
    'sequence' => 1,
    'reward_type' => 0,
    'reward_data_id' => 1001,
    'amount' => '32768',
    'description' => 'Disabled draft grant',
    'enabled' => 0,
    'option_id' => null,
));
achievement_test_assert(
    !achievement_validation_has_errors(achievement_validate_definition($staged_invalid_reward, null, $context)),
    'a disabled automatic grant may stage values beyond runtime delivery bounds'
);
$staged_invalid_reward['rewards'][0]['enabled'] = 1;
$staged_invalid_reward['enabled'] = 0;
achievement_test_assert(
    !achievement_validation_has_errors(achievement_validate_definition($staged_invalid_reward, null, $context)),
    'an unreachable disabled definition may stage values beyond runtime delivery bounds'
);
$staged_selectable_reward = unserialize(serialize($reward_definition));
$staged_selectable_reward['reward_set']['source_enabled'] = 0;
$staged_selectable_reward['rewards'][0]['amount'] = '32768';
achievement_test_assert(
    !achievement_validation_has_errors(achievement_validate_definition($staged_selectable_reward, null, $context)),
    'a disabled achievement source may stage selectable grant values beyond runtime delivery bounds'
);
$staged_selectable_reward['reward_set']['source_enabled'] = 1;
achievement_test_assert(
    achievement_test_has_finding(
        achievement_validate_definition($staged_selectable_reward, null, $context),
        'rewards.0.amount',
        '32,767'
    ),
    'reenabling a staged selectable source applies runtime delivery bounds before publication'
);

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
achievement_test_assert(strpos(achievement_field_help('achievements', 'version'), 'Increment') !== false, 'definition-version help explains editor action');

fwrite(STDOUT, 'achievement_metadata_test: ' . $achievement_test_assertions . " assertions passed" . PHP_EOL);
