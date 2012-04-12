<?php

class LanguageFilter extends sfFilter {
    
    public function execute($filterChain) {

//		$culture = $this->getDefaultLanguage();
//
//		if( !$culture )
//			$culture = 'en_US';
//
//		$culture = split('[_-]', $culture);
//		$culture = $culture[0].'_'.strtoupper($culture[1]);
//
//		if( !ereg('^[a-z]{2}\_[A-Z]{2}$', $culture))
//			$culture = 'en_US';
//			
//        if( $this->isFirstCall() && !MyTools::getAttribute('culture') )
//            sfContext::getInstance()->getUser()->setCulture($culture);
        
        sfContext::getInstance()->getUser()->setCulture('pt_BR');
        
        $filterChain->execute();
    }
    
	public function getDefaultLanguage() {
	   
	   if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
	      return $this->parseDefaultLanguage($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
	   else
	      return $this->parseDefaultLanguage(NULL);
   }
	
	public function parseDefaultLanguage($http_accept, $deflang = "en") {
		
	   if(isset($http_accept) && strlen($http_accept) > 1)  {
	   	
	      # Split possible languages into array
	      $x = explode(",",$http_accept);
	      foreach ($x as $val) {
	      	
	         #check for q-value and create associative array. No q-value means 1 by rule
	         if(preg_match("/(.*);q=([0-1]{0,1}\.\d{0,4})/i",$val,$matches))
	            $lang[$matches[1]] = (float)$matches[2];
	         else
	            $lang[$val] = 1.0;
	      }
	
	      #return default language (highest q-value)
	      $qval = 0.0;
	      foreach ($lang as $key => $value) {
	         if ($value > $qval) {
	            $qval = (float)$value;
	            $deflang = $key;
	         }
	      }
	   }
	   
	   return strtolower($deflang);
	}
}
?>