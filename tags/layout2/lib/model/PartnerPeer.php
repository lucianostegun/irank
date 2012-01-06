<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'partner'.
 *
 * 
 *
 * @package lib.model
 */ 
class PartnerPeer extends BasePartnerPeer
{
	
    public static function search( $request, $count ){
    
    	$partnerName = $request->getParameter('partnerName');
    	$externalUrl = $request->getParameter('externalUrl');
    	$fileName    = $request->getParameter('fileName');
    	
    	$limit  = $request->getParameter('limit', 50);
    	$offset = $request->getParameter('offset', 0);
    	
    	$databaseSortField = $request->getParameter('databaseSortField');
    	$databaseSortDesc  = $request->getParameter('databaseSortDesc');

		$criteria = new Criteria();
		
		if( $partnerName ) $criteria->add( PartnerPeer::PARTNER_NAME, '%'.$partnerName.'%', Criteria::ILIKE );
		if( $externalUrl ) $criteria->add( PartnerPeer::EXTERNAL_URL, '%'.$externalUrl.'%', Criteria::ILIKE );
		if( $fileName )    $criteria->add( FilePeer::FILE_NAME, '%'.$fileName.'%', Criteria::ILIKE );
		
		$criteria->add( PartnerPeer::VISIBLE, true );
		$criteria->add( PartnerPeer::DELETED, false );
		
		$criteria->addJoin( PartnerPeer::FILE_ID, FilePeer::ID, Criteria::INNER_JOIN );
		
		if( $databaseSortField ){
			if( $databaseSortDesc )
				$criteria->addDescendingOrderByColumn( $databaseSortField );
			else
				$criteria->addAscendingOrderByColumn( $databaseSortField );
		}else {	

			$criteria->addAscendingOrderByColumn( PartnerPeer::PARTNER_NAME );
		}
		
		if( $count )
    		return PartnerPeer::doCount( $criteria );
    	else{
    		$criteria->setLimit($limit);
    		$criteria->setOffset($offset);
    		
    		return PartnerPeer::doSelect( $criteria );
    	}
    }
}
