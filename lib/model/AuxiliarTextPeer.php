<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'auxiliarText'.
 *
 * 
 *
 * @package lib.model
 */ 
class AuxiliarTextPeer extends BaseAuxiliarTextPeer
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
		if( $description )   $criteria->add( AuxiliarTextPeer::DESCRIPTION, '%'.$description.'%', Criteria::ILIKE );
		$criteria->add( AuxiliarTextPeer::VISIBLE, true );
		$criteria->add( AuxiliarTextPeer::DELETED, false );
		
		if( $databaseSortField ){
			if( $databaseSortDesc )
				$criteria->addDescendingOrderByColumn( $databaseSortField );
			else
				$criteria->addAscendingOrderByColumn( $databaseSortField );
		}else {	

			$criteria->addAscendingOrderByColumn( AuxiliarTextPeer::DESCRIPTION );
		}
		
		if( $count )
    		return AuxiliarTextPeer::doCount( $criteria );
    	else{
    		$criteria->setLimit($limit);
    		$criteria->setOffset($offset);
    		
    		return AuxiliarTextPeer::doSelect( $criteria );
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
	public static function uniqueDescription( $description ){

		$auxiliarTextId    = MyTools::getRequestParameter('auxiliarTextId');

		$criteria = new Criteria();
		$criteria->add( AuxiliarTextPeer::VISIBLE, true );
		$criteria->add( AuxiliarTextPeer::ENABLED, true );
		$criteria->add( AuxiliarTextPeer::DELETED, false );
		$criteria->add( AuxiliarTextPeer::ID, $auxiliarTextId, Criteria::NOT_EQUAL );
		$criteria->add( AuxiliarTextPeer::DESCRIPTION, $description, Criteria::ILIKE );
		$auxiliarTextObj = AuxiliarTextPeer::doSelectOne( $criteria );
		
		return !is_object( $auxiliarTextObj );
	}
	
	public static function retrieveByTagName($tagName){
		
		$criteria = new Criteria();
		$criteria->add( AuxiliarTextPeer::VISIBLE, true );
		$criteria->add( AuxiliarTextPeer::DELETED, false );
		$criteria->add( AuxiliarTextPeer::TAG_NAME, $tagName );
		return AuxiliarTextPeer::doSelectOne( $criteria );
	}
}
