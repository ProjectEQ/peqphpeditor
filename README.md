## PEQ PHP Editor

#### IMPORTANT NOTE: Update the PHP runtime before serving the editor. See [PHP security updates](#php-security-updates) below. Apache 2.2 is no longer supported.

### Minimum Requirements
* Apache 2.4
* A supported PHP branch with the security updates listed below
* MySQL 5 or MariaDB 10

*For more help on getting Apache, PHP, or the Editor itself set up, visit us on Discord at https://discord.com/channels/212663220849213441/1019660515523440701*

### PHP security updates

The PHP project's [21 October 2026 security advisory](https://www.php.net/archive/2026.php#2026-10-21-5) requires an updated PHP runtime for CVE-2026-109618 and CVE-2026-109619. Install the latest security release for your supported branch, with these minimum versions:

| PHP branch | Minimum patched version |
| --- | --- |
| 8.2 | 8.2.35 |
| 8.3 | 8.3.36 |
| 8.4 | 8.4.27 |
| 8.5 | 8.5.12 |

PHP 8.1 and older no longer receive upstream security releases. Upgrade to a supported branch, or obtain confirmation from your distribution or LTS vendor that its package includes fixes for both CVEs. The editor's version warning compares upstream versions and cannot detect vendor backports or verify unlisted branches and prereleases.

These vulnerabilities affect PHP itself and can be triggered before the editor executes. Updating the editor, logging in, or adding an application version check does not patch PHP. This repository does not bundle PHP or manage the web server's runtime.

Update the PHP package or container image that actually serves the editor, then restart Apache, PHP-FPM, or the relevant PHP service so all workers use the patched runtime. Verify the version and vendor patch status of the PHP runtime serving web requests; `php -v` reports only the CLI version, which may be different. After upgrading, confirm `short_open_tag = On`, the `mysqli` extension is loaded, and the editor's login and normal editing workflow still work.

PHP 8.2 reaches end of upstream security support on 31 December 2026. Check PHP's [supported versions](https://www.php.net/supported-versions.php) when choosing a branch.

For Linux users, note the following:
* Permissions: If you choose to store these files outside of your normal html directory, ensure your symbolic link and physical folder have the same permissions. (Recommend 755 for folders and 644 for files)
* AutoUpdate: You can set the AutoUpdate file with the execute flag and run to pull the latest from git and fix permissions if any were changed.

### Installation

1) Install Apache and PHP. You can get from www.apache.org and www.php.net or get an all-in-one package such as XAMPP from www.apachefriends.org.

2) Configure Apache and PHP as needed, but make sure you allow short tags (short_open_tag = On). Also recommend you suppress NOTICE, STRICT, WARNING and DEPRECATED messages under error_reporting (E_ALL & ~E_NOTICE & ~E_STRICT & ~E_WARNING & ~E_DEPRECATED). Also, ensure you have the mysqli extension loaded.

3) Unzip or checkout the files into your public html directory (such as /htdocs/peqedit) or set up an alias outside that directory if you desire.

4) From the sql directory, source schema.sql into your database.

5) Rename config.php.dist as config.php.  Then, open up config.php and edit the variables according to your database and needs.

6) The default username/password for the editor is admin/password.  If you want to add a user other than the default user, you can do so via the "admin" link, by the "logout" link, after you log in.

7) Navigate to index.php in your web browser and have fun!


