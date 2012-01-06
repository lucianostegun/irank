<?php

/**
 * Subclasse de representação de objetos da tabela 'partner'.
 *
 * 
 *
 * @package lib.model
 */ 
class Partner extends BasePartner
{
	
	public function toString(){
		
		return $this->getPartnerName();
	}
	
	public static function getList(){
		
		$criteria = new Criteria();
		$criteria->add( PartnerPeer::ENABLED, true );
		$criteria->add( PartnerPeer::VISIBLE, true );
		$criteria->add( PartnerPeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( PartnerPeer::PARTNER_NAME );
		
		return PartnerPeer::doSelect( $criteria );
	}
	
	public function getFileName(){
		
		return $this->getFile()->getFileName();
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']          = $this->getId();
		$infoList['partnerName'] = $this->getPartnerName();
		$infoList['externalUrl'] = $this->getExternalUrl();
		$infoList['fileId']      = $this->getFileId();
		$infoList['fileName']    = $this->getFilePath();
		$infoList['visible']     = $this->getVisible();
		$infoList['deleted']     = $this->getDeleted();
		$infoList['locked']      = $this->getLocked();
		$infoList['createdAt']   = $this->getCreatedAt('d/m/Y H:i:s');
		$infoList['updatedAt']   = $this->getUpdatedAt('d/m/Y H:i:s');
		
		return $infoList;
	}
}
