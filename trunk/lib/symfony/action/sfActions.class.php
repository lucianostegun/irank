<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2004-2006 Sean Kerr <sean@code-box.org>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfActions executes all the logic for the current request.
 *
 * @package    symfony
 * @subpackage action
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Sean Kerr <sean@code-box.org>
 * @version    SVN: $Id: sfActions.class.php 19911 2009-07-06 07:52:48Z FabianLange $
 */
abstract class sfActions extends sfAction
{
  /**
   * Dispatches to the action defined by the 'action' parameter of the sfRequest object.
   *
   * This method try to execute the executeXXX() method of the current object where XXX is the
   * defined action name.
   *
   * @return string A string containing the view name associated with this action
   *
   * @throws sfInitializationException
   *
   * @see sfAction
   */
  public function execute()
  {

	$this->actionName     = $actionName     = $this->getActionName();
	$this->moduleName     = $moduleName     = MyTools::getRequest()->getParameterHolder()->get('module');
	$this->realModuleName = $realModuleName = $this->getModuleName();
	
	$userSiteId      = MyTools::getCookie('userSiteId');
	$userAdminId     = MyTools::getCookie('userAdminId');
	$isAuthenticated = $this->getUser()->isAuthenticated();
	
	$PHP_AUTH_USER = isset($PHP_AUTH_USER)?$_SERVER['PHP_AUTH_USER']:null;
	if( !$isAuthenticated && $PHP_AUTH_USER ){
		
		$userSiteObj = UserSitePeer::retrieveByUsername($PHP_AUTH_USER);
		if( is_object($userSiteObj) )
			$userSiteObj->login();
	}

	// Autentica o usuário do site se ele tiver o cookie de autenticação
	if( $userSiteId && $moduleName!=='login' && !$isAuthenticated ){

		$userSiteId = unserialize(base64_decode($userSiteId));
		$userSiteId = $userSiteId[0];

		$userSiteObj = UserSitePeer::retrieveByPK( $userSiteId );
		$userSiteObj->login();
	}

	// Autentica o usuário da administração se ele tiver o cookie de autenticação
	if( $userAdminId && $moduleName!=='login' && !$isAuthenticated ){

		$userAdminId = unserialize(base64_decode($userAdminId));
		$userAdminId = $userAdminId[0];

		$userAdminObj = UserAdminPeer::retrieveByPK( $userAdminId );
		$userAdminObj->login(true);
	}

    // dispatch action
    $actionToRun = 'execute'.ucfirst($actionName);

    if ($actionToRun === 'execute')
    {
      // no action given
      $error = 'sfAction initialization failed for module "%s". There was no action given.';
      $error = sprintf($error, $moduleName);
      throw new sfInitializationException($error);
    }

    if (!is_callable(array($this, $actionToRun)))
    {
      // action not found
      $error = 'sfAction initialization failed for module "%s", action "%s". You must create a "%s" method.';
      $error = sprintf($error, $moduleName, $actionName, $actionToRun);
      throw new sfInitializationException($error);
    }

    if (sfConfig::get('sf_logging_enabled'))
    {
      $this->getContext()->getLogger()->info('{sfAction} call "'.get_class($this).'->'.$actionToRun.'()'.'"');
    }

    // run action
    $ret = $this->$actionToRun($this->getRequest());

    return $ret;
  }
  
  public function handleFormFieldError( $formErrors ){

	Util::forceError(null, false);
	Util::getHelper('I18N');

	$formErrorList = array();
	$fieldNameList = array();

	foreach($formErrors as $fieldName=>$formError ){

		if( $formError=='nullError' )
			continue;
			
		$formErrorList[$fieldName] = __($formError);
		$fieldNameList[] = $fieldName;
	}

	$formErrorList['_fieldErrorCount'] = count($formErrors);
	$formErrorList['_fieldNameList']   = $fieldNameList;
	
	echo 'formError:'.Util::parseInfo($formErrorList);
	exit;
  }
  
}
