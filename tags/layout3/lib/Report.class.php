<?php

/**
 * Classe com métodos centralizados para envios de e-mail, paginação e
 * exportação de dados em PDF e Excel 
 *
 * @package    iRank
 * @author     Luciano Stegun
 */
class Report {
    
	/**
	 * Método responsável por enviar e-mails
	 *
	 * @author     Luciano Stegun
	 * @param      String: Assunto do e-mail
	 * @param      Array/String: Array contendo os destinatários do e-mail/String contendo um único destinatário
	 * @param      String: Corpo da mensagem
	 * @param      String: Nome que será exibido como remetente do e-mail
	 * @param      Array: Array de opções gerais do módulo
	 */
    public static function sendMail( $emailSubject, $emailAddressList, $emailContent, $options=array() ){
//return;
		$smtpComponent = 'smtp';
		$smtpHostname  = Config::getConfigByName('smtpHostname', true);
		$smtpUsername  = Config::getConfigByName('smtpUsername', true);
		$smtpPassword  = Config::getConfigByName('smtpPassword', true);
		$senderName    = Config::getConfigByName('emailSenderName', true);
		
		$contentType      = array_key_exists('contentType', $options)?$options['contentType']:'text/html';
		$replyTo          = array_key_exists('replyTo', $options)?$options['replyTo']:$smtpUsername;
		$attachmentList   = array_key_exists('attachmentList', $options)?$options['attachmentList']:array();
		$entitiesEncode   = array_key_exists('entitiesEncode', $options)?$options['entitiesEncode']:true;
		$emailLogId       = array_key_exists('emailLogId', $options)?$options['emailLogId']:null;
		$emailTemplateObj = array_key_exists('emailTemplateObj', $options)?$options['emailTemplateObj']:null;
		$emailTemplate    = array_key_exists('emailTemplate', $options)?$options['emailTemplate']:'emailTemplate';
		$templateName     = array_key_exists('templateName', $options)?$options['templateName']:null;
		$smtpUsername     = array_key_exists('smtpUsername', $options)?$options['smtpUsername']:$smtpUsername;
		$smtpPassword     = array_key_exists('smtpPassword', $options)?$options['smtpPassword']:$smtpPassword;
		$senderName       = array_key_exists('senderName', $options)?$options['senderName']:$senderName;
		$senderEmail      = array_key_exists('senderEmail', $options)?$options['senderEmail']:$smtpUsername;
		
		if( Util::isDebug() ) $emailAddressList = array('lucianostegun@gmail.com');
		
		$decodeEmail = Config::getConfigByName('decodeEmailFromUTF8', true);
		$encodeEmail = Config::getConfigByName('encodeEmailToUTF8', true);
		
		if( !is_array($emailAddressList) )
			$emailAddressList = array($emailAddressList);

		// class initialization
		$sfMailObj = new sfMail();
		$sfMailObj->initialize();
		$sfMailObj->setCharset('UTF-8');
		
		if( $encodeEmail ){
			
			$senderName   = utf8_encode($senderName);
			$emailContent = utf8_encode($emailContent);
			$emailSubject = utf8_encode($emailSubject);
		}
		
		if( $decodeEmail ){
			
			$senderName   = utf8_decode($senderName);
			$emailContent = utf8_decode($emailContent);
			$emailSubject = utf8_decode($emailSubject);
		}

		if( is_object($emailTemplateObj) && !is_null($emailTemplateObj->getTagNameParent()) ){
			
			$emailTemplate = EmailTemplate::getContentByTagName($emailTemplateObj->getTagNameParent());
			$emailContent  = str_replace('[emailContent]', $emailContent, $emailTemplate);
			$emailTemplate = null;
		}
		
		if( $emailTemplate ){
			
			$emailTemplate = EmailTemplate::getContentByTagName($emailTemplate);
			$emailContent = str_replace('[emailContent]', $emailContent, $emailTemplate);
		}
		
		$emailContent = self::defaultReplace($emailContent, array('emailTitle'=>$emailSubject), $emailLogId);
		
		$emailContent = utf8_decode($emailContent);
		
		if( $entitiesEncode )
			$emailContent = htmlentities($emailContent, ENT_NOQUOTES);
			
		$emailContent = str_replace('&gt;', '>', $emailContent);
		$emailContent = str_replace('&lt;', '<', $emailContent);

//		echo $emailContent;exit;
//		Util::forceError($emailContent);exit;
			
		$sfMailObj->setContentType( $contentType );
		$sfMailObj->setDomain( $smtpHostname );
		$sfMailObj->setHostname( $smtpHostname );
		
		if( $smtpUsername ) $sfMailObj->setUsername( $smtpUsername );
		if( $smtpPassword ) $sfMailObj->setPassword( $smtpPassword );

		$sfMailObj->setMailer( $smtpComponent );
		
		if( Util::isDebug() )
			$emailSubject = 'DEV: '.$emailSubject;

		// definition of the required parameters
		$sfMailObj->setSender( $senderEmail, $senderName);
		$sfMailObj->setFrom( $senderEmail, $senderName);
		$sfMailObj->addReplyTo( $replyTo, $senderName);
		$sfMailObj->setSubject( $emailSubject );

		foreach( $attachmentList as $fileName=>$attachment )
			$sfMailObj->addAttachment( $attachment, $fileName );

		$sendResult = true;
		
		foreach( $emailAddressList as $emailAddress ){
			
			if( !$emailAddress )
				continue;
				
			if( $templateName && self::checkLockSend($emailAddress, $templateName) )
				continue;
				
			$emailContentTmp = str_replace('[emailAddress]', $emailAddress, $emailContent);
			$emailContentTmp = str_replace('[emailToken]', Util::getToken($emailAddress), $emailContentTmp);
			
			$sfMailObj->setBody( $emailContentTmp );
			
			if( count($emailAddressList) > 1 )
				$sfMailObj->addBcc( $emailAddress );
			else
				$sfMailObj->addAddress( $emailAddress );
		}
		
		try{ 
		
			$sfMailObj->send();
			EmailLog::doLog($emailAddressList, $emailSubject, 'success', $emailLogId);
			
		}catch(Exception $e){
		
			$sendResult = false;
			EmailLog::doLog($emailAddressList, $emailSubject, 'error', $emailLogId);
		}
		
		return $sendResult;
    }
    
