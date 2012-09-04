<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking_subscribe_request'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingSubscribeRequest extends BaseRankingSubscribeRequest
{
	
	public function notify(){

		$peopleObj = $this->getUserSiteRelatedByUserSiteId()->getPeople();
		
		$infoList = array();
		$infoList['peopleName']   = $peopleObj->getName();
		$infoList['emailAddress'] = $peopleObj->getEmailAddress();
		$infoList['rankingName']  = $this->getRanking()->getRankingName();
		$infoList['createdAt']    = $peopleObj->getCreatedAt('d/m/Y');
		
		$emailContent = Report::replace(EmailTemplate::getContentByTagName('rankingSubscriptionRequest'), $infoList);

		$emailSubject = 'Pedido de inscrição no ranking';
		$emailAddressList = array('lucianostegun@gmail.com');
		
		Report::sendMail($emailSubject, $emailAddressList, $emailContent);
	}
}
