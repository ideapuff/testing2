<?php

$base_dir = str_replace('\\', '/', realpath(__DIR__));
define('BASE_DIR', $base_dir);

require_once BASE_DIR . "/system/System.php";
System::getInstance();

session_start();

$request_name = '';
if (isset($_REQUEST['action'])) {
    $request_name = $_REQUEST['action'];
}

ob_start();

try {
    $action = System::getInstance()->getAction('TestAction');
    $action->execute();
} catch (Exception $e) {
    $fe = new FrameworkException("Error in index.php.", $e);
    $fe->log();
}

ob_flush();
?>