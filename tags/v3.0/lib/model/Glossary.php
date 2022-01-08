<?php

/**
 * Subclasse de representação de objetos da tabela 'glossary'.
 *
 * 
 *
 * @package lib.model
 */ 
class Glossary extends BaseGlossary
{
	
	public function toString(){
		
		return $this->getTerm();
	}
	
	public function quickSave($request){
		
		$term        = $request->getParameter('term');
		$description = $request->getParameter('description', $term);
		$tags        = $request->getParameter('tags');
		
		$this->setTerm( $term );
		$this->setDescription( $description );
		$this->setTags( $tags );
		$this->setVisible( true );
		$this->setEnabled( true );
		$this->save();
	}
	
	public static function getList(Criteria $criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( GlossaryPeer::ENABLED, true );
		$criteria->add( GlossaryPeer::VISIBLE, true );
		$criteria->add( GlossaryPeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( GlossaryPeer::CREATED_AT );
		
		return GlossaryPeer::doSelect( $criteria );
	}

	public static function getOptionsForSelect($defaultValue=false, $returnArray=false){
		
		$productObjList = self::getList();

		$optionList = array();
		$optionList[''] = 'Selecione';
		foreach( $productObjList as $productObj )			
			$optionList[$productObj->getId()] = $productObj->toString();
		
		if( $returnArray )
			return $optionList;

		return options_for_select($optionList, $defaultValue);
	}
}
