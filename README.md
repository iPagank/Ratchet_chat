# Ratchet Chat
Simple chat on WebSockets with authorization
## Install 
1. Copy files on your local server

2. You need a Composer 
If you don't have it, visit [this page](https://getcomposer.org/download/).
Next step, run this command in your command line
```
php composer install
```
3. Open file 
> */bin/db.php*

And write information about your database

```php
/**
 * 1. Database Name
 * 2. Host
 * 3. Username
 * 4. Password
 */ 
$pdo = new PDO("mysql:dbname=ratchet_chat;host=localhost",'root','');
```
4. Change directory on project and write in Command Line
```
php /includes/seed.php
```
To create new table

5. To start WebSockets turn on your local server and write in Command Line 
```
php /bin/chat-server.php
```