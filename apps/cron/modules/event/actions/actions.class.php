<?php

class eventActions extends sfActions
{

  public function preExecute(){

	$this->getUser()->setAttribute('cron', true);
	$this->getUser()->setCulture('pt_BR');
  }
  
  public function executeReminder($request){
	
	$days = $request->getParameter('days', 7);
	$createdAt = date('Y-m-d', mktime(0,0,0,date('m'), date('d')-2, date('Y')));
	$eventDate = date('Y-m-d', mktime(0,0,0,date('m'), date('d')+$days, date('Y')));

	$criteria = new Criteria();
	$criteria->setNoFilter(true);
	$criteria->add( EventPeer::ENABLED, true );
	$criteria->add( EventPeer::VISIBLE, true );
	$criteria->add( EventPeer::DELETED, false );
	$criteria->add( EventPeer::EVENT_DATE, $eventDate );
	$criteria->add( EventPeer::CREATED_AT, $createdAt, Criteria::LESS_EQUAL );
	$eventObjList = EventPeer::doSelect($criteria);
	
	foreach($eventObjList as $eventObj)
		$eventObj->notifyReminder($days);
	
	$this->getUser()->getAttributeHolder()->remove('cron');
	
	echo 'Notificações enviadas com sucesso para '.count($eventObjList).' evento(s)';
	exit;
  }
  
  public function executeImportEmailComments($request){

		$emailAddress = 'event_comment@irank.com.br';
		$password     = 'K33p0utme';
		$server       = 'imap.irank.com.br';
		$port         = 993;
		$protocol     = 'imap';

		$emailImportObj = new EmailImport($protocol, false);
		$emailImportObj->setServer( $server );
		$emailImportObj->setPort($port);
		$emailImportObj->setImapParameters('/ssl/novalidate-cert');
		$emailImportObj->setDefaultFolder('INBOX');
		$emailImportObj->setUsername( $emailAddress );
		$emailImportObj->setPassword( $password );
		$emailImportObj->connect();
		$connection = $emailImportObj->getConnection();

		$successCount = 0;
		
		$messageObjList = $emailImportObj->getNewMessages();
		$messageObjList = array_reverse($messageObjList);

		foreach( $messageObjList as $messageObj ){

			$subject      = $messageObj->getSubject();
			$comment      = $messageObj->getBody();
			$emailAddress = $messageObj->getSenderAddress();
			$createdAt    = $messageObj->getDate();

			$comment  = substr($comment, 0, 140);
			$comment  = ereg_replace(chr(13).chr(10).chr(13).chr(10).'.*', '', $comment);
			$comment  = str_replace(chr(13).chr(10), chr(10), $comment);
			$encoding = mb_detect_encoding($comment);
			
			if( strtoupper($encoding)!='UTF-8' )
				$comment  = utf8_encode($comment);
				
			$eventId = ereg_replace('^.*#', '', $subject);
			$eventId = ($eventId>1985?$eventId-1985:$eventId);
			
			$error = false;
			
			try{
			
				$eventObj = EventPeer::retrieveByPK($eventId);
					
			}catch(Exception $e){
				
				$error = true;
			}
				
			$peopleObj = PeoplePeer::retrieveByEmailAddress($emailAddress);


			/* VALIDAÇÃO DE ERROS */
			if( !is_object($eventObj) || !is_object($peopleObj) )
				$error = true;
			
			if( !$error && !$eventObj->isInvited($peopleObj->getId()) )
				$error = true;
				
			if( strlen($comment) > 32 && !ereg(' ', $comment) )
				$error = true;
				
			
			if( !$error ){
				
				$criteria = new Criteria();
				$criteria->add( EventCommentPeer::CREATED_AT, $createdAt );
				$criteria->add( EventCommentPeer::PEOPLE_ID, $peopleObj->getId() );
				$criteria->add( EventCommentPeer::EVENT_ID, $eventObj->getId() );
				$eventCommentObj = EventCommentPeer::doSelectOne($criteria);
				
				if( is_object($eventCommentObj) )
					$error = true;
			}
				
			if( $error ){
				
		  	    $messageObj->move('INBOX.Antigos');
//		  	    $messageObj->delete();
		  	    continue;
			}
			/* FIM VALIDAÇÃO ERROS */
				
			$eventCommentObj = new EventComment();
			$eventCommentObj->setPeopleId( $peopleObj->getId() );
			
			$eventCommentObj->setEventId( $eventObj->getId() );
				
			$eventCommentObj->setComment( utf8_encode($comment) );
			$eventCommentObj->setCreatedAt( $createdAt );
			
			try{
				
				$eventCommentObj->save();
				$eventCommentObj->notify();
			}catch(Exception $e){

				try{
					
					$eventCommentObj->setComment( utf8_decode($comment) );
					$eventCommentObj->save();
					$eventCommentObj->notify();
				}catch(Exception $e){
					
				}
			}
			
	  	    $messageObj->move('INBOX.Antigos');
//	  	    $messageObj->delete();
	  	    
	  	    $successCount++;
		}
		
		echo 'Importação concluída com sucesso! E-mails importados: '.$successCount;
		
		exit;
  }
}
