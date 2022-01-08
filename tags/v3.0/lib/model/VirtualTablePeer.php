<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'virtual_table'.
 *
 * 
 *
 * @package lib.model
 */ 
class VirtualTablePeer extends BaseVirtualTablePeer
{

    public static function search( $virtualTableName, $request, $count ){
    
    	$tagName       = $request->getParameter('cdTagName');
    	$description   = $request->getParameter('description');
    	$descriptionEn = $request->getParameter('descriptionEn');
    	
    	$limit  = $request->getParameter('limit', 50);
    	$offset = $request->getParameter('offset', 0);
    	
    	$databaseSortField = $request->getParameter('databaseSortField');
    	$databaseSortDesc  = $request->getParameter('databaseSortDesc');
    	
		$criteria = new Criteria();
		$criteria->add( VirtualTablePeer::VIRTUAL_TABLE_NAME, $virtualTableName );
		if( $tagName )       $criteria->add( VirtualTablePeer::TAG_NAME, '%'.$tagName.'%', Criteria::ILIKE );
		if( $description )   $criteria->add( VirtualTablePeer::DESCRIPTION, '%'.$description.'%', Criteria::ILIKE );
		if( $descriptionEn ) $criteria->add( VirtualTablePeer::DESCRIPTION_EN, '%'.$descriptionEn.'%', Criteria::ILIKE );
		$criteria->add( VirtualTablePeer::ENABLED, true );
		$criteria->add( VirtualTablePeer::VISIBLE, true );
		$criteria->add( VirtualTablePeer::DELETED, false );
		
		if( $databaseSortField ){
			
			if( $databaseSortDesc )
				$criteria->addDescendingOrderByColumn( $databaseSortField );
			else
				$criteria->addAscendingOrderByColumn( $databaseSortField );
		}else		
			$criteria->addAscendingOrderByColumn( VirtualTablePeer::DESCRIPTION );
		
		if( $count )
    		return VirtualTablePeer::doCount( $criteria );
    	else{
    		$criteria->setLimit($limit);
    		$criteria->setOffset($offset);
    		
    		return VirtualTablePeer::doSelect( $criteria );
    	}
    }
    
	public static function uniqueDescription( $description ){

		$virtualTableId   = MyTools::getRequestParameter('virtualTableId');
		$virtualTableName = MyTools::getRequestParameter('virtualTableName');

		$criteria = new Criteria();
		$criteria->add( VirtualTablePeer::VISIBLE, true );
		$criteria->add( VirtualTablePeer::ENABLED, true );
		$criteria->add( VirtualTablePeer::DELETED, false );
		$criteria->add( VirtualTablePeer::VIRTUAL_TABLE_NAME, $virtualTableName );
		$criteria->add( VirtualTablePeer::ID, $virtualTableId, Criteria::NOT_EQUAL );
		$criteria->add( VirtualTablePeer::DESCRIPTION, $description, Criteria::ILIKE );
		$virtualTableObj = VirtualTablePeer::doSelectOne( $criteria );
		
		return !is_object( $virtualTableObj );
	}
	
	public static function uniqueTagName( $tagName ){

		$virtualTableId   = MyTools::getRequestParameter('virtualTableId');
		$virtualTableName = MyTools::getRequestParameter('virtualTableName');

		$criteria = new Criteria();
		$criteria->add( VirtualTablePeer::VISIBLE, true );
		$criteria->add( VirtualTablePeer::ENABLED, true );
		$criteria->add( VirtualTablePeer::DELETED, false );
		$criteria->add( VirtualTablePeer::VIRTUAL_TABLE_NAME, $virtualTableName );
		$criteria->add( VirtualTablePeer::ID, $virtualTableId, Criteria::NOT_EQUAL );
		$criteria->add( VirtualTablePeer::TAG_NAME, $tagName, Criteria::ILIKE );
		$virtualTableObj = VirtualTablePeer::doSelectOne( $criteria );
		
		return !is_object( $virtualTableObj );
	}
	
	public static function retrieveByTagName( $virtualTableName, $tagName ){
		
		$criteria = new Criteria();
		$criteria->add( VirtualTablePeer::VIRTUAL_TABLE_NAME, $virtualTableName );
		$criteria->add( VirtualTablePeer::TAG_NAME, $tagName );
		$virtualTableObj = VirtualTablePeer::doSelectOne( $criteria );
		
		return $virtualTableObj;
	}
}
