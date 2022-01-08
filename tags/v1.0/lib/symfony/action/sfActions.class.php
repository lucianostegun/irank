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
	
	$userSiteId = MyTools::getCookie('userSiteId');
	if( $userSiteId && $moduleName!=='login' ){
		
		$userSiteId = unserialize(base64_decode($userSiteId));
		$userSiteId = $userSiteId[0];
		
		$userSiteObj = UserSitePeer::retrieveByPK( $userSiteId );
		$userSiteObj->login();
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

  	Util::forceError();
  	
  	$formErrorList = array();
	
	foreach( $formErrors as $keyField=>$formError )
  		$formErrorList[] = $keyField.'|'.$formError;
  	
  	echo 'formError;'.implode(';', $formErrorList);
  	exit;
  }
}
