<?php

if (!function_exists('achievement_view_array')) {
  function achievement_view_array($value) {
    return is_array($value) ? $value : array();
  }
}

if (!function_exists('achievement_view_value')) {
  function achievement_view_value($row, $key, $default = '') {
    return is_array($row) && array_key_exists($key, $row) ? $row[$key] : $default;
  }
}

if (!function_exists('achievement_view_help')) {
  function achievement_view_help($metadata, $table, $field, $fallback = '') {
    if (is_array($metadata) && isset($metadata['fields'][$table][$field]['help'])) {
      return (string) $metadata['fields'][$table][$field]['help'];
    }
    return (string) $fallback;
  }
}

if (!function_exists('achievement_view_label')) {
  function achievement_view_label($metadata, $table, $field, $fallback = '') {
    if (is_array($metadata) && isset($metadata['fields'][$table][$field]['label'])) {
      return (string) $metadata['fields'][$table][$field]['label'];
    }
    return (string) $fallback;
  }
}

if (!function_exists('achievement_view_field_heading')) {
  function achievement_view_field_heading($id, $label, $help, $required = false) {
    $helpId = $id . '-help';
    echo '<label for="' . achievement_e($id) . '" title="' . achievement_e($help) . '">';
    echo achievement_e($label);
    if ($required) {
      echo ' <span class="achievement-required" aria-label="required">*</span>';
    }
    echo '</label>';
    echo '<span class="achievement-help" id="' . achievement_e($helpId) . '">';
    echo achievement_e($help);
    echo '</span>';
  }
}

if (!function_exists('achievement_view_nav')) {
  function achievement_view_nav($active, $canManageCharacters) {
    $items = array(
      'definitions' => array('label' => 'Definitions', 'url' => achievement_url(0), 'help' => 'Browse and author complete achievement definition graphs.'),
      'categories' => array('label' => 'Categories', 'url' => achievement_url(20), 'help' => 'Manage the client-facing achievement category hierarchy.'),
      'guide' => array('label' => 'Authoring Guide', 'url' => achievement_url(70), 'help' => 'Review event, progress, reward, and publishing guidance.'),
    );
    if ($canManageCharacters) {
      $items = array_slice($items, 0, 2, true) + array(
        'characters' => array('label' => 'Character State', 'url' => achievement_url(40), 'help' => 'Inspect and safely repair durable character achievement state.'),
      ) + array_slice($items, 2, null, true);
    }

    echo '<nav class="achievement-subnav" aria-label="Achievement editor sections">';
    foreach ($items as $key => $item) {
      $class = $key === $active ? ' class="is-active" aria-current="page"' : '';
      echo '<a' . $class . ' href="' . achievement_e($item['url']) . '" title="' . achievement_e($item['help']) . '">';
      echo achievement_e($item['label']);
      echo '<span>' . achievement_e($item['help']) . '</span>';
      echo '</a>';
    }
    echo '</nav>';
  }
}

if (!function_exists('achievement_view_flash')) {
  function achievement_view_flash($messages) {
    foreach (achievement_view_array($messages) as $message) {
      $type = isset($message['type']) ? (string) $message['type'] : 'info';
      if (!in_array($type, array('success', 'warning', 'error', 'info'), true)) {
        $type = 'info';
      }
      $role = $type === 'error' ? 'alert' : 'status';
      echo '<section class="achievement-flash achievement-flash-' . achievement_e($type) . '" role="' . $role . '">';
      echo '<strong>' . achievement_e(isset($message['message']) ? $message['message'] : '') . '</strong>';
      $details = isset($message['details']) && is_array($message['details']) ? $message['details'] : array();
      if ($details) {
        echo '<ul>';
        foreach ($details as $detail) {
          echo '<li>' . achievement_e($detail) . '</li>';
        }
        echo '</ul>';
      }
      echo '</section>';
    }
  }
}

if (!function_exists('achievement_view_timestamp')) {
  function achievement_view_timestamp($value) {
    $timestamp = (int) $value;
    if ($timestamp <= 0) {
      return 'Never / not recorded';
    }
    return gmdate('Y-m-d H:i:s', $timestamp) . ' UTC (' . $timestamp . ')';
  }
}

if (!function_exists('achievement_view_status')) {
  function achievement_view_status($metadata, $group, $value) {
    if (isset($metadata[$group][$value]['label'])) {
      return (string) $metadata[$group][$value]['label'];
    }
    return 'Unknown (' . (string) $value . ')';
  }
}

if (!function_exists('achievement_view_diagnostic_values')) {
  function achievement_view_diagnostic_values($values) {
    if (!is_array($values) || !$values) {
      return 'None';
    }
    $rendered = array();
    foreach ($values as $key => $value) {
      if (is_scalar($value) || $value === null) {
        $text = $value === null ? 'null' : (string) $value;
      }
      else {
        $encoded = json_encode($value);
        $text = $encoded === false ? 'Invalid diagnostic value' : $encoded;
      }
      $rendered[] = is_string($key) ? $key . ': ' . $text : $text;
    }
    return implode(', ', $rendered);
  }
}

if (!function_exists('achievement_view_query_url')) {
  function achievement_view_query_url($action, $parameters, $changes) {
    return achievement_url($action, array_merge(is_array($parameters) ? $parameters : array(), is_array($changes) ? $changes : array()));
  }
}

if (!function_exists('achievement_view_pager')) {
  function achievement_view_pager($action, $page, $pages, $parameters) {
    $page = max(1, (int) $page);
    $pages = max(0, (int) $pages);
    if ($pages <= 1) {
      return;
    }
    echo '<nav class="achievement-pager" aria-label="Result pages">';
    if ($page > 1) {
      echo '<a href="' . achievement_e(achievement_view_query_url($action, $parameters, array('page' => 1))) . '" title="Go to the first result page">First</a>';
      echo '<a href="' . achievement_e(achievement_view_query_url($action, $parameters, array('page' => $page - 1))) . '" title="Go to the previous result page">Previous</a>';
    }
    echo '<span>Page ' . achievement_e($page) . ' of ' . achievement_e($pages) . '</span>';
    if ($page < $pages) {
      echo '<a href="' . achievement_e(achievement_view_query_url($action, $parameters, array('page' => $page + 1))) . '" title="Go to the next result page">Next</a>';
      echo '<a href="' . achievement_e(achievement_view_query_url($action, $parameters, array('page' => $pages))) . '" title="Go to the last result page">Last</a>';
    }
    echo '</nav>';
  }
}

?>
