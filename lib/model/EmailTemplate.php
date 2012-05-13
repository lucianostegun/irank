<?php

/**
 * Subclasse de representação de objetos da tabela 'email_template'.
 *
 * 
 *
 * @package lib.model
 */ 
class EmailTemplate extends BaseEmailTemplate
{
	
	public function getIsNew(){
		
		return ($this->isNew() || (!$this->getVisible() && !$this->getEnabled() && !$this->getDeleted()));
	}
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
        	Log::quickLog('email_template', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('email_template', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
	}
	
	public function quickSave($request){
		
		$templateName       = $request->getParameter('templateName');
		$emailTemplateId    = $request->getParameter('emailTemplateIdParent');
		$tagName            = $request->getParameter('tagName');
		$isAvailableForUse  = $request->getParameter('isAvailableForUse');
		$isAvailableForSale = $request->getParameter('isAvailableForSale');
		$description        = $request->getParameter('description');
		$content            = $request->getParameter('content');
		
		$isNew = $this->getIsNew();
		
		$this->setEmailTemplateId(($emailTemplateId?$emailTemplateId:null));
		$this->setTemplateName($templateName);
		$this->setTagName(($tagName?$tagName:null));
		$this->setDescription(($description?$description:null));
		$this->setIsAvailableForUse(($isAvailableForUse?true:false));
		$this->setIsAvailableForSale(($isAvailableForSale?true:false));
		$this->setEnabled(true);
		$this->setVisible(true);
		$this->setDeleted(false);
		$this->save();
		
		if( $content )
			$this->updateContent($content);
		
		if( $isNew )
			$this->renameFile();
	}
	
	public function renameFile(){
		
		$fileObj     = $this->getFile();
		$filePath    = $fileObj->getFilePath(true);
		$fileName    = $this->getTagName().'.htm';
		$filePathNew = 'templates/email/'.$fileName;
		
		if( file_exists($filePath) )
			rename($filePath, Util::getFilePath('/'.$filePathNew));
			
		$fileObj->setFileName($fileName);
		$fileObj->setFilePath($filePathNew);
		$fileObj->save();
	}
    
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

	public static function getList($criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
		
		$criteria->add( EmailTemplatePeer::ENABLED, true );
		$criteria->add( EmailTemplatePeer::VISIBLE, true );
		$criteria->add( EmailTemplatePeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( EmailTemplatePeer::TEMPLATE_NAME );
		
		return EmailTemplatePeer::doSelect( $criteria );
	}

	public static function getOptionsForSelect( $defaultValue=false, $returnArray=false ){
		
		$emailTemplateObjList = self::getList();
		
		$optionList = array();
		$optionList[''] = __('select');
		foreach($emailTemplateObjList as $emailTemplateObj)
			$optionList[$emailTemplateObj->getId()] = $emailTemplateObj->getDescription();
		
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
	
	public static function getContentByTagName($tagName, $encodeUTF8=false, $culture=false){

		if( !$culture )
			$culture = MyTools::getCulture();
		
		$criteria = new Criteria();
		$criteria->add( EmailTemplatePeer::VISIBLE, true );
		$criteria->add( EmailTemplatePeer::DELETED, false );
		$criteria->add( EmailTemplatePeer::TAG_NAME, $tagName );
		$emailTemplateObj = EmailTemplatePeer::doSelectOne( $criteria );

		if( !is_object($emailTemplateObj) )
			return null;

		$content = $emailTemplateObj->getContent($culture);
		
		if( $encodeUTF8 )
			$content = utf8_encode($content);
			
		return $content;
	}
	
	public function getContent($culture=false){

		$filePath = $this->getFilePath(true);
//		$filePath = str_replace('templates', 'templates', $filePath);

		return file_get_contents($filePath);
	}
	
	public function updateContent($content){
		
		$fp = fopen($this->getFilePath(true), 'w');
		fwrite($fp, $content);
		fclose($fp);
	}
	
	public function getClub($con=null){
		
		$clubObj = parent::getClub($con);
		
		if( !is_object($clubObj) ){
			
			$clubObj = new Club();
			$clubObj->setClubName('Não informado');
		}
		
		return $clubObj;
	}

	public function getEmailTemplate(){
		
		$emailTemplateObj = $this->getEmailTemplateRelatedByEmailTemplateId();
		
		if( !is_object($emailTemplateObj) )
			$emailTemplateObj = new EmailTemplate();
		
		return $emailTemplateObj;
	}
	
	public function toString(){
		
		return $this->getTemplateName();
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
