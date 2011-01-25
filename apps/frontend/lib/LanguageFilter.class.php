<?php

class LanguageFilter extends sfFilter {
    
    public function execute($filterChain) {

		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$culture   = ereg('[a-z]{2}[-_][A-Z]{2}', $userAgent, $matches);
		$culture   = str_replace('-', '_', $matches[0]);
		
        if( $this->isFirstCall() && !MyTools::getAttribute('culture') )
            sfContext::getInstance()->getUser()->setCulture($culture);                   
        
        $filterChain->execute();
    }
}
?>