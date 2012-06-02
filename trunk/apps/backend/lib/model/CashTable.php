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
	
	private $totalEntranceFee = null;
	private $totalBuyin       = null;
	private $totalCashout     = null;
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
        	Log::quickLog('cash_table', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('cash_table', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
	}
	
	public function getIsNew(){
		
		return ($this->isNew() || (!$this->getVisible() && !$this->getEnabled() && !$this->getDeleted()));
	}
	
	public function quickSave($request){
		
		$clubId        = $request->getParameter('clubId');
		$cashTableName = $request->getParameter('cashTableName');
		$gameTypeId    = $request->getParameter('gameTypeId');
		$gameLimitId   = $request->getParameter('gameLimitId');
		$seats         = $request->getParameter('seats');
		$buyin         = $request->getParameter('buyin');
		$entranceFee   = $request->getParameter('entranceFee');
		$comments      = $request->getParameter('comments');
		
		if( $this->getIsNew() )
			$this->setClubId(nvl($clubId));
		
		$this->setCashTableName($cashTableName);
		$this->setSeats($seats);
		$this->setGameTypeId($gameTypeId);
		$this->setGameLimitId($gameLimitId);
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
	
	public function getCurrentValue($withEntranceFee=true){
		
		return $this->getTotalBuyin()+($withEntranceFee?$this->getTotalEntranceFee():0);
	}
	
	public function getTotalBuyin(){
		
		if( is_null($this->totalBuyin) )
			$this->totalBuyin = Util::executeOne('SELECT get_cash_table_total_buyin('.$this->getId().')', 'float');
		
		return $this->totalBuyin - $this->getTotalCashout();
	}

	public function getTotalEntranceFee(){
		
		if( !is_null($this->totalEntranceFee) )
			return $this->totalEntranceFee;
			
		$this->totalEntranceFee = Util::executeOne('SELECT get_cash_table_entrance_fee('.$this->getId().')', 'float');
		
		return $this->totalEntranceFee;
	}

	public function getTotalCashout(){
		
		if( !is_null($this->totalCashout) )
			return $this->totalCashout;
			
		$this->totalCashout = Util::executeOne('SELECT get_cash_table_cashout('.$this->getId().')', 'float');
		
		return $this->totalCashout;
	}
	
	public function getBalanceDifference(){
		
		return 0;
	}
	
	public function getBalanceStats(){
		
	    $balanceValue         = $this->getCurrentValue();
	    $balanceChanges       = 0;//$this->getBalanceDifference();
		$previousBalanceValue = 0;//$this->getPreviousEventLive()->getTotalBuyin(true);
	    
	    return array('value'=>$balanceValue,
	    			 'changes'=>$balanceChanges,
	    			 'previous'=>$previousBalanceValue);
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
	
	public function getClub($con=null){
		
		$clubObj = parent::getClub($con);
		
		if( !is_object($clubObj) )
			$clubObj = new Club();
		
		return $clubObj;
	}
	
	public function openTable(){
		
		if( $this->isOpen() )
    		throw new Exception('A mesa já está aberta');
    		
	    if( !$this->isMyCashTable() ){
	    	
		    $username = MyTools::getAttribute('username');
	    	Log::doLog('Usuário <b>'.$username.'</b> tentou abrir a mesa <b>('.$this->getId().') '.$this->toString().'</b>.', 'CashTable', array(), Log::LOG_CRITICAL);
	    	
	    	throw new Exception('Você não tem permissão para editar esta mesa!');
	    }
    	
    	$userAdminId = MyTools::getAttribute('userAdminId');
    	
		$con = Propel::getConnection();
		$con->begin();
		
		try{
			
			$dealerStartPosition = rand(1, $this->getSeats());
			
			$cashTableSessionObj = new CashTableSession();
			$cashTableSessionObj->setCashTableId($this->getId());
			$cashTableSessionObj->setOpenedAt(time());
			$cashTableSessionObj->setClosedAt(null);
			$cashTableSessionObj->setTotalPlayers(0);
			$cashTableSessionObj->setTotalDealers(0);
			$cashTableSessionObj->setUserAdminIdOpen($userAdminId);
			$cashTableSessionObj->setUserAdminIdClose(null);
			$cashTableSessionObj->setDealerStartPosition($dealerStartPosition);
			$cashTableSessionObj->save($con);
			
			$this->setCashTableSession($cashTableSessionObj);
			$this->setLastOpenedAt(date('Y-m-d H:i:s'));
			$this->setTableStatus('open');
			$this->save($con);
			
			$con->commit();
			return true;
		}catch(Exception $e){
			
			$con->rollback();
			
			return false;
		}
	}

	public function closeTable(){
		
		if( $this->isClosed() )
    		throw new Exception('A mesa já está fechada');
    	
	    if( !$this->isMyCashTable() ){
	    	
		    $username = MyTools::getAttribute('username');
	    	Log::doLog('Usuário <b>'.$username.'</b> tentou fechar a mesa <b>('.$this->getId().') '.$this->toString().'</b>.', 'CashTable', array(), Log::LOG_CRITICAL);
	    	
	    	throw new Exception('Você não tem permissão para editar esta mesa!');
	    }

		// Verifica se o dealer ainda está na mesa
		if( !is_null($this->getPeopleIdDealer()) )
    		throw new Exception('O dealer ainda não foi removido da mesa!');
    		
    	// Verifica se algum jogador ainda está sentado na mesa
		$cashTableSessionId = $this->getCashTableSessionId();
		$players = Util::executeOne("SELECT COUNT(1) FROM cash_table_player WHERE cash_table_session_id = $cashTableSessionId AND checkout_at IS NULL");
	    if( $players > 0 )
	    	throw new Exception('Ainda existem jogadores alocados na mesa.');
    	
    	$userAdminId = MyTools::getAttribute('userAdminId');
    	
		$con = Propel::getConnection();
		$con->begin();
		
		try{
			$cashTableSessionObj = $this->getCashTableSession();
			$cashTableSessionObj->setClosedAt(time());
			$cashTableSessionObj->setUserAdminIdClose($userAdminId);
			
			if( $cashTableSessionObj->getTotalPlayers()==0 )
				$cashTableSessionObj->delete($con);
			else
				$cashTableSessionObj->save($con);
			
			$this->setLastOpenedAt(null);
			$this->setCashTableSession(null);
			$this->setTableStatus('closed');
			$this->save($con);
			
			$con->commit();
			return true;
		}catch(Exception $e){
			
			$con->rollback();
			return false;
		}
	}
	
	public function isOpen(){
		
		return $this->getTableStatus()=='open';
	}

	public function isClosed(){
		
		return $this->getTableStatus()=='closed';
	}
	
	/**
	 * Método que verifica se uma posição da mesa está disponível para aquela sessão
	 */
	private function checkTablePosition($tablePosition){
		
		$cashTableSessionId = $this->getCashTableSessionId();
		
		$peopleId = Util::executeOne("SELECT people_id FROM cash_table_player WHERE cash_table_session_id = $cashTableSessionId AND table_position = $tablePosition AND checkout_at IS NULL");
		
		return is_null($peopleId);
	}
	
	/**
	 * Método que verifica se o jogador já está sentado na mesa
	 */
	private function checkPlayer($peopleId){
		
		$cashTableSessionId = $this->getCashTableSessionId();
		
		$peopleId = Util::executeOne("SELECT people_id FROM cash_table_player WHERE cash_table_session_id = $cashTableSessionId AND people_id = $peopleId AND checkout_at IS NULL");
		
		return is_null($peopleId);
	}
	
	/**
	 * Método que verifica se o dealer já está trabalhando em outra
	 */
	private function checkDealer($peopleId){
		
		$cashTableSessionId = $this->getCashTableSessionId();
		
		$peopleId = Util::executeOne("SELECT people_id FROM cash_table_dealer WHERE cash_table_session_id = $cashTableSessionId AND people_id = $peopleId AND checkout_at IS NULL");
		
		return is_null($peopleId);
	}
	
	public function seatPlayer($peopleId, $tablePosition, $buyin, $payMethodId, $checkInfo){
		
		$con = Propel::getConnection();
		$con->begin();
		
		if( !$this->checkTablePosition($tablePosition) )
			throw new Exception('O assento selecionado já está ocupado por outro jogador.');

		if( !$this->checkPlayer($peopleId) )
			throw new Exception('O jogador já está jogando em outra mesa.');
			
		try{
			
			$cashTablePlayerObj = new CashTablePlayer();
			$cashTablePlayerObj->setCashTableId($this->getId());
			$cashTablePlayerObj->setCashTableSessionId($this->getCashTableSessionId());
			$cashTablePlayerObj->setPeopleId($peopleId);
			$cashTablePlayerObj->setTablePosition($tablePosition);
			$cashTablePlayerObj->setCheckinAt(time());
			$cashTablePlayerObj->setCheckoutAt(null);
			$cashTablePlayerObj->setCashoutValue(0);
	    	$cashTablePlayerObj->addBuyin($buyin, $this->getEntranceFee(), $payMethodId, $checkInfo, $con);
	    	$cashTablePlayerObj->save($con);
	    	
	    	$cashTableSessionObj = $this->getCashTableSession();
	    	$cashTableSessionId  = $cashTableSessionObj->getId();
			
			$players = Util::executeOne("SELECT COUNT(DISTINCT people_id) FROM cash_table_player WHERE cash_table_session_id = $cashTableSessionId");
			$cashTableSessionObj->setTotalPlayers($players);
			$this->save($con);
			
			$this->setPlayers($this->getPlayers()+1);
			$this->save($con);
			
			$con->commit();
			return true;
		}catch(Exception $e){
			
			$con->rollback();
			
			echo $e->getMessage();
			return false;
		}
	}
	
	public function addRebuy($peopleId, $buyin, $payMethodId, $checkInfo){
		
		$con = Propel::getConnection();
		$con->begin();
		
		$cashTablePlayerObj = CashTablePlayerPeer::retrieveByFields($this->getId(), $this->getCashTableSessionId(), $peopleId);
		$result = $cashTablePlayerObj->addBuyin($buyin, 0, $payMethodId, $checkInfo);
		
		if( $result===true ){
			
			$cashTablePlayerObj->save($con);
			
			$con->commit();
			return true;
		}else{
			
			$con->rollback();
			return false;
		}
	}

	public function seatDealer($peopleId){
		
		$con = Propel::getConnection();
		$con->begin();
		
		if( !$this->checkDealer($peopleId) )
			throw new Exception('O dealer já está trabalhando em outra mesa.');
		
		try{
			
			$cashTableDealerObj = new CashTableDealer();
			$cashTableDealerObj->setCashTableId($this->getId());
			$cashTableDealerObj->setCashTableSessionId($this->getCashTableSessionId());
			$cashTableDealerObj->setPeopleId($peopleId);
			$cashTableDealerObj->setCheckinAt(time());
			$cashTableDealerObj->setCheckoutAt(null);
			$cashTableDealerObj->setCashoutValue(0);
	    	$cashTableDealerObj->save($con);
	    	
	    	$cashTableSessionObj = $this->getCashTableSession();
	    	$cashTableSessionId  = $cashTableSessionObj->getId();
			
			$dealers = Util::executeOne("SELECT COUNT(DISTINCT people_id) FROM cash_table_dealer WHERE cash_table_session_id = $cashTableSessionId");
			$cashTableSessionObj->setTotalDealers($dealers);
			$this->save($con);
			
			$this->setPeopleIdDealer($peopleId);
			$this->save($con);
			
			$con->commit();
			return true;
		}catch(Exception $e){
			
			$con->rollback();
			return false;
		}
	}

	public function cashout($peopleId, $cashoutValue){
		
		$criteria = new Criteria();
		$criteria->add( CashTablePlayerPeer::CASH_TABLE_ID, $this->getId() );
		$criteria->add( CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $this->getCashTableSessionId() );
		$criteria->add( CashTablePlayerPeer::PEOPLE_ID, $peopleId );
		$criteria->add( CashTablePlayerPeer::CHECKOUT_AT, null );
		$cashTablePlayerObj = CashTablePlayerPeer::doSelectOne($criteria);
		
		$cashTablePlayerObj->cashout($cashoutValue);
	}

	public function cashoutDealer($peopleId, $cashoutValue){
		
		$criteria = new Criteria();
		$criteria->add( CashTableDealerPeer::CASH_TABLE_ID, $this->getId() );
		$criteria->add( CashTableDealerPeer::CASH_TABLE_SESSION_ID, $this->getCashTableSessionId() );
		$criteria->add( CashTableDealerPeer::PEOPLE_ID, $peopleId );
		$criteria->add( CashTableDealerPeer::CHECKOUT_AT, null );
		$cashTableDealerObj = CashTableDealerPeer::doSelectOne($criteria);
		$cashTableDealerObj->cashout($cashoutValue);
	}
	
	public function getPlayerList(){
		
		$criteria = new Criteria();
		$criteria->add( CashTablePlayerPeer::CHECKOUT_AT, null );
		$criteria->add( CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $this->getCashTableSessionId() );
		$criteria->addAscendingOrderByColumn( CashTablePlayerPeer::TABLE_POSITION );
		return $this->getCashTablePlayerListJoinPeople($criteria);
	}

	public function getComments($format=false){
		
		$comments = parent::getComments();
		
		if( $format )
			$comments = preg_replace('/[\n\r]/i', '<br/>', $comments);
		
		return $comments;
	}
	
	public function getDealerStartPosition(){
		
		$cashTableSessionObj = $this->getCashTableSession();
		if( is_object($cashTableSessionObj) )
			return $cashTableSessionObj->getDealerStartPosition();
		else
			return null;
	}
	
	public function getGameType(){
		
		$virtualTableObj = $this->getVirtualTableRelatedByGameTypeId();
		
		if( !is_object($virtualTableObj) )
			$virtualTableObj = new VirtualTable();
		
		return $virtualTableObj;
	}
	
	public function getGameLimit(){
		
		$virtualTableObj = $this->getVirtualTableRelatedByGameLimitId();
		
		if( !is_object($virtualTableObj) )
			$virtualTableObj = new VirtualTable();
		
		return $virtualTableObj;
	}
	
	public function toString(){
		
		return $this->getCashTableName();
	}
	
	public function getInfo(){
		
		$infoList = array();
		$infoList['seats']               = $this->getSeats();
		$infoList['players']             = $this->getPlayers();
		$infoList['totalBuyin']          = $this->getTotalBuyin();
		$infoList['totalEntranceFee']    = $this->getTotalEntranceFee();
		$infoList['currentValue']        = $this->getCurrentValue();
		$infoList['tableStatus']         = $this->getTableStatus();
		$infoList['isOpen']              = $isOpen = $this->isOpen();
		$infoList['dealerStartPosition'] = $this->getDealerStartPosition();
		
		return $infoList;
	}
}
