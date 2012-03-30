<?php

/**
 * schedule actions.
 *
 * @package    iRank
 * @subpackage frontend
 * @author     Luciano Stegun
 */
class scheduleActions extends sfActions
{

  public function preExecute(){
    
  }
  
  public function executeIndex($request){
    
    $username    = $_SERVER['PHP_AUTH_USER'];
    $userSiteObj = UserSitePeer::retrieveByUsername($username);
    $peopleId    = $userSiteObj->getPeopleId();
    $startDate   = $userSiteObj->getScheduleStartDate('Y-m-d');
    
    if( !$startDate ){
    	
    	$startDate = date('Y-m-d');
    	$userSiteObj->setSignedSchedule(true);
    	$userSiteObj->setScheduleStartDate($startDate);
    	$userSiteObj->save();
    }
    
    $nl = chr(10);
    
    $eventList = array();
    $resultSet = Util::executeQuery("SELECT * FROM event_schedule_view WHERE people_id = $peopleId AND event_date >= '$startDate'");
    
    $sequence = 0;
    while( $resultSet->next() ){
    	
    	$eventId       = $resultSet->getInt(1);
    	$eventName     = $resultSet->getString(2);
    	$eventDateTime = $resultSet->getTimestamp(5);
    	$comments      = $resultSet->getString(6);
    	$players       = $resultSet->getInt(7);
    	$rankingName   = $resultSet->getString(8);
    	$eventPlace    = $resultSet->getString(9);
    	$createdAt     = $resultSet->getTimestamp(11);
    	$rankingId     = $resultSet->getInt(12);
    	
    	$sequence++;
    	
    	$eventDateTimeStart = date('Ymd\THis', strtotime($eventDateTime));
    	$eventDateTimeEnd   = date('Ymd\THis', strtotime($eventDateTime)+(3600*4));
    	$alarmDateTime      = date('Ymd\THis', strtotime($eventDateTime)-(3600*4));
    	$createdAt          = date('Ymd\THis', strtotime($createdAt));
    	$currentDate        = date('Ymd\THis');
    	
    	$eventName   = str_replace('"', '\"', $eventName); 
    	$rankingName = str_replace('"', '\"', $rankingName); 
    	$eventPlace  = str_replace('"', '\"', $eventPlace); 
    	
    	$eventIdBase64 = base64_encode($eventId);
    	
    	$eventIdMd5    = 'event-'.$eventIdBase64.'-ranking-'.$rankingId;
    	$eventIdMd5    = md5($eventIdMd5);
    	$eventIdMd5    = strtoupper($eventIdMd5);
    	$eventIdMd5    = sprintf('%s-%s-%s-%s-%s', substr($eventIdMd5, 0, 8), substr($eventIdMd5, 8, 4), substr($eventIdMd5, 12, 4), substr($eventIdMd5, 16, 4), substr($eventIdMd5, 20, 12));

    	$alarmId = 'event-'.$eventIdBase64.'-ranking-'.$rankingId.'-alarm';
    	$alarmId = md5($alarmId);
    	$alarmId = strtoupper($alarmId);
    	$alarmId = sprintf('%s-%s-%s-%s-%s', substr($alarmId, 0, 8), substr($alarmId, 8, 4), substr($alarmId, 12, 4), substr($alarmId, 16, 4), substr($alarmId, 20, 12));
    
		$event  = "BEGIN:VEVENT".$nl;
		$event .= "TRANSP:TRANSPARENT".$nl;
		$event .= "DTEND;TZID=America/Sao_Paulo:$eventDateTimeEnd".$nl;
		$event .= "UID:$eventIdMd5".$nl;
		$event .= "DTSTAMP:{$currentDate}Z".$nl;
		$event .= "LOCATION:$eventPlace".$nl;
		$event .= "DESCRIPTION:$comments".$nl;
		$event .= "URL;VALUE=URI:http://www.irank.com.br/event/show/$eventIdBase64".$nl;
		$event .= "STATUS:CONFIRMED".$nl;
		$event .= "SEQUENCE:$sequence".$nl;
		$event .= "SUMMARY:$rankingName\\n$eventName".$nl;
		$event .= "DTSTART;TZID=America/Sao_Paulo:{$eventDateTimeStart}".$nl;
		$event .= "CREATED:{$createdAt}Z".$nl;
		
		// Define o alarme apenas se a data do evento for maior que hoje
		if( strtotime($eventDateTime) > time() ){
		
			$event .= "BEGIN:VALARM".$nl;
			$event .= "X-WR-ALARMUID:$alarmId".$nl;
			$event .= "TRIGGER;VALUE=DATE-TIME:{$alarmDateTime}Z".$nl;
			$event .= "ATTACH;VALUE=URI:Basso".$nl;
			$event .= "ACTION:AUDIO".$nl;
			$event .= "END:VALARM".$nl;
		}
		$event .= "END:VEVENT".$nl;
		
		$eventList[] = $event;
    }
	
	$scheduleTemplate = file_get_contents(Util::getFilePath('templates/schedule.ics'));
	$scheduleTemplate = str_replace('<eventList>', implode(chr(10).chr(10), $eventList), $scheduleTemplate);
	
	Util::forceDownload('irank.ics', 'text/calendar');
	
	echo $scheduleTemplate;
	
	exit;
  }
}
