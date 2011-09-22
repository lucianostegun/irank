<?php

class MobileFilter extends sfFilter {

	public function execute($filterChain) {

		$smartPhoneList = array('iPhone', 'windows ce', 'netfront', 'palmos', 'blazer', 'elaine', 'plucker', 'avantgo', 'wap', 'android');

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

		if( $forceClassic ){

				MyTools::setAttribute('forceClassic', '1');
		}else{

			if( !in_array($url, $quitActionList) ){
				
				foreach ($smartPhoneList as $smartPhone)
					if ( !$forceClassic && stristr( $browser, $smartPhone ) )
						if($host=='irank')
							return sfContext::getInstance()->getController()->redirect('http://'.$host.'/mobile.php'.$uri);
						else
							return sfContext::getInstance()->getController()->redirect('http://m.irank.com.br'.$uri);
			}
		}

		$filterChain->execute();
	}
}
?>