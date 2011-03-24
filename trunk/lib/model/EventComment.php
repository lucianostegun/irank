<?php

/**
 * Subclasse de representação de objetos da tabela 'event_comment'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventComment extends BaseEventComment
{
	
	public function delete($con=null){
		
		$this->setDeleted(true);
		$this->save();
		
		Log::quickLogDelete('event_comment', $this->getPrimaryKey());
	}

    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

    		$this->postOnWall();

			parent::save();
			
       		Log::quickLog('event_comment', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('event_comment', $this->getPrimaryKey(), $e);
        }
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
	
	public function postOnWall(){
		
		if( !$this->isNew() )
			return false;
			
       	HomeWall::doLog('postou um comentário no evento <b>'.$this->getEvent()->getEventName().'</b>', 'eventComment', true);
	}
	
	public function notify(){

		Util::getHelper('I18N');

		$eventObj     = $this->getEvent();
		$emailContent = AuxiliarText::getContentByTagName('eventCommentNotify');
		
		$culture = MyTools::getCulture();
		if( !$culture )
			MyTools::setCulture('pt_BR');

		$emailContent = str_replace('<eventName>', $eventObj->getEventName(), $emailContent);
		$emailContent = str_replace('<rankingName>', $eventObj->getRanking()->getRankingName(), $emailContent);
		$emailContent = str_replace('<peopleName>', $this->getPeople()->getFirstName(), $emailContent);
		$emailContent = str_replace('<comment>', $this->getComment(), $emailContent);
		
		$emailAddressList = $eventObj->getEmailAddressList('receiveEventCommentNotify', true);
		
		$options = array();
		$options['emailTemplate'] = null;
		$options['replyTo']       = 'event_comment@irank.com.br';
		
		Report::sendMail(__('email.subject.eventComment', array('%eventCode%'=>$eventObj->getCode())), $emailAddressList, $emailContent, $options);
	}
}
