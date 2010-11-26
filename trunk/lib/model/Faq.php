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
	
	public function notify(){

		$userSiteObj  = UserSite::getCurrentUser();
		$fullName     = '-';
		$emailAddress = '-';
		$username     = '-';
		$ipAddress    = $_SERVER['REMOTE_ADDR'];
		$question     = str_replace(chr(10), '<br/>', $this->getQuestion());
		
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
		
		$options['emailTemplate'] = 'emailTemplateAdmin';
		
		Report::sendMail('Dúvida FAQ iRank', $emailAddress, $emailContent, $options);
	}
}
