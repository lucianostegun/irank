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

	public function send($genericObj=null, $con=null){
		
		try{
			
			// Verifica os créditos do site
			if( !Util::executeOne("SELECT check_admin_sms_credit()", 'boolean') ){
	
				$this->setStatusCode('009');
				$this->setStatusMessage($this->getStatus());
				$this->save($con);
	
				return false;
			}
			
			$username = MyTools::getAttribute('username');
			
			$mobile        = $this->getPhoneNumber();
			$msg           = $this->getMessage();
	//		$msg           = String::removeAccents($msg);
	//		$msg           = mb_convert_encoding($msg, 'UTF-8');
			$msg           = URLEncode($msg);
			$credencial    = Config::getConfigByName('smsMobileProntoKey', true);
			$principal     = 'IRANK';
			$auxuser       = ($username?$username:'iRank');
			$sendproj      = 'N';
			$url           = "http://www.mpgateway.com/v_2_00/smsfollow/smsfollow.aspx?Credencial=".$credencial."&Principal_User=".$principal."&Aux_User=".$auxuser."&Mobile=".$mobile."&Send_Project=".$sendproj."&Message=".$msg;
			
			$response   = @fopen($url,",r");
			$statusCode = @fgets($response, 40);
	
			// Quando estiver em desenvolvimento
	//		$statusCode = '000:0A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R';
	//		$messageId = null;
			
			if( preg_match('/^000:(.*)$/i', $statusCode, $matches) ){
				
				$statusCode = substr($statusCode, 0, 3);
				$messageId  = $matches[1];
			}else{
				
				$statusCode = substr($statusCode, 0, 3);
				$messageId  = null;
			}
			
			$this->setStatusCode($statusCode);
			$this->setStatusMessage($this->getStatus());
			$this->setMessageId($messageId);
			$this->save($con);
			
			// Lista de status que diminuem os créditos do clube
			$statusList = array('000', '005');
			if( in_array($statusCode, $statusList) ){
				
				if( is_object($genericObj) )
					$genericObj->decraseSmsCredit();
					
				return true;
			}
		}catch(Exception $e){
			
			return false;
		}
	}
	
	public function sendSmsOld($phoneNumber, &$smsLogObj, $clubId=null){
		
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
	
	public function setPhoneNumber($phoneNumber){
		
		$phoneNumber = '55'.preg_replace('/[^0-9]/', '', $phoneNumber);
		parent::setPhoneNumber($phoneNumber);
	}
	
	public function getStatus(){
		
		$statusCode = $this->getStatusCode();
		
		$statusMessageList = array();
		$statusMessageList['X01'] = 'Parâmetros com erro';
		$statusMessageList['X02'] = 'Parâmetros com erro';
		$statusMessageList['000'] = 'Mensagem enviada com sucesso';
		$statusMessageList['001'] = 'Credencial inválida';
		$statusMessageList['005'] = 'Mobile fora do formato +999(9999)99999999';
		$statusMessageList['007'] = 'SEND_PROJECT tem que ser S, ou N';
		$statusMessageList['008'] = 'Mensagem ou FROM+MESSAGE maior que 142 posições';
		$statusMessageList['009'] = 'Sem crédito para envio de SMS. Favor repor';
		$statusMessageList['010'] = 'Gateway bloqueado';
		$statusMessageList['012'] = 'Mobile no formato padrão, mas incorreto';
		$statusMessageList['013'] = 'Mensagem vazia ou vorpo inválido';
		$statusMessageList['015'] = 'Pais sem operação';
		$statusMessageList['016'] = 'Mobile com tamanho do código de área inválido';
		$statusMessageList['017'] = 'Operadora não autorizada para esta credencial';
		$statusMessageList['900'] = 'Erro de autenticação ou limite de segurança excedido';

		if( $statusCode >= 800 && $statusCode <= 899 )
			return 'Falha no gateway Mobile Pronto. Contate suporte Mobile Pronto';
		elseif( $statusCode >= 901 && $statusCode <= 999 )
			return 'Erro no acesso as operadoras.';
		else
			return $statusMessageList[$statusCode];
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
