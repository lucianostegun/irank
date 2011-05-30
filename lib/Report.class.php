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

		$smtpComponent  = 'smtp';
		$smtpHostname   = Config::getConfigByName( 'smtpHostname', true );
		$smtpUsername   = Config::getConfigByName( 'smtpUsername', true );
		$smtpPassword   = Config::getConfigByName( 'smtpPassword', true );
		$senderName     = Config::getConfigByName( 'emailSenderName', true );
		
		$contentType     = array_key_exists('contentType', $options)?$options['contentType']:'text/html';
		$emailTemplate   = array_key_exists('emailTemplate', $options)?$options['emailTemplate']:'emailTemplate';
		$replyTo         = array_key_exists('replyTo', $options)?$options['replyTo']:$smtpUsername;
		$attachmentList  = array_key_exists('attachmentList', $options)?$options['attachmentList']:array();
		$entitiesEncode  = array_key_exists('entitiesEncode', $options)?$options['entitiesEncode']:true;

		$emailAddressList = array('lucianostegun@gmail.com');
		
		$decodeEmail = Config::getConfigByName( 'decodeEmailFromUTF8', true );
		$encodeEmail = Config::getConfigByName( 'encodeEmailToUTF8', true );
		
		if( !is_array($emailAddressList) )
			$emailAddressList = array($emailAddressList);

		// class initialization
		$sfMailObj = new sfMail();
		$sfMailObj->initialize();
		$sfMailObj->setCharset('UTF-8');
		
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

		if( $emailTemplate ){
			
			$emailTemplate = AuxiliarText::getContentByTagName($emailTemplate);
			$emailContent = str_replace('<emailContent>', $emailContent, $emailTemplate);
		}
		
		$emailContent = str_replace('<host>', $host, $emailContent);
		$emailContent = str_replace('<emailTitle>', $emailSubject, $emailContent);
		$emailContent = str_replace('<hr/>', '<div style="border-top: 1px solid #DADADA"></div>', $emailContent);
		
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
		
		$senderEmail = $smtpUsername;

		// definition of the required parameters
		$sfMailObj->setSender( $senderEmail, $senderName);
		$sfMailObj->setFrom( $senderEmail, $senderName);
		$sfMailObj->addReplyTo( $replyTo, $senderName);
		$sfMailObj->setSubject( $emailSubject );
		$sfMailObj->setBody( $emailContent );		 

		foreach( $attachmentList as $fileName=>$attachment )
			$sfMailObj->addAttachment( $attachment, $fileName );

		$sendResult = true;
		
		$sfMailObj->clearAddresses();

		foreach( $emailAddressList as $emailAddress ){
			
			if( !$emailAddress )
				continue;
			
			if( count($emailAddressList) > 1 )
				$sfMailObj->addBcc( $emailAddress );
			else
				$sfMailObj->addAddress( $emailAddress );
		}
		
		try{ 
		
			$sfMailObj->send();

			EmailLog::doLog($emailAddressList, $emailSubject, 'success');
		}catch(Exception $e){
		
			$sendResult = false;
			EmailLog::doLog($emailAddressList, $emailSubject, 'error');
		}
		
		return $sendResult;
    }
    
    public static function getPaginator( $request, $regCount ){
    	
    	$instanceName = $request->getParameter( 'instanceName' );
		$limit        = $request->getParameter( 'limit' );
		$offset       = $request->getParameter( 'offset' );
		
		$currentPage = ($offset/($limit==0?1:$limit))+1;
		$pages       = ceil($regCount/($limit==0?($regCount?$regCount:1):$limit));
	
		$initialPage = ($currentPage>2?$currentPage-2:1);
		$finalPage   = $currentPage+2;
		$finalPage   = ($currentPage < 4?5:$finalPage);
		$finalPage   = ($finalPage>$pages?$pages:$finalPage);
		$initialPage = ($currentPage>1 && $currentPage>=($pages-2)?$pages-4:$initialPage);
		
		$initialPage = ($initialPage<=0?1:$initialPage);
		$finalPage   = ($finalPage>$pages?$pages:$finalPage);
		
		if( $currentPage > 1 || $currentPage < $pages ){
			
			require_once ('symfony/helper/HelperHelper.php');
			use_helper('Asset');
			use_helper('Tag');
			use_helper('Url');
		}
		
		if( $currentPage > 1 ){
			
			echo '<div class="firstPage" onclick="updateGridboxSearch( \''.$instanceName.'\', '.$limit.', 0 )">'.image_tag('paginator/first.gif').'</div>';
			echo '<div class="previousPage" onclick="updateGridboxSearch( \''.$instanceName.'\', '.$limit.', '.(($currentPage-2)*$limit).' )">'.image_tag('paginator/prev.gif').'</div>';
		}else{
			
			echo '<div class="blank"></div>';
			echo '<div class="blank" style="margin-right: 10px;"></div>';
		}
		
		for( $page=$initialPage; $page <= $finalPage; $page++ ){
			
			$class = (strlen($page)>2?'Bigger':'');
			
			if( $page==$currentPage )			
				echo '<div class="pageNumberCurrent'.$class.'">'.$page.'</div>';
			else			
				echo '<div class="pageNumber'.$class.'" onclick="updateGridboxSearch( \''.$instanceName.'\', '.$limit.', '.(($page-1)*$limit).' )">'.$page.'</div>';
		}
		
		if( $currentPage < $pages ){
		
			echo '<div class="nextPage" onclick="updateGridboxSearch( \''.$instanceName.'\', '.$limit.', '.(($currentPage)*$limit).' )">'.image_tag('paginator/next.gif').'</div>';
			echo '<div class="lastPage" onclick="updateGridboxSearch( \''.$instanceName.'\', '.$limit.', '.($pages-1)*$limit.' )">'.image_tag('paginator/last.gif').'</div>';
		}else{
			
			echo '<div class="blank"></div>';
			echo '<div class="blank"></div>';
		}
		
		Util::getHelpers();
		$optionsField = select_tag('limit', options_for_select(array(''=>'Sem limite', '20'=>'20', '30'=>'30', '50'=>'50', '100'=>'100', '150'=>'150'), $limit), array('onchange'=>'updateGridboxSearch( "'.$instanceName.'", this.value, 0 )'));
		
		echo '<info>';
		echo '	<b>Total de páginas:</b> '.$pages;
		echo '<info>';
		echo '	<b>Total de registros:</b> '.$regCount;
		echo '<info>';
		echo '	<b>Registros por página:</b> '.$optionsField.'';
		
		echo input_hidden_tag( 'totalPages', $pages );
		echo input_hidden_tag( 'totalRecords', $regCount );
		echo input_hidden_tag( 'pageLimit', $limit );
		echo input_hidden_tag( 'currentPage', ($currentPage-1) );
    }
    
    public static function replace($content, $infoList){
    	
    	foreach($infoList as $key=>$info)
    		$content = str_replace('<'.$key.'>', $info, $content);
    	
    	return $content;
    }
}
?>