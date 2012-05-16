<?php

/**
 * Subclasse de representação de objetos da tabela 'email_marketing'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class EmailMarketing extends BaseEmailMarketing
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
		
		$description     = $request->getParameter('description');
		$emailTemplateId = $request->getParameter('emailTemplateId');
		$emailSubject    = $request->getParameter('emailSubject');
		$content         = $request->getParameter('content');
		
		$isNew = $this->getIsNew();
		
		$this->setEmailTemplateId($emailTemplateId);
		$this->setDescription($description);
		$this->setEmailSubject($emailSubject);
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
		$dirPath     = Util::getFilePath('/templates/email/marketing/');
		$filePathNew = $dirPath.$fileObj->getFileName();
		
		if( !file_exists($dirPath) )
			mkdir($dirPath, 0777, true);
		
		if( file_exists($filePath) )
			rename($filePath, $filePathNew);
			
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
		
		$criteria->add( EmailMarketingPeer::ENABLED, true );
		$criteria->add( EmailMarketingPeer::VISIBLE, true );
		$criteria->add( EmailMarketingPeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( EmailMarketingPeer::DESCRIPTION );
		
		return EmailMarketingPeer::doSelect( $criteria );
	}

	public static function getOptionsForSelect( $defaultValue=false, $returnArray=false, $criteria=null ){
		
		$emailMarketingObjList = self::getList($criteria);
		
		$optionList = array();
		$optionList[''] = __('select');
		foreach($emailMarketingObjList as $emailMarketingObj)
			$optionList[$emailMarketingObj->getId()] = $emailMarketingObj->toString();
		
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
	
	public function getContent($peopleObj=null){

		$filePath = $this->getFilePath(true);

		$emailContent = file_get_contents($filePath);
		
		if( is_object($peopleObj) ){
			
			$infoList = array('emailTitle'=>$this->getEmailSubject(),
						  'peopleName'=>$peopleObj->getFirstName());
						  
			$userSiteObj = $peopleObj->getUserSite();
			if( is_object($userSiteObj) )
				$infoList = array_merge($infoList, $userSiteObj->getInfo(false, false));
			
			$emailContent = Report::defaultReplace($emailContent, $infoList);
		}
		
		$emailTemplate = $this->getEmailTemplate()->getContent();
		$emailContent  = str_replace('[emailContent]', $emailContent, $emailTemplate);
		
		return $emailContent;
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

	public function getContentPreview($includeTemplate=true){
		
		$emailContent = $this->getContent();
		
		$peopleObj = People::getCurrentPeople();
		
		$infoList = array('emailTitle'=>$this->getEmailSubject(),
						  'peopleName'=>$peopleObj->getFirstName());
		
		if( $includeTemplate && $this->getEmailTemplateId() ){
			
			$emailTemplate = $this->getEmailTemplate()->getContent();
			$emailContent  = str_replace('[emailContent]', $emailContent, $emailTemplate);
		}
						  
		return Report::defaultReplace($emailContent, $infoList);
	}
	
	public function getSendingStatus($description=false){
		
		$sendingStatus = parent::getSendingStatus();
		
		if( $description ){
			switch($sendingStatus){
				case 'pending':
					$sendingStatus = 'Não enviado';
					break;
				case 'sent':
					$sendingStatus = 'Enviado';
					break;
				case 'schedule':
					$sendingStatus = 'Agendado';
					break;
			}
		}
		
		return $sendingStatus;
	}
	
	public function sendEmail($peopleId){
		
	  	$peopleObj = PeoplePeer::retrieveByPK( $peopleId );
	  	
	  	if( !is_object($peopleObj) )
	  		throw new Exception ('Não foi possível concluir o envio do email');
	  	
	  	$emailAddress = $peopleObj->getEmailAddress();
	  	
	  	if(!$emailAddress)
	  		throw new Exception('Email não cadastrado');
	  		
	  	$emailMarketingPeopleObj = EmailMarketingPeoplePeer::retrieveByPK($this->getId(), $peopleId);
  		$emailLogObj = $emailMarketingPeopleObj->getEmailLog();
  		
  		if( $emailLogObj->getSendingSuccess() )
  			die($emailLogObj->getCreatedAt('d/m/Y H:i'));
  		
  		$emailLogObj->setEmailAddress($emailAddress);
  		$emailLogObj->save();
  		
  		$emailLogId = $emailLogObj->getId();
  		
  		$emailMarketingPeopleObj->setEmailLogId($emailLogId);
  		$emailMarketingPeopleObj->save();
  		
  		$emailContent = $this->getContent($peopleObj);
  		$emailSubject = $this->getEmailSubject();
  		
  		$options = array('emailLogId'=>$emailLogId, 'emailTemplate'=>null);
	  	Report::sendMail($emailSubject, $emailAddress, $emailContent, $options);
	  	
	  	echo $emailLogObj->getCreatedAt('d/m/Y H:i');
	}
	
	public function toString(){
		
		return $this->getDescription();
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']            = $this->getId();
		$infoList['description']   = $this->getDescription();
		$infoList['fileId']        = $this->getFileId();
		$infoList['fileName']      = $this->getFileName();
		$infoList['enabled']       = $this->getEnabled();
		$infoList['visible']       = $this->getVisible();
		$infoList['deleted']       = $this->getDeleted();
		$infoList['locked']        = $this->getLocked();
		$infoList['createdAt']     = $this->getCreatedAt('d/m/Y H:i:s');
		$infoList['updatedAt']     = $this->getUpdatedAt('d/m/Y H:i:s');
		
		return $infoList;
	}
}
