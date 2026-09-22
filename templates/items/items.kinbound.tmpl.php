          <div style="padding: 3px; text-align: left;">
            <label for="item_kinbound"><strong>Kinbound policy:</strong></label>
<?php if ($item_kinbound_available): ?>
            <select id="item_kinbound" name="kinbound">
<?php foreach (item_kinbound_options() as $value => $label): ?>
              <option value="<?=$value?>"<?=((string) (isset($kinbound) ? $kinbound : 0) === (string) $value) ? ' selected' : ''?>><?=$value?>: <?=$label?></option>
<?php endforeach; ?>
            </select>
            <div style="margin-top: 4px; font-size: 11px;">
              Unlisted does not enable Kinbound. Always Kinbound selects this item for sharing within the same forum account before attunement.<br>
              The server still requires No Drop = Yes, No Transfer = No, Kinbound enabled, and no epic catalog exclusion.
            </div>
<?php else: ?>
            Unavailable: the content database does not have the items.kinbound column.
<?php endif; ?>
          </div>
