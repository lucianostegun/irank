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
	
	public static function doLog($emailAddressList=array(), $emailSubject, $sendingStatus){
		
		$emailAddressList = implode(', ', $emailAddressList);
		
		$emailLogObj = new EmailLog();
		$emailLogObj->setEmailAddress($emailAddressList);
		$emailLogObj->setEmailSubject($emailSubject);
		$emailLogObj->setSendingStatus($sendingStatus);
		$emailLogObj->save();
	}
}
