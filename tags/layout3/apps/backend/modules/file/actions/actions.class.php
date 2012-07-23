<?php

/**
 * file actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class fileActions extends sfActions
{

  public function preExecute(){
    
  }
  
  public function executeIndex($request){
    
  }

  public function executeDownload($request){
    
    $fileId = $request->getParameter('fileId');
    $fileObj = FilePeer::retrieveByPK($fileId);
    
    $fileObj->download();
    exit;
  }
}
