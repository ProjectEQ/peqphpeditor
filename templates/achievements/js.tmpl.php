<script>
(function () {
  'use strict';

  var INITIAL_DEFINITION = <?=$definition_json?>;
  var METADATA = <?=$metadata_json?>;
  var CATEGORY_OPTIONS = <?=json_encode(isset($category_options) && is_array($category_options) ? $category_options : array(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)?>;
  var LOOKUP_URL = <?=json_encode(isset($lookup_url) ? (string) $lookup_url : 'index.php?editor=achievements&action=60', JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)?>;
  var IS_CREATE = <?=!empty($is_create) ? 'true' : 'false'?>;
  var PERSISTED_REWARD_SET_ID = <?=json_encode(isset($persisted_reward_set_id) ? $persisted_reward_set_id : null, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT)?>;
  var PERSISTED_COMPONENT_KEYS = <?=json_encode(isset($persisted_component_keys) && is_array($persisted_component_keys) ? array_values($persisted_component_keys) : array(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT)?>;
  var PERSISTED_REWARD_IDS = <?=json_encode(isset($persisted_reward_ids) && is_array($persisted_reward_ids) ? array_values($persisted_reward_ids) : array(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT)?>;
  var PERSISTED_OPTION_IDS = <?=json_encode(isset($persisted_option_ids) && is_array($persisted_option_ids) ? array_values($persisted_option_ids) : array(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT)?>;
  var MAX_GRAPH_BYTES = 2 * 1024 * 1024;

  document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('[data-achievement-definition-form]');
    if (!form) return;

    var graph = clone(INITIAL_DEFINITION || {});
    var initialVersion = stringValue(graph.version);
    var initialAchievementId = IS_CREATE ? '' : stringValue(graph.id || '');
    var initialRewardSetId = IS_CREATE ? '' : stringValue(PERSISTED_REWARD_SET_ID);
    var initialComponents = list(PERSISTED_COMPONENT_KEYS).map(stringValue);
    var initialRewardIds = list(PERSISTED_REWARD_IDS).map(stringValue);
    var initialOptionIds = list(PERSISTED_OPTION_IDS).map(stringValue);
    var uidCounter = 0;
    var validationTimer = null;

    graph.associations = list(graph.associations);
    graph.components = list(graph.components);
    graph.rewards = list(graph.rewards);
    graph.restrictions = list(graph.restrictions);
    graph.reward_set = graph.reward_set && typeof graph.reward_set === 'object'
      ? graph.reward_set : null;
    if (graph.reward_set) graph.reward_set.options = list(graph.reward_set.options);

    function clone(value) {
      return JSON.parse(JSON.stringify(value));
    }

    function list(value) {
      return Array.isArray(value) ? value : [];
    }

    function stringValue(value) {
      return value === null || typeof value === 'undefined' ? '' : String(value);
    }

    function integer(value, fallback) {
      var text = stringValue(value).trim();
      if (!/^\d+$/.test(text)) return typeof fallback === 'number' ? fallback : 0;
      var parsed = Number(text);
      return Number.isFinite(parsed) ? parsed : (typeof fallback === 'number' ? fallback : 0);
    }

    function enabled(value) {
      return integer(value, 0) === 1;
    }

    function nextUid(prefix) {
      uidCounter += 1;
      return 'achievement-' + prefix + '-' + Date.now() + '-' + uidCounter;
    }

    function clear(node) {
      while (node && node.firstChild) node.removeChild(node.firstChild);
    }

    function element(tag, className, text) {
      var node = document.createElement(tag);
      if (className) node.className = className;
      if (typeof text !== 'undefined' && text !== null) node.textContent = String(text);
      return node;
    }

    function button(label, className, title, handler) {
      var node = element('button', className || 'achievement-button is-small', label);
      node.type = 'button';
      if (title) node.title = title;
      node.addEventListener('click', handler);
      return node;
    }

    function retainedIdentityControl(label, title) {
      var node = button(label, 'achievement-button is-small is-secondary', title, function () {});
      node.disabled = true;
      node.setAttribute('aria-disabled', 'true');
      return node;
    }

    function metaField(table, key, fallbackLabel, fallbackHelp) {
      var fields = METADATA.fields || {};
      var entry = fields[table] && fields[table][key] ? fields[table][key] : {};
      return {
        label: entry.label || fallbackLabel || key.replace(/_/g, ' '),
        help: entry.help || fallbackHelp || 'Value stored by the achievement system.'
      };
    }

    function field(label, help, control, wide) {
      var wrap = element('div', 'achievement-field' + (wide ? ' achievement-field-span-2' : ''));
      var id = control.id || nextUid('control');
      control.id = id;
      var heading = element('label', 'achievement-field-label', label);
      heading.htmlFor = id;
      if (help) heading.title = help;
      wrap.appendChild(heading);
      wrap.appendChild(control);
      if (help) {
        var hint = element('small', 'achievement-help-text', help);
        hint.id = id + '-help';
        control.setAttribute('aria-describedby', hint.id);
        wrap.appendChild(hint);
      }
      return wrap;
    }

    function inputFor(object, key, options) {
      options = options || {};
      var input = document.createElement(options.multiline ? 'textarea' : 'input');
      if (!options.multiline) input.type = options.type || 'text';
      if (options.multiline) input.rows = options.rows || 3;
      input.value = stringValue(object[key]);
      if (options.inputmode) input.inputMode = options.inputmode;
      if (options.pattern) input.pattern = options.pattern;
      if (options.placeholder) input.placeholder = options.placeholder;
      if (options.maxlength) input.maxLength = options.maxlength;
      if (typeof options.min !== 'undefined') input.min = stringValue(options.min);
      if (typeof options.max !== 'undefined') input.max = stringValue(options.max);
      if (options.readonly) input.readOnly = true;
      if (options.required) input.required = true;
      input.addEventListener('input', function () {
        object[key] = input.value;
        if (options.onInput) options.onInput(input.value, input);
        changed();
      });
      input.addEventListener('change', function () {
        if (options.onChange) options.onChange(input.value, input);
        changed();
      });
      return input;
    }

    function selectFor(object, key, entries, options) {
      options = options || {};
      var select = document.createElement('select');
      if (options.blank) {
        var blank = document.createElement('option');
        blank.value = '';
        blank.textContent = options.blank;
        select.appendChild(blank);
      }
      entries.forEach(function (entry) {
        var option = document.createElement('option');
        option.value = stringValue(entry.value);
        option.textContent = entry.label;
        if (entry.title) option.title = entry.title;
        select.appendChild(option);
      });
      select.value = stringValue(object[key]);
      if (options.disabled) select.disabled = true;
      select.addEventListener('change', function () {
        object[key] = select.value;
        if (options.onChange) options.onChange(select.value, select);
        changed();
      });
      return select;
    }

    function enumEntries(group) {
      var source = METADATA[group] || {};
      return Object.keys(source).sort(function (a, b) { return integer(a) - integer(b); }).map(function (key) {
        var value = source[key];
        return {
          value: key,
          label: key + ' — ' + (typeof value === 'object' ? value.label : value),
          title: typeof value === 'object' ? value.help || '' : ''
        };
      });
    }

    function categoryEntries() {
      return Object.keys(CATEGORY_OPTIONS || {}).sort(function (a, b) {
        return integer(a) - integer(b);
      }).map(function (id) {
        return { value: id, label: id + ': ' + CATEGORY_OPTIONS[id] };
      });
    }

    function classEntries(includeAny) {
      var rows = [];
      if (includeAny) rows.push({ value: 0, label: '0 — Any class' });
      Object.keys(METADATA.classes || {}).sort(function (a, b) { return integer(a) - integer(b); }).forEach(function (id) {
        rows.push({ value: id, label: id + ' — ' + METADATA.classes[id] });
      });
      return rows;
    }

    function skillEntries(includeWildcard) {
      var rows = Object.keys(METADATA.skills || {}).sort(function (a, b) { return integer(a) - integer(b); }).map(function (id) {
        return { value: id, label: id + ' — ' + METADATA.skills[id] };
      });
      if (includeWildcard) rows.push({ value: '4294967295', label: '4294967295 — Any skill (wildcard)' });
      return rows;
    }

    function nextSequence(rows) {
      var maximum = -1;
      rows.forEach(function (row) { maximum = Math.max(maximum, integer(row.sequence, 0)); });
      return maximum + 1;
    }

    function nextComponentId() {
      var maximum = Math.max(0, integer(graph.suggested_component_id, 1) - 1);
      graph.components.forEach(function (row) { maximum = Math.max(maximum, integer(row.component_id, 0)); });
      return maximum + 1;
    }

    function nextOptionId() {
      var maximum = 0;
      if (graph.reward_set) graph.reward_set.options.forEach(function (row) {
        maximum = Math.max(maximum, integer(row.option_id, 0));
      });
      return maximum + 1;
    }

    function sectionCard(title, subtitle) {
      var card = element('article', 'achievement-repeat-card');
      var heading = element('div', 'achievement-repeat-card-heading');
      var copy = element('div');
      copy.appendChild(element('h3', '', title));
      if (subtitle) copy.appendChild(element('p', '', subtitle));
      heading.appendChild(copy);
      card.appendChild(heading);
      return { card: card, heading: heading };
    }

    function removeButton(handler, title) {
      return button('Remove', 'achievement-button is-small is-danger', title || 'Remove this row from the submitted graph', handler);
    }

    function lookupFor(object, key, type, options) {
      options = options || {};
      var box = element('div', 'achievement-lookup-control');
      var input = inputFor(object, key, {
        inputmode: 'numeric',
        pattern: '[0-9]+',
        placeholder: options.placeholder || 'Type an ID or search text',
        onInput: function (value, control) {
          if (typeof options.onInput === 'function') options.onInput(value, control);
        }
      });
      var dataList = document.createElement('datalist');
      var listId = nextUid('lookup-list');
      dataList.id = listId;
      input.setAttribute('list', listId);
      input.setAttribute('autocomplete', 'off');
      var status = element('small', 'achievement-lookup-status', 'Type any valid numeric ID; suggestions are optional.');
      var timer = null;
      var requestNumber = 0;

      function load() {
        var query = input.value.trim();
        if (!query && !options.loadEmpty) return;
        requestNumber += 1;
        var currentRequest = requestNumber;
        status.textContent = 'Loading suggestions…';
        var url;
        try {
          url = new URL(LOOKUP_URL, window.location.href);
          url.searchParams.set('type', type);
          if (/^\d+$/.test(query)) url.searchParams.set('ids', query);
          else url.searchParams.set('q', query);
        } catch (error) {
          var buildFailureStatus = typeof options.onFailure === 'function'
            ? options.onFailure(query) : '';
          status.textContent = buildFailureStatus
            || 'Suggestions unavailable; a valid numeric ID can still be entered.';
          return;
        }
        fetch(url.toString(), { credentials: 'same-origin', headers: { Accept: 'application/json' } })
          .then(function (response) {
            if (!response.ok) throw new Error('Lookup returned HTTP ' + response.status + '.');
            return response.json();
          })
          .then(function (payload) {
            if (currentRequest !== requestNumber
              || stringValue(object[key]).trim() !== query) return;
            clear(dataList);
            var results = list(payload.results);
            results.forEach(function (result) {
              var option = document.createElement('option');
              option.value = stringValue(result.id);
              option.label = typeof options.formatResult === 'function'
                ? options.formatResult(result)
                : stringValue(result.id) + ' — ' + stringValue(result.name);
              dataList.appendChild(option);
            });
            status.textContent = dataList.children.length
              ? 'Choose a suggestion or keep any valid numeric ID you entered.'
              : 'No suggestions found; a valid numeric ID can still be entered.';
            if (typeof options.onResults === 'function') {
              var resultStatus = options.onResults(results, query);
              if (resultStatus) status.textContent = resultStatus;
            }
          })
          .catch(function () {
            if (currentRequest !== requestNumber
              || stringValue(object[key]).trim() !== query) return;
            var failureStatus = typeof options.onFailure === 'function'
              ? options.onFailure(query) : '';
            status.textContent = failureStatus
              || 'Suggestions could not be loaded; editing remains available with a numeric ID.';
          });
      }

      input.addEventListener('focus', load);
      input.addEventListener('input', function () {
        requestNumber += 1;
        clear(dataList);
        window.clearTimeout(timer);
        timer = window.setTimeout(load, 250);
      });
      box.appendChild(input);
      box.appendChild(dataList);
      box.appendChild(status);
      return box;
    }

    function changed() {
      updateCounts();
      window.clearTimeout(validationTimer);
      validationTimer = window.setTimeout(renderValidation, 160);
    }

    function bindGeneral() {
      form.querySelectorAll('[data-achievement-field]').forEach(function (control) {
        var key = control.getAttribute('data-achievement-field');
        control.addEventListener('input', function () {
          graph[key] = control.value;
          var badge = document.querySelector('[data-achievement-state-badge]');
          if (key === 'enabled' && badge) {
            badge.textContent = enabled(control.value) ? 'Enabled' : 'Draft / disabled';
            badge.className = 'achievement-badge ' + (enabled(control.value) ? 'is-success' : 'is-muted');
          }
          changed();
        });
        control.addEventListener('change', function () {
          graph[key] = control.value;
          changed();
        });
      });
    }

    function setupTabs() {
      var tabs = Array.prototype.slice.call(form.querySelectorAll('[data-achievement-tab]'));
      function activate(key, focusTab) {
        tabs.forEach(function (tab) {
          var active = tab.getAttribute('data-achievement-tab') === key;
          tab.setAttribute('aria-selected', active ? 'true' : 'false');
          tab.tabIndex = active ? 0 : -1;
          var panel = form.querySelector('[data-achievement-panel="' + tab.getAttribute('data-achievement-tab') + '"]');
          if (panel) {
            panel.hidden = !active;
            panel.classList.toggle('is-active', active);
          }
          if (active && focusTab) tab.focus();
        });
      }
      tabs.forEach(function (tab, index) {
        tab.addEventListener('click', function () { activate(tab.getAttribute('data-achievement-tab'), false); });
        tab.addEventListener('keydown', function (event) {
          if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight' && event.key !== 'Home' && event.key !== 'End') return;
          event.preventDefault();
          var target = index;
          if (event.key === 'ArrowLeft') target = (index + tabs.length - 1) % tabs.length;
          if (event.key === 'ArrowRight') target = (index + 1) % tabs.length;
          if (event.key === 'Home') target = 0;
          if (event.key === 'End') target = tabs.length - 1;
          activate(tabs[target].getAttribute('data-achievement-tab'), true);
        });
      });
      return activate;
    }

    var activateTab = setupTabs();

    function renderAssociations() {
      var target = form.querySelector('[data-achievement-associations]');
      var empty = form.querySelector('[data-achievement-associations-empty]');
      if (!target) return;
      clear(target);
      graph.associations.forEach(function (row, index) {
        var parts = sectionCard('Category association ' + (index + 1), 'The category ID is validated against the current content database.');
        parts.heading.appendChild(removeButton(function () {
          graph.associations.splice(index, 1);
          renderAssociations();
          changed();
        }));
        var grid = element('div', 'achievement-form-grid');
        var categoryMeta = metaField('achievement_category_associations', 'category_id');
        grid.appendChild(field(categoryMeta.label, categoryMeta.help,
          selectFor(row, 'category_id', categoryEntries(), { blank: 'Select a category…' })));
        var sequenceMeta = metaField('achievement_category_associations', 'sequence');
        grid.appendChild(field(sequenceMeta.label, sequenceMeta.help,
          inputFor(row, 'sequence', { inputmode: 'numeric', pattern: '[0-9]+' })));
        var displayMeta = metaField('achievement_category_associations', 'display_text');
        grid.appendChild(field(displayMeta.label, displayMeta.help,
          inputFor(row, 'display_text', { maxlength: 255 }), true));
        parts.card.appendChild(grid);
        target.appendChild(parts.card);
      });
      if (empty) empty.hidden = graph.associations.length > 0;
    }

    function eventGuidance(eventType) {
      var event = (METADATA.events || {})[stringValue(eventType)] || {};
      return event;
    }

    function applyEventDefaults(criterion, previous) {
      var eventType = integer(criterion.event_type, 0);
      if (integer(previous, eventType) !== eventType) {
        criterion.target_id = 0;
        criterion.target_id2 = 0;
        criterion.target_value = 0;
        criterion._npc_name = '';
      }
      if ([1, 10].indexOf(eventType) !== -1) criterion.target_id = 0;
      if ([7, 12, 13].indexOf(eventType) === -1) criterion.target_id2 = 0;
      if ([1, 4, 7, 9, 10, 11, 13].indexOf(eventType) !== -1 && integer(criterion.progress_mode, 0) === 0) {
        criterion.progress_mode = 3;
      }
      if ([1, 7, 9, 10, 13].indexOf(eventType) !== -1 && integer(criterion.target_value, 0) < 1) {
        criterion.target_value = 1;
      }
      if (eventType === 13 && integer(criterion.target_id2, 0) < 1) criterion.target_id2 = 1;
    }

    function canonicalNpcName(value) {
      var canonical = '';
      var hasLetter = false;
      var pending = false;
      String(value || '').split('').forEach(function (character) {
        var code = character.charCodeAt(0);
        if (code === 32 || code === 95) {
          pending = hasLetter;
          return;
        }
        if (code >= 65 && code <= 90) code += 32;
        if (code < 97 || code > 122) return;
        if (pending) {
          canonical += ' ';
          pending = false;
        }
        canonical += String.fromCharCode(code);
        hasLetter = true;
      });
      return canonical;
    }

    function npcNameHash(value) {
      var canonical = canonicalNpcName(value);
      if (!canonical) return 0;
      var hash = 0x811c9dc5;
      for (var index = 0; index < canonical.length; index += 1) {
        hash ^= canonical.charCodeAt(index);
        hash = Math.imul(hash, 0x01000193) >>> 0;
      }
      return hash >>> 0;
    }

    function targetControl(criterion, which) {
      var eventType = integer(criterion.event_type, 0);
      var key = which === 2 ? 'target_id2' : 'target_id';
      if (which === 1 && (eventType === 9 || eventType === 13)) {
        return selectFor(criterion, key, skillEntries(eventType === 9));
      }
      if (which === 2 && (eventType === 7 || eventType === 13)) {
        return selectFor(criterion, key, classEntries(eventType === 7));
      }
      var lookupType = null;
      if (which === 1) {
        lookupType = eventGuidance(eventType).lookup || null;
        if (lookupType === 'skill' || lookupType === 'npc_name') lookupType = null;
      }
      if (which === 2 && eventType === 12) lookupType = 'zone';
      if (lookupType) return lookupFor(criterion, key, lookupType);
      return inputFor(criterion, key, { inputmode: 'numeric', pattern: '[0-9]+' });
    }

    function renderCriterion(component, criterion, index, container) {
      var existing = stringValue(criterion.id);
      var parts = sectionCard('Criterion ' + (index + 1), existing ? 'Stored row ' + existing : 'New criterion row');
      parts.card.classList.add('achievement-criterion-card');
      parts.heading.appendChild(removeButton(function () {
        if (stringValue(criterion.id) && !window.confirm('Remove stored criterion row ' + stringValue(criterion.id) + ' from this definition?')) return;
        component.criteria.splice(index, 1);
        renderComponents();
        changed();
      }, 'Remove this criterion'));
      var grid = element('div', 'achievement-form-grid');

      var eventMeta = metaField('achievement_criteria', 'event_type');
      var oldEvent = criterion.event_type;
      grid.appendChild(field(eventMeta.label, eventMeta.help,
        selectFor(criterion, 'event_type', enumEntries('events'), { onChange: function () {
          applyEventDefaults(criterion, oldEvent);
          renderComponents();
        }})));
      var modeMeta = metaField('achievement_criteria', 'progress_mode');
      grid.appendChild(field(modeMeta.label, modeMeta.help, selectFor(criterion, 'progress_mode', enumEntries('progress_modes'))));
      var behaviorMeta = metaField('achievement_criteria', 'behavior');
      grid.appendChild(field(behaviorMeta.label, behaviorMeta.help, selectFor(criterion, 'behavior', enumEntries('behaviors'))));
      var requiredMeta = metaField('achievement_criteria', 'required_count');
      grid.appendChild(field(requiredMeta.label, requiredMeta.help,
        inputFor(criterion, 'required_count', { inputmode: 'numeric', pattern: '[0-9]+' })));

      var guidance = eventGuidance(criterion.event_type);
      if (integer(criterion.event_type, 0) === 12) {
        var nameInput = document.createElement('input');
        nameInput.type = 'text';
        nameInput.value = criterion._npc_name || '';
        nameInput.placeholder = 'For example: Rallos_Zek';
        var nameBox = element('div', 'achievement-npc-hash-control');
        var hashStatus = element('small', 'achievement-lookup-status', 'Canonical: ' + canonicalNpcName(nameInput.value) + ' · Hash: ' + npcNameHash(nameInput.value));
        var applyHash = button('Apply hash', 'achievement-button is-small is-secondary', 'Normalize the name and copy its unsigned FNV-1a hash into Primary target', function () {
          criterion._npc_name = nameInput.value;
          criterion.target_id = stringValue(npcNameHash(nameInput.value));
          renderComponents();
          changed();
        });
        nameInput.addEventListener('input', function () {
          criterion._npc_name = nameInput.value;
          hashStatus.textContent = 'Canonical: ' + canonicalNpcName(nameInput.value) + ' · Hash: ' + npcNameHash(nameInput.value);
        });
        nameBox.appendChild(nameInput);
        nameBox.appendChild(applyHash);
        nameBox.appendChild(hashStatus);
        grid.appendChild(field('NPC name hash helper', 'Uses the exact ASCII normalization and unsigned FNV-1a algorithm used by EQEmu. Review collisions within the selected zone.', nameBox, true));
      }

      grid.appendChild(field(guidance.target_id_label || 'Primary target', guidance.target_id_help || metaField('achievement_criteria', 'target_id').help,
        targetControl(criterion, 1)));
      grid.appendChild(field(guidance.target_id2_label || 'Secondary target', guidance.target_id2_help || metaField('achievement_criteria', 'target_id2').help,
        targetControl(criterion, 2)));
      var targetValueMeta = metaField('achievement_criteria', 'target_value');
      grid.appendChild(field(guidance.target_value_label || targetValueMeta.label, guidance.target_value_help || targetValueMeta.help,
        inputFor(criterion, 'target_value', { inputmode: 'numeric', pattern: '[0-9]+' })));
      var enabledMeta = metaField('achievement_criteria', 'enabled');
      grid.appendChild(field(enabledMeta.label, enabledMeta.help,
        selectFor(criterion, 'enabled', [{ value: 1, label: 'Enabled (1)' }, { value: 0, label: 'Disabled (0)' }])));

      var callout = element('div', 'achievement-callout is-info');
      callout.appendChild(element('strong', '', ((METADATA.events || {})[stringValue(criterion.event_type)] || {}).label || 'Event guidance'));
      callout.appendChild(element('p', '', (guidance.help || '') + (guidance.replay ? ' ' + guidance.replay : '')));
      parts.card.appendChild(callout);
      parts.card.appendChild(grid);
      container.appendChild(parts.card);
    }

    function renderComponents() {
      var target = form.querySelector('[data-achievement-components]');
      var empty = form.querySelector('[data-achievement-components-empty]');
      if (!target) return;
      clear(target);
      graph.components.forEach(function (component, index) {
        component.criteria = list(component.criteria);
        var identity = stringValue(component.component_type) + ':' + stringValue(component.component_id);
        var componentPersisted = initialComponents.indexOf(identity) !== -1;
        var parts = sectionCard('Component ' + identity, component.criteria.length + ' criterion row' + (component.criteria.length === 1 ? '' : 's'));
        parts.card.classList.add('achievement-component-card');
        var actions = element('div', 'achievement-heading-actions');
        actions.appendChild(button('+ Add criterion', 'achievement-button is-small', 'Add an alternate event target to this component', function () {
          component.criteria.push({
            id: null, event_type: 0, progress_mode: 2, behavior: 0,
            target_id: 0, target_id2: 0, target_value: 0,
            required_count: Math.max(1, integer(component.presentation_count, 1)), enabled: 1
          });
          renderComponents();
          changed();
        }));
        if (componentPersisted) {
          actions.appendChild(retainedIdentityControl(
            'Persisted - retire only',
            'Character progress can reference this identity. Disable all criteria to retire it safely.'
          ));
        } else {
          actions.appendChild(removeButton(function () {
            if (component.criteria.length
                && !window.confirm('Remove component ' + identity + ' and all of its nested criteria from this definition?')) return;
            graph.components.splice(index, 1);
            renderComponents();
            changed();
          }, 'Remove this new component and its criteria'));
        }
        parts.heading.appendChild(actions);
        var grid = element('div', 'achievement-form-grid');
        var typeMeta = metaField('achievement_components', 'component_type');
        grid.appendChild(field(typeMeta.label, typeMeta.help,
          selectFor(component, 'component_type', enumEntries('component_types'), {
            disabled: componentPersisted,
            onChange: function () { renderComponents(); }
          })));
        ['component_id', 'sequence', 'presentation_count'].forEach(function (key) {
          var info = metaField('achievement_components', key);
          grid.appendChild(field(info.label, info.help,
            inputFor(component, key, {
              inputmode: 'numeric', pattern: '[0-9]+',
              readonly: key === 'component_id' && componentPersisted,
              onChange: key === 'component_id' ? renderComponents : null
            })));
        });
        ['name', 'description'].forEach(function (key) {
          var info = metaField('achievement_components', key);
          grid.appendChild(field(info.label, info.help, inputFor(component, key, {}), true));
        });
        parts.card.appendChild(grid);
        var criterionList = element('div', 'achievement-repeat-list achievement-criterion-list');
        component.criteria.forEach(function (criterion, criterionIndex) {
          renderCriterion(component, criterion, criterionIndex, criterionList);
        });
        if (!component.criteria.length) {
          criterionList.appendChild(element('p', 'achievement-empty-inline', 'No criteria. This component is presentation-only until a criterion is added.'));
        }
        parts.card.appendChild(criterionList);
        target.appendChild(parts.card);
      });
      if (empty) empty.hidden = graph.components.length > 0;
    }

    function clearAaRewardLookupState(reward) {
      delete reward._aa_rank_count;
      delete reward._aa_rank_chain_valid;
      delete reward._aa_class_mask;
      delete reward._aa_eligible_classes;
      delete reward._aa_enabled;
    }

    function applyRewardTypeDefaults(reward, previous) {
      var type = integer(reward.reward_type, 0);
      if (integer(previous, type) !== type) reward.reward_data_id = 0;
      if (type === 2 || type === 3) reward.reward_data_id = 0;
      if (integer(reward.amount, 0) < 1) reward.amount = 1;
      if (type === 5) reward.amount = 1;
      if (type === 7) reward.option_id = null;
      clearAaRewardLookupState(reward);
    }

    function aaClassSummary(result) {
      var classIds = list(result.eligible_classes);
      if (!classIds.length) return 'no playable classes';
      if (classIds.length === 16) return 'all playable classes';
      return classIds.map(function (classId) {
        return (METADATA.classes || {})[stringValue(classId)] || ('Class ' + stringValue(classId));
      }).join(', ');
    }

    function rewardDataControl(reward) {
      var type = integer(reward.reward_type, 0);
      var lookupType = { 0: 'item', 4: 'currency', 5: 'title-set', 6: 'aa-ability', 7: 'aa-ability' }[type] || null;
      if (lookupType === 'aa-ability') {
        return lookupFor(reward, 'reward_data_id', lookupType, {
          formatResult: function (result) {
            return stringValue(result.id) + ' — ' + stringValue(result.name)
              + (enabled(result.enabled) ? '' : ' (disabled; cannot be delivered)')
              + ' · ' + stringValue(result.rank_count) + ' rank(s) · ' + aaClassSummary(result);
          },
          onInput: function () {
            clearAaRewardLookupState(reward);
          },
          onFailure: function () {
            clearAaRewardLookupState(reward);
            changed();
            return 'AA suggestions could not be loaded; server validation will verify any numeric ability ID when saved.';
          },
          onResults: function (results, query) {
            var exact = null;
            results.forEach(function (result) {
              if (stringValue(result.id) === stringValue(query)) exact = result;
            });
            if (!exact) {
              clearAaRewardLookupState(reward);
              changed();
              return results.length
                ? 'Choose an enabled AA ability. Suggestions show reachable ranks and eligible classes.'
                : 'No enabled AA ability matched. A published grant must reference an enabled aa_ability row.';
            }
            reward._aa_rank_count = integer(exact.rank_count, 0);
            reward._aa_rank_chain_valid = exact.rank_chain_valid !== false;
            reward._aa_class_mask = integer(exact.class_mask, 0);
            reward._aa_eligible_classes = list(exact.eligible_classes);
            reward._aa_enabled = enabled(exact.enabled);
            changed();
            return stringValue(exact.name)
              + (reward._aa_enabled ? '' : ' is disabled and cannot be published')
              + ': ' + stringValue(exact.rank_count)
              + ' reachable rank(s)'
              + (reward._aa_rank_chain_valid ? '' : '; the linked chain is malformed after that reachable prefix')
              + '; eligible classes: ' + aaClassSummary(exact) + '.';
          }
        });
      }
      if (lookupType) return lookupFor(reward, 'reward_data_id', lookupType);
      if (type === 1) {
        return selectFor(reward, 'reward_data_id', [
          { value: 0, label: '0 — Normal XP handling' },
          { value: 1, label: '1 — Normal-only raw XP' }
        ]);
      }
      var control = inputFor(reward, 'reward_data_id', { inputmode: 'numeric', pattern: '[0-9]+' });
      if (type === 2 || type === 3) control.readOnly = true;
      return control;
    }

    function optionEntries() {
      if (!graph.reward_set) return [];
      return graph.reward_set.options.map(function (option) {
        var kind = enabled(option.common_to_all) ? 'Common' : 'Choice';
        return {
          value: option.option_id,
          label: stringValue(option.option_id) + ' — ' + kind + ': ' + (option.label || 'Untitled option')
        };
      });
    }

    function renderRewards() {
      var target = form.querySelector('[data-achievement-rewards]');
      var empty = form.querySelector('[data-achievement-rewards-empty]');
      if (!target) return;
      clear(target);
      graph.rewards.forEach(function (reward, index) {
        var rewardId = stringValue(reward.reward_id);
        var rewardPersisted = initialRewardIds.indexOf(rewardId) !== -1;
        var parts = sectionCard(rewardId ? 'Grant ' + rewardId : 'New grant ' + (index + 1), rewardId ? 'Existing stable reward identity' : 'ID will be allocated atomically when saved');
        if (rewardPersisted) {
          parts.heading.appendChild(retainedIdentityControl(
            'Persisted - retire only',
            'Character reward ledgers can reference this grant. Set Enabled to 0 to retire it safely.'
          ));
        } else {
          parts.heading.appendChild(removeButton(function () {
            graph.rewards.splice(index, 1);
            renderRewards();
            changed();
          }, 'Remove this new unsaved grant'));
        }
        var grid = element('div', 'achievement-form-grid');
        var idMeta = metaField('rewards', 'reward_id');
        grid.appendChild(field(idMeta.label, idMeta.help,
          inputFor(reward, 'reward_id', { inputmode: 'numeric', pattern: '[0-9]+', readonly: true, placeholder: 'Allocated on save' })));
        var sequenceMeta = metaField('rewards', 'sequence');
        grid.appendChild(field(sequenceMeta.label, sequenceMeta.help,
          inputFor(reward, 'sequence', { inputmode: 'numeric', pattern: '[0-9]+' })));
        var oldType = reward.reward_type;
        var typeMeta = metaField('rewards', 'reward_type');
        grid.appendChild(field(typeMeta.label, typeMeta.help,
          selectFor(reward, 'reward_type', enumEntries('reward_types'), { onChange: function () {
            applyRewardTypeDefaults(reward, oldType);
            renderRewards();
          }})));
        var rewardType = (METADATA.reward_types || {})[stringValue(reward.reward_type)] || {};
        var dataMeta = metaField('rewards', 'reward_data_id');
        grid.appendChild(field(rewardType.data_label || dataMeta.label, rewardType.data_help || rewardType.help || dataMeta.help, rewardDataControl(reward)));
        var amountMeta = metaField('rewards', 'amount');
        var amountOptions = { inputmode: 'numeric', pattern: '[0-9]+', min: 1 };
        if (integer(reward.reward_type, -1) === 6 && integer(reward._aa_rank_count, 0) > 0) {
          amountOptions.max = reward._aa_rank_count;
        }
        grid.appendChild(field(amountMeta.label, rewardType.amount_help || amountMeta.help,
          inputFor(reward, 'amount', amountOptions)));
        var enabledMeta = metaField('rewards', 'enabled');
        grid.appendChild(field(enabledMeta.label, enabledMeta.help,
          selectFor(reward, 'enabled', [{ value: 1, label: 'Enabled (1)' }, { value: 0, label: 'Disabled (0)' }])));
        var optionMeta = metaField('rewards', 'option_id');
        var automaticOnly = integer(reward.reward_type, -1) === 7;
        var fallbackNeedsRepair = automaticOnly && stringValue(reward.option_id) !== '';
        var deliveryControl = selectFor(
          reward,
          'option_id',
          automaticOnly && !fallbackNeedsRepair ? [] : optionEntries(),
          {
            blank: automaticOnly
              ? (fallbackNeedsRepair ? 'Clear this mapping: automatic is required' : 'Automatic only (required)')
              : 'Automatic on completion',
            disabled: automaticOnly && !fallbackNeedsRepair
          }
        );
        grid.appendChild(field(optionMeta.label, automaticOnly
          ? (fallbackNeedsRepair
            ? 'This existing type 7 row is mapped to an option. Clear the mapping before publishing it.'
            : 'Type 7 is a server-only inverse-class fallback and must be a direct automatic achievement reward.')
          : optionMeta.help, deliveryControl));
        var descMeta = metaField('rewards', 'description');
        grid.appendChild(field(descMeta.label, descMeta.help,
          inputFor(reward, 'description', { maxlength: 255 }), true));
        parts.card.appendChild(grid);
        target.appendChild(parts.card);
      });
      if (empty) empty.hidden = graph.rewards.length > 0;
    }

    function removeRewardOption(index) {
      if (!graph.reward_set) return;
      var option = graph.reward_set.options[index];
      var mapped = graph.rewards.filter(function (reward) {
        return stringValue(reward.option_id) === stringValue(option.option_id);
      });
      var existing = initialOptionIds.indexOf(stringValue(option.option_id)) !== -1;
      if (existing) {
        window.alert('This reward option is a persisted identity. Set Enabled to 0 to retire it safely.');
        return;
      }
      if (mapped.length && !window.confirm(
        'It has ' + mapped.length + ' mapped grant(s); removing it will clear those mappings and disable those grants to prevent accidental automatic delivery. '
        + 'Remove option ' + stringValue(option.option_id) + '?'
      )) return;
      mapped.forEach(function (reward) {
        reward.option_id = '';
        reward.enabled = 0;
      });
      graph.reward_set.options.splice(index, 1);
      renderRewardSet();
      renderRewards();
      changed();
    }

    function renderRewardSet() {
      var target = form.querySelector('[data-achievement-reward-set]');
      var toggle = form.querySelector('[data-achievement-use-reward-set]');
      if (!target || !toggle) return;
      toggle.checked = !!graph.reward_set;
      toggle.disabled = initialRewardSetId !== '' && !!graph.reward_set;
      toggle.title = toggle.disabled
        ? 'Character selections can reference this persisted set. Set Enabled to 0 to retire it safely.'
        : 'Create or remove a selectable reward set before it has been saved.';
      clear(target);
      if (!graph.reward_set) {
        target.appendChild(element('p', 'achievement-empty-inline', 'No selectable set. Unmapped enabled grants are delivered automatically on completion.'));
        return;
      }
      graph.reward_set.options = list(graph.reward_set.options);
      var setGrid = element('div', 'achievement-form-grid');
      var setIdMeta = metaField('reward_sets', 'reward_set_id');
      setGrid.appendChild(field(setIdMeta.label, setIdMeta.help,
        inputFor(graph.reward_set, 'reward_set_id', { inputmode: 'numeric', pattern: '[0-9]+', readonly: initialRewardSetId !== '', placeholder: 'Allocated on save' })));
      var titleMeta = metaField('reward_sets', 'title');
      setGrid.appendChild(field(titleMeta.label, titleMeta.help,
        inputFor(graph.reward_set, 'title', { maxlength: 255 })));
      var setEnabledMeta = metaField('reward_sets', 'enabled');
      setGrid.appendChild(field(setEnabledMeta.label, setEnabledMeta.help,
        selectFor(graph.reward_set, 'enabled', [{ value: 1, label: 'Enabled (1)' }, { value: 0, label: 'Disabled (0)' }])));
      var sourceEnabledMeta = metaField('reward_sources', 'enabled');
      setGrid.appendChild(field(sourceEnabledMeta.label, sourceEnabledMeta.help,
        selectFor(graph.reward_set, 'source_enabled', [{ value: 1, label: 'Enabled (1)' }, { value: 0, label: 'Disabled (0)' }])));
      target.appendChild(setGrid);
      var optionHeading = element('div', 'achievement-panel-heading');
      var copy = element('div');
      copy.appendChild(element('h4', '', 'Options'));
      copy.appendChild(element('p', '', 'When the definition, achievement source, and shared catalog set are all enabled, every enabled option needs an enabled mapped grant. Disable the source to stage incomplete work safely. Common options accompany one selected non-common choice.'));
      optionHeading.appendChild(copy);
      optionHeading.appendChild(button('+ Add option', 'achievement-button is-small', 'Add a common or selectable reward option', function () {
        graph.reward_set.options.push({
          option_id: nextOptionId(), sequence: nextSequence(graph.reward_set.options),
          label: '', common_to_all: 0, flags: 0, enabled: 1
        });
        renderRewardSet();
        renderRewards();
        changed();
      }));
      target.appendChild(optionHeading);
      var options = element('div', 'achievement-repeat-list');
      graph.reward_set.options.forEach(function (option, index) {
        var optionPersisted = initialOptionIds.indexOf(stringValue(option.option_id)) !== -1;
        var parts = sectionCard('Option ' + stringValue(option.option_id), enabled(option.common_to_all) ? 'Common grant group' : 'Selectable player choice');
        if (optionPersisted) {
          parts.heading.appendChild(retainedIdentityControl(
            'Persisted - retire only',
            'Character reward selections can reference this option. Set Enabled to 0 to retire it safely.'
          ));
        } else {
          parts.heading.appendChild(removeButton(function () { removeRewardOption(index); }, 'Remove this new reward option'));
        }
        var grid = element('div', 'achievement-form-grid');
        ['option_id', 'sequence', 'flags'].forEach(function (key) {
          var info = metaField('reward_options', key);
          grid.appendChild(field(info.label, info.help,
            inputFor(option, key, {
              inputmode: 'numeric', pattern: '[0-9]+',
              readonly: key === 'option_id' && initialOptionIds.indexOf(stringValue(option.option_id)) !== -1,
              onChange: key === 'option_id' ? function () { renderRewardSet(); renderRewards(); } : null
            })));
        });
        var labelMeta = metaField('reward_options', 'label');
        grid.appendChild(field(labelMeta.label, labelMeta.help, inputFor(option, 'label', { maxlength: 255 }), true));
        ['common_to_all', 'enabled'].forEach(function (key) {
          var info = metaField('reward_options', key);
          grid.appendChild(field(info.label, info.help,
            selectFor(option, key, [{ value: 1, label: 'Enabled (1)' }, { value: 0, label: 'Disabled (0)' }], {
              onChange: function () { if (key === 'common_to_all') renderRewardSet(); }
            })));
        });
        var grants = graph.rewards.filter(function (reward) {
          return stringValue(reward.option_id) === stringValue(option.option_id);
        });
        var grantText = grants.length
          ? grants.map(function (reward) { return (reward.reward_id || 'new') + ': ' + (reward.description || 'Untitled grant') + (enabled(reward.enabled) ? '' : ' (disabled)'); }).join(', ')
          : 'No grants mapped. Map a canonical grant below before enabling this option.';
        parts.card.appendChild(element('p', grants.length ? 'achievement-mapping-summary' : 'achievement-mapping-summary is-warning', grantText));
        parts.card.appendChild(grid);
        options.appendChild(parts.card);
      });
      if (!graph.reward_set.options.length) options.appendChild(element('p', 'achievement-empty-inline', 'No options. Add at least one enabled non-common choice before enabling the set.'));
      target.appendChild(options);
    }

    function renderRestrictions() {
      var target = form.querySelector('[data-achievement-restrictions]');
      var empty = form.querySelector('[data-achievement-restrictions-empty]');
      if (!target) return;
      clear(target);
      graph.restrictions.forEach(function (restriction, index) {
        var parts = sectionCard('Cast restriction ' + (index + 1), 'All achievement-backed rows sharing one restriction ID are evaluated with AND semantics.');
        parts.heading.appendChild(removeButton(function () {
          graph.restrictions.splice(index, 1);
          renderRestrictions();
          changed();
        }));
        var grid = element('div', 'achievement-form-grid');
        var idMeta = metaField('achievement_cast_requirements', 'restriction_id');
        grid.appendChild(field(idMeta.label, idMeta.help,
          inputFor(restriction, 'restriction_id', { inputmode: 'numeric', pattern: '[0-9]+' })));
        var stateMeta = metaField('achievement_cast_requirements', 'requires_completed');
        grid.appendChild(field(stateMeta.label, stateMeta.help,
          selectFor(restriction, 'requires_completed', [
            { value: 1, label: 'Achievement must be completed (1)' },
            { value: 0, label: 'Achievement must remain incomplete (0)' }
          ])));
        parts.card.appendChild(grid);
        target.appendChild(parts.card);
      });
      if (empty) empty.hidden = graph.restrictions.length > 0;
    }

    function addIssue(issues, severity, path, message) {
      issues.push({ severity: severity, path: path, message: message });
    }

    function isUnsigned(value, minimum, maximum) {
      var text = stringValue(value).trim();
      if (!/^\d+$/.test(text)) return false;
      text = text.replace(/^0+(?=\d)/, '');
      var min = String(minimum);
      var max = String(maximum);
      function compare(a, b) { return a.length === b.length ? (a === b ? 0 : (a < b ? -1 : 1)) : (a.length < b.length ? -1 : 1); }
      return compare(text, min) >= 0 && compare(text, max) <= 0;
    }

    function rewardConstraintAccepts(value, values, minimum, maximum) {
      if (Array.isArray(values)) {
        return values.some(function (allowed) {
          return isUnsigned(value, stringValue(allowed), stringValue(allowed));
        });
      }
      return isUnsigned(value, stringValue(minimum), stringValue(maximum));
    }

    function validateRuntimeRewardSemantics(reward, type, path, issues) {
      var constraints = (METADATA.reward_types || {})[stringValue(type)] || null;
      if (!constraints) return;
      if (!rewardConstraintAccepts(
        reward.reward_data_id,
        constraints.data_values,
        constraints.data_min,
        constraints.data_max
      )) {
        addIssue(issues, 'error', path + '.reward_data_id', constraints.data_help || 'Referenced data is outside the runtime delivery range.');
      }
      if (!rewardConstraintAccepts(
        reward.amount,
        constraints.amount_values,
        constraints.amount_min,
        constraints.amount_max
      )) {
        addIssue(issues, 'error', path + '.amount', constraints.amount_help || 'Amount is outside the runtime delivery range.');
      }
    }

    function validateGraph() {
      var issues = [];
      var uint32 = '4294967295';
      if (!isUnsigned(graph.id, '1', uint32)) addIssue(issues, 'error', 'id', 'Achievement ID must be a nonzero unsigned 32-bit integer.');
      if (initialAchievementId && stringValue(graph.id) !== initialAchievementId) addIssue(issues, 'error', 'id', 'The stable achievement ID cannot change after creation.');
      if (!stringValue(graph.name).trim()) addIssue(issues, 'error', 'name', 'Name is required.');
      if (stringValue(graph.name).length > 255) addIssue(issues, 'error', 'name', 'Name cannot exceed 255 characters.');
      [['icon_id', '0', uint32], ['points', '0', uint32], ['has_reward', '0', '1'], ['client_flag', '0', '255'], ['version', '0', uint32]].forEach(function (rule) {
        if (!isUnsigned(graph[rule[0]], rule[1], rule[2])) addIssue(issues, 'error', rule[0], rule[0].replace(/_/g, ' ') + ' is outside its allowed unsigned range.');
      });

      var categoryIds = {};
      graph.associations.forEach(function (row, index) {
        var path = 'associations.' + index;
        var id = stringValue(row.category_id);
        if (!isUnsigned(id, '1', uint32)) addIssue(issues, 'error', path + '.category_id', 'Select an existing category.');
        if (categoryIds[id]) addIssue(issues, 'error', path + '.category_id', 'An achievement may use a category only once.');
        categoryIds[id] = true;
        if (!Object.prototype.hasOwnProperty.call(CATEGORY_OPTIONS, id)) addIssue(issues, 'error', path + '.category_id', 'Category ' + id + ' is not in the current catalog.');
        if (!isUnsigned(row.sequence, '0', uint32)) addIssue(issues, 'error', path + '.sequence', 'Category order must be an unsigned integer.');
        if (stringValue(row.display_text).length > 255) addIssue(issues, 'error', path + '.display_text', 'Display override cannot exceed 255 characters.');
      });
      if (enabled(graph.enabled) && !graph.associations.length) addIssue(issues, 'error', 'associations', 'An enabled achievement needs at least one valid category association.');

      var componentKeys = {};
      var componentSequences = {};
      var globalCounts = {};
      var criterionIds = {};
      var requiredClasses = {};
      var hasEnabledCriterion = false;
      var hasRequiredCriterion = false;
      graph.components.forEach(function (component, componentIndex) {
        var path = 'components.' + componentIndex;
        var type = integer(component.component_type, -1);
        var componentId = stringValue(component.component_id);
        var sequence = stringValue(component.sequence);
        if (type < 0 || type > 3) addIssue(issues, 'error', path + '.component_type', 'Wire type must be 0 through 3.');
        if (!isUnsigned(componentId, '0', uint32)) addIssue(issues, 'error', path + '.component_id', 'Component ID must be unsigned. Zero is valid.');
        if (!isUnsigned(sequence, '0', uint32)) addIssue(issues, 'error', path + '.sequence', 'Component order must be unsigned.');
        if (!isUnsigned(component.presentation_count, '1', uint32)) addIssue(issues, 'error', path + '.presentation_count', 'Presentation count must be positive.');
        var key = type + ':' + componentId;
        if (componentKeys[key]) addIssue(issues, 'error', path + '.component_id', 'Component wire type plus component ID must be unique.');
        componentKeys[key] = true;
        var sequenceKey = type + ':' + sequence;
        if (componentSequences[sequenceKey]) addIssue(issues, 'warning', path + '.sequence', 'Another component in this wire type uses the same client order.');
        componentSequences[sequenceKey] = true;
        if (integer(sequence, 0) > 255) addIssue(issues, 'warning', path + '.sequence', 'RoF2 clamps component display order above 255.');
        if (Object.prototype.hasOwnProperty.call(globalCounts, componentId) && globalCounts[componentId] !== stringValue(component.presentation_count)) {
          addIssue(issues, 'error', path + '.presentation_count', 'Components sharing a component ID must share one global presentation count.');
        }
        globalCounts[componentId] = stringValue(component.presentation_count);
        var identities = {};
        var enabledPolicy = null;
        list(component.criteria).forEach(function (criterion, criterionIndex) {
          var criterionPath = path + '.criteria.' + criterionIndex;
          var rowId = stringValue(criterion.id);
          if (rowId) {
            if (!isUnsigned(rowId, '1', '18446744073709551615')) addIssue(issues, 'error', criterionPath + '.id', 'Criterion row ID is invalid.');
            if (criterionIds[rowId]) addIssue(issues, 'error', criterionPath + '.id', 'Criterion row IDs may appear only once.');
            criterionIds[rowId] = true;
          }
          var eventType = integer(criterion.event_type, -1);
          var mode = integer(criterion.progress_mode, -1);
          var behavior = integer(criterion.behavior, -1);
          var target1 = stringValue(criterion.target_id);
          var target2 = stringValue(criterion.target_id2);
          var targetValue = stringValue(criterion.target_value);
          var requiredCount = stringValue(criterion.required_count);
          if (eventType < 0 || eventType > 13) addIssue(issues, 'error', criterionPath + '.event_type', 'Event must be 0 through 13.');
          if (mode < 0 || mode > 3) addIssue(issues, 'error', criterionPath + '.progress_mode', 'Progress mode must be 0 through 3.');
          if (behavior < 0 || behavior > 5) addIssue(issues, 'error', criterionPath + '.behavior', 'Behavior must be 0 through 5.');
          if (!isUnsigned(target1, '0', uint32)) addIssue(issues, 'error', criterionPath + '.target_id', 'Primary target must be unsigned.');
          if (!isUnsigned(target2, '0', uint32)) addIssue(issues, 'error', criterionPath + '.target_id2', 'Secondary target must be unsigned.');
          if (!isUnsigned(targetValue, '0', '9223372036854775807')) addIssue(issues, 'error', criterionPath + '.target_value', 'Target value must be a nonnegative signed 64-bit value.');
          if (!isUnsigned(requiredCount, '1', uint32)) addIssue(issues, 'error', criterionPath + '.required_count', 'Required count must be positive.');
          var identity = eventType + ':' + target1 + ':' + target2;
          if (identities[identity]) addIssue(issues, 'error', criterionPath + '.target_id', 'Event and target identity must be unique within this component.');
          identities[identity] = true;
          var allowed = ((METADATA.events || {})[stringValue(eventType)] || {}).allowed_progress_modes || [];
          if (allowed.map(integer).indexOf(mode) === -1) addIssue(issues, 'error', criterionPath + '.progress_mode', 'This progress mode is unsafe for the selected replayed or absolute event.');
          if ([7, 12, 13].indexOf(eventType) === -1 && integer(target2, 0) !== 0) addIssue(issues, 'error', criterionPath + '.target_id2', 'This event requires secondary target 0.');
          if ([1, 10].indexOf(eventType) !== -1 && integer(target1, 0) !== 0) addIssue(issues, 'error', criterionPath + '.target_id', 'This event requires primary target 0.');
          if (eventType === 4 && integer(target1, 0) === 0) addIssue(issues, 'error', criterionPath + '.target_id', 'Task Complete requires an exact nonzero task ID.');
          if (eventType === 7 && integer(target2, 0) !== 0 && (integer(target2) < 1 || integer(target2) > 16)) addIssue(issues, 'error', criterionPath + '.target_id2', 'Own Item class must be 0 or 1 through 16.');
          if (eventType === 9 && target1 !== '4294967295' && (integer(target1, -1) < 0 || integer(target1) > 77)) addIssue(issues, 'error', criterionPath + '.target_id', 'Skill Value requires skill ID 0 through 77 or the wildcard.');
          if (eventType === 12 && integer(target1, 0) === 0) addIssue(issues, 'error', criterionPath + '.target_id', 'NPC Name Kill requires a nonzero canonical-name hash.');
          if (eventType === 13) {
            if (integer(target1, -1) < 0 || integer(target1) > 77) addIssue(issues, 'error', criterionPath + '.target_id', 'Skill Cap requires skill ID 0 through 77.');
            if (integer(target2, 0) < 1 || integer(target2) > 16) addIssue(issues, 'error', criterionPath + '.target_id2', 'Skill Cap requires class ID 1 through 16.');
            if (integer(targetValue, 0) < 1 || integer(targetValue) > 255) addIssue(issues, 'error', criterionPath + '.target_value', 'Skill Cap milestone level must be 1 through 255.');
          }
          if (mode === 3 && [1, 7, 9, 10, 13].indexOf(eventType) !== -1 && integer(targetValue, 0) === 0) addIssue(issues, 'error', criterionPath + '.target_value', 'Boolean mode requires a positive threshold for this absolute event.');
          if (enabled(criterion.enabled)) {
            hasEnabledCriterion = true;
            if (type === 3) addIssue(issues, 'error', criterionPath + '.enabled', 'Presentation-only wire type 3 cannot have an enabled criterion.');
            var policy = [eventType, mode, behavior, requiredCount].join(':');
            if (enabledPolicy !== null && enabledPolicy !== policy) addIssue(issues, 'error', criterionPath, 'Enabled alternatives must agree on event, progress mode, behavior, and required count.');
            enabledPolicy = policy;
            if (behavior === 0) hasRequiredCriterion = true;
            if ([0, 2, 3].indexOf(behavior) !== -1 && [7, 13].indexOf(eventType) !== -1 && integer(target2, 0) >= 1 && integer(target2) <= 16) requiredClasses[target2] = true;
            if (eventType === 11 && target1 !== '0' && target1 === stringValue(graph.id)) addIssue(issues, 'error', criterionPath + '.target_id', 'An achievement cannot depend on its own completion.');
          }
        });
      });
      if (Object.keys(requiredClasses).length > 1) addIssue(issues, 'error', 'components', 'Required, Unlock, and Visibility class criteria must agree on one EQ class.');
      if (enabled(graph.enabled) && !graph.components.length) addIssue(issues, 'warning', 'components', 'This enabled definition has no visible components.');
      if (enabled(graph.enabled) && hasEnabledCriterion && !hasRequiredCriterion) addIssue(issues, 'warning', 'components', 'No enabled Required criterion can complete this achievement automatically.');

      var rewardIds = {};
      var automaticRewardSequences = {};
      var optionRewardSequences = {};
      var optionIds = {};
      var optionEnabled = {};
      var optionCommon = {};
      if (graph.reward_set) {
        if (initialRewardSetId && stringValue(graph.reward_set.reward_set_id) !== initialRewardSetId) addIssue(issues, 'error', 'reward_set.reward_set_id', 'The stable reward-set ID cannot change.');
        if (stringValue(graph.reward_set.reward_set_id) && !isUnsigned(graph.reward_set.reward_set_id, '1', uint32)) addIssue(issues, 'error', 'reward_set.reward_set_id', 'Reward-set ID must be nonzero and unsigned.');
        if (stringValue(graph.reward_set.title).length > 255) addIssue(issues, 'error', 'reward_set.title', 'Reward-set title cannot exceed 255 characters.');
        var optionSequences = {};
        graph.reward_set.options.forEach(function (option, index) {
          var path = 'reward_set.options.' + index;
          var id = stringValue(option.option_id);
          if (!isUnsigned(id, '1', uint32)) addIssue(issues, 'error', path + '.option_id', 'Option ID must be nonzero and unsigned.');
          if (optionIds[id]) addIssue(issues, 'error', path + '.option_id', 'Option IDs must be unique within the set.');
          optionIds[id] = true;
          optionEnabled[id] = enabled(option.enabled);
          optionCommon[id] = enabled(option.common_to_all);
          if (!isUnsigned(option.sequence, '0', uint32)) addIssue(issues, 'error', path + '.sequence', 'Option order must be unsigned.');
          if (optionSequences[stringValue(option.sequence)]) addIssue(issues, 'warning', path + '.sequence', 'Another option uses the same display order.');
          optionSequences[stringValue(option.sequence)] = true;
          if (stringValue(option.label).length > 255) addIssue(issues, 'error', path + '.label', 'Option label cannot exceed 255 characters.');
          if (!isUnsigned(option.flags, '0', '255')) addIssue(issues, 'error', path + '.flags', 'Option flags must be 0 through 255.');
        });
      }
      var enabledGrantsByOption = {};
      var effectiveAutomaticAaRewards = {};
      graph.rewards.forEach(function (reward, index) {
        var path = 'rewards.' + index;
        var id = stringValue(reward.reward_id);
        if (id) {
          if (!isUnsigned(id, '1', '18446744073709551615')) addIssue(issues, 'error', path + '.reward_id', 'Reward ID is invalid.');
          if (rewardIds[id]) addIssue(issues, 'error', path + '.reward_id', 'Canonical reward IDs may appear only once.');
          rewardIds[id] = true;
          if (enabled(reward.enabled) && !isUnsigned(id, '1', uint32)) addIssue(issues, 'error', path + '.reward_id', 'Enabled reward IDs must fit the RoF2 unsigned 32-bit wire field.');
        }
        var sequence = stringValue(reward.sequence);
        if (!isUnsigned(sequence, '0', uint32)) addIssue(issues, 'error', path + '.sequence', 'Reward order must be unsigned.');
        var type = integer(reward.reward_type, -1);
        if (type < 0 || type > 7) addIssue(issues, 'error', path + '.reward_type', 'Reward type must be 0 through 7.');
        if (!isUnsigned(reward.reward_data_id, '0', uint32)) addIssue(issues, 'error', path + '.reward_data_id', 'Referenced data must be unsigned.');
        if (!isUnsigned(reward.amount, '1', '18446744073709551615')) addIssue(issues, 'error', path + '.amount', 'Amount must be positive.');
        if (stringValue(reward.description).length > 255) addIssue(issues, 'error', path + '.description', 'Reward description cannot exceed 255 characters.');
        var optionId = stringValue(reward.option_id);
        if (optionId) {
          if (!graph.reward_set) addIssue(issues, 'error', path + '.option_id', 'Mapped grants require a selectable reward set.');
          else if (!optionIds[optionId]) addIssue(issues, 'error', path + '.option_id', 'The mapped option does not exist.');
          if (enabled(reward.enabled)) enabledGrantsByOption[optionId] = (enabledGrantsByOption[optionId] || 0) + 1;
          if (enabled(reward.enabled) && optionIds[optionId] && !optionEnabled[optionId]) addIssue(issues, 'warning', path + '.option_id', 'This enabled grant is mapped to a disabled option and will not deliver automatically.');
          var optionSequenceKey = optionId + ':' + sequence;
          if (optionRewardSequences[optionSequenceKey]) addIssue(issues, 'warning', path + '.sequence', 'Another grant in this option uses the same display order.');
          optionRewardSequences[optionSequenceKey] = true;
        } else {
          if (automaticRewardSequences[sequence]) addIssue(issues, 'error', path + '.sequence', 'Automatic reward order must be unique within this achievement source.');
          automaticRewardSequences[sequence] = true;
        }
        var runtimeReachable = enabled(graph.enabled) && enabled(reward.enabled);
        if (optionId) {
          runtimeReachable = runtimeReachable && !!graph.reward_set
            && enabled(graph.reward_set.source_enabled)
            && enabled(graph.reward_set.enabled)
            && !!optionIds[optionId]
            && !!optionEnabled[optionId];
        }
        if (runtimeReachable && type >= 0 && type <= 7) {
          validateRuntimeRewardSemantics(reward, type, path, issues);
        }
        if (runtimeReachable && type === 7 && optionId) {
          addIssue(issues, 'error', path + '.option_id', 'Class-ineligible AA fallbacks must be direct automatic achievement rewards.');
        }
        if (runtimeReachable && !optionId && (type === 6 || type === 7)) {
          var aaKey = stringValue(reward.reward_data_id);
          if (!effectiveAutomaticAaRewards[aaKey]) effectiveAutomaticAaRewards[aaKey] = { 6: [], 7: [] };
          effectiveAutomaticAaRewards[aaKey][type].push(path);
        }
        if (runtimeReachable && (type === 6 || type === 7)
          && Object.prototype.hasOwnProperty.call(reward, '_aa_enabled') && !reward._aa_enabled) {
          addIssue(issues, 'error', path + '.reward_data_id', 'The selected AA ability is disabled and cannot be delivered.');
        }
        if (runtimeReachable && type === 6 && !isUnsigned(reward.amount, '1', '10000')) {
          addIssue(issues, 'error', path + '.amount', 'Desired AA rank must be at most the editor safety limit of 10,000 linked ranks.');
        } else if (runtimeReachable && type === 6
          && Object.prototype.hasOwnProperty.call(reward, '_aa_rank_count')
          && !isUnsigned(reward.amount, '1', stringValue(reward._aa_rank_count))) {
          addIssue(issues, 'error', path + '.amount', 'Desired AA rank is not within the ' + stringValue(reward._aa_rank_count) + ' reachable rank(s).');
        } else if (runtimeReachable && type === 6
          && Object.prototype.hasOwnProperty.call(reward, '_aa_rank_chain_valid')
          && !reward._aa_rank_chain_valid) {
          addIssue(issues, 'warning', path + '.reward_data_id', 'The AA rank chain is malformed after the reachable prefix; the requested earlier rank remains deliverable.');
        }
        if (runtimeReachable && type === 7 && Array.isArray(reward._aa_eligible_classes)
          && (reward._aa_eligible_classes.length === 0 || reward._aa_eligible_classes.length === 16)) {
          addIssue(issues, 'error', path + '.reward_data_id', 'A fallback must reference an AA ability limited to some, but not all, playable classes.');
        }
      });
      Object.keys(effectiveAutomaticAaRewards).forEach(function (aaAbilityId) {
        var aaRewards = effectiveAutomaticAaRewards[aaAbilityId];
        if (!aaRewards[7].length) return;
        if (aaRewards[6].length !== 1 || aaRewards[7].length !== 1) {
          aaRewards[7].forEach(function (fallbackPath) {
            addIssue(issues, 'error', fallbackPath + '.reward_data_id', 'Each enabled automatic fallback requires exactly one type 6 primary and one type 7 fallback for AA ability ' + aaAbilityId + '.');
          });
        }
      });
      if (graph.reward_set && enabled(graph.reward_set.enabled) && !enabled(graph.reward_set.source_enabled)) {
        addIssue(issues, 'warning', 'reward_set.source_enabled', 'This achievement-to-set source is disabled, so the selectable catalog is staged and inactive.');
      }
      if (graph.reward_set && enabled(graph.reward_set.source_enabled) && !enabled(graph.reward_set.enabled)) {
        addIssue(issues, 'warning', 'reward_set.enabled', 'This source is enabled but the shared reward-set catalog row is disabled, so the selectable rewards are staged and inactive.');
      }
      if (graph.reward_set && !enabled(graph.enabled) && enabled(graph.reward_set.source_enabled) && enabled(graph.reward_set.enabled)) {
        addIssue(issues, 'warning', 'enabled', 'The selectable reward path is authored and enabled, but unreachable while this achievement is disabled.');
      }
      if (graph.reward_set && enabled(graph.enabled) && enabled(graph.reward_set.source_enabled) && enabled(graph.reward_set.enabled)) {
        var selectable = false;
        Object.keys(optionIds).forEach(function (id) {
          if (!optionEnabled[id]) return;
          if (!optionCommon[id]) selectable = true;
          if (!enabledGrantsByOption[id]) addIssue(issues, 'error', 'reward_set.options', 'Enabled reward option ' + id + ' has no enabled grant.');
        });
        if (!selectable) addIssue(issues, 'error', 'reward_set.options', 'An enabled set needs at least one enabled non-common player choice.');
      }

      var restrictions = {};
      graph.restrictions.forEach(function (restriction, index) {
        var id = stringValue(restriction.restriction_id);
        var path = 'restrictions.' + index + '.restriction_id';
        if (!isUnsigned(id, '1', uint32)) addIssue(issues, 'error', path, 'Cast restriction IDs must be positive.');
        if (restrictions[id]) addIssue(issues, 'error', path, 'A cast restriction ID may be attached only once.');
        restrictions[id] = true;
      });
      if (!enabled(graph.enabled) && graph.restrictions.length) addIssue(issues, 'warning', 'restrictions', 'Cast restrictions are inactive while this definition is disabled.');
      if (stringValue(graph.version) !== initialVersion && enabled(graph.reset_on_version_change)) addIssue(issues, 'warning', 'version', 'Version changed with reset enabled; character completion, progress, reward, and selection state will be rebuilt.');
      return issues;
    }

    function renderValidation() {
      var target = form.querySelector('[data-achievement-validation-summary]');
      if (!target) return [];
      var issues = validateGraph();
      clear(target);
      if (!issues.length) {
        var okay = element('div', 'achievement-callout is-success');
        okay.appendChild(element('strong', '', 'No immediate issues found.'));
        okay.appendChild(element('p', '', 'Saving will repeat these checks and add authoritative database and dependency validation.'));
        target.appendChild(okay);
      } else {
        var listNode = element('ul', 'achievement-validation-list');
        issues.forEach(function (issue) {
          var item = element('li', 'is-' + issue.severity);
          if (issue.path) item.appendChild(element('code', '', issue.path));
          item.appendChild(element('span', '', issue.message));
          listNode.appendChild(item);
        });
        target.appendChild(listNode);
      }
      var count = form.querySelector('[data-achievement-tab-count="validation"]');
      if (count) count.textContent = String(issues.filter(function (issue) { return issue.severity === 'error'; }).length);
      return issues;
    }

    function updateCounts() {
      var counts = {
        categories: graph.associations.length,
        components: graph.components.length,
        rewards: graph.rewards.length,
        restrictions: graph.restrictions.length
      };
      Object.keys(counts).forEach(function (key) {
        var node = form.querySelector('[data-achievement-tab-count="' + key + '"]');
        if (node) node.textContent = String(counts[key]);
      });
      var summary = form.querySelector('[data-achievement-save-summary]');
      if (summary) summary.textContent = (enabled(graph.enabled) ? 'Enabled' : 'Disabled') + ' definition · Version ' + stringValue(graph.version) + ' · ' + graph.components.length + ' components';
    }

    function cleanCriterion(criterion) {
      var result = {
        event_type: criterion.event_type, progress_mode: criterion.progress_mode,
        behavior: criterion.behavior, target_id: criterion.target_id,
        target_id2: criterion.target_id2, target_value: criterion.target_value,
        required_count: criterion.required_count, enabled: criterion.enabled
      };
      if (stringValue(criterion.id)) result.id = criterion.id;
      return result;
    }

    function submittedGraph() {
      var result = {
        id: graph.id, name: graph.name, description: graph.description,
        icon_id: graph.icon_id, points: graph.points,
        has_reward: graph.has_reward, client_flag: graph.client_flag,
        version: graph.version,
        reset_on_version_change: graph.reset_on_version_change, enabled: graph.enabled,
        associations: graph.associations.map(function (row) {
          return { category_id: row.category_id, sequence: row.sequence, display_text: row.display_text };
        }),
        components: graph.components.map(function (row) {
          return {
            component_type: row.component_type, sequence: row.sequence,
            component_id: row.component_id, name: row.name,
            description: row.description, presentation_count: row.presentation_count,
            criteria: list(row.criteria).map(cleanCriterion)
          };
        }),
        rewards: graph.rewards.map(function (row) {
          return {
            reward_id: stringValue(row.reward_id) || null, sequence: row.sequence,
            reward_type: row.reward_type, reward_data_id: row.reward_data_id,
            amount: row.amount, description: row.description, enabled: row.enabled,
            option_id: stringValue(row.option_id) || null
          };
        }),
        reward_set: graph.reward_set ? {
          reward_set_id: stringValue(graph.reward_set.reward_set_id) || null,
          title: graph.reward_set.title, enabled: graph.reward_set.enabled,
          source_enabled: graph.reward_set.source_enabled,
          options: graph.reward_set.options.map(function (row) {
            return {
              option_id: row.option_id, sequence: row.sequence, label: row.label,
              common_to_all: row.common_to_all, flags: row.flags, enabled: row.enabled
            };
          })
        } : null,
        restrictions: graph.restrictions.map(function (row) {
          return { restriction_id: row.restriction_id, requires_completed: row.requires_completed };
        })
      };
      return result;
    }

    form.querySelector('[data-achievement-add-association]').addEventListener('click', function () {
      graph.associations.push({ category_id: '', sequence: nextSequence(graph.associations), display_text: '' });
      renderAssociations(); changed();
    });
    form.querySelector('[data-achievement-add-component]').addEventListener('click', function () {
      graph.components.push({
        component_type: 1, sequence: nextSequence(graph.components), component_id: nextComponentId(),
        name: '', description: '', presentation_count: 1, criteria: []
      });
      renderComponents(); changed();
    });
    form.querySelector('[data-achievement-add-reward]').addEventListener('click', function () {
      graph.rewards.push({ reward_id: null, sequence: nextSequence(graph.rewards), reward_type: 0, reward_data_id: 0, amount: 1, description: '', enabled: 1, option_id: null });
      renderRewards(); changed();
    });
    form.querySelector('[data-achievement-add-restriction]').addEventListener('click', function () {
      graph.restrictions.push({ restriction_id: '', requires_completed: 1 });
      renderRestrictions(); changed();
    });
    form.querySelector('[data-achievement-run-validation]').addEventListener('click', function () {
      renderValidation(); activateTab('validation', false);
    });
    form.querySelector('[data-achievement-use-reward-set]').addEventListener('change', function (event) {
      if (event.target.checked) {
        graph.reward_set = {
          reward_set_id: initialRewardSetId || graph.suggested_reward_set_id || null,
          title: graph.name || '', enabled: 0, source_enabled: 0, options: []
        };
      } else {
        if (initialRewardSetId) {
          event.target.checked = true;
          window.alert('This selectable reward set is persisted and may be referenced by character selections. Set the set Enabled field to 0 to retire it safely.');
          return;
        }
        var mapped = graph.rewards.filter(function (reward) { return stringValue(reward.option_id) !== ''; });
        if (mapped.length && !window.confirm('Removing the selectable set will clear mappings and disable ' + mapped.length + ' mapped grant(s) so they cannot become automatic unexpectedly. Continue?')) {
          event.target.checked = true;
          return;
        }
        mapped.forEach(function (reward) { reward.option_id = null; reward.enabled = 0; });
        graph.reward_set = null;
      }
      renderRewardSet(); renderRewards(); changed();
    });

    form.addEventListener('submit', function (event) {
      var issues = renderValidation();
      var blocking = issues.filter(function (issue) { return issue.severity === 'error'; });
      if (blocking.length) {
        event.preventDefault();
        activateTab('validation', false);
        var summary = form.querySelector('[data-achievement-validation-summary]');
        if (summary) summary.focus();
        window.alert('The definition was not submitted because ' + blocking.length + ' authoring error(s) remain. Review the Validation tab.');
        return;
      }
      var json = JSON.stringify(submittedGraph());
      var bytes = window.TextEncoder ? new TextEncoder().encode(json).length : unescape(encodeURIComponent(json)).length;
      if (bytes > MAX_GRAPH_BYTES) {
        event.preventDefault();
        window.alert('The definition graph is larger than the 2 MiB safety limit. Remove unnecessary rows or text before saving.');
        return;
      }
      document.getElementById('achievement-graph-json').value = json;
    });

    bindGeneral();
    renderAssociations();
    renderComponents();
    renderRewardSet();
    renderRewards();
    renderRestrictions();
    updateCounts();
    renderValidation();
  });
}());
</script>
