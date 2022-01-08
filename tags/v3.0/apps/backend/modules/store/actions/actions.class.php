<?php

/**
 * store actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class storeActions extends sfActions
{

  public function preExecute(){
    
    $this->pathList = array('Loja virtual'=>'store/index', 'Configurações'=>null);
    $this->toolbarList = array('save');
  }

  public function executeIndex($request){
    
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    Config::saveConfig('storeShippingZipcode', $request);
    
    exit;
  }
}
