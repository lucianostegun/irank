<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'email_marketing'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class EmailMarketingPeer extends BaseEmailMarketingPeer
{
	/**
	 * Método de pesquisa e contagens de registros a partir de condições
	 * passadas por parâmetros na requisição.
	 * Retorna um array de objetos ou a quantidade de registros encontrada 
	 *
	 * @author     Luciano Stegun
	 * @param      Object: Objeto da classe sfRequest nativa do framework
	 * @param      Boolean: Define se a pesquisa será apenas uma contagem de registros
	 * @return     Array/Integer
	 */
    public static function search( $request, $count ){
    
    	$description = $request->getParameter('description');
    	
    	$limit  = $request->getParameter('limit', UserAdmin::getUserOptionValue('recordsPerPage'));
    	$offset = $request->getParameter('offset', 0);
    	
    	$databaseSortField = $request->getParameter('databaseSortField');
    	$databaseSortDesc  = $request->getParameter('databaseSortDesc');

		$criteria = new Criteria();
		if( $description )   $criteria->add( EmailMarketingPeer::DESCRIPTION, '%'.$description.'%', Criteria::ILIKE );
		$criteria->add( EmailMarketingPeer::VISIBLE, true );
		$criteria->add( EmailMarketingPeer::DELETED, false );
		
		if( $databaseSortField ){
			if( $databaseSortDesc )
				$criteria->addDescendingOrderByColumn( $databaseSortField );
			else
				$criteria->addAscendingOrderByColumn( $databaseSortField );
		}else {	

			$criteria->addAscendingOrderByColumn( EmailMarketingPeer::DESCRIPTION );
		}
		
		if( $count )
    		return EmailMarketingPeer::doCount( $criteria );
    	else{
    		$criteria->setLimit($limit);
    		$criteria->setOffset($offset);
    		
    		return EmailMarketingPeer::doSelect( $criteria );
    	}
    }
	
	/**
	 * Método de verificação de valor único para a coluna DESCRIPTION
	 * da tabela, utilizado no cadastro/edição de registros do módulo 
	 *
	 * @author     Luciano Stegun
	 * @param      String: Valor em duplicidade a ser verificado
	 * @return     Boolean
	 */
	public static function uniqueTagName($tagName){

		$emailMarketingId = MyTools::getRequestParameter('emailMarketingId');

		$criteria = new Criteria();
		$criteria->add( EmailMarketingPeer::VISIBLE, true );
		$criteria->add( EmailMarketingPeer::ENABLED, true );
		$criteria->add( EmailMarketingPeer::DELETED, false );
		$criteria->add( EmailMarketingPeer::ID, $emailMarketingId, Criteria::NOT_EQUAL );
		$criteria->add( EmailMarketingPeer::TAG_NAME, $tagName, Criteria::ILIKE );
		$emailMarketingCount = EmailMarketingPeer::doCount( $criteria );
		
		return ($emailMarketingCount==0);
	}
	
	public static function retrieveByTagName($tagName){
		
		$criteria = new Criteria();
		$criteria->add( EmailMarketingPeer::VISIBLE, true );
		$criteria->add( EmailMarketingPeer::DELETED, false );
		$criteria->add( EmailMarketingPeer::TAG_NAME, $tagName );
		return EmailMarketingPeer::doSelectOne( $criteria );
	}
}
	