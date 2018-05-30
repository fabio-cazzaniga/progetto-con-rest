# REST-PHP
No description required

##Working Env (If you're not using IntelliJ IDEA)
To get the project working you need to clone it in htdocs of XAMPP directory.
There is a bit of work to do to get it up and running the way it is sopposed to.
When you open the XAMPP control panel, go to config on Apache model and select *Apache (httpd.conf)* and comment (*using #*) every line that includes the word **DocumentRoot "path"**.

Add a line below the commmented line 
>DocumentRoot "path-to-xampp-htdocs-dir/path-to-project/public"

Save the changes and restart *Apache*.

You're all set.


##Description
The .htaccess file is used to redirect every request made to the site to index.php [Read More](https://gist.github.com/RaVbaker/2254618)
