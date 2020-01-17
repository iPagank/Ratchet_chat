<?php
 require 'bin/db.php';

$table = 'users';
$colums = "CREATE TABLE `ratchet_chat`.`$table` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(535) NOT NULL , `password` VARCHAR(535) NOT NULL , `remember_token` VARCHAR(535) NOT NULL , PRIMARY KEY (`id`))";
$pdo->exec($colums);
