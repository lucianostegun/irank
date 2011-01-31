<?php

class faqActions extends sfActions
{

  public function executeIndex($request){
  	
  	$this->faqObj = new Faq();
	$this->readOnly   = true;
  }
  
  public function executeCreate($request){

  	$id          = $request->getParameter('id');
  	$faqId = $request->getParameter('faqId', $id);
  	
	$this->readOnly = $request->getParameter('readOnly');
	
  	if( $faqId ){	
  		
  		$this->faqObj = FaqPeer::retrieveByPK( $faqId );
  		if( !is_object($this->faqObj) )
  			return $this->redirect( 'faq', 'index' );
  		$this->actionDescription = '<b>Editando:</b> <i>'.$this->faqObj->getQuestion().'</i>';
  	}else{
	 	
	 	$this->faqObj = Util::getNewObject( 'faq' );
	 	$this->actionDescription = '<b>Criando novo registro</b>';
  	}

  	if( $this->readOnly )
  		$this->actionDescription = '<b>Visualizando:</b> <i>'.$this->faqObj->getQuestion().'</i>';
  	
  	return $this->setTemplate('index');
  }
  
  public function executeEdit($request){

	return $this->forward( 'faq', 'create' );
  }
  
  public function executeView($request){

	$request->setParameter( 'readOnly', true );
  	return $this->forward( 'faq', 'create' );
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSave($request){
  	
  	$faqId  = $request->getParameter('faqId');
  	$faqObj = FaqPeer::retrieveByPK( $faqId );

  	$faqObj->quickSave($request);
  	
  	exit;
  }
  
  public function executeDelete($request){

  	$faqId = $request->getParameter('id');
  	$faqId = $request->getParameter('faqId', $faqId);
  	
  	$faqObj = FaqPeer::retrieveByPK( $faqId );
  	
  	if( is_object( $faqObj ) )
  		$faqObj->delete();
  		
  	exit;
  }

  public function executeGetInfo($request){

  	$faqId  = $request->getParameter('id');
  	$faqId  = $request->getParameter('faqId', $faqId);
  	$faqObj = FaqPeer::retrieveByPK( $faqId );

  	echo Util::parseInfo($faqObj->getInfo());
  	exit;
  }
  
  public function executeGetXml($request){
    
    $grid      = $request->getParameter('grid');
    $paginator = $request->getParameter('paginator');
    $faqId     = $request->getParameter('faqId');
    
	$data     = array();
	$dataType = array();
	
	Util::getHelper('Text');

    switch( $grid ){
    	case 'list':
    	default:
			
			$faqObjList = FaqPeer::search( $request, $paginator );
	    	if( $paginator ) break;
	
	    	foreach( $faqObjList as $faqObj ){
	    		
	    		$dataRow = array();
				$dataRow[] = $faqObj->getId();
				$dataRow[] = strip_tags($faqObj->getQuestion());
				$dataRow[] = $faqObj->getCreatedAt('d/m/Y H:i:s');
	    		
				$data[] = $dataRow;
	    	}
	    	break;
    	case 'i18n':
			
			$faqObj         = FaqPeer::retrieveByPK($faqId);
			$faqI18nObjList = $faqObj->getFaqI18nList();

			foreach( $faqI18nObjList as $faqI18nObj ){
	    		
	    		$answer = $faqI18nObj->getAnswerI18n();
	    		$answer = str_replace('<', '&lt;', $answer);
	    		$answer = str_replace('>', '&gt;', $answer);
	    		
	    		$dataRow = array();
				$dataRow[] = $faqI18nObj->getCulture();
				$dataRow[] = strip_tags($faqI18nObj->getQuestionI18n());
				$dataRow[] = $answer;
	    		
				$data[] = $dataRow;
	    	}
	    		
	    	break;
    }
    
    if( $paginator )    
    	echo Report::getPaginator( $request, $faqObjList );	
    else    	
    	echo DhtmlxGrid::getXml( $data, $dataType );

    exit;
  }
}
