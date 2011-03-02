<?php

/**
 * Subclasse de representação de objetos da tabela 'auxiliar_text'.
 *
 * 
 *
 * @package lib.model
 */ 
class AuxiliarText extends BaseAuxiliarText
{
    
	public function getFile($con = null){

		$fileObj = parent::getFile($con);
		
		if( !is_object($fileObj) )
			$fileObj = new File();
		
		return $fileObj;
	}
    
	public function getFileName(){

		return $this->getFile()->getFileName();
	}
    
	public function getFileFormat(){

		$fileName  = $this->getFileName();
		$fileName  = explode('.', $fileName);
		$extension = end($fileName);
		
		$extension = strtoupper($extension);
		$extension = ($extension=='HTM'?'HTML':$extension);
		
		return $extension;
	}
    
	public function getFilePath($full=false){

		return $this->getFile()->getFilePath($full);
	}

	public static function getList(){
		
		$criteria = new Criteria();
		$criteria->add( AuxiliarTextPeer::ENABLED, true );
		$criteria->add( AuxiliarTextPeer::VISIBLE, true );
		$criteria->add( AuxiliarTextPeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( AuxiliarTextPeer::DESCRIPTION );
		
		return AuxiliarTextPeer::doSelect( $criteria );
	}

	public static function getOptionsForSelect( $defaultValue=false, $returnArray=false ){
		
		$auxiliarTextObjList = self::getList();
		
		$optionList = array();
		$optionList[''] = __('select');
		foreach( $auxiliarTextObjList as $auxiliarTextObj ){
			
			$optionList[$auxiliarTextObj->getId()] = $auxiliarTextObj->getDescription();
		}
		
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
	
	public static function getContentByTagName($tagName, $encodeUTF8=false, $culture=false){
		
		if( !$culture )
			$culture = MyTools::getCulture();
		
		$criteria = new Criteria();
		$criteria->add( AuxiliarTextPeer::VISIBLE, true );
		$criteria->add( AuxiliarTextPeer::DELETED, false );
		$criteria->add( AuxiliarTextPeer::TAG_NAME, $tagName );
		$auxiliarTextObj = AuxiliarTextPeer::doSelectOne( $criteria );

		if( !is_object($auxiliarTextObj) )
			return null;

		$content = $auxiliarTextObj->getContent($culture);
		
		if( $encodeUTF8 )
			$content = utf8_encode($content);
			
		return $content;
	}
	
	public function getContent($culture=false){

		$filePath = $this->getFilePath(true);
		$filePath = str_replace('templates', 'templates'.DIRECTORY_SEPARATOR.$culture, $filePath);

		return file_get_contents($filePath);
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']            = $this->getId();
		$infoList['description']   = $this->getDescription();
		$infoList['fileId']        = $this->getFileId();
		$infoList['fileName']      = $this->getFileName();
		$infoList['tagName']       = $this->getTagName();
		$infoList['enabled']       = $this->getEnabled();
		$infoList['visible']       = $this->getVisible();
		$infoList['deleted']       = $this->getDeleted();
		$infoList['locked']        = $this->getLocked();
		$infoList['createdAt']     = $this->getCreatedAt('d/m/Y H:i:s');
		$infoList['updatedAt']     = $this->getUpdatedAt('d/m/Y H:i:s');
		
		return $infoList;
	}
}
