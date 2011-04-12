<?php

/**
 * Classe de controle do módulo de login, 
 * contém os métodos que representam as regras de negócio dentro do módulo
 * e precedem a execução da classe de exibição
 *
 * @package    Research beta
 * @subpackage login
 * @author     Luciano Stegun
 */
class loginActions extends sfActions
{

  public function preExecute(){
	
	Util::getHelper('I18N');
	
	$this->title = __('login.title');
	
	$this->userSiteId = $this->getUser()->getAttribute('userSiteId');
  }

  public function executeIndex($request)
  {
	if ( $this->getContext()->getUser()->isAuthenticated() && $this->getUser()->hasCredential('iRankSite'))
	  return $this->redirect( 'home/index' );
  }
  
  public function executeLogin($request)
  {

	$username = $request->getParameter('username');
	$password = $request->getParameter('password');
	
	$statusMessage = false;
	
	if( $username && $password ){
		
		$criteria = new Criteria();
		$criteria->add( UserSitePeer::ACTIVE, true );
		$criteria->add( UserSitePeer::ENABLED, true );
		$criteria->add( UserSitePeer::VISIBLE, true );
		$criteria->add( UserSitePeer::DELETED, false );
		$criterion = $criteria->getNewCriterion( UserSitePeer::USERNAME, $username );
		$criterion->addOr( $criteria->getNewCriterion( PeoplePeer::EMAIL_ADDRESS, $username ) );
		$criteria->add($criterion);
		$criteria->add( UserSitePeer::PASSWORD, md5($password) );
		$criteria->addJoin( UserSitePeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$userSiteObj = UserSitePeer::doSelectOne( $criteria );
		
		if( is_object($userSiteObj) )	        
	        $userSiteObj->login(true);
		else
			$statusMessage = '<b>ACESSO NEGADO!</b><br />O login e/ou senha não são válidos';
	}else{
		
		$statusMessage = '<b>ACESSO NEGADO!</b><br />Informe se login e senha de acesso';
	}
	
	if( $statusMessage )
		Util::forceError( $statusMessage );
		
	exit;
  }

  public function executeLogout()
  {
    
    UserSite::logout();
   
    return $this->redirect('home/index');
  }
}
