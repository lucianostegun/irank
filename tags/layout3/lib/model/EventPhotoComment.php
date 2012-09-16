<?php

/**
 * Subclasse de representação de objetos da tabela 'event_photo_comment'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventPhotoComment extends BaseEventPhotoComment
{

	public function delete($con=null){
		
		$this->setDeleted(true);
		$this->save();
	}
    
    public function getCode(){
    	
    	$eventPhotoCommentId = $this->getId();
		$eventPhotoCommentId = (1983+$eventPhotoCommentId);
		
		return '#'.sprintf('%04d', $eventPhotoCommentId);
    }
    
    public function getComment($format=false){
    	
    	$comment = parent::getComment();
    	
		$comment = str_replace('>', '&gt;', $comment);
		$comment = str_replace('<', '&lt;', $comment);
    	
    	if( $format )
    		$comment = str_replace(chr(10), '<br/>', $comment);
		
    	return $comment;
    }
    
    public function getTimeAgo(){
    	
    	return Util::getTimeAgo($this->getCreatedAt(null));
    }
	
	public function isMyComment(){
		
		$peopleId = MyTools::getAttribute('peopleId');

		return ($this->getPeopleId()==$peopleId);
	}
	
	public function notify(){

		Util::getHelper('I18N');

		$templateName = 'eventPhotoCommentNotify';
		$eventObj     = $this->getEventPhoto()->getEvent();
		$emailContent = EmailTemplate::getContentByTagName($templateName);

		$emailContent = str_replace('[eventName]', $eventObj->getEventName(), $emailContent);
		$emailContent = str_replace('[rankingName]', $eventObj->getRanking()->getRankingName(), $emailContent);
		$emailContent = str_replace('[peopleName]', $this->getPeople()->getFirstName(), $emailContent);
		$emailContent = str_replace('[comment]', $this->getComment(), $emailContent);
		
		$emailContent = str_replace('[eventId]', $eventObj->getId(), $emailContent);
		$emailContent = str_replace('[eventPhotoId]', $this->getEventPhotoId(), $emailContent);
		$emailContent = str_replace('[shareId]', base64_encode($this->getEventPhotoId()), $emailContent);
		$emailContent = str_replace('[eventPlace]', $eventObj->getEventPlace(), $emailContent);
		$emailContent = str_replace('[eventDate]', $eventObj->getEventDate('d/m/Y'), $emailContent);
		$emailContent = str_replace('[startTime]', $eventObj->getStartTime('H:i'), $emailContent);
		$emailContent = str_replace('[peopleEmail]', $this->getPeople()->getEmailAddress(), $emailContent);
		
		$emailAddressList = $eventObj->getEmailAddressList('receiveEventCommentNotify', true);
		
		$options = array();
		$options['emailTemplate']  = null;
		$options['replyTo']        = 'event_photo_comment@irank.com.br';
		$options['templateName']   = $templateName;
		
		Report::sendMail(__('email.subject.eventPhotoComment', array('%eventName%'=>$eventObj->getEventName(), '%eventPhotoCommentCode%'=>$this->getCode())), $emailAddressList, $emailContent, $options);
	}
}
