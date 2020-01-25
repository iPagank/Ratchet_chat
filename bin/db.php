<?php
/**
 * Database Connection
 * 
 */
try {
    $pdo = new PDO("mysql:dbname=ratchet_chat;host=localhost",'root','');
} catch (PDOException $err) {
    echo $err->getMessage();
}