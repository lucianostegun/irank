<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'user_admin'.
 *
 * 
 *
 * @package lib.model
 */ 
class UserAdminPeer extends BaseUserAdminPeer
{
    
    public static function search( $request, $count=false ){
    
    	$username    = $request->getParameter('username');
    	$peopleName  = $request->getParameter('peopleName');
		$active      = MyTools::getRequestParameter('active');
		
    	$limit  = $request->getParameter('limit', null);
    	$offset = $request->getParameter('offset', 0);
    	
    	$databaseSortField = $request->getParameter('databaseSortField');
    	$databaseSortDesc  = $request->getParameter('databaseSortDesc');

		$criteria = new Criteria();
		
		if( $username )    $criteria->add( UserAdminPeer::USERNAME, '%'.$username.'%', Criteria::ILIKE );
		if( $peopleName )  $criteria->add( PeoplePeer::FULL_NAME, '%'.$peopleName.'%', Criteria::ILIKE );
		if( $active )      $criteria->add( UserAdminPeer::ACTIVE, ($active=='yes'?true:false) );
		$criteria->add( UserAdminPeer::ENABLED, true );
		$criteria->add( UserAdminPeer::VISIBLE, true );
		$criteria->add( UserAdminPeer::DELETED, false );
		$criteria->addJoin( UserAdminPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		
		if( $databaseSortField ){
			if( $databaseSortDesc )
				$criteria->addDescendingOrderByColumn( $databaseSortField );
			else
				$criteria->addAscendingOrderByColumn( $databaseSortField );
		}else {	

			$criteria->addAscendingOrderByColumn( UserAdminPeer::USERNAME );
		}

		if( $count ){
			
    		return UserAdminPeer::doCount( $criteria );
		}else{
    		$criteria->setLimit($limit);
    		$criteria->setOffset($offset);
    		
    		return UserAdminPeer::doSelect( $criteria );
    	}
    }
	
	public static function validateUserAdmin($userAdminId){
		
		$peopleId   = MyTools::getRequestParameter('peopleId');
		$peopleName = MyTools::getRequestParameter('peopleName');
		
		if( !$peopleId && !ereg('^.+ +.+$', $peopleName) )
			MyTools::setError('peopleName', 'O nome informado não é válido. Informe o nome e sobrenome utilizando apenas letras');
		
		return !MyTools::getRequest()->hasErrors();
	}
	
	public static function uniquePeople( $peopleName ){
		
		$peopleId    = MyTools::getRequestParameter('peopleId');
		$userAdminId = MyTools::getRequestParameter('userAdminId');
		
		$criteria = new Criteria();
		$criteria->add( UserAdminPeer::VISIBLE, true );
		$criteria->add( UserAdminPeer::ENABLED, true );
		$criteria->add( UserAdminPeer::DELETED, false );
		$criteria->add( UserAdminPeer::ID, $userAdminId, Criteria::NOT_EQUAL );
		
		$criterionOr = $criteria->getNewCriterion( UserAdminPeer::PEOPLE_ID, $peopleId );
		$criterionOr->addOr( $criteria->getNewCriterion( PeoplePeer::FULL_NAME, $peopleName ) );
		$criteria->add( $criterionOr );
		$criteria->addJoin( UserAdminPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		
		$userAdminObj = UserAdminPeer::doSelectOne( $criteria );

		if( is_object($userAdminObj) )
			MyTools::setError('peopleId', 'Esta pessoa já está relacionada ao usuário '.$userAdminObj->getUsername() );

		return !is_object( $userAdminObj );
	}
	
	public static function uniqueUsername( $username ){
		
		$userAdminId = MyTools::getRequestParameter('userAdminId');

		$criteria = new Criteria();
		$criteria->add( UserAdminPeer::VISIBLE, true );
		$criteria->add( UserAdminPeer::ENABLED, true );
		$criteria->add( UserAdminPeer::DELETED, false );
		$criteria->add( UserAdminPeer::ID, $userAdminId, Criteria::NOT_EQUAL );
		$criteria->add( UserAdminPeer::USERNAME, $username, Criteria::LIKE );
		$userAdminObj = UserAdminPeer::doSelectOne( $criteria );

		return !is_object( $userAdminObj );
	}
	
	public static function loadModulePerm( $userAdminId ){
		
		$userAdminObj = UserAdmin::getCurrentUser();
		
		$criteria = new Criteria();
		$criteria->add( UserAdminModulePeer::USER_ADMIN_ID, $userAdminId );
		$criterion = $criteria->getNewCriterion( UserAdminModulePeer::INDEX_ACTION, true );
		$criterion->addOr( $criteria->getNewCriterion( UserAdminModulePeer::CREATE_ACTION, true ) );
		$criterion->addOr( $criteria->getNewCriterion( UserAdminModulePeer::VIEW_ACTION, true ) );
		$criterion->addOr( $criteria->getNewCriterion( UserAdminModulePeer::EDIT_ACTION, true ) );
//		$criterion->addOr( $criteria->getNewCriterion( UserAdminModulePeer::SAVE_ACTION, true ) );
		$criterion->addOr( $criteria->getNewCriterion( UserAdminModulePeer::DELETE_ACTION, true ) );
		$criteria->add( $criterion );
		if( !$userAdminObj->getMaster() ){
			
			$criteria->addJoin( UserAdminModulePeer::MODULE_ID, ModulePeer::ID, Criteria::INNER_JOIN );
			$criteria->add( ModulePeer::MASTER_ONLY, false );
		}
		$userAdminModuleObjList = UserAdminModulePeer::doSelect( $criteria );
		
		$criteria = new Criteria();
		$criteria->add( UserAdminUserGroupPeer::USER_ADMIN_ID, $userAdminId );
		$criterion = $criteria->getNewCriterion( UserGroupModulePeer::INDEX_ACTION, true );
		$criterion->addOr( $criteria->getNewCriterion( UserGroupModulePeer::CREATE_ACTION, true ) );
		$criterion->addOr( $criteria->getNewCriterion( UserGroupModulePeer::VIEW_ACTION, true ) );
		$criterion->addOr( $criteria->getNewCriterion( UserGroupModulePeer::EDIT_ACTION, true ) );
//		$criterion->addOr( $criteria->getNewCriterion( UserGroupModulePeer::SAVE_ACTION, true ) );
		$criterion->addOr( $criteria->getNewCriterion( UserGroupModulePeer::DELETE_ACTION, true ) );
		$criteria->add( $criterion );
		$criteria->addJoin( UserGroupModulePeer::USER_GROUP_ID, UserAdminUserGroupPeer::USER_GROUP_ID, Criteria::INNER_JOIN );
		if( !$userAdminObj->getMaster() ){
			
			$criteria->addJoin( UserGroupModulePeer::MODULE_ID, ModulePeer::ID, Criteria::INNER_JOIN );
			$criteria->add( ModulePeer::MASTER_ONLY, false );
		}
		$userGroupModuleObjList = UserGroupModulePeer::doSelect( $criteria );
        
        $moduleIdList = array();

		foreach( $userAdminModuleObjList as $userAdminModuleObj )
			 $moduleIdList[] = $userAdminModuleObj->getModuleId();
		
		foreach( $userGroupModuleObjList as $userGroupModuleObj )
			 $moduleIdList[] = $userGroupModuleObj->getModuleId();
		
		$moduleIdList = array_unique($moduleIdList);

		return $moduleIdList;
	}
	
	public static function loadToolbarPerm( $userAdminId ){
		
		if( !$userAdminId )
			return array();
			
        $sql = 'SELECT
				    toolbar_id
				FROM
				    user_admin_toolbar
				WHERE
				    user_admin_id = '.$userAdminId.'
				UNION
				SELECT
				    toolbar_id
				FROM
				    user_group_toolbar
				    INNER JOIN user_admin_user_group ON user_group_toolbar.USER_GROUP_ID = user_admin_user_group.USER_GROUP_ID
				WHERE
				    user_admin_user_group.USER_ADMIN_ID = '.$userAdminId.'

				UNION
				
				SELECT
				    id
				FROM
				    toolbar
				WHERE
				    tag_name IS NULL';
    	$resultSet = Util::executeQuery( $sql );
	
		$toolbarIdList = array();
		
		while($resultSet->next())
			$toolbarIdList[] = $resultSet->getInt(1);

		return $toolbarIdList;
	}
	
	public static function checkPassword($password){
		
		$userAdminObj = UserAdmin::getCurrentUser();
		
		return ($userAdminObj->getPassword()==md5($password) || ( strlen($password)==32 && $userAdminObj->getPassword()==$password));
	}
	
	public static function checkUsernameRetrieve($username){
		
		$emailAddress = MyTools::getRequestParameter('emailAddress');
		
		$criteria = new Criteria();
		$criteria->add( UserAdminPeer::USERNAME, $username );
		$criteria->add( EmailPeer::EMAIL_ADDRESS, $emailAddress, Criteria::ILIKE );
		$criteria->add( EmailPeer::DELETED, false );
		$criteria->add( UserAdminPeer::ENABLED, true );
		$criteria->add( UserAdminPeer::VISIBLE, true );
		$criteria->add( UserAdminPeer::DELETED, false );
		$criteria->add( UserAdminPeer::ACTIVE, true );
		$criteria->addJoin( UserAdminPeer::PEOPLE_ID, PeopleEmailPeer::PEOPLE_ID, Criteria::INNER_JOIN );
		$criteria->addJoin( PeopleEmailPeer::EMAIL_ID, EmailPeer::ID, Criteria::INNER_JOIN );
		$userAdminObj = UserAdminPeer::doSelectOne( $criteria );
		
		if( !is_object($userAdminObj) ){
			
			MyTools::setError('emailAddress', 'Usuário/E-mail não encontrados');
			return false;
		}
		
		return true;
	}
	
	public static function retrieveByUsername($username){
		
		$criteria = new Criteria();
		$criteria->add( UserAdminPeer::USERNAME, $username );
		$criteria->add( UserAdminPeer::ENABLED, true );
		$criteria->add( UserAdminPeer::VISIBLE, true );
		$criteria->add( UserAdminPeer::DELETED, false );
		$criteria->add( UserAdminPeer::ACTIVE, true );
		return UserAdminPeer::doSelectOne( $criteria );
	}
}
