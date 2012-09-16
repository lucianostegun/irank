<?php


abstract class BaseCashTable extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $club_id;


	
	protected $people_id_dealer;


	
	protected $game_type_id;


	
	protected $game_limit_id;


	
	protected $cash_table_name;


	
	protected $table_status = 'closed';


	
	protected $players = 0;


	
	protected $seats;


	
	protected $entrance_fee;


	
	protected $buyin;


	
	protected $comments;


	
	protected $last_opened_at;


	
	protected $cash_table_session_id;


	
	protected $layout_top;


	
	protected $layout_left;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aClub;

	
	protected $aCashTableSession;

	
	protected $aPeople;

	
	protected $aVirtualTableRelatedByGameTypeId;

	
	protected $aVirtualTableRelatedByGameLimitId;

	
	protected $collCashTableSessionList;

	
	protected $lastCashTableSessionCriteria = null;

	
	protected $collCashTablePlayerList;

	
	protected $lastCashTablePlayerCriteria = null;

	
	protected $collCashTableDealerList;

	
	protected $lastCashTableDealerCriteria = null;

	
	protected $collCashTablePlayerBuyinList;

	
	protected $lastCashTablePlayerBuyinCriteria = null;

	
	protected $collClubCheckList;

	
	protected $lastClubCheckCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getClubId()
	{

		return $this->club_id;
	}

	
	public function getPeopleIdDealer()
	{

		return $this->people_id_dealer;
	}

	
	public function getGameTypeId()
	{

		return $this->game_type_id;
	}

	
	public function getGameLimitId()
	{

		return $this->game_limit_id;
	}

	
	public function getCashTableName()
	{

		return $this->cash_table_name;
	}

	
	public function getTableStatus()
	{

		return $this->table_status;
	}

	
	public function getPlayers()
	{

		return $this->players;
	}

	
	public function getSeats()
	{

		return $this->seats;
	}

	
	public function getEntranceFee()
	{

		return $this->entrance_fee;
	}

	
	public function getBuyin()
	{

		return $this->buyin;
	}

	
	public function getComments()
	{

		return $this->comments;
	}

	
	public function getLastOpenedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->last_opened_at === null || $this->last_opened_at === '') {
			return null;
		} elseif (!is_int($this->last_opened_at)) {
						$ts = strtotime($this->last_opened_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [last_opened_at] as date/time value: " . var_export($this->last_opened_at, true));
			}
		} else {
			$ts = $this->last_opened_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getCashTableSessionId()
	{

		return $this->cash_table_session_id;
	}

	
	public function getLayoutTop()
	{

		return $this->layout_top;
	}

	
	public function getLayoutLeft()
	{

		return $this->layout_left;
	}

	
	public function getEnabled()
	{

		return $this->enabled;
	}

	
	public function getVisible()
	{

		return $this->visible;
	}

	
	public function getDeleted()
	{

		return $this->deleted;
	}

	
	public function getLocked()
	{

		return $this->locked;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = CashTablePeer::ID;
		}

	} 
	
	public function setClubId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->club_id !== $v) {
			$this->club_id = $v;
			$this->modifiedColumns[] = CashTablePeer::CLUB_ID;
		}

		if ($this->aClub !== null && $this->aClub->getId() !== $v) {
			$this->aClub = null;
		}

	} 
	
	public function setPeopleIdDealer($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id_dealer !== $v) {
			$this->people_id_dealer = $v;
			$this->modifiedColumns[] = CashTablePeer::PEOPLE_ID_DEALER;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setGameTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->game_type_id !== $v) {
			$this->game_type_id = $v;
			$this->modifiedColumns[] = CashTablePeer::GAME_TYPE_ID;
		}

		if ($this->aVirtualTableRelatedByGameTypeId !== null && $this->aVirtualTableRelatedByGameTypeId->getId() !== $v) {
			$this->aVirtualTableRelatedByGameTypeId = null;
		}

	} 
	
	public function setGameLimitId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->game_limit_id !== $v) {
			$this->game_limit_id = $v;
			$this->modifiedColumns[] = CashTablePeer::GAME_LIMIT_ID;
		}

		if ($this->aVirtualTableRelatedByGameLimitId !== null && $this->aVirtualTableRelatedByGameLimitId->getId() !== $v) {
			$this->aVirtualTableRelatedByGameLimitId = null;
		}

	} 
	
	public function setCashTableName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cash_table_name !== $v) {
			$this->cash_table_name = $v;
			$this->modifiedColumns[] = CashTablePeer::CASH_TABLE_NAME;
		}

	} 
	
	public function setTableStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->table_status !== $v || $v === 'closed') {
			$this->table_status = $v;
			$this->modifiedColumns[] = CashTablePeer::TABLE_STATUS;
		}

	} 
	
	public function setPlayers($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->players !== $v || $v === 0) {
			$this->players = $v;
			$this->modifiedColumns[] = CashTablePeer::PLAYERS;
		}

	} 
	
	public function setSeats($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->seats !== $v) {
			$this->seats = $v;
			$this->modifiedColumns[] = CashTablePeer::SEATS;
		}

	} 
	
	public function setEntranceFee($v)
	{

		if ($this->entrance_fee !== $v) {
			$this->entrance_fee = $v;
			$this->modifiedColumns[] = CashTablePeer::ENTRANCE_FEE;
		}

	} 
	
	public function setBuyin($v)
	{

		if ($this->buyin !== $v) {
			$this->buyin = $v;
			$this->modifiedColumns[] = CashTablePeer::BUYIN;
		}

	} 
	
	public function setComments($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comments !== $v) {
			$this->comments = $v;
			$this->modifiedColumns[] = CashTablePeer::COMMENTS;
		}

	} 
	
	public function setLastOpenedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [last_opened_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->last_opened_at !== $ts) {
			$this->last_opened_at = $ts;
			$this->modifiedColumns[] = CashTablePeer::LAST_OPENED_AT;
		}

	} 
	
	public function setCashTableSessionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cash_table_session_id !== $v) {
			$this->cash_table_session_id = $v;
			$this->modifiedColumns[] = CashTablePeer::CASH_TABLE_SESSION_ID;
		}

		if ($this->aCashTableSession !== null && $this->aCashTableSession->getId() !== $v) {
			$this->aCashTableSession = null;
		}

	} 
	
	public function setLayoutTop($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->layout_top !== $v) {
			$this->layout_top = $v;
			$this->modifiedColumns[] = CashTablePeer::LAYOUT_TOP;
		}

	} 
	
	public function setLayoutLeft($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->layout_left !== $v) {
			$this->layout_left = $v;
			$this->modifiedColumns[] = CashTablePeer::LAYOUT_LEFT;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = CashTablePeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = CashTablePeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = CashTablePeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = CashTablePeer::LOCKED;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = CashTablePeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = CashTablePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->club_id = $rs->getInt($startcol + 1);

			$this->people_id_dealer = $rs->getInt($startcol + 2);

			$this->game_type_id = $rs->getInt($startcol + 3);

			$this->game_limit_id = $rs->getInt($startcol + 4);

			$this->cash_table_name = $rs->getString($startcol + 5);

			$this->table_status = $rs->getString($startcol + 6);

			$this->players = $rs->getInt($startcol + 7);

			$this->seats = $rs->getInt($startcol + 8);

			$this->entrance_fee = $rs->getFloat($startcol + 9);

			$this->buyin = $rs->getFloat($startcol + 10);

			$this->comments = $rs->getString($startcol + 11);

			$this->last_opened_at = $rs->getTimestamp($startcol + 12, null);

			$this->cash_table_session_id = $rs->getInt($startcol + 13);

			$this->layout_top = $rs->getInt($startcol + 14);

			$this->layout_left = $rs->getInt($startcol + 15);

			$this->enabled = $rs->getBoolean($startcol + 16);

			$this->visible = $rs->getBoolean($startcol + 17);

			$this->deleted = $rs->getBoolean($startcol + 18);

			$this->locked = $rs->getBoolean($startcol + 19);

			$this->created_at = $rs->getTimestamp($startcol + 20, null);

			$this->updated_at = $rs->getTimestamp($startcol + 21, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 22; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CashTable object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CashTablePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CashTablePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(CashTablePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(CashTablePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CashTablePeer::DATABASE_NAME);
		}

		$tableName = CashTablePeer::TABLE_NAME;
		
		try {
			
			if( !preg_match('/log$/', $tableName) )
				$columnModifiedList = Log::getModifiedColumnList($this);
			
			$isNew = $this->isNew();
			
			$con->begin();
			$affectedRows = $this->doSave($con);
			
			if( !preg_match('/log$/', $tableName) ){
			
				if( method_exists($this, 'getDeleted') && $this->getDeleted() )
	        		Log::quickLogDelete($tableName, $this->getPrimaryKey(), get_class($this));
	        	else
	        		Log::quickLog($tableName, $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
		   }
	   
			$con->commit();
			
			return $affectedRows;
		} catch (PropelException $e) {
			
			$con->rollback();
			if( !preg_match('/log$/', $tableName) )
				Log::quickLogError($tableName, $this->getPrimaryKey(), $e);
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aClub !== null) {
				if ($this->aClub->isModified()) {
					$affectedRows += $this->aClub->save($con);
				}
				$this->setClub($this->aClub);
			}

			if ($this->aCashTableSession !== null) {
				if ($this->aCashTableSession->isModified()) {
					$affectedRows += $this->aCashTableSession->save($con);
				}
				$this->setCashTableSession($this->aCashTableSession);
			}

			if ($this->aPeople !== null) {
				if ($this->aPeople->isModified()) {
					$affectedRows += $this->aPeople->save($con);
				}
				$this->setPeople($this->aPeople);
			}

			if ($this->aVirtualTableRelatedByGameTypeId !== null) {
				if ($this->aVirtualTableRelatedByGameTypeId->isModified() || $this->aVirtualTableRelatedByGameTypeId->getCurrentVirtualTableI18n()->isModified()) {
					$affectedRows += $this->aVirtualTableRelatedByGameTypeId->save($con);
				}
				$this->setVirtualTableRelatedByGameTypeId($this->aVirtualTableRelatedByGameTypeId);
			}

			if ($this->aVirtualTableRelatedByGameLimitId !== null) {
				if ($this->aVirtualTableRelatedByGameLimitId->isModified() || $this->aVirtualTableRelatedByGameLimitId->getCurrentVirtualTableI18n()->isModified()) {
					$affectedRows += $this->aVirtualTableRelatedByGameLimitId->save($con);
				}
				$this->setVirtualTableRelatedByGameLimitId($this->aVirtualTableRelatedByGameLimitId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CashTablePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CashTablePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collCashTableSessionList !== null) {
				foreach($this->collCashTableSessionList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCashTablePlayerList !== null) {
				foreach($this->collCashTablePlayerList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCashTableDealerList !== null) {
				foreach($this->collCashTableDealerList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCashTablePlayerBuyinList !== null) {
				foreach($this->collCashTablePlayerBuyinList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClubCheckList !== null) {
				foreach($this->collClubCheckList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aClub !== null) {
				if (!$this->aClub->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aClub->getValidationFailures());
				}
			}

			if ($this->aCashTableSession !== null) {
				if (!$this->aCashTableSession->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCashTableSession->getValidationFailures());
				}
			}

			if ($this->aPeople !== null) {
				if (!$this->aPeople->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPeople->getValidationFailures());
				}
			}

			if ($this->aVirtualTableRelatedByGameTypeId !== null) {
				if (!$this->aVirtualTableRelatedByGameTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVirtualTableRelatedByGameTypeId->getValidationFailures());
				}
			}

			if ($this->aVirtualTableRelatedByGameLimitId !== null) {
				if (!$this->aVirtualTableRelatedByGameLimitId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVirtualTableRelatedByGameLimitId->getValidationFailures());
				}
			}


			if (($retval = CashTablePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCashTableSessionList !== null) {
					foreach($this->collCashTableSessionList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCashTablePlayerList !== null) {
					foreach($this->collCashTablePlayerList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCashTableDealerList !== null) {
					foreach($this->collCashTableDealerList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCashTablePlayerBuyinList !== null) {
					foreach($this->collCashTablePlayerBuyinList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClubCheckList !== null) {
					foreach($this->collClubCheckList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CashTablePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getClubId();
				break;
			case 2:
				return $this->getPeopleIdDealer();
				break;
			case 3:
				return $this->getGameTypeId();
				break;
			case 4:
				return $this->getGameLimitId();
				break;
			case 5:
				return $this->getCashTableName();
				break;
			case 6:
				return $this->getTableStatus();
				break;
			case 7:
				return $this->getPlayers();
				break;
			case 8:
				return $this->getSeats();
				break;
			case 9:
				return $this->getEntranceFee();
				break;
			case 10:
				return $this->getBuyin();
				break;
			case 11:
				return $this->getComments();
				break;
			case 12:
				return $this->getLastOpenedAt();
				break;
			case 13:
				return $this->getCashTableSessionId();
				break;
			case 14:
				return $this->getLayoutTop();
				break;
			case 15:
				return $this->getLayoutLeft();
				break;
			case 16:
				return $this->getEnabled();
				break;
			case 17:
				return $this->getVisible();
				break;
			case 18:
				return $this->getDeleted();
				break;
			case 19:
				return $this->getLocked();
				break;
			case 20:
				return $this->getCreatedAt();
				break;
			case 21:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CashTablePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getClubId(),
			$keys[2]=>$this->getPeopleIdDealer(),
			$keys[3]=>$this->getGameTypeId(),
			$keys[4]=>$this->getGameLimitId(),
			$keys[5]=>$this->getCashTableName(),
			$keys[6]=>$this->getTableStatus(),
			$keys[7]=>$this->getPlayers(),
			$keys[8]=>$this->getSeats(),
			$keys[9]=>$this->getEntranceFee(),
			$keys[10]=>$this->getBuyin(),
			$keys[11]=>$this->getComments(),
			$keys[12]=>$this->getLastOpenedAt(),
			$keys[13]=>$this->getCashTableSessionId(),
			$keys[14]=>$this->getLayoutTop(),
			$keys[15]=>$this->getLayoutLeft(),
			$keys[16]=>$this->getEnabled(),
			$keys[17]=>$this->getVisible(),
			$keys[18]=>$this->getDeleted(),
			$keys[19]=>$this->getLocked(),
			$keys[20]=>$this->getCreatedAt(),
			$keys[21]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CashTablePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setClubId($value);
				break;
			case 2:
				$this->setPeopleIdDealer($value);
				break;
			case 3:
				$this->setGameTypeId($value);
				break;
			case 4:
				$this->setGameLimitId($value);
				break;
			case 5:
				$this->setCashTableName($value);
				break;
			case 6:
				$this->setTableStatus($value);
				break;
			case 7:
				$this->setPlayers($value);
				break;
			case 8:
				$this->setSeats($value);
				break;
			case 9:
				$this->setEntranceFee($value);
				break;
			case 10:
				$this->setBuyin($value);
				break;
			case 11:
				$this->setComments($value);
				break;
			case 12:
				$this->setLastOpenedAt($value);
				break;
			case 13:
				$this->setCashTableSessionId($value);
				break;
			case 14:
				$this->setLayoutTop($value);
				break;
			case 15:
				$this->setLayoutLeft($value);
				break;
			case 16:
				$this->setEnabled($value);
				break;
			case 17:
				$this->setVisible($value);
				break;
			case 18:
				$this->setDeleted($value);
				break;
			case 19:
				$this->setLocked($value);
				break;
			case 20:
				$this->setCreatedAt($value);
				break;
			case 21:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CashTablePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setClubId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPeopleIdDealer($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setGameTypeId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setGameLimitId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCashTableName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTableStatus($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPlayers($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setSeats($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEntranceFee($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setBuyin($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setComments($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setLastOpenedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCashTableSessionId($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setLayoutTop($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setLayoutLeft($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setEnabled($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setVisible($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setDeleted($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setLocked($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCreatedAt($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setUpdatedAt($arr[$keys[21]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CashTablePeer::DATABASE_NAME);

		if ($this->isColumnModified(CashTablePeer::ID)) $criteria->add(CashTablePeer::ID, $this->id);
		if ($this->isColumnModified(CashTablePeer::CLUB_ID)) $criteria->add(CashTablePeer::CLUB_ID, $this->club_id);
		if ($this->isColumnModified(CashTablePeer::PEOPLE_ID_DEALER)) $criteria->add(CashTablePeer::PEOPLE_ID_DEALER, $this->people_id_dealer);
		if ($this->isColumnModified(CashTablePeer::GAME_TYPE_ID)) $criteria->add(CashTablePeer::GAME_TYPE_ID, $this->game_type_id);
		if ($this->isColumnModified(CashTablePeer::GAME_LIMIT_ID)) $criteria->add(CashTablePeer::GAME_LIMIT_ID, $this->game_limit_id);
		if ($this->isColumnModified(CashTablePeer::CASH_TABLE_NAME)) $criteria->add(CashTablePeer::CASH_TABLE_NAME, $this->cash_table_name);
		if ($this->isColumnModified(CashTablePeer::TABLE_STATUS)) $criteria->add(CashTablePeer::TABLE_STATUS, $this->table_status);
		if ($this->isColumnModified(CashTablePeer::PLAYERS)) $criteria->add(CashTablePeer::PLAYERS, $this->players);
		if ($this->isColumnModified(CashTablePeer::SEATS)) $criteria->add(CashTablePeer::SEATS, $this->seats);
		if ($this->isColumnModified(CashTablePeer::ENTRANCE_FEE)) $criteria->add(CashTablePeer::ENTRANCE_FEE, $this->entrance_fee);
		if ($this->isColumnModified(CashTablePeer::BUYIN)) $criteria->add(CashTablePeer::BUYIN, $this->buyin);
		if ($this->isColumnModified(CashTablePeer::COMMENTS)) $criteria->add(CashTablePeer::COMMENTS, $this->comments);
		if ($this->isColumnModified(CashTablePeer::LAST_OPENED_AT)) $criteria->add(CashTablePeer::LAST_OPENED_AT, $this->last_opened_at);
		if ($this->isColumnModified(CashTablePeer::CASH_TABLE_SESSION_ID)) $criteria->add(CashTablePeer::CASH_TABLE_SESSION_ID, $this->cash_table_session_id);
		if ($this->isColumnModified(CashTablePeer::LAYOUT_TOP)) $criteria->add(CashTablePeer::LAYOUT_TOP, $this->layout_top);
		if ($this->isColumnModified(CashTablePeer::LAYOUT_LEFT)) $criteria->add(CashTablePeer::LAYOUT_LEFT, $this->layout_left);
		if ($this->isColumnModified(CashTablePeer::ENABLED)) $criteria->add(CashTablePeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(CashTablePeer::VISIBLE)) $criteria->add(CashTablePeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(CashTablePeer::DELETED)) $criteria->add(CashTablePeer::DELETED, $this->deleted);
		if ($this->isColumnModified(CashTablePeer::LOCKED)) $criteria->add(CashTablePeer::LOCKED, $this->locked);
		if ($this->isColumnModified(CashTablePeer::CREATED_AT)) $criteria->add(CashTablePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(CashTablePeer::UPDATED_AT)) $criteria->add(CashTablePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CashTablePeer::DATABASE_NAME);

		$criteria->add(CashTablePeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setClubId($this->club_id);

		$copyObj->setPeopleIdDealer($this->people_id_dealer);

		$copyObj->setGameTypeId($this->game_type_id);

		$copyObj->setGameLimitId($this->game_limit_id);

		$copyObj->setCashTableName($this->cash_table_name);

		$copyObj->setTableStatus($this->table_status);

		$copyObj->setPlayers($this->players);

		$copyObj->setSeats($this->seats);

		$copyObj->setEntranceFee($this->entrance_fee);

		$copyObj->setBuyin($this->buyin);

		$copyObj->setComments($this->comments);

		$copyObj->setLastOpenedAt($this->last_opened_at);

		$copyObj->setCashTableSessionId($this->cash_table_session_id);

		$copyObj->setLayoutTop($this->layout_top);

		$copyObj->setLayoutLeft($this->layout_left);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getCashTableSessionList() as $relObj) {
				$copyObj->addCashTableSession($relObj->copy($deepCopy));
			}

			foreach($this->getCashTablePlayerList() as $relObj) {
				$copyObj->addCashTablePlayer($relObj->copy($deepCopy));
			}

			foreach($this->getCashTableDealerList() as $relObj) {
				$copyObj->addCashTableDealer($relObj->copy($deepCopy));
			}

			foreach($this->getCashTablePlayerBuyinList() as $relObj) {
				$copyObj->addCashTablePlayerBuyin($relObj->copy($deepCopy));
			}

			foreach($this->getClubCheckList() as $relObj) {
				$copyObj->addClubCheck($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CashTablePeer();
		}
		return self::$peer;
	}

	
	public function setClub($v)
	{


		if ($v === null) {
			$this->setClubId(NULL);
		} else {
			$this->setClubId($v->getId());
		}


		$this->aClub = $v;
	}


	
	public function getClub($con = null)
	{
		if ($this->aClub === null && ($this->club_id !== null)) {
						include_once 'lib/model/om/BaseClubPeer.php';

			$this->aClub = ClubPeer::retrieveByPK($this->club_id, $con);

			
		}
		return $this->aClub;
	}

	
	public function setCashTableSession($v)
	{


		if ($v === null) {
			$this->setCashTableSessionId(NULL);
		} else {
			$this->setCashTableSessionId($v->getId());
		}


		$this->aCashTableSession = $v;
	}


	
	public function getCashTableSession($con = null)
	{
		if ($this->aCashTableSession === null && ($this->cash_table_session_id !== null)) {
						include_once 'apps/backend/lib/model/om/BaseCashTableSessionPeer.php';

			$this->aCashTableSession = CashTableSessionPeer::retrieveByPK($this->cash_table_session_id, $con);

			
		}
		return $this->aCashTableSession;
	}

	
	public function setPeople($v)
	{


		if ($v === null) {
			$this->setPeopleIdDealer(NULL);
		} else {
			$this->setPeopleIdDealer($v->getId());
		}


		$this->aPeople = $v;
	}


	
	public function getPeople($con = null)
	{
		if ($this->aPeople === null && ($this->people_id_dealer !== null)) {
						include_once 'lib/model/om/BasePeoplePeer.php';

			$this->aPeople = PeoplePeer::retrieveByPK($this->people_id_dealer, $con);

			
		}
		return $this->aPeople;
	}

	
	public function setVirtualTableRelatedByGameTypeId($v)
	{


		if ($v === null) {
			$this->setGameTypeId(NULL);
		} else {
			$this->setGameTypeId($v->getId());
		}


		$this->aVirtualTableRelatedByGameTypeId = $v;
	}


	
	public function getVirtualTableRelatedByGameTypeId($con = null)
	{
		if ($this->aVirtualTableRelatedByGameTypeId === null && ($this->game_type_id !== null)) {
						include_once 'lib/model/om/BaseVirtualTablePeer.php';

			$this->aVirtualTableRelatedByGameTypeId = VirtualTablePeer::retrieveByPK($this->game_type_id, $con);

			
		}
		return $this->aVirtualTableRelatedByGameTypeId;
	}

	
	public function setVirtualTableRelatedByGameLimitId($v)
	{


		if ($v === null) {
			$this->setGameLimitId(NULL);
		} else {
			$this->setGameLimitId($v->getId());
		}


		$this->aVirtualTableRelatedByGameLimitId = $v;
	}


	
	public function getVirtualTableRelatedByGameLimitId($con = null)
	{
		if ($this->aVirtualTableRelatedByGameLimitId === null && ($this->game_limit_id !== null)) {
						include_once 'lib/model/om/BaseVirtualTablePeer.php';

			$this->aVirtualTableRelatedByGameLimitId = VirtualTablePeer::retrieveByPK($this->game_limit_id, $con);

			
		}
		return $this->aVirtualTableRelatedByGameLimitId;
	}

	
	public function initCashTableSessionList()
	{
		if ($this->collCashTableSessionList === null) {
			$this->collCashTableSessionList = array();
		}
	}

	
	public function getCashTableSessionList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTableSessionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableSessionList === null) {
			if ($this->isNew()) {
			   $this->collCashTableSessionList = array();
			} else {

				$criteria->add(CashTableSessionPeer::CASH_TABLE_ID, $this->getId());

				CashTableSessionPeer::addSelectColumns($criteria);
				$this->collCashTableSessionList = CashTableSessionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CashTableSessionPeer::CASH_TABLE_ID, $this->getId());

				CashTableSessionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCashTableSessionCriteria) || !$this->lastCashTableSessionCriteria->equals($criteria)) {
					$this->collCashTableSessionList = CashTableSessionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCashTableSessionCriteria = $criteria;
		return $this->collCashTableSessionList;
	}

	
	public function countCashTableSessionList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTableSessionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CashTableSessionPeer::CASH_TABLE_ID, $this->getId());

		return CashTableSessionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCashTableSession(CashTableSession $l)
	{
		$this->collCashTableSessionList[] = $l;
		$l->setCashTable($this);
	}


	
	public function getCashTableSessionListJoinUserAdminRelatedByUserAdminIdOpen($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTableSessionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableSessionList === null) {
			if ($this->isNew()) {
				$this->collCashTableSessionList = array();
			} else {

				$criteria->add(CashTableSessionPeer::CASH_TABLE_ID, $this->getId());

				$this->collCashTableSessionList = CashTableSessionPeer::doSelectJoinUserAdminRelatedByUserAdminIdOpen($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTableSessionPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastCashTableSessionCriteria) || !$this->lastCashTableSessionCriteria->equals($criteria)) {
				$this->collCashTableSessionList = CashTableSessionPeer::doSelectJoinUserAdminRelatedByUserAdminIdOpen($criteria, $con);
			}
		}
		$this->lastCashTableSessionCriteria = $criteria;

		return $this->collCashTableSessionList;
	}


	
	public function getCashTableSessionListJoinUserAdminRelatedByUserAdminIdClose($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTableSessionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableSessionList === null) {
			if ($this->isNew()) {
				$this->collCashTableSessionList = array();
			} else {

				$criteria->add(CashTableSessionPeer::CASH_TABLE_ID, $this->getId());

				$this->collCashTableSessionList = CashTableSessionPeer::doSelectJoinUserAdminRelatedByUserAdminIdClose($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTableSessionPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastCashTableSessionCriteria) || !$this->lastCashTableSessionCriteria->equals($criteria)) {
				$this->collCashTableSessionList = CashTableSessionPeer::doSelectJoinUserAdminRelatedByUserAdminIdClose($criteria, $con);
			}
		}
		$this->lastCashTableSessionCriteria = $criteria;

		return $this->collCashTableSessionList;
	}

	
	public function initCashTablePlayerList()
	{
		if ($this->collCashTablePlayerList === null) {
			$this->collCashTablePlayerList = array();
		}
	}

	
	public function getCashTablePlayerList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerList === null) {
			if ($this->isNew()) {
			   $this->collCashTablePlayerList = array();
			} else {

				$criteria->add(CashTablePlayerPeer::CASH_TABLE_ID, $this->getId());

				CashTablePlayerPeer::addSelectColumns($criteria);
				$this->collCashTablePlayerList = CashTablePlayerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CashTablePlayerPeer::CASH_TABLE_ID, $this->getId());

				CashTablePlayerPeer::addSelectColumns($criteria);
				if (!isset($this->lastCashTablePlayerCriteria) || !$this->lastCashTablePlayerCriteria->equals($criteria)) {
					$this->collCashTablePlayerList = CashTablePlayerPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCashTablePlayerCriteria = $criteria;
		return $this->collCashTablePlayerList;
	}

	
	public function countCashTablePlayerList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CashTablePlayerPeer::CASH_TABLE_ID, $this->getId());

		return CashTablePlayerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCashTablePlayer(CashTablePlayer $l)
	{
		$this->collCashTablePlayerList[] = $l;
		$l->setCashTable($this);
	}


	
	public function getCashTablePlayerListJoinCashTableSession($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerList === null) {
			if ($this->isNew()) {
				$this->collCashTablePlayerList = array();
			} else {

				$criteria->add(CashTablePlayerPeer::CASH_TABLE_ID, $this->getId());

				$this->collCashTablePlayerList = CashTablePlayerPeer::doSelectJoinCashTableSession($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerCriteria) || !$this->lastCashTablePlayerCriteria->equals($criteria)) {
				$this->collCashTablePlayerList = CashTablePlayerPeer::doSelectJoinCashTableSession($criteria, $con);
			}
		}
		$this->lastCashTablePlayerCriteria = $criteria;

		return $this->collCashTablePlayerList;
	}


	
	public function getCashTablePlayerListJoinPeople($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerList === null) {
			if ($this->isNew()) {
				$this->collCashTablePlayerList = array();
			} else {

				$criteria->add(CashTablePlayerPeer::CASH_TABLE_ID, $this->getId());

				$this->collCashTablePlayerList = CashTablePlayerPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerCriteria) || !$this->lastCashTablePlayerCriteria->equals($criteria)) {
				$this->collCashTablePlayerList = CashTablePlayerPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastCashTablePlayerCriteria = $criteria;

		return $this->collCashTablePlayerList;
	}

	
	public function initCashTableDealerList()
	{
		if ($this->collCashTableDealerList === null) {
			$this->collCashTableDealerList = array();
		}
	}

	
	public function getCashTableDealerList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTableDealerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableDealerList === null) {
			if ($this->isNew()) {
			   $this->collCashTableDealerList = array();
			} else {

				$criteria->add(CashTableDealerPeer::CASH_TABLE_ID, $this->getId());

				CashTableDealerPeer::addSelectColumns($criteria);
				$this->collCashTableDealerList = CashTableDealerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CashTableDealerPeer::CASH_TABLE_ID, $this->getId());

				CashTableDealerPeer::addSelectColumns($criteria);
				if (!isset($this->lastCashTableDealerCriteria) || !$this->lastCashTableDealerCriteria->equals($criteria)) {
					$this->collCashTableDealerList = CashTableDealerPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCashTableDealerCriteria = $criteria;
		return $this->collCashTableDealerList;
	}

	
	public function countCashTableDealerList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTableDealerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CashTableDealerPeer::CASH_TABLE_ID, $this->getId());

		return CashTableDealerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCashTableDealer(CashTableDealer $l)
	{
		$this->collCashTableDealerList[] = $l;
		$l->setCashTable($this);
	}


	
	public function getCashTableDealerListJoinCashTableSession($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTableDealerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableDealerList === null) {
			if ($this->isNew()) {
				$this->collCashTableDealerList = array();
			} else {

				$criteria->add(CashTableDealerPeer::CASH_TABLE_ID, $this->getId());

				$this->collCashTableDealerList = CashTableDealerPeer::doSelectJoinCashTableSession($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTableDealerPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastCashTableDealerCriteria) || !$this->lastCashTableDealerCriteria->equals($criteria)) {
				$this->collCashTableDealerList = CashTableDealerPeer::doSelectJoinCashTableSession($criteria, $con);
			}
		}
		$this->lastCashTableDealerCriteria = $criteria;

		return $this->collCashTableDealerList;
	}


	
	public function getCashTableDealerListJoinPeople($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTableDealerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableDealerList === null) {
			if ($this->isNew()) {
				$this->collCashTableDealerList = array();
			} else {

				$criteria->add(CashTableDealerPeer::CASH_TABLE_ID, $this->getId());

				$this->collCashTableDealerList = CashTableDealerPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTableDealerPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastCashTableDealerCriteria) || !$this->lastCashTableDealerCriteria->equals($criteria)) {
				$this->collCashTableDealerList = CashTableDealerPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastCashTableDealerCriteria = $criteria;

		return $this->collCashTableDealerList;
	}

	
	public function initCashTablePlayerBuyinList()
	{
		if ($this->collCashTablePlayerBuyinList === null) {
			$this->collCashTablePlayerBuyinList = array();
		}
	}

	
	public function getCashTablePlayerBuyinList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerBuyinPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerBuyinList === null) {
			if ($this->isNew()) {
			   $this->collCashTablePlayerBuyinList = array();
			} else {

				$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->getId());

				CashTablePlayerBuyinPeer::addSelectColumns($criteria);
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->getId());

				CashTablePlayerBuyinPeer::addSelectColumns($criteria);
				if (!isset($this->lastCashTablePlayerBuyinCriteria) || !$this->lastCashTablePlayerBuyinCriteria->equals($criteria)) {
					$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCashTablePlayerBuyinCriteria = $criteria;
		return $this->collCashTablePlayerBuyinList;
	}

	
	public function countCashTablePlayerBuyinList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerBuyinPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->getId());

		return CashTablePlayerBuyinPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCashTablePlayerBuyin(CashTablePlayerBuyin $l)
	{
		$this->collCashTablePlayerBuyinList[] = $l;
		$l->setCashTable($this);
	}


	
	public function getCashTablePlayerBuyinListJoinCashTableSession($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerBuyinPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerBuyinList === null) {
			if ($this->isNew()) {
				$this->collCashTablePlayerBuyinList = array();
			} else {

				$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->getId());

				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinCashTableSession($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerBuyinCriteria) || !$this->lastCashTablePlayerBuyinCriteria->equals($criteria)) {
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinCashTableSession($criteria, $con);
			}
		}
		$this->lastCashTablePlayerBuyinCriteria = $criteria;

		return $this->collCashTablePlayerBuyinList;
	}


	
	public function getCashTablePlayerBuyinListJoinPeople($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerBuyinPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerBuyinList === null) {
			if ($this->isNew()) {
				$this->collCashTablePlayerBuyinList = array();
			} else {

				$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->getId());

				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerBuyinCriteria) || !$this->lastCashTablePlayerBuyinCriteria->equals($criteria)) {
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastCashTablePlayerBuyinCriteria = $criteria;

		return $this->collCashTablePlayerBuyinList;
	}


	
	public function getCashTablePlayerBuyinListJoinVirtualTable($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerBuyinPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerBuyinList === null) {
			if ($this->isNew()) {
				$this->collCashTablePlayerBuyinList = array();
			} else {

				$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->getId());

				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinVirtualTable($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerBuyinCriteria) || !$this->lastCashTablePlayerBuyinCriteria->equals($criteria)) {
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinVirtualTable($criteria, $con);
			}
		}
		$this->lastCashTablePlayerBuyinCriteria = $criteria;

		return $this->collCashTablePlayerBuyinList;
	}


	
	public function getCashTablePlayerBuyinListJoinClubCheck($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerBuyinPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerBuyinList === null) {
			if ($this->isNew()) {
				$this->collCashTablePlayerBuyinList = array();
			} else {

				$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->getId());

				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinClubCheck($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerBuyinCriteria) || !$this->lastCashTablePlayerBuyinCriteria->equals($criteria)) {
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinClubCheck($criteria, $con);
			}
		}
		$this->lastCashTablePlayerBuyinCriteria = $criteria;

		return $this->collCashTablePlayerBuyinList;
	}


	
	public function getCashTablePlayerBuyinListJoinCashTablePlayer($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerBuyinPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerBuyinList === null) {
			if ($this->isNew()) {
				$this->collCashTablePlayerBuyinList = array();
			} else {

				$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->getId());

				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinCashTablePlayer($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerBuyinCriteria) || !$this->lastCashTablePlayerBuyinCriteria->equals($criteria)) {
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinCashTablePlayer($criteria, $con);
			}
		}
		$this->lastCashTablePlayerBuyinCriteria = $criteria;

		return $this->collCashTablePlayerBuyinList;
	}

	
	public function initClubCheckList()
	{
		if ($this->collClubCheckList === null) {
			$this->collClubCheckList = array();
		}
	}

	
	public function getClubCheckList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseClubCheckPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubCheckList === null) {
			if ($this->isNew()) {
			   $this->collClubCheckList = array();
			} else {

				$criteria->add(ClubCheckPeer::CASH_TABLE_ID, $this->getId());

				ClubCheckPeer::addSelectColumns($criteria);
				$this->collClubCheckList = ClubCheckPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClubCheckPeer::CASH_TABLE_ID, $this->getId());

				ClubCheckPeer::addSelectColumns($criteria);
				if (!isset($this->lastClubCheckCriteria) || !$this->lastClubCheckCriteria->equals($criteria)) {
					$this->collClubCheckList = ClubCheckPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClubCheckCriteria = $criteria;
		return $this->collClubCheckList;
	}

	
	public function countClubCheckList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseClubCheckPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ClubCheckPeer::CASH_TABLE_ID, $this->getId());

		return ClubCheckPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addClubCheck(ClubCheck $l)
	{
		$this->collClubCheckList[] = $l;
		$l->setCashTable($this);
	}


	
	public function getClubCheckListJoinClub($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseClubCheckPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubCheckList === null) {
			if ($this->isNew()) {
				$this->collClubCheckList = array();
			} else {

				$criteria->add(ClubCheckPeer::CASH_TABLE_ID, $this->getId());

				$this->collClubCheckList = ClubCheckPeer::doSelectJoinClub($criteria, $con);
			}
		} else {
									
			$criteria->add(ClubCheckPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastClubCheckCriteria) || !$this->lastClubCheckCriteria->equals($criteria)) {
				$this->collClubCheckList = ClubCheckPeer::doSelectJoinClub($criteria, $con);
			}
		}
		$this->lastClubCheckCriteria = $criteria;

		return $this->collClubCheckList;
	}


	
	public function getClubCheckListJoinCashTableSession($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseClubCheckPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubCheckList === null) {
			if ($this->isNew()) {
				$this->collClubCheckList = array();
			} else {

				$criteria->add(ClubCheckPeer::CASH_TABLE_ID, $this->getId());

				$this->collClubCheckList = ClubCheckPeer::doSelectJoinCashTableSession($criteria, $con);
			}
		} else {
									
			$criteria->add(ClubCheckPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastClubCheckCriteria) || !$this->lastClubCheckCriteria->equals($criteria)) {
				$this->collClubCheckList = ClubCheckPeer::doSelectJoinCashTableSession($criteria, $con);
			}
		}
		$this->lastClubCheckCriteria = $criteria;

		return $this->collClubCheckList;
	}


	
	public function getClubCheckListJoinPeople($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseClubCheckPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubCheckList === null) {
			if ($this->isNew()) {
				$this->collClubCheckList = array();
			} else {

				$criteria->add(ClubCheckPeer::CASH_TABLE_ID, $this->getId());

				$this->collClubCheckList = ClubCheckPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(ClubCheckPeer::CASH_TABLE_ID, $this->getId());

			if (!isset($this->lastClubCheckCriteria) || !$this->lastClubCheckCriteria->equals($criteria)) {
				$this->collClubCheckList = ClubCheckPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastClubCheckCriteria = $criteria;

		return $this->collClubCheckList;
	}

} 