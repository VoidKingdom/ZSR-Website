# Fayaz Sheikh Final Year Project - ZSR Website
This git repository contains the PHP website for my development project module. This `README.md` will give a quick breakdown of things needed to be done to get this to work on another PC.
##Database Connect
For the project to work, you will need to have a MySQL database that the website can connect to. To allow this, you need to change the data in `dbconnect.php` to what the permissions are for your database. Only the following 4 variables need to be changes
```
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "zsr";
```
The names are self explanatory as to what they require. After this website can connect to the database, make sure you have the same database structure as I have for this to work. `Database Creation.txt` includes all the sql commands needed to create the same structure as me. If done correctly, it should compile with no errors. 

After all these steps have been correctly followed, you should be able to run the website with no errors. I have not added the presentation in this git as I was informed that I only need to bring it on the day to my VIVA by my personal tutor. Otherwise, everythign is either included in this git or in my report submitted on blackboard
##Structure
All files have been broken down into a clear structure so any file you need is in a consistent place.
 * Javascript Files are in the js Folder
 * PHP script files (files that do not contain viewable information for the user) are in the php Folder
 * CSS Styling sheet is in the styles folder
 * All images used are in the images folder
 * All none sorted pages are pages that can be viewed by the user and make up the structure of the website with `home.php` being the front page.

-Fayaz Sheikh P16207462 