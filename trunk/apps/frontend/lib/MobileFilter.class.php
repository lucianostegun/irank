<?php

class MobileFilter extends sfFilter {
    
    public function execute($filterChain) {
        
        $smartPhoneList = array('iPhone', 'windows ce', 'netfront', 'palmos', 'blazer', 'elaine', 'plucker', 'avantgo', 'wap', 'android');
        
        $browser = $_SERVER['HTTP_USER_AGENT'];
        
        $forceClassic = MyTools::getAttribute('forceClassic');

        foreach ($smartPhoneList as $smartPhone)            
            if ( !$forceClassic && stristr( $browser, $smartPhone ) )
				return sfContext::getInstance()->getController()->redirect('/mobile.php');
        
        $filterChain->execute();
    }
}
?>