<?php

use classes\Users;

require_once __DIR__ . '/vendor/autoload.php';

$users = new Users();

$users->addUser($_POST['first_name'], $_POST['last_name'], $_POST['email']);