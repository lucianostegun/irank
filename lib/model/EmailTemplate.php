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
		$this->setTagName($this->getTagName().'_'.time());
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
		
		$isNew              = $this->getIsNew();
		$tagNameOld         = $this->getTagName();
		$emailTemplateIdOld = $this->getEmailTemplateId();
		
		$this->setEmailTemplateId(nvl($emailTemplateId));
		$this->setTemplateName($templateName);
		$this->setTagName(nvl($tagName));
		$this->setDescription(nvl($description));
		$this->setIsAvailableForUse(($isAvailableForUse?true:false));
		$this->setIsAvailableForSale(($isAvailableForSale?true:false));
		$this->setEnabled(true);
		$this->setVisible(true);
		$this->setDeleted(false);
		
		if( $emailTemplateIdOld!=$emailTemplateId )
			$this->updateTagNameParent();
		
		$this->save();
		
		if( $content )
			$this->updateContent($content);
		
		if( $isNew || ($tagNameOld!=$tagName) )
			$this->renameFile();
	}
	
	public function updateTagNameParent(){
		
		$tagName = $this->getEmailTemplate()->getTagName();
		$this->setTagNameParent( nvl($tagName) );
		unset($tagName);
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

	public static function getOptionsForSelect( $defaultValue=false, $returnArray=false, $criteria=null ){
		
		$emailTemplateObjList = self::getList($criteria);
		
		$optionList = array();
		$optionList[''] = __('select');
		foreach($emailTemplateObjList as $emailTemplateObj)
			$optionList[$emailTemplateObj->getId()] = $emailTemplateObj->getTemplateName();
		
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}

	public static function getOptionsForSelectClub( $defaultValue=false, $returnArray=false ){
		
		$clubId = MyTools::getAttribute('clubId');
		$criteria = new Criteria();
		$criteria->add( EmailTemplatePeer::IS_AVAILABLE_FOR_USE, true );
		
		if( $clubId ){
			
			$criterion = $criteria->getNewCriterion( EmailTemplatePeer::CLUB_ID, $clubId );
			$criterion->addOr( $criteria->getNewCriterion( EmailTemplatePeer::CLUB_ID, NULL ) );
			$criteria->add( $criterion );
		}

		return self::getOptionsForSelect($defaultValue, $returnArray, $criteria);
	}
	
	public static function getContentByTagName($tagName, $encodeUTF8=false, $culture=false){
		
		$filePath = Util::getFilePath('/templates/email/'.$tagName.'.htm');
		$content = file_get_contents($filePath);
		
		if( $encodeUTF8 )
			$content = utf8_encode($content);
			
		return $content;
	}
	
	public function getContent($culture=false){

		$filePath = $this->getFilePath(true);

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
	
	public function getContentPreview($includeTemplate=true){
		
		$tagName      = $this->getTagName();
		$emailContent = $this->getContent();
		
		$peopleObj = People::getCurrentPeople();
		
		$infoList = array('emailTitle'=>$this->toString(),
						  'peopleName'=>$peopleObj->getFirstName());
		
		if( preg_match('/eventLive/', $tagName) ){
			
			$eventLiveObj = EventLivePeer::retrieveByPK(12);
			
			$infoList = array_merge($infoList, $eventLiveObj->getReplaceTags($peopleObj));
			
		}elseif( preg_match('/event/', $tagName) ){
			
			$eventObj = EventPeer::retrieveByPK(10);	
			$infoList['resultList']   = $eventObj->getEmailResultList();
			$infoList['classifyList'] = $eventObj->getEmailClassifyList();
			$infoList = array_merge($infoList, $eventObj->getInfo());
		}
		
		if( $includeTemplate && !is_null($this->getEmailTemplateId()) ){
			
			$emailTemplate = $this->getEmailTemplate()->getContent();
			$emailContent = str_replace('[emailContent]', $emailContent, $emailTemplate);
		}
						  
		return Report::defaultReplace($emailContent, $infoList);
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
