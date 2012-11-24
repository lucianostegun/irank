<?php if (!defined('ALLOW_PAGSEGURO_CONFIG')) { die('No direct script access allowed'); }
/*
************************************************************************
PagSeguro Config File
************************************************************************
*/

$PagSeguroConfig = array();

$PagSeguroConfig['environment'] = Array();
$PagSeguroConfig['environment']['environment'] = 'production';

$PagSeguroConfig['credentials'] = Array();
$PagSeguroConfig['credentials']['email'] = 'lucianostegun@gmail.com';
$PagSeguroConfig['credentials']['token'] = 'EE85B624730F4E17B157DB48B4032EA1';

$PagSeguroConfig['application'] = Array();
$PagSeguroConfig['application']['charset'] = "UTF-8"; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = Array();
$PagSeguroConfig['log']['active'] = TRUE;
$PagSeguroConfig['log']['fileLocation'] = 'pagseguro.log';

?>