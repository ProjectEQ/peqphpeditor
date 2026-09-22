# Kinbound and player DZ history

Item create/edit pages expose **Kinbound policy** under Restrictions when the
content database has `items.kinbound`. The values are `0` Unlisted, `1` Always
Kinbound and `2` Never Kinbound. Copies preserve the flag. Item search supports
policy filtering, and results and imported-item comparisons show policy names.
The server's existing NO TRADE, NO TRANSFER, epic and attunement restrictions
still apply. This editor does not create or migrate the item column.

On a player profile, select **DZ History**. This administrator-only, read-only
page shows the active saved expeditions offered by the updated DZManager,
including authorized characters who have left or been kicked. It requires the
exact saved UUID and the latest-copy record, so expired, revoked and superseded
copies are excluded even after the newer copy has been deleted. Ordinary
members without a saved self-return right are not included.

The view shows expedition/instance identity, leader, members, expiration,
remaining time and rejoin status. Database checks cover current membership,
locked/full expeditions, seasons and conflicting lockouts. Configured rules
inherit the named default ruleset before the selected ruleset. The game server
still decides final eligibility using its live rules, pending invitations,
current instance and loaded expedition state.

DZ history requires the source server migrations, in order:

1. `utils/sql/git/2026_09_20_dynamic_zone_resume.sql`
2. `utils/sql/git/2026_09_21_dynamic_zone_resume_latest.sql`

Follow the server's `docs/dz_manager.md` rollout instructions, including stopping
world/zones for migration. All participating tables must use InnoDB. Missing
tables produce a prerequisite message; the editor never modifies history,
latest-copy records, memberships, lockouts or rules. Disabling saved rejoin
still allows administrators to inspect retained history.

Focused checks (PHP with short tags enabled):

```text
php -d short_open_tag=1 tests/item_kinbound_test.php
php -d short_open_tag=1 tests/player_dz_history_template_test.php
php -d short_open_tag=1 tests/player_dz_history_test.php
```

The first two checks need no database. The SQL check uses only connection-local
temporary tables and needs `DB_HOST`, `DB_USER`, `DB_PASSWORD`, `DB_NAME` and
optionally `DB_PORT`, or `DZ_HISTORY_TEST_CONFIG` pointing to an editor config.
