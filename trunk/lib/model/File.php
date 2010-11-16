<?php

/**
 * Subclasse de representação de objetos da tabela 'file'.
 *
 * 
 *
 * @package lib.model
 */ 
class File extends BaseFile
{
	
	public function toString(){
		
		return $this->getFileName();
	}
    
	public function delete($con = null){

		$this->setDeleted(true);
		$this->save();
		
		Log::quickLogDelete('file', $this->getPrimaryKey());
	}
    
	public function getFilePath($full=false){

		$filePath = parent::getFilePath();

		if( $full )
			$filePath = Util::getFilePath($filePath);
			
		$filePath = ereg_replace('[\\/]', DIRECTORY_SEPARATOR, $filePath);
		
	    if( !file_exists($filePath) )
	    	$filePath = str_replace('TaskManager', 'TaskManagerOld', $filePath);

		return $filePath;
	}
	
	public static function getUploadFrame($ationType, $objectId, $statusFunction){
		
		echo '<iframe id="uploadFileFrame" name="uploadFileFrame" src="'.url_for( 'file/fileUploadFrame?ationType='.$ationType.'&objectId='.$objectId.'&statusFunction='.$statusFunction ).'" width="140" height="23" scrolling="no" frameborder="0"></iframe>'; 
	}

	public static function createUploadWindow($relationType, $objectId){

		sfContext::getInstance()->getResponse()->addJavascript( 'backend/file' );
		sfContext::getInstance()->getResponse()->addStylesheet( 'backend/file' );
		DhtmlxWindows::createWindow('fileUpload', 'Upload de arquivo', 500, 175, 'file/upload', array('relationType'=>$relationType, 'objectId'=>$objectId));
	}

	public static function downloadFile( $fileId, $forcedFileName=null, $pdf=false ){
   	
   		$filePath = (is_numeric($fileId)?null:$fileId);

   		if( $filePath ){
   			
			$fileName = Util::getFileName($filePath);
   		}else{
   			
			$fileObj  = FilePeer::retrieveByPk( $fileId );
			$filePath = $fileObj->getFilePath(true);
			$fileName = $fileObj->getFileName();
   		}

		$fileName = ($forcedFileName?$forcedFileName:$fileName);
		
		if( $pdf ){
			
			header('Content-Type: application/pdf');
			header('Content-Transfer-Encoding: binary');
		}else{
			
			header('Content-type: application/force-download');
			header('Content-Disposition: attachment; filename="'.$fileName.'"');
		}
		
	    header('Expires: 0');
	    header('Pragma: no-cache');
	    	
		$fileContent = file_get_contents( $filePath );
    	print_r($fileContent);
    	exit;
	}

	public function download(){
   	
   		File::downloadFile($this->getId());
    	exit;
	}
    
	public static function getFile( $fileId, $width=false, $height=false ){
		
		$fileObj = FilePeer::retrieveByPK( $fileId );

		$filePath = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.$fileObj->getFilePath();

		$filePath = str_replace('/', DIRECTORY_SEPARATOR, $filePath);
		$filePath = str_replace('\\', DIRECTORY_SEPARATOR, $filePath);

		$extension     = explode( '.', $filePath );
		$realExtension = strtolower(end( $extension ));

		header('Content-type: file/jpeg');
	}
	
	public static function upload( $request, $filePathName, $fieldName='filePath', $subPath=null, $fileId=null ){
		
		$fileObj = ($fileId?FilePeer::retrieveByPK($fileId):new File());
		$isNew   = $fileObj->isNew();
		
		if( $isNew )
			$fileObj->setFileName( time() );
			
		$fileObj->save();
		
		$objectId    = $request->getParameter( 'objectId' );
		$description = $request->getParameter( 'description' );
		
		$fileName  = $request->getFileName($fieldName);
		$fileSize  = $request->getFileSize($fieldName);
		$fileType  = $request->getFileType($fieldName);
		$extension = explode('.', $fileName);
		$extension = strtolower(end($extension));

		$extensionImageList = array('jpg', 'png', 'jpeg', 'bmp', 'gif');

		$filePathName .= '.'.$extension;
		$path          = Util::getFilePath('uploads/'.$subPath); 
		
		if( !is_dir($path) )
			mkdir($path, 0755);
		
		if( $isNew )
			$filePath = $path . DIRECTORY_SEPARATOR . $filePathName;
		else
			$filePath = $fileObj->getFilePath(true);

		$request->moveFile($fieldName, $filePath);

		$fileObj->setFileName( $fileName );
		$fileObj->setFilePath( $filePath );
		$fileObj->setDescription( $description );
		$fileObj->setFileSize($fileSize);
		
		if( in_array($extension, $extensionImageList) )
			$fileObj->setImage();		
		
		$fileObj->save();
		
		return $fileObj;
	}
	
