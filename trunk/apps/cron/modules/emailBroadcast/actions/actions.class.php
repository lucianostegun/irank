<?php

class emailBroadcastActions extends sfActions
{

  public function executeAppStore($request){
	
	$emailSubject = 'iRank App para iPhone e iPad';
	$filePath     = Util::getFilePath('/templates/pt_BR/appstoreNotify.htm');
	$emailContent = file_get_contents($filePath);

	$peopleObjList = People::getList();

	foreach($peopleObjList as $peopleObj){
		
		$emailAddress    = $peopleObj->getEmailAddress();
		$emailContentTmp = str_replace('<peopleName>', $peopleObj->getFirstName(), $emailContent);

		$sendResult = Report::sendMail($emailSubject, $emailAddress, $emailContentTmp);
		
		echo $emailAddress.' - '.($sendResult?'OK':'ERRO');
		echo '<br/>';
	}
	
	echo '<hr/>';
	echo 'Processo concluido com sucesso!';
  	exit;
  }
}
