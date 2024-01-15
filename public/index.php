<?php declare(strict_types=1);

require_once "../bootstrap.php";

$handler = new SampleAppImpl\TaskController($taskManager);

$request = $_GET + $_POST;
$handler->__invoke($request);