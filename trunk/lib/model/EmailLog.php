<?php

/**
 * Subclasse de representação de objetos da tabela 'email_log'.
 *
 * 
 *
 * @package lib.model
 */ 
class EmailLog extends BaseEmailLog
{
	
	public static function doLog($emailAddressList=array(), $emailSubject, $sendingStatus, $emailLogId=null){
		
		$emailAddressList = implode(', ', $emailAddressList);
		
		if( $emailLogId )
			$emailLogObj = EmailLogPeer::retrieveByPK($emailLogId);
		else
			$emailLogObj = new EmailLog();
		
		$emailLogObj->setEmailAddress($emailAddressList);
		$emailLogObj->setEmailSubject($emailSubject);
		$emailLogObj->setSendingStatus($sendingStatus);
		$emailLogObj->save();
	}
	
	public function isRead(){
		
		return !is_null($this->getReadAt());
	}

	public function getSendingSuccess(){
		
		return $this->getSendingStatus()=='success';
	}
}
