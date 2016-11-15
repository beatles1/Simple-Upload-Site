# Simple-Upload-Site
A very simple web app with a public list of files and an admin page to upload or sideload and delete the files again.

To set the password:
* Generate and save a salt in `a/login.php` (I used lastpass password generator)
* Append that salt to the end of your password and generate an SHA256 hash and save that in `a/login.php` (Google for a generator)
