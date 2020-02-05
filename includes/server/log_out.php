<?php
/**
 * Log out user
 * Delete cookies and session
 */
session_start();
 session_destroy();
 unset($_COOKIE['remember_token']);
setcookie('remember_token',null,-1,'/');
header('Location: http://websockets/');