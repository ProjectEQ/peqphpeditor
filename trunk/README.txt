For more help on getting Apache, PHP, or the Editor itself set up, visit http://www.peqtgc.com/phpBB2/viewforum.php?f=29

Step 1:
Install Apache and PHP. You can get from www.apache.org and www.php.net or get an all-in-one package such as XAMPP from www.apachefriends.org.

Step 2:
Configure Apache and PHP as needed, but make sure you allow short tags (short_open_tag = On). Also recommend you suppress NOTICE and STRICT messages under error_reporting.

Step 3:
Unzip or checkout the files into your public html directory (such as /htdocs/peqedit) or set up an alias outside that directory if you desire.

Step 4:
From the sql directory, source schema.sql into your database. You should also source the expansions.sql into your database.

Step 5:
Rename config.php.dist as config.php.  Then, open up config.php and edit the variables according to your database and needs.

Step 6:
Edit your .htaccess files in the editor root directory and the templates/iframes directory as needed to match your Apache version.

Step 7:
The default username/password for the editor is admin/password.  If you want to add a user other than the default user, you can do so via the "admin" link, by the "logout" link, after you log in.

Step 8:
Open up index.php in your web browser and have fun!