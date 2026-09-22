<?php

// The custom flag is optional so the editor also works with stock content DBs.
function items_have_kinbound($database) {
  static $availability;
  if ($availability === null) {
    $availability = new SplObjectStorage();
  }
  if (!$availability->contains($database)) {
    $availability[$database] = (bool) $database->query_assoc("SHOW COLUMNS FROM items LIKE 'kinbound'");
  }
  return $availability[$database];
}

function item_kinbound_options() {
  return array(0 => 'Unlisted', 1 => 'Always Kinbound', 2 => 'Never Kinbound');
}

function item_kinbound_value($value) {
  if ((!is_string($value) && !is_int($value)) || !in_array((string) $value, array('0', '1', '2'), true)) {
    throw new InvalidArgumentException('Kinbound must be 0 (Unlisted), 1 (Always Kinbound), or 2 (Never Kinbound).');
  }
  return (int) $value;
}

function item_kinbound_label($value) {
  $options = item_kinbound_options();
  return isset($options[$value]) ? $options[$value] : 'Unknown';
}

function item_kinbound_save_fields($post, $supported, $current = null) {
  // Missing fields preserve existing values and let new items use the DB default.
  if (!$supported || !array_key_exists('kinbound', $post)) {
    return '';
  }
  $value = item_kinbound_value($post['kinbound']);
  if ($current !== null && (string) $current === (string) $value) {
    return '';
  }
  return 'kinbound="' . $value . '", ';
}

function search_editor_items($database, $parameters) {
  foreach (array('id', 'search') as $parameter) {
    if (isset($parameters[$parameter]) && !is_scalar($parameters[$parameter])) {
      throw new InvalidArgumentException('Item ID and name searches must be single values.');
    }
  }
  $supported = items_have_kinbound($database);
  $filter = isset($parameters['kinbound']) && $parameters['kinbound'] !== ''
    ? item_kinbound_value($parameters['kinbound']) : null;
  if ($filter !== null && !$supported) {
    return array();
  }

  $fields = $supported ? 'id, name, kinbound' : 'id, name';
  $where = array();
  if (isset($parameters['id']) && $parameters['id'] !== '' && $parameters['id'] !== 'ID') {
    $where[] = 'id="' . $database->real_escape_string((string) $parameters['id']) . '"';
  }
  else {
    $search = isset($parameters['search']) ? (string) $parameters['search'] : '';
    if ($search !== '' && $search !== 'Enter an Item') {
      $where[] = 'name RLIKE "' . $database->real_escape_string($search) . '"';
    }
    elseif ($filter === null) {
      return array();
    }
  }
  if ($filter !== null) {
    $where[] = 'kinbound=' . $filter;
  }

  // Read one extra row so the route can tell users when to narrow their filter.
  $limit = $filter !== null ? ' LIMIT 501' : '';
  return $database->query_mult_assoc('SELECT ' . $fields . ' FROM items WHERE ' . implode(' AND ', $where) . ' ORDER BY id' . $limit);
}
