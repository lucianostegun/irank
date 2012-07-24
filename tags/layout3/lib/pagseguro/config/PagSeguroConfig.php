<?php if (!defined('ALLOW_PAGSEGURO_CONFIG')) { die('No direct script access allowed'); }
/*
************************************************************************
PagSeguro Config File
************************************************************************
*/

$PagSeguroConfig = array();

$PagSeguroConfig['environment'] = Array();
$PagSeguroConfig['environment']['environment'] = 'debug';

$PagSeguroConfig['credentials'] = Array();
$PagSeguroConfig['credentials']['email'] = 'lucianostegun@gmail.com';
$PagSeguroConfig['credentials']['token'] = '985ED91D71AE42AFAC677FC30BA364AE';

$PagSeguroConfig['application'] = Array();
$PagSeguroConfig['application']['charset'] = "UTF-8"; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = Array();
$PagSeguroConfig['log']['active'] = TRUE;
$PagSeguroConfig['log']['fileLocation'] = Util::getFilePath('pagseguro.log', sfConfig::get('sf_log_dir'));

?>