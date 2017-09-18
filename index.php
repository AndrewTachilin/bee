<?php
ob_start();
session_start();

include(__DIR__.'/view/head.php');
include (__DIR__.'/view/index.php');
include('model/dbconnect.php');
include('components/Router.php');
$router = new Router();
$router->run();

