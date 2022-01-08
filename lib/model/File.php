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
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
       		Log::quickLog('file', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('file', $this->getPrimaryKey(), $e);
        }
    }
	
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
	
	public static function upload( $request, $fieldName, $destinationPath, $options=array() ){
		
		$fileId               = (array_key_exists('fileId', $options)?$options['fileId']:null);
		$allowedExtensionList = (array_key_exists('allowedExtensionList', $options)?$options['allowedExtensionList']:array());
		$maxFileSize          = (array_key_exists('maxFileSize', $options)?$options['maxFileSize']:null);
		$destFileName         = (array_key_exists('fileName', $options)?$options['fileName']:null);
		$noFile               = (array_key_exists('noFile', $options)?$options['noFile']:false);
		
		$fileName  = $request->getFileName($fieldName);
		$fileSize  = $request->getFileSize($fieldName);
		$fileType  = $request->getFileType($fieldName);
		$extension = explode('.', $fileName);
		$extension = strtolower(end($extension));

		if( $fileSize > $maxFileSize )
			throw new Exception('Tamanho máximo de arquivo excedido');
		
		if( count($allowedExtensionList) > 0 && !in_array($extension, $allowedExtensionList) )
			throw new Exception('Formato de arquivo inválido. Formatos permitidos: '.implode(', ', $allowedExtensionList));

		$fileObj = ($fileId?FilePeer::retrieveByPK($fileId):new File());
		$fileObj->setFileName($fileName);
		$isNew   = $fileObj->isNew();		
		
		$fileName = ereg_replace('[^0-9]', '', microtime()).'.'.$extension;
		$fileName = ($destFileName?$destFileName:$fileName);

		$extensionImageList = array('jpg', 'png', 'jpeg', 'bmp', 'gif');

		$destinationPath = Util::getFilePath('uploads/'.$destinationPath); 

		if( !is_dir($destinationPath) )
			mkdir($destinationPath, 0755);
		
		if( $isNew )
			$filePath = $destinationPath.DIRECTORY_SEPARATOR.$fileName;
		else
			$filePath = $fileObj->getFilePath(true);

		$request->moveFile($fieldName, $filePath);

		if( !$noFile ){
			
			$fileObj->setFilePath($filePath);
			$fileObj->setFileSize($fileSize);
	
			if( in_array($extension, $extensionImageList) )
				$fileObj->setIsImage(true);		
			
			$fileObj->save();
			
			Log::doLog('Upload do arquivo '.$fileObj->getId(), 'File');
			
			return $fileObj;
		}else{
			
			Log::doLog('Upload do arquivo '.$fileName, 'File', array('FILE_PATH'=>$filePath));
		}
	}
	
	public function getDimensions(){
   	
   		return File::getFileDimension($this->getFilePath(true));
	}
   	
	public static function getFileDimension( $filePath ){
   	
		$fileInfo = array();
		
		$fileInfo['width']  = null;
		$fileInfo['height'] = null;
		   	
	   	try{
		   	$fileDimension = getimagesize( $filePath );
	   
		   	$fileInfo['width']  = $fileDimension[0];
			$fileInfo['height'] = $fileDimension[1];
		}catch( Exception $e ){

		}
		   	
		return $fileInfo;
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
	
	public static function getFileExtension($filePath){
	 	
		$filePath = explode('.', $filePath);
		return strtolower(end($filePath));
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
	
	public function createThumbnail($destinationPath, $minWidth=false, $minHeight=false){
		
		$filePath        = $this->getFilePath(true);
		$fileName        = Util::getFileName($filePath);
		$thumbFilePath   = Util::getFilePath($destinationPath.'/'.$fileName);
		$destinationPath = Util::getFilePath($destinationPath);
		$extension       = $this->getExtension();
		$fileDimensions  = $this->getDimensions();
		
		switch( $extension ){
			case 'jpg':
				$newImg = imagecreatefromjpeg( $filePath );
				break;
			case 'png':
				$newImg = imagecreatefrompng( $filePath );
				break;
			case 'gif':
				$newImg = imagecreatefromgif( $filePath );
				break;	
		}

		if( !is_dir($destinationPath) )
			mkdir($destinationPath, 0755);
			
		$width  = $fileDimensions['width'];
		$height = $fileDimensions['height'];
		
		$newHeight = round($height*$minWidth/$width);
		
		if( $newHeight < $minHeight ){
			
			$newHeight = $minHeight;
			$newWidth  = round($width*$minHeight/$height);
		}
		
		$srcW = imagesx($newImg);
		$srcH = imagesy($newImg);
	
		$top  = ($newHeight>$minHeight?$height/6:0);
		$left = 0;
	
		$new = imagecreatetruecolor($minWidth, $minHeight);
		imagecopyresampled($new, $newImg, 0, 0, $left, $top, $minWidth, $newHeight, $srcW, $srcH);

//		header('Content-Type: image/jpeg');

		imagejpeg($new, $thumbFilePath, 100);
//		imagejpeg($new, ''	, 100);
		imagedestroy($new);
		imagedestroy($newImg);
	}
	
	public function resizeMax($maxWidth=false, $maxHeight=false){
		
		$filePath       = $this->getFilePath(true);
		$fileName       = Util::getFileName($filePath);
		$extension      = $this->getExtension();
		$fileDimensions = $this->getDimensions();
		
		switch( $extension ){
			case 'jpg':
				$newImg = imagecreatefromjpeg( $filePath );
				break;
			case 'png':
				$newImg = imagecreatefrompng( $filePath );
				break;
			case 'gif':
				$newImg = imagecreatefromgif( $filePath );
				break;	
		}
			
		$width  = $fileDimensions['width'];
		$height = $fileDimensions['height'];
		
		if( $width < $maxWidth && $height < $maxHeight )
			return false;
		
		if( $width >= $height ){
			
			$newWidth  = $maxWidth;
			$newHeight = round($height*$maxWidth/$width);
		}else{
			
//			$widthTmp  = $maxHeight;
//			$maxHeight = $maxWidth;
//			$maxWidth  = $widthTmp;
			
			$newHeight = $maxHeight;
			$newWidth  = round($width*$maxHeight/$height);
		}

		$srcW = imagesx($newImg);
		$srcH = imagesy($newImg);
	
	
		$new = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($new, $newImg, 0, 0, 0, 0, $newWidth, $newHeight, $srcW, $srcH);

//		header('Content-Type: image/jpeg');

		imagejpeg($new, $filePath, 100);
//		imagejpeg($new, ''	, 100);
		imagedestroy($new);
		imagedestroy($newImg);
	}
	
	public function getResized($maxWidth=false, $maxHeight=false){

		$filePath       = $this->getFilePath(true);
		$fileName       = Util::getFileName($filePath);
		$extension      = $this->getExtension();
		$fileDimensions = $this->getDimensions();

		$newImg = imagecreatefromjpeg( $filePath );
			
		$width  = $fileDimensions['width'];
		$height = $fileDimensions['height'];
		
		if( $width < $maxWidth && $height < $maxHeight )
			return false;
			
		$maxWidth  = ($maxWidth?$maxWidth:$width);

		if( $width >= $height && !$maxHeight ){

			$newWidth  = ($maxWidth>$width?$width:$maxWidth);
			$newHeight = round($height*$newWidth/$width);
		}else{

			$maxHeight = ($maxHeight?$maxHeight:$height);
			$newHeight = $maxHeight;
			$newWidth  = round($width*$maxHeight/$height);
		}

		$srcW = imagesx($newImg);
		$srcH = imagesy($newImg);
	
	
		$new = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($new, $newImg, 0, 0, 0, 0, $newWidth, $newHeight, $srcW, $srcH);

		header('Content-Type: image/jpeg');

		imagejpeg($new, ''	, 100);
		imagedestroy($new);
		imagedestroy($newImg);
	}
}
