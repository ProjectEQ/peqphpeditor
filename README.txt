For more help on getting Apache, PHP, or the Editor itself set up, visit http://www.projecteq.net/phpBB2/viewforum.php?f=29

Step 1:

Go to www.mozilla.com and download Firefox.  While I tried to make sure that the editor looks and works as intended with other browsers, I really don't have the time to fully test everything with browsers that refuse to accept web standards (Internet Explorer).  Do yourself (and the entire Internet) a favor and get Firefox--it's more secure, has better features, and you'll be doing your part to pressure Microsoft into making its browser standards-compliant.  It's currently only about 5mb in size to download, so even dial-up users have no excuse not to get it.


Step 2:

Go to www.apache.org and download and install the Apache http server.


Step 3:

Go to www.php.net and download and install PHP.


Step 4: (Not required if gotten from SVN)

Unzip the files in peq_editor.zip into a public html directory.


Step 5:

Source schema.sql (in the editor's /sql directory) into your database.


Step 6:

Rename config.php.dist as config.php.  Then, open up config.php and edit the variables according to your database and needs.


Step 7:

If you chose to enable sql logging, make sure you created the file you specified in $log_file.  Otherwise you will get an error when the editor attempts to write to that (non-existant) file.


Step 8:

The default username/password for the editor is admin/password.  If you want to add a user other than the default user, you can do so via the "admin" link, by the "logout" link, after you log in.


Step 9:

Open up index.php in your web browser and have fun!