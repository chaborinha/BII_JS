<?php
require __DIR__ . '/controllers/login_controller.php';

$verify = new login();
$verify->acess_verify();
