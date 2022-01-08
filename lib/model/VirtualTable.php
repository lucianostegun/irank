<?php

/**
 * Subclasse de representação de objetos da tabela 'virtual_table'.
 *
 * 
 *
 * @package lib.model
 */ 
class VirtualTable extends BaseVirtualTable
{
	
	public function __construct(){
		
		$this->setCulture(MyTools::getCulture());
	}
	
	public function toString(){
		
		return $this->getDescription();
	}
	
//	public function getDescription(){
//		
//		$this->setCulture(MyTools::getCulture());
//		return $this->getDescriptionI18n();
//	}
	
	public function quickSave($request){
		
		$description = $request->getParameter('description');
		$tagName     = $request->getParameter('tagName');
		
		$this->setDescription($description);
		$this->setTagName($tagName);
		
		$this->setEnabled(true);
		$this->setVisible(true);
		$this->setDeleted(false);
		$this->save();
	}
	
	public static function getList( $virtualTableName, $orderBy=null ){
		
		if( $orderBy==null )
			$orderBy = VirtualTablePeer::DESCRIPTION;

		$criteria = new Criteria();
		$criteria->add( VirtualTablePeer::VIRTUAL_TABLE_NAME, $virtualTableName );
		$criteria->add( VirtualTablePeer::ENABLED, true );
		$criteria->add( VirtualTablePeer::VISIBLE, true );
		$criteria->add( VirtualTablePeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( $orderBy );
		
		return VirtualTablePeer::doSelect( $criteria );
	}

	public static function getOptionsForSelect( $virtualTableName, $defaultValue=false, $returnArray=false, $orderBy=VirtualTablePeer::DESCRIPTION ){
		
		$virtualTableObjList = self::getList( $virtualTableName, $orderBy );
		
		$optionList = array();
		$optionList[''] = __('select');
		foreach( $virtualTableObjList as $virtualTableObj )			
			$optionList[$virtualTableObj->getId()] = $virtualTableObj->getDescription();
		
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
	
	public static function getIdByTagName( $virtualTableName, $tagName ){
		
		$criteria = new Criteria();
		$criteria->add( VirtualTablePeer::VIRTUAL_TABLE_NAME, $virtualTableName );
		$criteria->add( VirtualTablePeer::TAG_NAME, $tagName );
		$virtualTableObj = VirtualTablePeer::doSelectOne( $criteria );
		
		if( is_object($virtualTableObj) )
			return $virtualTableObj->getId();
		else
			return null;
	}

	public function isTagName( $tagNameList ){
		
		if( !is_array($tagNameList) )
			$tagNameList = array($tagNameList);
		
		foreach( $tagNameList as $tagName )
			if( $this->getTagName()==$tagName )
				return true;
		
		return false;
	}
	
	public static function getIdByDescription( $virtualTableName, $description ){
		
		$criteria = new Criteria();
		$criteria->add( VirtualTablePeer::VIRTUAL_TABLE_NAME, $virtualTableName );
		$criteria->add( VirtualTablePeer::DESCRIPTION, trim($description), Criteria::ILIKE );
		$virtualTableObj = VirtualTablePeer::doSelectOne( $criteria );
		
		if( is_object($virtualTableObj) )
			return $virtualTableObj->getId();
		else
			return null;
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']                   = $this->getId();
		$infoList['virtualTableName']     = $this->getVirtualTableName();
		$infoList['description']          = $this->getDescription();
		$infoList['tagName']              = $this->getTagName();
		$infoList['enabled']              = $this->getEnabled();
		$infoList['visible']              = $this->getVisible();
		$infoList['deleted']              = $this->getDeleted();
		$infoList['locked']               = $this->getLocked();
		$infoList['createdAt']            = $this->getCreatedAt('d/m/Y H:i:s');
		$infoList['updatedAt']            = $this->getUpdatedAt('d/m/Y H:i:s');
		
		return $infoList;
	}
}
