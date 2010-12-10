<?php

class MobileFilter extends sfFilter {
    
    public function execute($filterChain) {
        
        $smartPhoneList = array('iPhone', 'windows ce', 'netfront', 'palmos', 'blazer', 'elaine', 'plucker', 'avantgo', 'wap');
        
        $browser = $_SERVER['HTTP_USER_AGENT'];

        foreach ($smartPhoneList as $smartPhone)            
            if ( stristr( $browser, $smartPhone ) )
				return sfContext::getInstance()->getController()->redirect('/mobile.php');
        
        $filterChain->execute();
    }
}
?>