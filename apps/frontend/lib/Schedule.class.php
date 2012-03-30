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
	const FILE_PATH_TMP      = 'temp/schedule';
	const FILE_PATH_TEMPLATE = 'templates/schedule.ics';
	private $peopleId;
	private $fileName;
	private $startDate;
	private $sequence = 0;
	
    function __construct($username=null) {
    	
    	if( !$username )
    		$username = $_SERVER['PHP_AUTH_USER'];
    	
    	if( !$username )
    		$username ='irank'; 
    		
    	if( strtolower($username)!='irank' ){
    		
		    $userSiteObj = UserSitePeer::retrieveByUsername($username);
		    $peopleId    = $userSiteObj->getPeopleId();
		    $startDate   = $userSiteObj->getScheduleStartDate('Y-m-d');
		    
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
		$this->fileName  = $username.'.ics';
		
		$this->startDate = $startDate;
		$this->peopleId  = $peopleId;
		
		$this->buildTmpFile();
		
		// Se não for usuário "irank" gera os eventos dos rankings pessoais
		if( strtolower($username)!='irank' )
			$this->buildEvent();
			
		// Gera os eventos ao vivo
//		$this->buildEventLive();

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
			if( $comments )
				$event .= "DESCRIPTION:$comments".$nl;
			$event .= "URL;VALUE=URI:http://www.irank.com.br/event/show/$eventIdBase64".$nl;
			$event .= "STATUS:CONFIRMED".$nl;
			$event .= "SEQUENCE:{$this->sequence}".$nl;
			$event .= "SUMMARY:$rankingName\\n$eventName".$nl;
			$event .= "DTSTART;TZID=America/Sao_Paulo:{$eventDateTimeStart}".$nl;
			$event .= "CREATED:{$createdAt}Z".$nl;
			
			// Define o alarme apenas se a data do evento for maior que hoje
			if( strtotime($eventDateTime) > time() ){
			
				$event .= "BEGIN:VALARM".$nl;
				$event .= "X-WR-ALARMUID:$alarmId".$nl;
				$event .= "TRIGGER:-PT4H".$nl;
				$event .= "ATTACH;VALUE=URI:Basso".$nl;
				$event .= "ACTION:AUDIO".$nl;
				$event .= "END:VALARM".$nl;
			}
			$event .= "END:VEVENT";
			
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