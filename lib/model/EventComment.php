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
    	
    	$minutes = 60;
    	$hours   = $minutes*60;
    	$days    = $hours*24;
    	$weeks   = $days*7;
    	$months  = $days*30;
    	$years   = $months*12;
    	
    	$timeAgo = time()-$this->getCreatedAt(null);
    	
    	if( $timeAgo >= $years ){
    		
    		$timeAgo = ceil($timeAgo/$years);
    		$timeAgo = $timeAgo.' '.($timeAgo==1?'ano':'anos');
    	}elseif( $timeAgo >= $months ){
    		
    		$timeAgo = ceil($timeAgo/$months);
    		$timeAgo = $timeAgo.' '.($timeAgo==1?'mês':'meses');
    	}elseif( $timeAgo >= $weeks ){
    		
    		$timeAgo = ceil($timeAgo/$weeks);
    		$timeAgo = $timeAgo.' '.($timeAgo==1?'semana':'semanas');
    	}elseif( $timeAgo >= $days ){
    		
    		$timeAgo = ceil($timeAgo/$days);
    		$timeAgo = $timeAgo.' '.($timeAgo==1?'dia':'dias');
    	}elseif( $timeAgo >= $hours ){
    		
    		$timeAgo = ceil($timeAgo/$hours);
    		$timeAgo = $timeAgo.' '.($timeAgo==1?'hora':'horas');
    	}elseif( $timeAgo >= $minutes ){
    		
    		$timeAgo = ceil($timeAgo/$minutes);
    		$timeAgo = $timeAgo.' '.($timeAgo==1?'minuto':'minutos');
    	}else{
    		
    		$timeAgo = 'menos de 1 minuto';
    	}
    	
    	return $timeAgo;
    }
	
	public function isMyComment(){
		
		$peopleId = MyTools::getAttribute('peopleId');
			
		return ($this->getPeopleId()==$peopleId);
	}
	
	public function notify(){

		$eventCommentId = $this->getId();
		$eventCommentId = (1985+$eventCommentId);
		
		$eventObj     = $this->getEvent();
		$emailContent = AuxiliarText::getContentByTagName('eventCommentNotify');

		$emailContent = str_replace('<eventName>', $eventObj->getEventName(), $emailContent);
		$emailContent = str_replace('<rankingName>', $eventObj->getRanking()->getRankingName(), $emailContent);
		$emailContent = str_replace('<peopleName>', $this->getPeople()->getFirstName(), $emailContent);
		$emailContent = str_replace('<comment>', $this->getComment(), $emailContent);
		
		$emailAddressList = $eventObj->getEmailAddressList('receiveEventCommentNotify', true);
		
		$options = array();
		$options['emailTemplate'] = null;
		$options['replyTo']       = 'event_comment@irank.com.br';
		
		Report::sendMail('Comentários do evento '.$eventObj->getCode(), $emailAddressList, $emailContent, $options);
	}
}
