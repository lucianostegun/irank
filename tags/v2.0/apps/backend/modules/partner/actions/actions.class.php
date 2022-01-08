<?php

class partnerActions extends sfActions
{

  public function executeIndex($request){
  	
  	$this->partnerObj = new Partner();
	$this->readOnly   = true;
  }
  
  public function executeCreate($request){

  	$id        = $request->getParameter('id');
  	$partnerId = $request->getParameter('partnerId', $id);
  	
	$this->readOnly = $request->getParameter('readOnly');
	
  	if( $partnerId ){	
  		
  		$this->partnerObj = PartnerPeer::retrieveByPK( $partnerId );
  		if( !is_object($this->partnerObj) )
  			return $this->redirect('partner', 'index');
  		$this->actionDescription = '<b>Editando:</b> <i>'.$this->partnerObj->toString().'</i>';
  	}else{
	 	
	 	$this->partnerObj = Util::getNewObject( 'partner' );
	 	$this->actionDescription = '<b>Criando novo registro</b>';
  	}

  	if( $this->readOnly )
  		$this->actionDescription = '<b>Visualizando:</b> <i>'.$this->partnerObj->toString().'</i>';
  	
  	return $this->setTemplate('index');
  }
  
  public function executeEdit($request){

	return $this->forward( 'partner', 'create' );
  }
  
  public function executeView($request){

	$request->setParameter( 'readOnly', true );
  	return $this->forward( 'partner', 'create' );
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSave($request){
  	
  	$partnerId  = $request->getParameter('partnerId');
  	$partnerObj = PartnerPeer::retrieveByPK( $partnerId );

  	$partnerObj->quickSave($request);
  	
  	exit;
  }
  
  public function executeDelete($request){

  	$partnerId = $request->getParameter('id');
  	$partnerId = $request->getParameter('partnerId', $partnerId);
  	
  	$partnerObj = PartnerPeer::retrieveByPK( $partnerId );
  	
  	if( is_object( $partnerObj ) )
  		$partnerObj->delete();
  		
  	exit;
  }

  public function executeGetInfo($request){

  	$partnerId  = $request->getParameter('id');
  	$partnerId  = $request->getParameter('partnerId', $partnerId);
  	$partnerObj = PartnerPeer::retrieveByPK( $partnerId );

  	echo Util::parseInfo($partnerObj->getInfo());
  	exit;
  }
  
  public function executeGetXml($request){
    
    $grid      = $request->getParameter('grid');
    $paginator = $request->getParameter('paginator');
    $partnerId = $request->getParameter('partnerId');
    
	$data     = array();
	$dataType = array();
	
	Util::getHelper('Text');

    switch( $grid ){
    	case 'list':
    	default:
			
			$partnerObjList = PartnerPeer::search( $request, $paginator );
	    	if( $paginator ) break;
	
	    	foreach( $partnerObjList as $partnerObj ){
	    		
	    		$dataRow = array();
				$dataRow[] = $partnerObj->getId();
				$dataRow[] = $partnerObj->getPartnerName();
				$dataRow[] = $partnerObj->getExternalUrl();
				$dataRow[] = $partnerObj->getFileName();
				$dataRow[] = $partnerObj->getCreatedAt('d/m/Y H:i:s');
	    		
				$data[] = $dataRow;
	    	}
	    	break;
    }
    
    if( $paginator )    
    	echo Report::getPaginator( $request, $partnerObjList );	
    else    	
    	echo DhtmlxGrid::getXml( $data, $dataType );

    exit;
  }
}
