<?php

/**
 * Subclasse de representação de objetos da tabela 'user_site'.
 *
 * 
 *
 * @package lib.model
 */ 
class UserSite extends BaseUserSite
{
	
	public function quickSave($request){
		
		$username     = $request->getParameter('username');
	  	$emailAddress = $request->getParameter('emailAddress');
	  	$firstName    = $request->getParameter('firstName');
	  	$lastName     = $request->getParameter('lastName');
	  	$password     = $request->getParameter('password');
	  	
	  	$peopleObj = People::getQuickPeople($firstName.' '.$lastName, 'userAdmin');
	
	  	$this->setPeopleId( $peopleObj->getId() );
	  	$this->setUsername( $username );
	  	$this->setEmailAddress( $emailAddress );
	  	$this->setPassword( md5($password) );
	  	$this->setActive(true);
	  	$this->save();
	}
}
