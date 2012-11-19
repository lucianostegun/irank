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
	}
    
	public function getFilePath($full=false){

		$filePath = parent::getFilePath();

		if( $full )
			$filePath = Util::getFilePath($filePath);
			
		$filePath = str_replace('/', DIRECTORY_SEPARATOR, $filePath);
		$filePath = str_replace('\\', DIRECTORY_SEPARATOR, $filePath);
		
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
		$minWidth             = (array_key_exists('minWidth', $options)?$options['minWidth']:null);
		$maxWidth             = (array_key_exists('maxWidth', $options)?$options['maxWidth']:null);
		$minHeight            = (array_key_exists('minHeight', $options)?$options['minHeight']:null);
		$maxHeight            = (array_key_exists('maxHeight', $options)?$options['maxHeight']:null);
		$destFileName         = (array_key_exists('fileName', $options)?$options['fileName']:null);
		$filePathName         = (array_key_exists('filePathName', $options)?$options['filePathName']:null);
		$noFile               = (array_key_exists('noFile', $options)?$options['noFile']:false);
		$noLog                = (array_key_exists('noLog', $options)?$options['noLog']:false);
		$forceNewFile         = (array_key_exists('forceNewFile', $options)?$options['forceNewFile']:false);
		
		$maxFileSizeIni = ini_get('upload_max_filesize');
		$maxFileSizeIni = ((int)$maxFileSizeIni)*1024*1024;
		
		if( !$maxFileSize || $maxFileSizeIni < $maxFileSize )
			$maxFileSize = $maxFileSizeIni;
		
		$fileName  = $request->getFileName($fieldName);
		$fileSize  = $request->getFileSize($fieldName);
		$fileType  = $request->getFileType($fieldName);
		$extension = explode('.', $fileName);
		$extension = strtolower(end($extension));
		
		if( preg_match('/^[0-9]*[Mm][bB]?$/', $maxFileSize) )
			$maxFileSize = Util::formatFloat($maxFileSize)*1024*1024;

		if( $fileSize > $maxFileSize )
			throw new FileException('Tamanho máximo de arquivo excedido');
		
		if( count($allowedExtensionList) > 0 && !in_array($extension, $allowedExtensionList) )
			throw new FileException('Formato de arquivo inválido. Formatos permitidos: '.implode(', ', $allowedExtensionList));

		$fileObj = ($fileId?FilePeer::retrieveByPK($fileId):new File());
		
		$isNew = $fileObj->isNew();		
		
		if( $filePathName=='temp' )
			$filePathName = preg_replace('/[^0-9]/', '', microtime()).'.'.$extension;
		elseif( $destFileName )
			$filePathName = $destFileName.'.'.$extension;
		else
			$filePathName = $fileName;
			
		$fileName = ($destFileName?$destFileName:$filePathName);
		
		if( !preg_match('/\.[a-z]*$/i', $fileName) )
			$fileName = "$fileName.$extension";
			
		$fileObj->setFileName($fileName);

		$extensionImageList = array('jpg', 'png', 'jpeg', 'bmp', 'gif');
		
		$isImage = in_array($extension, $extensionImageList);
			
		if( !preg_match('/^\//', $destinationPath) )
			$destinationPath = 'uploads/'.$destinationPath;

		$destinationPath = Util::getFilePath($destinationPath); 

		if( !is_dir($destinationPath) )
			mkdir($destinationPath, 0755, true);
		
		if( $isNew || $forceNewFile ){
		
			$filePath = $destinationPath.DIRECTORY_SEPARATOR.$filePathName;
			
			if( file_exists($filePath) )
				unlink($filePath);
		}else
			$filePath = $fileObj->getFilePath(true);

		$request->moveFile($fieldName, $filePath);
		
		if( $isImage ){
			
			$dimension = getimagesize($filePath);

			if( ($minWidth && $dimension[0] < $minWidth) ||
				($maxWidth && $dimension[0] > $maxWidth) ||
				($minHeight && $dimension[0] < $minHeight) ||
				($maxHeight && $dimension[0] > $maxHeight) ){
					
					unlink($filePath);
					throw new FileException('Dimensões inválidas. Dimensão requerida:\n\nMin: '.$minWidth.'x'.$minHeight.'\nMax: '.$maxWidth.'x'.$maxHeight);
				}
		}

			
		$fileObj->setFilePath($filePath);
		$fileObj->setFileSize($fileSize);

		if( in_array($extension, $extensionImageList) )
			$fileObj->setIsImage(true);
		
		if( !$noFile ){
			
			$fileObj->save();
			
			if( !$noLog )
				Log::doLog('Upload do arquivo '.$fileObj->getId(), 'File');
		}else{
			
			if( !$noLog )
				Log::doLog('Upload do arquivo '.$fileName, 'File', array('FILE_PATH'=>$filePath));
		}
		
		return $fileObj;
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
	
	public function createThumbnail($destinationPath, $minWidth=false, $minHeight=false, $quality=100){
		
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
		
		if( $extension=='png' ){
			
			imagealphablending($new, false);
			imagesavealpha($new,true);
		}
		
		imagecopyresampled($new, $newImg, 0, 0, $left, $top, $minWidth, $newHeight, $srcW, $srcH);

		if( file_exists($thumbFilePath) )
			unlink($thumbFilePath);
		
		if( $extension=='png' )
			imagepng($new, $thumbFilePath);
		else
			imagejpeg($new, $thumbFilePath, $quality);

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
	
//	
//		$exif = exif_read_data($filePath);
////		echo '<pre>';print_r($exif);exit;
//		$ort  = 0;
//		$ort  = (isset($exif['Orientation'])?$exif['Orientation']:0);
//		
//	    switch($ort){
//	        case 3: // 180 rotate left
//	            $newImg = imagerotate($newImg, 180, 0);
//	        break;
//	                   
//	        case 1: // 90 rotate right
//	        
//				$newImg = imagerotate($newImg, -90, 0);
//				$tmpWidth = $srcW; 
//				$srcW = $srcH;
//				$srcH = $srcW;
//	        break;
//	               
//	        case 8:    // 90 rotate left
//	            $newImg = imagerotate($newImg, 90, 0);
//	        break;
//	    }
//	
	
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

		if( $extension=='jpg' || $extension=='jpeg' )
			$newImg = imagecreatefromjpeg( $filePath );
		elseif( $extension=='png' )
			$newImg = imagecreatefrompng( $filePath );
			
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

		if( $extension=='jpg' || $extension=='jpeg' ){
			
			header('Content-Type: image/jpeg');
			imagejpeg($new, '', 100);
		}elseif( $extension=='png' ){
			
			header('Content-Type: image/png');
			imagepng($new);
		}
		imagedestroy($new);
		imagedestroy($newImg);
	}
}

class FileException extends Exception 
{
    
}