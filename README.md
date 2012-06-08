After downloading the source code, you will need to do some initial configuration.

##Settings File##

The file include/default.settings.php will need to be updated to reflect the specifics of your installation. Search for the word
UPDATE to locate the lines that need to be changed. This includes adding your database username and password.

##Database##

Configure the database username and password in your *.settings.php file. If you can't create your own file, you will have to edit the default.settings.php file directly, just make sure not to commit that file back to the repository.

Install the database tables from the scripts/sql/schema.sql file provided. After the tables are created, run the scripts/sql/initdata.sql file to insert some default data.

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

##3rd Party Software##

There are a number of 3rd party software packages required by the software.

###WKHTMLTOPDF###

[wkhtmltopdf project](http://code.google.com/p/wkhtmltopdf/). 

In order to generate PDF for the Career Roadmaps and POST drawings, the tool WKHTMLTOPDF must be installed on the server and the file
pdf/index.html (search for shell_exec) must be updated to reflect the location of the installed tool. 

###Amazon Mailer###

[Amazon Mailer Repo](https://github.com/geoloqi/Amazon-SES-Mailer-PHP). 

Pull and install into the directory __common/Amazon-SES-Mailer-PHP__.

###Amazon Web Services###

[Amazon Web Services](http://aws.amazon.com/sdkforphp/).

Download and install into the directory __common/AWSSDKforPHP__.

##Try it out##

Visit your install in the browser, and you should be presented with a login prompt. The default user account is admin@example.com and a password of 1234. 
