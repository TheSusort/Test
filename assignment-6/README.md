Assignment 6
============

In short, your task is the following

  1. Set up the project on localhost
  2. Complete the missing functionality
  3. Push changes to github
  4. Deploy the application on unix under your username
  5. Submit your unix username on itslearning
  
See the detailed instructions below.

1. Setting up the project on localhost
--------------------------------------

  1. Clone this github repository to `c:\wamp\www\dat310-signup`
  2. Make sure Smarty is installed in your www-root (most likely it will be found at `c:\wamp\www\Smarty-3.1.18`)
     * For further information see the [Smarty Quick install page](http://www.smarty.net/quick_install)
  3. Create a MySQL database (e.g., `dat310`)
  4. Create the `students` table (see the MySQL statement below). For this step, you can use [phpMyAdmin](http://localhost/phpMyAdmin), some other client like MySQLWorkBench, or command line SQL  
  5. Adjust the Smarty path and MySQL settings in `inc/config.inc.php`
  6. If everything is set up correctly, at [http://localhost/dat310-signup](http://localhost/dat310-signup) you will see the same application that you used for signing up


### Statement for creating the students table

```
CREATE TABLE IF NOT EXISTS `students` (
  `student_no` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `user_unix` varchar(20) NOT NULL,
  `user_codecademy` varchar(20) NOT NULL,
  `user_github` varchar(20) NOT NULL,
  PRIMARY KEY (`student_no`)
) DEFAULT CHARSET=utf8;
```	


2. Completing the missing functionality
---------------------------------------

Briefly about the code (this is just FYI):
  * It allows students to sign up (register)
  * Registered students can log in and view their profile. Upon login, all their details get stored in a session.
  * [Bootstrap 3 CSS](http://getbootstrap.com/css/) is used for styling
  * You can open the project in NetBeans (the NetBeans project files are included in the repository)

Complete the PHP code with the followings. The respective parts are indicated by `@todo` comments in the code.

  * Add the possibility for admin login
    * There is a single admin account that uses the values set in `ADMIN_USER` and `ADMIN_PASSWORD` in `inc/config.inc.php`. By default these are admin/MyAdmin. Writing these into the student number and email fields should let the admin in. 
      * We note that it is not very nice that the admin password is visible in the input field as plain text, but we will fix that in a later exercise.
    * You need to implement it in `function login()` (and you might need to edit the `login.tpl` file too)
  * Generate a student list for the admin
    * When the admin is logged in, instead of displaying a profile page, show the list of signed up students in a table
    * You need to implement it in `list_students()` and in `student_list.tpl`
  * Create a static "info" page 
    * The contents go to `info.tpl` (to be created). It does not really matter what you say here, I leave it to your creativity.
    * This info page should be accessible on this link `index.php?action=info` (to be handled in `index.php`)
    * The page should only be accessible to logged in users (students or admins). For non-logged in users the link should simply take them to the login page.
  * Add a top menu that is visible for logged in users
    * Top menu is visible only for logged in users, so not on the login and signup pages
    * Menu items:
      1. "profile" (for students) or "student list" (for admin)
      2. "info" (this is the new static page)
      3. "logout" Move the logout link from the bottom of the profile and list pages to the top menu    
    * Use the [Bootstrap default navbar component](http://getbootstrap.com/components/#navbar-default) for styling the menu

You can try and see how it should all look like at [http://krisztianbalog.com/uis-dat310](http://krisztianbalog.com/uis-dat310). (Of course, you won't see the actual list of students.)


3. Pushing changes to github
----------------------------

Commit all changes and push them from your machine.


4. Deploying the application on unix under your username
--------------------------------------------------------

Note that on the unix system `public_html` is your www-root. You can SFTP to `badne5.ux.uis.no` (using your unix username and password) in order to copy files.

The steps are similar to what you've done in Step 1) on localhost:

  1. Install smarty. Simply copy `c:\wamp\www\Smarty-3.1.18` to `public_html`
  2. Copy the entire project `c:\wamp\www\dat310-signup` to `public_html`
  3. Empty the `dat310-signup/smarty/cache` and `dat310-signup/smarty/templates_c` directories and make them writeable by Apache (`chmod 777`)
  4. Create the `students` table. For this step, you can use a client like MySQLWorkBench, or command line SQL  
  5. Adjust the Smarty and project paths and MySQL settings in `inc/config.inc.php`
     * `define("SMARTY_PATH", "full-path-to-your-home-dir/public_html/Smarty-3.1.18");`
     * `define("PROJECT_DIR", "full-path-to-your-home-dir/public_html/dat310-signup");`
     * `define("MYSQL_HOST", "mysql.ux.uis.no");`
     * `MYSQL_USER`, `MYSQL_PASSWORD`, and `MYSQL_DB` values from the email you got from Theo
  6. If everything is set up correctly, `http://www.ux.uis.no/~yourusername/dat310-signup` should be working.
     * Don't use a different name for the folder! I know you unix username and I'll be looking for it under `dat310-signup`!


5. Submitting your unix username on itslearning
-----------------------------------------------

Put a single word in the textbox: your unix username. 

That's all.
