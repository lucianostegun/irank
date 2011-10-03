<?php

class MobileFilter extends sfFilter {

	public function execute($filterChain) {

		$smartPhoneList = array('iPhone', 'windows ce', 'netfront', 'palmos', 'blazer', 'elaine', 'plucker', 'avantgo', 'wap', 'android');
		$tabletList     = array('iPad');

		$moduleName = MyTools::getContext()->getModuleName();
		$actionName = MyTools::getContext()->getActionName();
		$host       = MyTools::getRequest()->getHost();
		$uri        = '';
		
		if( array_key_exists('REDIRECT_URL', $_SERVER) )
			$uri = $_SERVER['REDIRECT_URL'];

		$browser = $_SERVER['HTTP_USER_AGENT'];

		$url = $moduleName.'/'.$actionName;

		$quitActionList = array('event/facebookResult', 'event/facebookResultImage');

		$forceClassic = MyTools::getRequestParameter('fc');
		$forceClassic = MyTools::getAttribute('forceClassic', $forceClassic);
		
		$urlRedirect = null;

		if( $forceClassic ){

				MyTools::setAttribute('forceClassic', '1');
		}else{

			if( !in_array($url, $quitActionList) && !$forceClassic ){
				
				foreach($smartPhoneList as $smartPhone){
					if ( strstr($browser, $smartPhone) ){
						if($host=='irank')
							$urlRedirect = 'http://'.$host.'/mobile.php'.$uri;
						else
							$urlRedirect = 'http://m.irank.com.br'.$uri;
					}
				}
				
//				foreach($tabletList as $tablet){
//
//					if ( strstr($browser, $tablet) ){
//						if($host=='irank')
//							$urlRedirect = 'http://'.$host.'/tablet.php'.$uri;
//						else
//							$urlRedirect = 'http://t.irank.com.br'.$uri;
//					}
//				}
			}
		}
		
		if( $urlRedirect )
			return sfContext::getInstance()->getController()->redirect($urlRedirect);

		$filterChain->execute();
	}
}
?>