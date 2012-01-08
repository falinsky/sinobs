<?php

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","sinobs");

define("TEMPLATE_DIR",dirname(__FILE__)."/views");

require_once("vendor/KLogger.php");

require_once("core/Db.class.php");
require_once("core/Auth.class.php");
require_once("core/IObservable.class.php");
require_once("core/Observable.class.php");
require_once("core/IObserver.class.php");
require_once("core/FileLogger.class.php");
require_once("core/DbLogger.class.php");
require_once("core/BaseApplication.class.php");

require_once("controllers/App.class.php");

