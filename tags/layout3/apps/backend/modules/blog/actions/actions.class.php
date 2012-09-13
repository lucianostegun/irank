<?php

/**
 * blog actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class blogActions extends sfActions
{

  public function preExecute(){
    
    $this->blogId = $this->getRequestParameter('id');
    $this->blogId = $this->getRequestParameter('blogId', $this->blogId);
    $this->blogId = $this->getUser()->getAttribute('blogId', $this->blogId);
    
    $this->blogIdAttribute = $this->getUser()->getAttribute('blogId');
    
    $this->pathList = array('Blog'=>'blog/index');
    $this->toolbarList = array('new');
  }

  public function executeIndex($request){
    
  }

  public function executeUpload($request){
    
  }

  public function executeNew($request){
  	
    $this->blogObj = Util::getNewObject('blog');
    $this->blogObj->setPublishDate(time());
    
    $this->pathList['Novo artigo'] = '#';
    $this->setTemplate('edit');
    
    $this->toolbarList = array('new', 'save');
  }
  
  public function executeEdit($request){
    
    $this->blogObj = $blogObj = BlogPeer::retrieveByPK($this->blogId);
    
    if( !is_object($blogObj) )
    	return $this->redirect('blog/index');
    	
    $this->pathList[$blogObj->getShortTitle()] = '#';
    
    $isAdmin = $this->getUser()->hasCredential('iRankAdmin');
    
    if( $this->blogIdAttribute && !$isAdmin )
    	$this->toolbarList = array('save');
    else
    	$this->toolbarList = array('new', 'save', 'delete');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $blogId  = $this->getUser()->getAttribute('blogId');
    $blogObj = BlogPeer::retrieveByPK($this->blogId);
    
    $blogObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->blogId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( BlogPeer::ID, $this->blogId, Criteria::IN );
	    $criteria->add( BlogPeer::VISIBLE, true );
	    $criteria->add( BlogPeer::ENABLED, true );
	    $criteria->add( BlogPeer::DELETED, false );
    	$blogObjList = BlogPeer::doSelect($criteria);
    	
    	$blogIdList = array();
    	foreach($blogObjList as $blogObj){
    		
    		$blogObj->delete();
	    	$blogIdList[] = $blogObj->getId();
    	}
    	
    	echo implode(',', $blogIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
  
  public function executeAutoCompleteImageShare($request){
    
	header('content-type: application/json; charset=UTF-8');

	$directory = Util::getFilePath('images/blog');   
    $fileList  = array();

    $handler = opendir($directory);

    while( $fileName = readdir($handler) ){

      if($fileName != '.' && $fileName != '..' && preg_match('/\.(jpg|png|gif|jpeg)$/i', $fileName))
        $fileList[] = $fileName;
    }

    closedir($handler); 
   
	foreach($fileList as $fileName)
		$resultList[] = '{"id":"'.$fileName.'", "label": "'.$fileName.'", "value": "'.$fileName.'"}';    	

	echo '['.implode(', ', $resultList).']';
	exit;
  }
  
  public function executeConnector($request){
    
//	error_reporting(0); // Set E_ALL for debuging
	
//	if (function_exists('date_default_timezone_set'))
//		date_default_timezone_set('America/Sao_Paulo');
	
	$rootDir = Util::getFilePath('/images/blog');
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
				'URL'        => 'http://'.$request->getHost().'/images/blog', // root directory URL
//				 'alias'     => 'File system',
				'mimeDetect' => 'internal',
				'tmbPath'    => '.tmb',
				'utf8fix'    => true,
				'tmbCrop'    => false,
//				'tmbBgColor' => 'transparent',
				'accessControl' => 'access',
	 			'uploadAllow'  => array('image/jpeg', 'image/png', 'image/gif'),      // mimetypes which allowed to upload
	 			'uploadDeny'   => array('*'),      // mimetypes which not allowed to upload
	 			'uploadOrder'  => 'allow,deny', // order to proccess uploadAllow and uploadAllow options
				 
				 'dirSize'      => true,
				 'dotFiles'     => false,        // display dot files
				 
				 'disabled'         => array('edit', 'mkfile'),
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