	public function setImage(){
		
		$this->setIsImage(true);
		
		$imageObj = new Image();
		$this->addImage($imageObj);
		$imageObj->setDimension(); 
	}
	
	public static function getFileByPath( $filePath ){
		
		$criteria = new Criteria();
		$criteria->add( FilePeer::FILE_PATH, $filePath );
		$fileObj = FilePeer::doSelectOne( $criteria );
		
		return $fileObj;
	}
	
	public static function forceDownload( $fileName ){
	 	
		header('Content-type: application/force-download');
		header('Content-Disposition: attachment; filename="'.$fileName.'"');
	    header('Expires: 0');
	    header('Pragma: no-cache');
	}
	
	public function getFileExtension(){
	 	
		$fileName = explode('.', $this->getFileName());
		return end($fileName);
	}
	
	public function setFilePath($filePath){
	 	
		$rootPath = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR;
		$filePath = str_replace($rootPath, '', $filePath);
		$filePath = str_replace('\\', '/', $filePath);
		parent::setFilePath($filePath);
	}
	 
	public function addRelation($relationType, $objectId){
		
		switch( $relationType ){
			case 'task':
				$object = new TaskFile();
				$object->setTaskId($objectId);
				break;
		}
		
		$object->setFileId($this->getId());
		$object->save();
		return $object;
	} 
	
	public function getIcon(){
		
		eregi('.[a-zA-Z]*$', $this->getFileName(), $matches);
		$fileExtension = str_replace('.', '', $matches[0]);

		$fileExtension = strtolower($fileExtension);
		
		$extensionList = array( 'doc'=>array('doc', 'docx', 'rtf'),
								'zip'=>array('zip', 'rar', 'tar'),
								'xls'=>array('xls', 'xlsx', 'csv'),
								'zip'=>array('zip', 'rar', 'tar'),
								'ppt'=>array('ppt', 'pps', 'pptx'),
								'png'=>array('png', 'jpg', 'jpeg', 'gif', 'bmp', 'gif'),
								'pdf'=>array('pdf'),
								'txt'=>array('txt'));
		
		$extension = null;
		foreach( $extensionList as $key=>$extensions )
			if( in_array($fileExtension, $extensions) )
				$extension = $key;

		if( !$extension )
			$extension = 'other';
					
		return image_tag('icon/extension/'.$extension);
	}
	
	public function getImage(){
		
		$criteria = new Criteria();
		$criteria->add( ImagePeer::FILE_ID, $this->getId() );
		$imageObj = ImagePeer::doSelectOne( $criteria );
		
		if( !is_object($imageObj) )
			$imageObj = new Image();
		
		return $imageObj;
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']          = $this->getId(true);
		$infoList['fileName']    = $this->getFileName();
		$infoList['filePath']    = $this->getFilePath();
		$infoList['description'] = $this->getDescription();
		$infoList['isImage']     = $this->getIsImage();
		$infoList['width']       = $this->getImage()->getWidth();
		$infoList['height']      = $this->getImage()->getHeight();
		$infoList['createdAt']   = $this->getCreatedAt('d/m/Y H:i:s');
		$infoList['updatedAt']   = $this->getUpdatedAt('d/m/Y H:i:s');
		
		return $infoList;
	}
	
	public function getExtension(){
		
		$fileName = $this->getFileName();
		$fileName = explode('.', $fileName);
		
		return strtolower(end($fileName));
	}
	
	public function isImage(){
		
		return $this->getIsImage();
	}
	
	public function isPdf(){
		
		$extension = $this->getExtension();
		return ($extension=='pdf');
	}
}
