<?php
$app = 'frontend';

// $ip = $_SERVER['REMOTE_ADDR'];
// if( $ip=='186.203.217.251' ){
	
	$serverName = strtolower($_SERVER['SERVER_NAME']);
	$app = preg_replace('/\.?irank\.com\.br/', '', $serverName);
	$appList = array(''=>'frontend', 'www'=>'frontend', 'backend'=>'backend', 'agenda'=>'frontend', 'm'=>'mobile', 'ios'=>'ios', 'cron'=>'cron');
	
	$app = $appList[$app];
// }

define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         $app);
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       false);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

sfContext::getInstance()->getController()->dispatch();
