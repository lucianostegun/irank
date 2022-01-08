<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking_subscription_request'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingSubscriptionRequest extends BaseRankingSubscriptionRequest
{
	
	public function notify(){

		$peopleObj = $this->getUserSiteRelatedByUserSiteId()->getPeople();
		
		$infoList = array();
		$infoList['peopleName']   = $peopleObj->getName();
		$infoList['emailAddress'] = $peopleObj->getEmailAddress();
		$infoList['rankingName']  = $this->getRanking()->getRankingName();
		$infoList['createdAt']    = $peopleObj->getCreatedAt('d/m/Y');
		
		$emailContent = Report::replace(EmailTemplate::getContentByTagName('rankingSubscriptionRequest'), $infoList);

		$emailSubject     = 'Pedido de inscrição no ranking';
		$emailAddressList = array();
		
		$rankingObj       = $this->getRanking();
		$emailAddressList = array();
		
		foreach($rankingObj->getOwnerList() as $peopleObj)
			$emailAddressList[] = $peopleObj->getEmailAddress();
		
		Report::sendMail($emailSubject, $emailAddressList, $emailContent);
	}
	
	public function agree($userSiteId){
		
		$this->setRequestStatus('agreed');
		$this->setUserSiteIdOwner($userSiteId);
		$this->save();
		
		$peopleId = $this->getUserSiteRelatedByUserSiteId()->getPeopleId();
		
		$rankingObj = $this->getRanking();
		$rankingObj->addPlayer($peopleId);
	}
	
	public function decline($userSiteId){
		
		$this->setRequestStatus('declined');
		$this->setUserSiteIdOwner($userSiteId);
		$this->save();
	}
}
