<?php

use classes\Users;

require_once __DIR__ . '/vendor/autoload.php';

$users = new Users();

$users->findData($_POST['query']);