    public static function defaultReplace($content, $infoList=array(), $emailLogId=false){
    	
    	$host = MyTools::getRequest()->getHost();
    	$host = str_replace('backend', 'www', $host);
    	
		if( $emailLogId ){
			
			$emailLogId = Util::encodeId($emailLogId);
			
			$headerStoreLogoUrl = "http://[host]/home/$emailLogId/logo/logoStoreHeader.png";
			$headerLogoUrl      = "http://[host]/home/$emailLogId/logo/logoHeader.png";
			$footerLogoUrl      = "http://[host]/home/$emailLogId/logo/logoFooter.png";
		}else{
			
			$headerStoreLogoUrl = 'http://[host]/images/email/logoStoreHeader.png';
			$headerLogoUrl      = 'http://[host]/images/email/logoHeader.png';
			$footerLogoUrl      = 'http://[host]/images/email/logoFooter.png';
		}
		
    	$infoList['headerStoreLogoUrl'] = $headerStoreLogoUrl;
    	$infoList['headerLogoUrl']      = $headerLogoUrl;
    	$infoList['footerLogoUrl']      = $footerLogoUrl;
		$infoList['host']               = $host;
		$content = str_replace('<hr/>', '<div style="border-top: 1px solid #C0C0C0"></div>', $content);
		$content = str_replace('[separator]', '<div style="margin: 10px 0px 10px 0px; height: 1px; background: #E0E0E0; border-bottom: 1px solid #FEFEFE"></div>', $content);
		
		return self::replace($content, $infoList);
    }
    
    public static function replace($content, $infoList){
    	
    	foreach($infoList as $key=>$info)
    		$content = str_replace('['.$key.']', $info, $content);
    	
    	return $content;
    }
    
    public static function checkLockSend($emailAddress, $templateName){
    	
    	return Util::executeOne("SELECT check_lock_send('$emailAddress', '$templateName')", 'boolean');
    }
}
?>
