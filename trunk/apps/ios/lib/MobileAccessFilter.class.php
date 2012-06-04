<?php

class MobileAccessFilter extends sfFilter {

	public function execute($filterChain) {

		$moduleName  = MyTools::getContext()->getModuleName();
		$actionName  = MyTools::getContext()->getActionName();
		$userSiteId  = MyTools::getRequestParameter('userSiteId');
		$deviceUDID  = MyTools::getRequestParameter('deviceUDID');
		$mobileToken = MyTools::getRequestParameter('mobileToken');
		
		if( $moduleName=='login' && in_array($actionName, array('doLogin', 'save', 'recoveryPassword')) || !MyTools::getRequest()->hasParameter('deviceUDID') )
			return $filterChain->execute();
			
		$accessGranted = Util::executeOne("SELECT check_mobile_access($userSiteId, '$deviceUDID', '$mobileToken')", 'boolean');
		
		if( !$accessGranted )
			Util::forceError('invalidToken');

		$filterChain->execute();
	}
}
?>