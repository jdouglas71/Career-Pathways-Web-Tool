After downloading the source code, you will need to do some initial configuration.

##Settings File##


The file include/default.settings.php will need to be updated to reflect the specifics of your installation. Search for the word
UPDATE to locate the lines that need to be changed. This includes adding your database username and password.


##Filesystem##

If it doesn't already exist, create a `cache` folder at the top level directory for the site, next to the `include` and `scripts` folders, and make it writable by apache.

```
drwxr-xr-x  3 apache   apache    4096 2011-03-24 14:35 cache
drwxr-xr-x  7 pathways pathways  4096 2011-03-24 14:15 common
drwxr-xr-x  2 pathways pathways  4096 2011-03-24 14:15 examples
drwxr-xr-x  3 pathways pathways  4096 2011-03-24 14:15 scripts
drwxr-xr-x 12 pathways pathways  4096 2011-03-24 14:29 include
```

##php.ini##

Ensure the setting __mpc_magic_quotes__ is set to __Off__.
Add the __include_path__ setting to include the full path to your include and common directories. 
```
include_path=".:/home/wwwcaree/public_html/common:/home/wwwcaree/public_html/include"
```

Make sure the setting __disable_functions__ does __not__ include __shell_exec__.
```
disable_functions = posix_getpwuid,posix_getpwnam,exec
```

Ensure the setting __allow_url_fopen__ is set to __On__.

##WKHTMLTOPDF##

In order to generate PDF for the Career Roadmaps and POST drawings, the tool WKHTMLTOPDF must be installed on the server and the file
pdf/index.html (search for shell_exec) must be updated to reflect the location of the installed tool.


##Try it out##

Visit your install in the browser, and you should be presented with a login prompt. The default user account is admin@example.com and a password of 1234. 
