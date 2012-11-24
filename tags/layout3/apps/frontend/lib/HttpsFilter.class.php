<?php

class HttpsFilter extends sfFilter {
    
    public function execute($filterChain) {

		if( !$this->isFirstCall() )
			return true;
        
		$actionName = MyTools::getRequest()->getParameterHolder()->get('action');
		$moduleName = MyTools::getRequest()->getParameterHolder()->get('module');
		$serverName = $_SERVER['SERVER_NAME'];
		
		if( $serverName!='www.irank.com.br' )
			return $filterChain->execute();
		
		if( $moduleName=='store' && !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS']!='on' ){
  		
	  		$redirectUrl = null;
	  		
	  		if( isset($_SERVER['REDIRECT_SCRIPT_URI']) )
	  			$redirectUrl = $_SERVER['REDIRECT_SCRIPT_URI'];
	  		
	  		elseif( isset($_SERVER['SCRIPT_URI']) )
	  			$redirectUrl = $_SERVER['SCRIPT_URI'];
	  		
	  		if( $redirectUrl ){
	  			
	  			$redirectUrl = str_replace('http://', 'https://', $redirectUrl);
		  		return $this->redirect($redirectUrl);
	  		}
	  	}elseif( isset($_SERVER['HTTPS']) || $_SERVER['HTTPS']=='on' ){
  		
	  		$redirectUrl = null;
	  		
	  		if( isset($_SERVER['REDIRECT_SCRIPT_URI']) )
	  			$redirectUrl = $_SERVER['REDIRECT_SCRIPT_URI'];
	  		
	  		elseif( isset($_SERVER['SCRIPT_URI']) )
	  			$redirectUrl = $_SERVER['SCRIPT_URI'];
	  		
	  		if( $redirectUrl ){
	  			
	  			$redirectUrl = str_replace('https://', 'http://', $redirectUrl);
		  		return $this->redirect($redirectUrl);
	  		}
	  	}
	  	
        $filterChain->execute();
    }
}
?>