<?php

/**
 * Subclasse de representação de objetos da tabela 'cash_table'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class CashTable extends BaseCashTable
{
	
	public function getIsNew(){
		
		return ($this->isNew() || (!$this->getVisible() && !$this->getEnabled() && !$this->getDeleted()));
	}
	
	public function quickSave($request){
		
		$clubId        = $request->getParameter('clubId');
		$cashTableName = $request->getParameter('cashTableName');
		$seats         = $request->getParameter('seats');
		$buyin         = $request->getParameter('buyin');
		$entranceFee   = $request->getParameter('entranceFee');
		$comments      = $request->getParameter('comments');
		
		if( $this->getIsNew() )
			$this->setClubId(nvl($clubId));
		
		$this->setCashTableName($cashTableName);
		$this->setSeats($seats);
		$this->setBuyin(Util::formatFloat($buyin));
		$this->setEntranceFee(Util::formatFloat($entranceFee));
		$this->setComments(nvl($comments));
		$this->setEnabled(true);
		$this->setVisible(true);
		$this->setDeleted(false);
		$this->save();
	}

	public static function getList(Criteria $criteria=null){
		
		if( !$criteria )
			$criteria = new Criteria();
			
		$criteria->add( CashTablePeer::ENABLED, true );
		$criteria->add( CashTablePeer::VISIBLE, true );
		$criteria->add( CashTablePeer::DELETED, false );
		
		return CashTablePeer::doSelect($criteria);
	}
	
	public function getCurrentValue(){
		
		return 0;
	}
	
	public function getBalanceDifference(){
		
//		$eventLiveObj       = $this->getPreviousEventLive();
//		$totalBuyin         = $this->getTotalBuyin(true);
//		$totalBuyinPrevious = $eventLiveObj->getTotalBuyin(true);
//		
//		if( $eventLiveObj->isNew() || $this->getIsNew() )
//			return 0;
//		
//		$difference = $totalBuyin-$totalBuyinPrevious;
//		$percent    = ($difference*100/($totalBuyinPrevious?$totalBuyinPrevious:1));
		
		return 0;//$percent;
	}
	
	public function getBalanceStats(){
		
	    $balanceValue         = 0;//$this->getTotalBuyin(true);
	    $balanceChanges       = 0;//$this->getBalanceDifference();
		$previousBalanceValue = 0;//$this->getPreviousEventLive()->getTotalBuyin(true);
	    
	    return array('value'=>$balanceValue,
	    			 'changes'=>$balanceChanges,
	    			 'previous'=>$previousBalanceValue);
	}
	
	public function getStats($jsKeys=false){
		
		$players         = 0;
		$changePlayers   = 0;
		$playersPrevious = 0;
			
		$numStatList = array();
    	$numStatList[($jsKeys?'players':'Jogadores')]      = array('tagName'=>'players',        'value'=>$players, 'changes'=>$changePlayers, 'previous'=>$playersPrevious);
    	
    	return $numStatList;
	}
	
	public function getTableStatus($description=false){
		
		$tableStatus = parent::getTableStatus();
		
		if( $description ){
			
			switch($tableStatus){
				case 'closed':
					$tableStatus = 'Fechada';
					break;
				case 'open':
					$tableStatus = 'Aberta';
					break;
			}
		}
		
		return $tableStatus;
	}
	
	public function isMyCashTable(){
		
	    $iRankAdmin = MyTools::hasCredential('iRankAdmin');
		$clubId     = MyTools::getAttribute('clubId');
		
		if( $this->getClubId()!=$clubId && !$iRankAdmin )
			return false;
		
		return true;
	}
	
	public function openTable(){
		
		$this->setLastOpenedAt(date('Y-m-d H:i:s'));
		$this->setTableStatus('open');
		$this->save();
	}

	public function closeTable(){
		
		$this->setLastOpenedAt(null);
		$this->setTableStatus('closed');
		$this->save();
	}
	
	public function isOpen(){
		
		return $this->getTableStatus()=='open';
	}

	public function isClosed(){
		
		return $this->getTableStatus()=='closed';
	}

	public function getComments($format=false){
		
		$comments = parent::getComments();
		
		if( $format )
			$comments = preg_replace('/[\n\r]/i', '<br/>', $comments);
		
		return $comments;
	}
	
	public function toString(){
		
		return $this->getCashTableName();
	}
}
