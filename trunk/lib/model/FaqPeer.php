<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'faq'.
 *
 * 
 *
 * @package lib.model
 */ 
class FaqPeer extends BaseFaqPeer
{
	
    public static function search( $request, $count ){
    
    	$question = $request->getParameter('question');
    	$answer   = $request->getParameter('answer');
    	
    	$limit  = $request->getParameter('limit', 50);
    	$offset = $request->getParameter('offset', 0);
    	
    	$databaseSortField = $request->getParameter('databaseSortField');
    	$databaseSortDesc  = $request->getParameter('databaseSortDesc');

		$criteria = new Criteria();
		
		if( $question ) $criteria->add( FaqPeer::QUESTION, '%'.$question.'%', Criteria::ILIKE );
		if( $answer )   $criteria->add( FaqPeer::ANSWER, '%'.$answer.'%', Criteria::ILIKE );
		
		$criteria->add( FaqPeer::VISIBLE, true );
		$criteria->add( FaqPeer::DELETED, false );
		
		if( $databaseSortField ){
			if( $databaseSortDesc )
				$criteria->addDescendingOrderByColumn( $databaseSortField );
			else
				$criteria->addAscendingOrderByColumn( $databaseSortField );
		}else {	

			$criteria->addAscendingOrderByColumn( FaqPeer::QUESTION );
		}
		
		if( $count )
    		return FaqPeer::doCount( $criteria );
    	else{
    		$criteria->setLimit($limit);
    		$criteria->setOffset($offset);
    		
    		return FaqPeer::doSelect( $criteria );
    	}
    }
}
