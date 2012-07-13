<?php

/**
 * Subclasse de representação de objetos da tabela 'sms'.
 *
 * 
 *
 * @package lib.model
 */ 
class Sms extends BaseSms
{
	
	public function sendSms($phoneNumber, &$smsLogObj, $clubId=null){
		
		// Se for um clube, verifica os créditos do clube
		if( $clubId && !Util::executeOne("SELECT check_club_sms_credit($clubId)", 'boolean') ){
			
			$smsLogObj->setSendingStatus('109');
			$smsLogObj->save();
			Util::forceError('O clube não possui mais créditos para envio de SMS');
		}
		
		// E mesmo se não for um clube, verifica os créditos do site
		if( !Util::executeOne("SELECT check_admin_sms_credit()", 'boolean') ){

			$smsLogObj->setSendingStatus('109');
			$smsLogObj->save();			
			Util::forceError('O iRank não possui mais créditos para envio de SMS');
		}
		
		if( $clubId )
			$tagName = Util::executeOne('SELECT tag_name FROM club WHERE id = '.$clubId, 'string');
		
		$mobile        = $smsLogObj->getPhoneNumber();
		$msg           = $this->getTextMessage();
//		$msg           = String::removeAccents($msg);
//		$msg           = mb_convert_encoding($msg, 'UTF-8');
		$msg           = URLEncode($msg);
		$credencial    = Config::getConfigByName('smsMobileProntoKey', true);
		$principal     = 'IRANK';
		$auxuser       = ($clubId?$tagName:'iRank');
		$sendproj      = 'N';
		$url           = "http://www.mpgateway.com/v_2_00/smsfollow/smsfollow.aspx?Credencial=".$credencial."&Principal_User=".$principal."&Aux_User=".$auxuser."&Mobile=".$mobile."&Send_Project=".$sendproj."&Message=".$msg;
		
		$response = @fopen($url,",r");
		$sendingStatus = @fgets($response,40);

		// Quando estiver em desenvolvimento
//		$sendingStatus = '000:0A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R';
//		$messageId = null;
		
		if( preg_match('/^000:(.*)$/i', $sendingStatus, $matches) ){
			
			$sendingStatus = substr($sendingStatus, 0, 3);
			$messageId     = $matches[1];
		}else{
			
			$sendingStatus = substr($sendingStatus, 0, 3);
		}
		
		$smsLogObj->setSendingStatus($sendingStatus);
		$smsLogObj->save();
		
		$this->setTotalMessages($this->getTotalMessages()+1);
		
		if( $sendingStatus=='000' )
			$this->setSuccessMessages($this->getSuccessMessages()+1);
		else
			$this->setErrorMessages($this->getErrorMessages()+1);
		
		$this->save();
		
		// Lista de status que diminuem os créditos do clube
		$statusList = array('000', '005');
		if( $clubId && in_array($sendingStatus, $statusList) )
			Util::executeOne("SELECT decrase_club_sms_credit($clubId, true)"); // O parâmetro TRUE passado aqui faz com que os créditos do iRank também sejam decrementados
		else
			Util::executeOne("SELECT decrase_admin_sms_credit()");
		
		return $sendingStatus;
	}
	
	public static function getNewSms($textMessage, $className, $objectId){
		
		$clubId   = MyTools::getAttribute('clubId');
		$peopleId = MyTools::getAttribute('peopleId');
		
		if( !$clubId && !$peopleId )
			throw new Exception('Parâmetros insuficientes para geração do token SMS');
		
		if( strlen(String::removeAccents($textMessage)) > 140 )
			$textMessage = substr($textMessage, 0, 140);
		
		$smsObj = new Sms();
		$smsObj->setClubId($clubId);
		$smsObj->setPeopleId($peopleId);
		$smsObj->setClassName(ucfirst($className));
		$smsObj->setObjectId($objectId);
		$smsObj->setTextMessage($textMessage);
		$smsObj->setToken(Sms::getNewToken($clubId, $peopleId));
		$smsObj->save();
		
		return $smsObj;
	}
	
	public static function getNewToken($clubId, $peopleId){
		
		$microtime   = microtime();
		$tokenString = "$clubId-$peopleId-$microtime";
		return md5($tokenString);
	}
	
	public static function validateToken($clubId=null, $peopleId, $smsId, $token, $className, $objectId){
		
		$clubId = ($clubId?$clubId:'NULL');
		$result = Util::executeOne("SELECT validate_sms_token($clubId, $peopleId, $smsId, '$token', '$className', $objectId)", 'boolean');
		
		if( !$result )
			throw new Exception('Combinação de chaves para envio de SMS inválida');
	}
	
	public static function getCurrentCredit(){
		
		$clubId = MyTools::getAttribute('clubId');
		return Util::executeOne('SELECT get_sms_credit('.$clubId.')');
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']          = $this->getId();
		$infoList['clubId']      = $this->getClubId();
		$infoList['peopleId']    = $this->getPeopleId();
		$infoList['className']   = $this->getClassName();
		$infoList['objectId']    = $this->getObjectId();
		$infoList['textMessage'] = $this->getTextMessage();
		$infoList['token']       = $this->getToken();
		$infoList['createdAt']   = $this->getCreatedAt('d/m/Y H:i:s');
		
		return $infoList;
	}
}
