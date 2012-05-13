<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'email_template'.
 *
 * 
 *
 * @package lib.model
 */ 
class EmailTemplatePeer extends BaseEmailTemplatePeer
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
		if( $description )   $criteria->add( EmailTemplatePeer::DESCRIPTION, '%'.$description.'%', Criteria::ILIKE );
		$criteria->add( EmailTemplatePeer::VISIBLE, true );
		$criteria->add( EmailTemplatePeer::DELETED, false );
		
		if( $databaseSortField ){
			if( $databaseSortDesc )
				$criteria->addDescendingOrderByColumn( $databaseSortField );
			else
				$criteria->addAscendingOrderByColumn( $databaseSortField );
		}else {	

			$criteria->addAscendingOrderByColumn( EmailTemplatePeer::DESCRIPTION );
		}
		
		if( $count )
    		return EmailTemplatePeer::doCount( $criteria );
    	else{
    		$criteria->setLimit($limit);
    		$criteria->setOffset($offset);
    		
    		return EmailTemplatePeer::doSelect( $criteria );
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

		$emailTemplateId = MyTools::getRequestParameter('emailTemplateId');

		$criteria = new Criteria();
		$criteria->add( EmailTemplatePeer::VISIBLE, true );
		$criteria->add( EmailTemplatePeer::ENABLED, true );
		$criteria->add( EmailTemplatePeer::DELETED, false );
		$criteria->add( EmailTemplatePeer::ID, $emailTemplateId, Criteria::NOT_EQUAL );
		$criteria->add( EmailTemplatePeer::TAG_NAME, $tagName, Criteria::ILIKE );
		$emailTemplateCount = EmailTemplatePeer::doCount( $criteria );
		
		return ($emailTemplateCount==0);
	}
	
	public static function retrieveByTagName($tagName){
		
		$criteria = new Criteria();
		$criteria->add( EmailTemplatePeer::VISIBLE, true );
		$criteria->add( EmailTemplatePeer::DELETED, false );
		$criteria->add( EmailTemplatePeer::TAG_NAME, $tagName );
		return EmailTemplatePeer::doSelectOne( $criteria );
	}
}
