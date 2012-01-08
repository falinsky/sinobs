<?php

require_once("config.php");

$app = new App();
$app->addObserver(new FileLogger(),App::EVENT_LOGIN_FAILURE);
$app->run();
