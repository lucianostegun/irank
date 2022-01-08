<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'glossary'.
 *
 * 
 *
 * @package lib.model
 */ 
class GlossaryPeer extends BaseGlossaryPeer
{
	
	public static function retrieveByTerm($term){
		
		$criteria = new Criteria();
		$criteria->add( GlossaryPeer::VISIBLE, true );
		$criteria->add( GlossaryPeer::ENABLED, true );
		$criteria->add( GlossaryPeer::DELETED, false );
		$criteria->add( GlossaryPeer::TERM, $term, Criteria::ILIKE );
		$glossaryObj = GlossaryPeer::doSelectOne($criteria);
		
		if( is_object($glossaryObj) )
			return $glossaryObj;
		
		$criteria = new Criteria();
		$criteria->add( GlossaryPeer::VISIBLE, true );
		$criteria->add( GlossaryPeer::ENABLED, true );
		$criteria->add( GlossaryPeer::DELETED, false );
		$criteria->add( GlossaryPeer::TAGS, "','||glossary.TAGS||',' ILIKE '%,$term,%'", Criteria::CUSTOM );
		
		return GlossaryPeer::doSelectOne($criteria);
	}
}
