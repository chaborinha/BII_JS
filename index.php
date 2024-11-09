<?php
// arquivo para redirecionar para alguma rota
session_start();

if (empty($_SESSION['id']))
{
    header('location: views/form_login.php');
}
else
{
    header('location: acess_verify.php');
}