<?php

/**
 * Subclasse de representação de objetos da tabela 'faq'.
 *
 * 
 *
 * @package lib.model
 */ 
class Faq extends BaseFaq
{
	
	public static function getList(){
		
		$criteria = new Criteria();
		$criteria->add( FaqPeer::VISIBLE, true );
		$criteria->addAscendingOrderByColumn( FaqPeer::ORDER_SEQ );
		
		return FaqPeer::doSelect( $criteria );
	}
	
	public function getQuestion($culture=null){
		
		$this->setCulture(($culture?$culture:MyTools::getCulture()));
		return $this->getQuestionI18n();
	}
	
	public function getAnswer($culture=null){
		
		$this->setCulture(($culture?$culture:MyTools::getCulture()));
		return $this->getAnswerI18n();
	}
	
	public function notify(){

		$userSiteObj  = UserSite::getCurrentUser();
		$fullName     = '-';
		$emailAddress = '-';
		$username     = '-';
		$ipAddress    = $_SERVER['REMOTE_ADDR'];
		$question     = $this->getQuestion();
		
		$emailContent = AuxiliarText::getContentByTagName('faqQuestion');
		
		if( is_object($userSiteObj) ){

			$fullName     = $userSiteObj->getPeople()->getFullName();
			$emailAddress = $userSiteObj->getPeople()->getEmailAddress();
			$username     = $userSiteObj->getUsername();
		}
		
		$emailContent = str_replace('<fullName>', $fullName, $emailContent);
		$emailContent = str_replace('<emailAddress>', $emailAddress, $emailContent);
		$emailContent = str_replace('<username>', $username, $emailContent);
		$emailContent = str_replace('<ipAddress>', $ipAddress, $emailContent);
		$emailContent = str_replace('<questionDate>', date('d/m/Y H:i:s'), $emailContent);
		$emailContent = str_replace('<question>', $question, $emailContent);
		
		$emailAddress = 'lucianostegun@gmail.com';
		$options      = array();
		
		$options['emailTemplate']  = 'emailTemplateAdmin';
		$options['contentType']    = 'text/plain';
		$options['entitiesEncode'] = false;
		
		Report::sendMail('Dúvida FAQ iRank', $emailAddress, $emailContent, $options);
	}
	
	public function quickSave($request){

	  	$question    = $request->getParameter('question');
	  	$gridboxData = $request->getParameter('gridboxI18nData');

	  	$this->setQuestion( $question );
	  	$this->setEnabled(true);
	  	$this->setVisible(true);
	  	$this->save();
	  	$this->saveI18n($gridboxData);
	}
	
	public function saveI18n($gridboxData){
		
		$gridboxDataList = DhtmlxGrid::convertXmlToArray($gridboxData);
		foreach($gridboxDataList as $gridboxData){
			
			$culture  = $gridboxData[0];
			$question = $gridboxData[1];
			$answer   = $gridboxData[2];
			
			$faqI18nObj = FaqI18nPeer::retrieveByPK($this->getId(), $culture);
			$faqI18nObj->setQuestionI18n($question);
			$faqI18nObj->setAnswerI18n($answer);
			$faqI18nObj->save();
		}
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']        = $this->getId();
		$infoList['question']  = str_replace(chr(10), '\n', $this->getQuestion('pt_BR'));
		$infoList['visible']   = $this->getVisible();
		$infoList['deleted']   = $this->getDeleted();
		$infoList['locked']    = $this->getLocked();
		$infoList['createdAt'] = $this->getCreatedAt('d/m/Y H:i:s');
		$infoList['updatedAt'] = $this->getUpdatedAt('d/m/Y H:i:s');
		
		return $infoList;
	}
}
