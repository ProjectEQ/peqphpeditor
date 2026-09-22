<?php

/**
 * HTTP and presentation helpers used only by the achievement editor.
 *
 * PEQ's older modules predate CSRF protection and often mutate through GET.
 * This feature keeps its safer request contract local so existing editors are
 * not changed unexpectedly.
 */

function achievement_e($value) {
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function achievement_url($action = 0, $parameters = array()) {
  $query = array_merge(array(
    'editor' => 'achievements',
    'action' => (int) $action,
  ), $parameters);

  foreach ($query as $key => $value) {
    if ($value === null || $value === '') {
      unset($query[$key]);
    }
  }

  return 'index.php?' . http_build_query($query, '', '&');
}

function achievement_csrf_token() {
  if (!isset($_SESSION['achievement_csrf']) || !is_string($_SESSION['achievement_csrf'])) {
    try {
      $_SESSION['achievement_csrf'] = bin2hex(random_bytes(32));
    }
    catch (Exception $exception) {
      $_SESSION['achievement_csrf'] = hash(
        'sha256',
        session_id() . microtime(true) . mt_rand() . __FILE__
      );
    }
  }

  return $_SESSION['achievement_csrf'];
}

function achievement_require_post() {
  if (!isset($_SERVER['REQUEST_METHOD']) || strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
    throw new AchievementHttpException('This operation must be submitted from its editor form.');
  }
}

function achievement_verify_csrf() {
  achievement_require_post();
  $expected = achievement_csrf_token();
  $actual = isset($_POST['csrf_token']) ? (string) $_POST['csrf_token'] : '';
  $valid = function_exists('hash_equals')
    ? hash_equals($expected, $actual)
    : $expected === $actual;

  if (!$valid) {
    throw new AchievementHttpException(
      'The form expired or came from another session. Reload the page and try again.'
    );
  }
}

function achievement_decode_graph() {
  achievement_verify_csrf();
  $json = isset($_POST['graph_json']) ? (string) $_POST['graph_json'] : '';
  if ($json === '') {
    throw new AchievementHttpException('The achievement definition payload is missing.');
  }
  if (strlen($json) > 2097152) {
    throw new AchievementHttpException('The definition is larger than the 2 MB editor safety limit.');
  }

  $graph = json_decode($json, true);
  if (!is_array($graph) || json_last_error() !== JSON_ERROR_NONE) {
    throw new AchievementHttpException('The definition payload is not valid JSON. Reload and try again.');
  }

  $limits = array(
    'associations' => 100,
    'components' => 1000,
    'rewards' => 500,
    'restrictions' => 500,
  );
  foreach ($limits as $field => $limit) {
    $rows = isset($graph[$field]) && is_array($graph[$field]) ? $graph[$field] : array();
    if (count($rows) > $limit) {
      throw new AchievementHttpException(
        ucfirst($field) . ' exceeds the editor safety limit of ' . $limit . ' rows.'
      );
    }
  }

  $criterionCount = 0;
  foreach ((isset($graph['components']) && is_array($graph['components'])) ? $graph['components'] : array() as $component) {
    if (is_array($component) && isset($component['criteria']) && is_array($component['criteria'])) {
      $criterionCount += count($component['criteria']);
    }
  }
  if ($criterionCount > 2000) {
    throw new AchievementHttpException('Criteria exceeds the editor safety limit of 2,000 rows.');
  }

  $options = array();
  if (isset($graph['reward_set']) && is_array($graph['reward_set'])) {
    $options = isset($graph['reward_set']['options']) && is_array($graph['reward_set']['options'])
      ? $graph['reward_set']['options']
      : array();
  }
  if (count($options) > 500) {
    throw new AchievementHttpException('Reward options exceeds the editor safety limit of 500 rows.');
  }

  return $graph;
}

function achievement_require_confirmation($expected, $field = 'confirmation') {
  achievement_verify_csrf();
  $actual = isset($_POST[$field]) ? trim((string) $_POST[$field]) : '';
  if (!hash_equals((string) $expected, $actual)) {
    throw new AchievementHttpException('The confirmation text did not match. No changes were made.');
  }
}

function achievement_flash($type, $message, $details = array()) {
  if (!isset($_SESSION['achievement_flash']) || !is_array($_SESSION['achievement_flash'])) {
    $_SESSION['achievement_flash'] = array();
  }
  $_SESSION['achievement_flash'][] = array(
    'type' => in_array($type, array('success', 'warning', 'error', 'info'), true) ? $type : 'info',
    'message' => (string) $message,
    'details' => is_array($details) ? array_values($details) : array(),
  );
}

function achievement_take_flash() {
  $messages = isset($_SESSION['achievement_flash']) && is_array($_SESSION['achievement_flash'])
    ? $_SESSION['achievement_flash']
    : array();
  unset($_SESSION['achievement_flash']);
  return $messages;
}

function achievement_failed_slot($slot) {
  $slot = trim((string) $slot);
  if ($slot === '' || strlen($slot) > 64 || !preg_match('/^[a-z0-9:_-]+$/i', $slot)) {
    return 'create';
  }
  return $slot;
}

function achievement_store_failed_graph($graph, $errors, $slot = 'create') {
  $slot = achievement_failed_slot($slot);
  if (!isset($_SESSION['achievement_failed_graphs']) || !is_array($_SESSION['achievement_failed_graphs'])) {
    $_SESSION['achievement_failed_graphs'] = array();
  }
  $_SESSION['achievement_failed_graphs'][$slot] = array(
    'graph' => is_array($graph) ? $graph : array(),
    'errors' => is_array($errors) ? $errors : array(),
  );
  while (count($_SESSION['achievement_failed_graphs']) > 4) {
    array_shift($_SESSION['achievement_failed_graphs']);
  }
}

function achievement_take_failed_graph($slot = 'create') {
  $slot = achievement_failed_slot($slot);
  $stored = isset($_SESSION['achievement_failed_graphs'][$slot])
    && is_array($_SESSION['achievement_failed_graphs'][$slot])
    ? $_SESSION['achievement_failed_graphs'][$slot]
    : array();
  $value = array(
    'graph' => isset($stored['graph']) && is_array($stored['graph']) ? $stored['graph'] : null,
    'errors' => isset($stored['errors']) && is_array($stored['errors']) ? $stored['errors'] : array(),
  );
  unset($_SESSION['achievement_failed_graphs'][$slot]);
  if (isset($_SESSION['achievement_failed_graphs']) && count($_SESSION['achievement_failed_graphs']) === 0) {
    unset($_SESSION['achievement_failed_graphs']);
  }
  return $value;
}

function achievement_store_failed_category($category, $errors, $editingId = 0) {
  $editingId = max(0, (int) $editingId);
  $slot = $editingId > 0 ? 'edit:' . $editingId : 'create';
  if (!isset($_SESSION['achievement_failed_categories']) || !is_array($_SESSION['achievement_failed_categories'])) {
    $_SESSION['achievement_failed_categories'] = array();
  }
  $_SESSION['achievement_failed_categories'][$slot] = array(
    'category' => is_array($category) ? $category : array(),
    'errors' => is_array($errors) ? $errors : array(),
    'editing_id' => $editingId,
  );
  while (count($_SESSION['achievement_failed_categories']) > 8) {
    array_shift($_SESSION['achievement_failed_categories']);
  }
}

function achievement_take_failed_category($editingId = 0) {
  $editingId = max(0, (int) $editingId);
  $slot = $editingId > 0 ? 'edit:' . $editingId : 'create';
  $stored = isset($_SESSION['achievement_failed_categories'][$slot])
    && is_array($_SESSION['achievement_failed_categories'][$slot])
    ? $_SESSION['achievement_failed_categories'][$slot]
    : array();
  unset($_SESSION['achievement_failed_categories'][$slot]);
  if (isset($_SESSION['achievement_failed_categories']) && count($_SESSION['achievement_failed_categories']) === 0) {
    unset($_SESSION['achievement_failed_categories']);
  }
  return array(
    'category' => isset($stored['category']) && is_array($stored['category']) ? $stored['category'] : null,
    'errors' => isset($stored['errors']) && is_array($stored['errors']) ? $stored['errors'] : array(),
    'editing_id' => isset($stored['editing_id']) ? (int) $stored['editing_id'] : $editingId,
  );
}

function achievement_redirect($action = 0, $parameters = array()) {
  header('Location: ' . achievement_url($action, $parameters));
  exit;
}

function achievement_uint($value, $label, $minimum = 0, $maximum = 4294967295) {
  $text = trim((string) $value);
  if ($text === '' || !ctype_digit($text)) {
    throw new AchievementHttpException($label . ' must be a whole number.');
  }
  $number = (float) $text;
  if ($number < $minimum || $number > $maximum) {
    throw new AchievementHttpException(
      $label . ' must be between ' . $minimum . ' and ' . $maximum . '.'
    );
  }
  return (int) $text;
}

function achievement_post_uint($field, $label, $minimum = 0, $maximum = 4294967295) {
  return achievement_uint(isset($_POST[$field]) ? $_POST[$field] : '', $label, $minimum, $maximum);
}

function achievement_positive_platform_int($value, $label) {
  $text = trim((string) $value);
  if ($text === '' || !ctype_digit($text)) {
    throw new AchievementHttpException($label . ' must be a positive whole number.');
  }
  $normalized = ltrim($text, '0');
  if ($normalized === '') {
    throw new AchievementHttpException($label . ' must be at least 1.');
  }
  $maximum = (string) PHP_INT_MAX;
  if (strlen($normalized) > strlen($maximum)
    || (strlen($normalized) === strlen($maximum) && strcmp($normalized, $maximum) > 0)) {
    throw new AchievementHttpException($label . ' is too large for this editor runtime.');
  }
  return (int) $normalized;
}

function achievement_post_positive_platform_int($field, $label) {
  return achievement_positive_platform_int(isset($_POST[$field]) ? $_POST[$field] : '', $label);
}

function achievement_query_uint($field, $default = 0, $minimum = 0, $maximum = 4294967295) {
  if (!isset($_GET[$field]) || $_GET[$field] === '') {
    return $default;
  }
  return achievement_uint($_GET[$field], ucfirst(str_replace('_', ' ', $field)), $minimum, $maximum);
}

function achievement_post_bool($field) {
  if (!isset($_POST[$field])) {
    return false;
  }
  return in_array(strtolower((string) $_POST[$field]), array('1', 'true', 'yes', 'on'), true);
}

function achievement_json_response($payload, $status = 200) {
  if (function_exists('http_response_code')) {
    http_response_code((int) $status);
  }
  header('Content-Type: application/json; charset=UTF-8');
  header('Cache-Control: no-store, max-age=0');
  echo json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
  exit;
}

function achievement_log_exception($context, $exception) {
  $message = sprintf(
    '[PEQ Achievement Editor] %s: %s in %s:%d',
    $context,
    $exception->getMessage(),
    $exception->getFile(),
    $exception->getLine()
  );
  error_log($message);
  if (method_exists($exception, 'getDetails')) {
    $details = $exception->getDetails();
    if (is_array($details) && count($details) > 0) {
      error_log('[PEQ Achievement Editor] details: ' . json_encode($details));
    }
  }
}

class AchievementHttpException extends RuntimeException {}

?>
