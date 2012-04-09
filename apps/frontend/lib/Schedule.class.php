<?php

/**
 * Classe responsável por gerar os arquivos de sincronização de calendário de eventos 
 *
 * @package    iRank
 * @author     Luciano Stegun
 */
class Schedule {

	const FILE_NAME_EXPORT   = 'iRank.ics';
	const NEW_LINE           = "\r\n";
	const NEW_STRING_LINE    = "\\n";
	const FILE_PATH_TMP      = 'temp/schedule';
	const FILE_PATH_TEMPLATE = 'templates/schedule.ics';
	private $peopleId;
	private $fileName;
	private $startDate;
	private $sequence = 0;
	private $scheduleAlarmTime = '4H';
	
    function __construct($username=null) {
    	
    	if( !$username )
    		$username = $_SERVER['PHP_AUTH_USER'];
    	
    	if( !$username )
    		$username ='irank'; 
    		
    	if( strtolower($username)!='irank' ){
    		
		    $userSiteObj = UserSitePeer::retrieveByUsername($username);
		    $peopleId    = $userSiteObj->getPeopleId();
		    $startDate   = $userSiteObj->getScheduleStartDate('Y-m-d');
		    
		    $this->scheduleAlarmTime = $userSiteObj->getOptionValue('scheduleAlarmTime', '4H');
		    
		    if( !$startDate ){
		    	
		    	$startDate = date('Y-m-d', mktime(0,0,0,date('m')-2, date('d'), date('Y')));
		    	$userSiteObj->setSignedSchedule(true);
		    	$userSiteObj->setScheduleStartDate($startDate);
		    	$userSiteObj->save();
		    }
    	}else{
    		
		    $peopleId  = 0;
		    $startDate = date('Y-m-d', mktime(0,0,0,date('m')-3,date('d'),date('Y')));
    	}
    	
    	$microtime = preg_replace('/[^0-9]/', '', (string)microtime());
		$this->fileName  = sprintf('%s-%s.ics', $username, $microtime);
//		$this->fileName  = $username.'.ics';
		
		$this->startDate = $startDate;
		$this->peopleId  = $peopleId;
		
		$this->buildTmpFile();
		
		// Se não for usuário "irank" gera os eventos dos rankings pessoais
		if( strtolower($username)!='irank' )
			$this->buildEvent();
			
		// Gera os eventos ao vivo
		$this->buildEventLive();

		$this->buildFile();
    }
    
