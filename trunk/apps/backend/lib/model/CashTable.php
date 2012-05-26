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
		
		return $this->getTotalBuyin()+$this->getTotalEntranceFee();
	}
	
	public function getTotalBuyin(){
		
		if( !is_null($this->totalBuyin) )
			return $this->totalBuyin;
			
		$this->totalBuyin = Util::executeOne('SELECT get_cash_table_total_buyin('.$this->getId().')', 'float');
		
		return $this->totalBuyin;
	}

	public function getTotalEntranceFee(){
		
		if( !is_null($this->totalEntranceFee) )
			return $this->totalEntranceFee;
			
		$this->totalEntranceFee = Util::executeOne('SELECT get_cash_table_entrance_fee('.$this->getId().')', 'float');
		
		return $this->totalEntranceFee;
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
	
	public function getStats($jsKeys=false){
		
		$players         = $this->getPlayers();
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
			
			$cashTableSessionObj = new CashTableSession();
			$cashTableSessionObj->setCashTableId($this->getId());
			$cashTableSessionObj->setOpenedAt(time());
			$cashTableSessionObj->setClosedAt(null);
			$cashTableSessionObj->setTotalPlayers(0);
			$cashTableSessionObj->setTotalDealers(0);
			$cashTableSessionObj->setUserAdminIdOpen($userAdminId);
			$cashTableSessionObj->setUserAdminIdClose(null);
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
	
	public function seatPlayer($peopleId, $tablePosition, $buyin){
		
		$con = Propel::getConnection();
		$con->begin();
		
		if( !$this->checkTablePosition($tablePosition) )
			throw new Exception('O assento selecionado já está ocupado por outro jogador');
		
		try{
			
			$cashTablePlayerObj = new CashTablePlayer();
			$cashTablePlayerObj->setCashTableId($this->getId());
			$cashTablePlayerObj->setCashTableSessionId($this->getCashTableSessionId());
			$cashTablePlayerObj->setPeopleId($peopleId);
			$cashTablePlayerObj->setTablePosition($tablePosition);
			$cashTablePlayerObj->setBuyin(Util::formatFloat($buyin));
			$cashTablePlayerObj->setEntranceFee($this->getEntranceFee());
			$cashTablePlayerObj->setCheckinAt(time());
			$cashTablePlayerObj->setCheckoutAt(null);
			$cashTablePlayerObj->setCashOut(0);
	    	$cashTablePlayerObj->save($con);
			
			$this->setPlayers($this->getPlayers()+1);
			$this->save($con);
			
			$con->commit();
			
			return true;
		}catch(Exception $e){
			
			$con->rollback();
			return false;
		}
	}
	
	public function getPlayerList(){
		
		$criteria = new Criteria();
		$criteria->add( CashTablePlayerPeer::CHECKOUT_AT, null );
		$criteria->add( CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $this->getCashTableSessionId() );
		$criteria->addAscendingOrderByColumn( CashTablePlayerPeer::TABLE_POSITION );
		return $this->getCashTablePlayerListJoinPeople();
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
	
	public function getInfo(){
		
		$infoList = array();
		$infoList['players']          = $this->getPlayers();
		$infoList['totalBuyin']       = $this->getTotalBuyin();
		$infoList['totalEntranceFee'] = $this->getTotalEntranceFee();
		$infoList['currentValue']     = $this->getCurrentValue();
		
		return $infoList;
	}
}
