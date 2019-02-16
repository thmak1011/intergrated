<?php
unset($_COOKIE['login']);
unset($_COOKIE['type']);
setcookie('login',null,-1);
setcookie('type',null,-1);
header('location: index.php');
?>