    private function buildEvent(){
    	
	    $resultSet = Util::executeQuery(sprintf("SELECT * FROM event_schedule_view WHERE people_id = %d AND event_date >= '%s'", $this->peopleId, $this->startDate));
	    
	    $nl = Schedule::NEW_LINE;
	    
	    while( $resultSet->next() ){
	    	
	    	$eventId       = $resultSet->getInt(1);
	    	$eventName     = $resultSet->getString(2);
	    	$eventDateTime = $resultSet->getTimestamp(5);
	    	$comments      = $resultSet->getString(6);
	    	$players       = $resultSet->getInt(7);
	    	$isFreeroll    = $resultSet->getBoolean(8);
	    	$buyin         = $resultSet->getFloat(9);
	    	$entranceFee   = $resultSet->getFloat(10);
	    	$allowRebuy    = $resultSet->getBoolean(11);
	    	$allowAddon    = $resultSet->getBoolean(12);
	    	$rankingName   = $resultSet->getString(13);
	    	$eventPlace    = $resultSet->getString(14);
	    	$createdAt     = $resultSet->getTimestamp(15);
	    	$rankingId     = $resultSet->getInt(16);
	    	$inviteStatus  = $resultSet->getString(17);
	    	
	    	if( $isFreeroll )
	    		$eventName .= ' [FREEROLL]';
	    	
	    	if( $buyin )
	    		$buyin = Util::formatFloat($buyin, true);
	    	else
	    		$buyin = '';
	    	
	    	if( $entranceFee )
	    		$buyin = Util::formatFloat($entranceFee, true).($buyin?'+'.$buyin:'');
	    	
	    	if( $buyin )
	    		$comments = 'Buy-in: '.$buyin.($comments?Schedule::NEW_STRING_LINE.Schedule::NEW_STRING_LINE.$comments:'');
	    	
	    	$this->sequence++;
	    	
	    	$eventDateTimeStart = date('Ymd\THis', strtotime($eventDateTime));
	    	$eventDateTimeEnd   = date('Ymd\THis', strtotime($eventDateTime)+(3600*4));
	    	$alarmDateTime      = date('Ymd\THis', strtotime($eventDateTime)-(3600*4));
	    	$createdAt          = date('Ymd\THis', strtotime($createdAt));
	    	$currentDate        = date('Ymd\THis');
	    	
	    	$eventName   = str_replace('"', '\"', $eventName); 
	    	$rankingName = str_replace('"', '\"', $rankingName); 
	    	$eventPlace  = str_replace('"', '\"', $eventPlace); 
	    	
	    	$eventIdBase64 = base64_encode($eventId);
	    	
	    	$eventIdMd5 = $this->getMd5Id('event-'.$eventIdBase64.'-ranking-'.$rankingId);
	    	$alarmId    = $this->getMd5Id('event-'.$eventIdBase64.'-ranking-'.$rankingId.'-alarm');
	    
			$event  = "BEGIN:VEVENT".$nl;
			$event .= "TRANSP:TRANSPARENT".$nl;
//			$event .= "DTEND;TZID=America/Sao_Paulo:$eventDateTimeEnd".$nl;
			$event .= "UID:$eventIdMd5".$nl;
			$event .= "DTSTAMP:{$currentDate}Z".$nl;
			$event .= "LOCATION:$eventPlace".$nl;
			if( $comments )
				$event .= "DESCRIPTION:$comments".$nl;
			$event .= "URL;VALUE=URI:http://www.irank.com.br/event/details/$eventIdBase64".$nl;
			$event .= "STATUS:CONFIRMED".$nl;
			$event .= "SEQUENCE:{$this->sequence}".$nl;
			$event .= "SUMMARY:$rankingName\\n$eventName".$nl;
			$event .= "DTSTART;TZID=America/Sao_Paulo:{$eventDateTimeStart}".$nl;
			$event .= "CREATED:{$createdAt}Z".$nl;
			
			// Define o alarme apenas se a data do evento for maior que hoje
			if( strtotime($eventDateTime) > time() && $inviteStatus=='yes' ){
			
				$scheduleAlarmTime = $this->scheduleAlarmTime;
			
				$event .= "BEGIN:VALARM".$nl;
				$event .= "X-WR-ALARMUID:$alarmId".$nl;
				$event .= "TRIGGER:-PT$scheduleAlarmTime".$nl;
				$event .= "ATTACH;VALUE=URI:Basso".$nl;
				$event .= "ACTION:AUDIO".$nl;
				$event .= "END:VALARM".$nl;
			}
			$event .= "END:VEVENT".$nl;
			
			$this->appendFile($event);
	    }
    }

