<?php

/**
 * login actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class loginActions extends sfActions
{

  public function executeIndex()
  {
  	
  }

  public function executeAccessDenied()
  {
  	
  }

  public function executeLogin()
  {
  	
  	$this->getUser()->setCulture('pt_BR');
  	$this->getUser()->addCredential('iRankAdmin');
  	$this->getUser()->setAuthenticated(true);
  	
  	return $this->forward('home', 'index');
  }

  public function executeLogout()
  {
  	
  	$this->getUser()->removeCredential('iRankAdmin');
  	$this->getUser()->removeCredential('iRankClub');
  	$this->getUser()->setAuthenticated(false);
  	
  	return $this->forward('login', 'index');
  }
}
