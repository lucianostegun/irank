<?php
/**
 * fileManager actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class fileManagerActions extends sfActions
{

  public function preExecute(){
    
    $this->pathList = array('Gerenciador de arquivos'=>null);
  }
  
  public function executeIndex($request){
    
  }
  
  public function executeConnector($request){
    
	error_reporting(0); // Set E_ALL for debuging
	
	if (function_exists('date_default_timezone_set')) {
		date_default_timezone_set('America/Sao_Paulo');
	}
	
	$clubId  = $this->getUser()->getAttribute('clubId');
	$clubObj = ClubPeer::retrieveByPK($clubId);
	
	$clubFolder = ($clubId?'club-'.$clubId:'');
	if( is_object($clubObj) )
		$clubFolder = $clubObj->getTagName();
	else
		$clubFolder = '';
	
	$rootDir = Util::getFilePath('/uploads/fm/'.$clubFolder);
	if( !file_exists($rootDir) )
		mkdir($rootDir, 0777);
	
	$opts = array(
		'locale' => 'pt_BR.UTF-8',
		'bind' => array(
			'*' => 'logger'
			// 'mkdir mkfile rename duplicate upload rm paste' => 'logger'
		),
		'debug' => true,
		'roots' => array(
			array(
				'driver'     => 'LocalFileSystem',
				'path'       => $rootDir,         // path to files (REQUIRED)
				'startPath'  => $rootDir,
				'URL'        => 'http://'.$request->getHost().'/uploads/fm/'.($clubFolder?$clubFolder.'/':''), // root directory URL
//				 'alias'     => 'File system',
				'mimeDetect' => 'internal',
				'tmbPath'    => '.tmb',
				'utf8fix'    => true,
				'tmbCrop'    => false,
//				'tmbBgColor' => 'transparent',
				'accessControl' => 'access',
	 			'uploadAllow'  => array('image/jpeg', 'image/png', 'image/gif', 'image/bmp'),      // mimetypes which allowed to upload
	 			'uploadDeny'   => array('*'),      // mimetypes which not allowed to upload
	 			'uploadOrder'  => 'allow,deny', // order to proccess uploadAllow and uploadAllow options
				 
				 'dirSize'      => true,
				 'dotFiles'     => false,        // display dot files
				 
				 'disabled'         => array('edit', 'rename', 'mkfile'),
				 'disableShortcuts' => true,
				 'rememberLastDir'  => false,
				 
				 'defaults'     => array(        // default permisions
				 	'read'   => true,
				 	'write'  => true,
				 	'rm'     => false
				 	),
				 
			)
		)
	);

	// run elFinder
	$connector = new elFinderConnector(new elFinder($opts));
	$connector->run();
	exit;
  }
}

function access($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
}