    private function buildEventLive(){
    	
	    $resultSet = Util::executeQuery(sprintf("SELECT * FROM event_live_schedule_view WHERE event_date >= '%s'", $this->startDate));
	    
	    $nl = Schedule::NEW_LINE;
	    
	    while( $resultSet->next() ){
    
	    	$eventLiveId      = $resultSet->getInt(1);
	    	$eventName        = $resultSet->getString(2);
	    	$eventDateTime    = $resultSet->getTimestamp(5);
	    	$comments         = $resultSet->getString(6);
	    	$players          = $resultSet->getInt(7);
	    	$isFreeroll       = $resultSet->getBoolean(8);
	    	$buyin            = $resultSet->getFloat(9);
	    	$entranceFee      = $resultSet->getFloat(10);
	    	$allowedRebuys    = $resultSet->getInt(11);
	    	$isIlimitedRebuys = $resultSet->getBoolean(12);
	    	$allowedAddons    = $resultSet->getInt(13);
	    	$rankingName      = $resultSet->getString(14);
	    	$clubName         = $resultSet->getString(15);
	    	$mapsLink         = $resultSet->getString(16);
	    	$cityName         = $resultSet->getString(17);
	    	$initial          = $resultSet->getString(18);
	    	$createdAt        = $resultSet->getTimestamp(19);
	    	$rankingLiveId    = $resultSet->getInt(20);
	    	
	    	if( $isFreeroll ){
	    		
	    		$eventName  = preg_replace('/FREEROLL/g', '', $eventName);
	    		$eventName  = str_replace('  ', '', $eventName);
	    		$eventName  = trim($eventName);
	    		$eventName .= ' [FREEROLL]';
	    	}
	    	
	    	if( $buyin )
	    		$buyin = Util::formatFloat($buyin, true);
	    	else
	    		$buyin = '';
	    	
	    	if( $entranceFee )
	    		$buyin = Util::formatFloat($entranceFee, true).($buyin?'+'.$buyin:'');
	    	
	    	if( $buyin )
	    		$comments = 'Buy-in: '.$buyin.Schedule::NEW_STRING_LINE.Schedule::NEW_STRING_LINE.$comments;
	    		
	    	$comments = 'Etapa do ranking '.$rankingName.($comments?Schedule::NEW_STRING_LINE.Schedule::NEW_STRING_LINE.$comments:'');
	    	
	    	$mapsLink = ($mapsLink?Schedule::NEW_STRING_LINE.$mapsLink:'');
	    	
	    	$this->sequence++;
	    	
	    	$eventDateTimeStart = date('Ymd\THis', strtotime($eventDateTime));
	    	$eventDateTimeEnd   = date('Ymd\THis', strtotime($eventDateTime)+(3600*4));
	    	$alarmDateTime      = date('Ymd\THis', strtotime($eventDateTime)-(3600*4));
	    	$createdAt          = date('Ymd\THis', strtotime($createdAt));
	    	$currentDate        = date('Ymd\THis');
	    	
	    	$eventName   = str_replace('"', '\"', $eventName); 
	    	$clubName    = str_replace('"', '\"', $clubName); 
	    	
	    	$eventLiveIdBase64 = base64_encode($eventLiveId);
	    	
	    	$eventLiveIdMd5 = $this->getMd5Id('eventLive-'.$eventLiveIdBase64.'-rankingLive-'.$rankingLiveId);
	    	$alarmId    = $this->getMd5Id('eventLive-'.$eventLiveIdBase64.'-rankingLive-'.$rankingLiveId.'-alarm');
	    
			$event  = "BEGIN:VEVENT".$nl;
			$event .= "TRANSP:TRANSPARENT".$nl;
//			$event .= "DTEND;TZID=America/Sao_Paulo:$eventDateTimeEnd".$nl;
			$event .= "UID:$eventLiveIdMd5".$nl;
			$event .= "DTSTAMP:{$currentDate}Z".$nl;
			$event .= "LOCATION:$clubName\\n{$cityName}-$initial{$mapsLink}".$nl;
			if( $comments )
				$event .= "DESCRIPTION:$comments".$nl;
			$event .= "URL;VALUE=URI:http://www.irank.com.br/eventLive/details/$eventLiveIdBase64".$nl;
			$event .= "STATUS:CONFIRMED".$nl;
			$event .= "SEQUENCE:{$this->sequence}".$nl;
			$event .= "SUMMARY:$eventName".$nl;
			$event .= "DTSTART;TZID=America/Sao_Paulo:{$eventDateTimeStart}".$nl;
			$event .= "CREATED:{$createdAt}Z".$nl;
			
			// Define o alarme apenas se a data do evento for maior que hoje
			if( strtotime($eventDateTime) > time() ){
			
				$scheduleAlarmTime = $this->scheduleAlarmTime;
				
				$event .= "BEGIN:VALARM".$nl;
				$event .= "X-WR-ALARMUID:$alarmId".$nl;
				$event .= "TRIGGER:-PT$scheduleAlarmTime".$nl;
				$event .= "ATTACH;VALUE=URI:Basso".$nl;
				$event .= "ACTION:AUDIO".$nl;
				$event .= "END:VALARM".$nl;
			}
			$event .= "END:VEVENT".$nl;
			
			$this->appendFile($event);
	    }
    }
    
    private function getFilePathTemplate(){
    	
    	return Util::getFilePath(Schedule::FILE_PATH_TEMPLATE);
    }

    private function getFilePathTmp(){
    	
    	return Util::getFilePath(Schedule::FILE_PATH_TMP.'/'.$this->fileName);
    }
    
    public function buildTmpFile(){
    	
    	$fp = fopen($this->getFilePathTmp(), 'w');
    	
    	if( $fp===false )
    		return false;
    	
    	fclose($fp);
    }

    public function appendFile($event){
    	
    	$fp = fopen($this->getFilePathTmp(), 'a');
    	
		fwrite($fp, $event);
		    	
    	fclose($fp);
    }
    
    private function getMd5Id($md5Id){
    	
		$md5Id = md5($md5Id);
	    $md5Id = strtoupper($md5Id);
	    $md5Id = sprintf('%s-%s-%s-%s-%s', substr($md5Id, 0, 8), substr($md5Id, 8, 4), substr($md5Id, 12, 4), substr($md5Id, 16, 4), substr($md5Id, 20, 12));
    }
    
    public function buildFile(){
    	
		Util::forceDownload(Schedule::FILE_NAME_EXPORT, 'text/calendar');
		
		$fileNameTmp = $this->getFilePathTmp();
		echo file_get_contents($this->getFilePathTemplate());
		echo file_get_contents($fileNameTmp);
		echo Schedule::NEW_LINE;
		echo 'END:VCALENDAR';
		
		unlink($fileNameTmp);
    }
}
?>