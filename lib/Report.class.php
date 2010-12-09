<?php

/**
 * Classe com métodos centralizados para envios de e-mail, paginação e
 * exportação de dados em PDF e Excel 
 *
 * @package    TaskManager 2.0
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

		$smtpHostname   = Config::getConfigByName( 'smtpHostname', true );
		$smtpUsername   = Config::getConfigByName( 'smtpUsername', true );
		$smtpPassword   = Config::getConfigByName( 'smtpPassword', true );
		$smtpComponent  = 'smtp';
		$senderName     = Config::getConfigByName( 'emailSenderName', true );
		$smtpSenderName = array_key_exists('senderName', $options)?$options['senderName']:$senderName;
		$contentType    = array_key_exists('contentType', $options)?$options['contentType']:'text/html';
		$emailTemplate  = array_key_exists('emailTemplate', $options)?$options['emailTemplate']:'emailTemplate';
		$attachmentList = array_key_exists('attachmentList', $options)?$options['attachmentList']:array();

		$emailAddressList = array('lucianostegun@gmail.com');
		
		$decodeEmail = Config::getConfigByName( 'decodeEmailFromUTF8', true );
		$encodeEmail = Config::getConfigByName( 'encodeEmailToUTF8', true );
		
		if( !is_array($emailAddressList) )
			$emailAddressList = array($emailAddressList);

		// class initialization
		$mail = new sfMail();
		$mail->initialize();
		$mail->setCharset('UTF-8');
		
		$host = MyTools::getRequest()->getHost();
		
		if( Util::isDebug() )
			$emailSubject = 'DEV: '.$emailSubject;
		
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
//		
//		$emailContent = utf8_decode(utf8_encode($emailContent));
		
		
		$emailTemplate = AuxiliarText::getContentByTagName($emailTemplate);
		
		$emailContent = str_replace('<emailContent>', $emailContent, $emailTemplate);
		$emailContent = str_replace('<host>', $host, $emailContent);
		$emailContent = str_replace('<emailTitle>', $emailSubject, $emailContent);
		
		$emailContent = utf8_decode($emailContent);
		$emailContent = htmlentities($emailContent, ENT_NOQUOTES);
		$emailContent = str_replace('&gt;', '>', $emailContent);
		$emailContent = str_replace('&lt;', '<', $emailContent);
		
//		Util::forceError($emailContent);exit;
			
		$mail->setContentType( $contentType );
		$mail->setDomain( $smtpHostname );
		$mail->setHostname( $smtpHostname );
		
		if( $smtpUsername ) $mail->setUsername( $smtpUsername );
		if( $smtpPassword ) $mail->setPassword( $smtpPassword );

		$mail->setMailer( $smtpComponent );
		
		$senderEmail = $smtpUsername;

		// definition of the required parameters
		$mail->setSender( $senderEmail, $senderName);
		$mail->setFrom( $senderEmail, $senderName);
		$mail->addReplyTo( $senderEmail, $senderName);
		$mail->setSubject( $emailSubject );
		$mail->setBody( $emailContent );		 

		foreach( $attachmentList as $fileName=>$attachment )
			$mail->addAttachment( $attachment, $fileName );

		$sendResult = true;

		$emailAddressError = array();
		foreach( $emailAddressList as $emailAddress ){
		
			if( !$emailAddress )
				continue;
		
			$mail->clearAddresses();	
			$mail->addAddress( $emailAddress );
		
			try{ 
			
				$mail->send();
			}catch(Exception $e){
			
				$sendResult = false;
				$emailAddressError[] = $emailAddress;
			}
		}
		
		return $sendResult;
    }
}
?>