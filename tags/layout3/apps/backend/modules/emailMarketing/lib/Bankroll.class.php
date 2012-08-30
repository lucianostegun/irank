<?php

class Bankroll {

  public static function getAttachment($peopleId){
    
    $host = MyTools::getRequest()->getHost();
    $fileContent = file_get_contents('http://'.$host.'/index.php/myAccount/exportBankrollBatch/peopleId/'.Util::encodeId($peopleId));
    
    if( !$fileContent || $fileContent=='error' )
    	return null;
    
    $filePath = Util::getFilePath('/temp/emailMarketing/'.microtime().'.pdf');
    $fp = fopen($filePath, 'w');
    fwrite($fp, $fileContent);
    fclose($fp);
    
    return $filePath;
  }
}
