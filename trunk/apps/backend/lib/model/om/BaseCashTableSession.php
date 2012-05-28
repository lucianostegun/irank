<?php


abstract class BaseCashTableSession extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $cash_table_id;


	
	protected $opened_at;


	
	protected $closed_at;


	
	protected $user_admin_id_open;


	
	protected $user_admin_id_close;


	
	protected $total_players;


	
	protected $total_dealers;


	
	protected $dealer_start_position;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aCashTable;

	
	protected $aUserAdminRelatedByUserAdminIdOpen;

	
	protected $aUserAdminRelatedByUserAdminIdClose;

	
	protected $collCashTableList;

	
	protected $lastCashTableCriteria = null;

	
	protected $collCashTablePlayerList;

	
	protected $lastCashTablePlayerCriteria = null;

	
	protected $collCashTableDealerList;

	
	protected $lastCashTableDealerCriteria = null;

	
	protected $collCashTablePlayerBuyinList;

	
	protected $lastCashTablePlayerBuyinCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCashTableId()
	{

		return $this->cash_table_id;
	}

	
	public function getOpenedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->opened_at === null || $this->opened_at === '') {
			return null;
		} elseif (!is_int($this->opened_at)) {
						$ts = strtotime($this->opened_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [opened_at] as date/time value: " . var_export($this->opened_at, true));
			}
		} else {
			$ts = $this->opened_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getClosedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->closed_at === null || $this->closed_at === '') {
			return null;
		} elseif (!is_int($this->closed_at)) {
						$ts = strtotime($this->closed_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [closed_at] as date/time value: " . var_export($this->closed_at, true));
			}
		} else {
			$ts = $this->closed_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUserAdminIdOpen()
	{

		return $this->user_admin_id_open;
	}

	
	public function getUserAdminIdClose()
	{

		return $this->user_admin_id_close;
	}

	
	public function getTotalPlayers()
	{

		return $this->total_players;
	}

	
	public function getTotalDealers()
	{

		return $this->total_dealers;
	}

	
	public function getDealerStartPosition()
	{

		return $this->dealer_start_position;
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
			$this->modifiedColumns[] = CashTableSessionPeer::ID;
		}

	} 
	
	public function setCashTableId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cash_table_id !== $v) {
			$this->cash_table_id = $v;
			$this->modifiedColumns[] = CashTableSessionPeer::CASH_TABLE_ID;
		}

		if ($this->aCashTable !== null && $this->aCashTable->getId() !== $v) {
			$this->aCashTable = null;
		}

	} 
	
	public function setOpenedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [opened_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->opened_at !== $ts) {
			$this->opened_at = $ts;
			$this->modifiedColumns[] = CashTableSessionPeer::OPENED_AT;
		}

	} 
	
	public function setClosedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [closed_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->closed_at !== $ts) {
			$this->closed_at = $ts;
			$this->modifiedColumns[] = CashTableSessionPeer::CLOSED_AT;
		}

	} 
	
	public function setUserAdminIdOpen($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_admin_id_open !== $v) {
			$this->user_admin_id_open = $v;
			$this->modifiedColumns[] = CashTableSessionPeer::USER_ADMIN_ID_OPEN;
		}

		if ($this->aUserAdminRelatedByUserAdminIdOpen !== null && $this->aUserAdminRelatedByUserAdminIdOpen->getId() !== $v) {
			$this->aUserAdminRelatedByUserAdminIdOpen = null;
		}

	} 
	
	public function setUserAdminIdClose($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_admin_id_close !== $v) {
			$this->user_admin_id_close = $v;
			$this->modifiedColumns[] = CashTableSessionPeer::USER_ADMIN_ID_CLOSE;
		}

		if ($this->aUserAdminRelatedByUserAdminIdClose !== null && $this->aUserAdminRelatedByUserAdminIdClose->getId() !== $v) {
			$this->aUserAdminRelatedByUserAdminIdClose = null;
		}

	} 
	
	public function setTotalPlayers($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_players !== $v) {
			$this->total_players = $v;
			$this->modifiedColumns[] = CashTableSessionPeer::TOTAL_PLAYERS;
		}

	} 
	
	public function setTotalDealers($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_dealers !== $v) {
			$this->total_dealers = $v;
			$this->modifiedColumns[] = CashTableSessionPeer::TOTAL_DEALERS;
		}

	} 
	
	public function setDealerStartPosition($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->dealer_start_position !== $v) {
			$this->dealer_start_position = $v;
			$this->modifiedColumns[] = CashTableSessionPeer::DEALER_START_POSITION;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = CashTableSessionPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = CashTableSessionPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = CashTableSessionPeer::DELETED;
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
			$this->modifiedColumns[] = CashTableSessionPeer::CREATED_AT;
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
			$this->modifiedColumns[] = CashTableSessionPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->cash_table_id = $rs->getInt($startcol + 1);

			$this->opened_at = $rs->getTimestamp($startcol + 2, null);

			$this->closed_at = $rs->getTimestamp($startcol + 3, null);

			$this->user_admin_id_open = $rs->getInt($startcol + 4);

			$this->user_admin_id_close = $rs->getInt($startcol + 5);

			$this->total_players = $rs->getInt($startcol + 6);

			$this->total_dealers = $rs->getInt($startcol + 7);

			$this->dealer_start_position = $rs->getInt($startcol + 8);

			$this->enabled = $rs->getBoolean($startcol + 9);

			$this->visible = $rs->getBoolean($startcol + 10);

			$this->deleted = $rs->getBoolean($startcol + 11);

			$this->created_at = $rs->getTimestamp($startcol + 12, null);

			$this->updated_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CashTableSession object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CashTableSessionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CashTableSessionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(CashTableSessionPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(CashTableSessionPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CashTableSessionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aCashTable !== null) {
				if ($this->aCashTable->isModified()) {
					$affectedRows += $this->aCashTable->save($con);
				}
				$this->setCashTable($this->aCashTable);
			}

			if ($this->aUserAdminRelatedByUserAdminIdOpen !== null) {
				if ($this->aUserAdminRelatedByUserAdminIdOpen->isModified()) {
					$affectedRows += $this->aUserAdminRelatedByUserAdminIdOpen->save($con);
				}
				$this->setUserAdminRelatedByUserAdminIdOpen($this->aUserAdminRelatedByUserAdminIdOpen);
			}

			if ($this->aUserAdminRelatedByUserAdminIdClose !== null) {
				if ($this->aUserAdminRelatedByUserAdminIdClose->isModified()) {
					$affectedRows += $this->aUserAdminRelatedByUserAdminIdClose->save($con);
				}
				$this->setUserAdminRelatedByUserAdminIdClose($this->aUserAdminRelatedByUserAdminIdClose);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CashTableSessionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CashTableSessionPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collCashTableList !== null) {
				foreach($this->collCashTableList as $referrerFK) {
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


												
			if ($this->aCashTable !== null) {
				if (!$this->aCashTable->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCashTable->getValidationFailures());
				}
			}

			if ($this->aUserAdminRelatedByUserAdminIdOpen !== null) {
				if (!$this->aUserAdminRelatedByUserAdminIdOpen->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserAdminRelatedByUserAdminIdOpen->getValidationFailures());
				}
			}

			if ($this->aUserAdminRelatedByUserAdminIdClose !== null) {
				if (!$this->aUserAdminRelatedByUserAdminIdClose->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserAdminRelatedByUserAdminIdClose->getValidationFailures());
				}
			}


			if (($retval = CashTableSessionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCashTableList !== null) {
					foreach($this->collCashTableList as $referrerFK) {
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CashTableSessionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCashTableId();
				break;
			case 2:
				return $this->getOpenedAt();
				break;
			case 3:
				return $this->getClosedAt();
				break;
			case 4:
				return $this->getUserAdminIdOpen();
				break;
			case 5:
				return $this->getUserAdminIdClose();
				break;
			case 6:
				return $this->getTotalPlayers();
				break;
			case 7:
				return $this->getTotalDealers();
				break;
			case 8:
				return $this->getDealerStartPosition();
				break;
			case 9:
				return $this->getEnabled();
				break;
			case 10:
				return $this->getVisible();
				break;
			case 11:
				return $this->getDeleted();
				break;
			case 12:
				return $this->getCreatedAt();
				break;
			case 13:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CashTableSessionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getCashTableId(),
			$keys[2]=>$this->getOpenedAt(),
			$keys[3]=>$this->getClosedAt(),
			$keys[4]=>$this->getUserAdminIdOpen(),
			$keys[5]=>$this->getUserAdminIdClose(),
			$keys[6]=>$this->getTotalPlayers(),
			$keys[7]=>$this->getTotalDealers(),
			$keys[8]=>$this->getDealerStartPosition(),
			$keys[9]=>$this->getEnabled(),
			$keys[10]=>$this->getVisible(),
			$keys[11]=>$this->getDeleted(),
			$keys[12]=>$this->getCreatedAt(),
			$keys[13]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CashTableSessionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCashTableId($value);
				break;
			case 2:
				$this->setOpenedAt($value);
				break;
			case 3:
				$this->setClosedAt($value);
				break;
			case 4:
				$this->setUserAdminIdOpen($value);
				break;
			case 5:
				$this->setUserAdminIdClose($value);
				break;
			case 6:
				$this->setTotalPlayers($value);
				break;
			case 7:
				$this->setTotalDealers($value);
				break;
			case 8:
				$this->setDealerStartPosition($value);
				break;
			case 9:
				$this->setEnabled($value);
				break;
			case 10:
				$this->setVisible($value);
				break;
			case 11:
				$this->setDeleted($value);
				break;
			case 12:
				$this->setCreatedAt($value);
				break;
			case 13:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CashTableSessionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCashTableId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setOpenedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setClosedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUserAdminIdOpen($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUserAdminIdClose($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTotalPlayers($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTotalDealers($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDealerStartPosition($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEnabled($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setVisible($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setDeleted($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CashTableSessionPeer::DATABASE_NAME);

		if ($this->isColumnModified(CashTableSessionPeer::ID)) $criteria->add(CashTableSessionPeer::ID, $this->id);
		if ($this->isColumnModified(CashTableSessionPeer::CASH_TABLE_ID)) $criteria->add(CashTableSessionPeer::CASH_TABLE_ID, $this->cash_table_id);
		if ($this->isColumnModified(CashTableSessionPeer::OPENED_AT)) $criteria->add(CashTableSessionPeer::OPENED_AT, $this->opened_at);
		if ($this->isColumnModified(CashTableSessionPeer::CLOSED_AT)) $criteria->add(CashTableSessionPeer::CLOSED_AT, $this->closed_at);
		if ($this->isColumnModified(CashTableSessionPeer::USER_ADMIN_ID_OPEN)) $criteria->add(CashTableSessionPeer::USER_ADMIN_ID_OPEN, $this->user_admin_id_open);
		if ($this->isColumnModified(CashTableSessionPeer::USER_ADMIN_ID_CLOSE)) $criteria->add(CashTableSessionPeer::USER_ADMIN_ID_CLOSE, $this->user_admin_id_close);
		if ($this->isColumnModified(CashTableSessionPeer::TOTAL_PLAYERS)) $criteria->add(CashTableSessionPeer::TOTAL_PLAYERS, $this->total_players);
		if ($this->isColumnModified(CashTableSessionPeer::TOTAL_DEALERS)) $criteria->add(CashTableSessionPeer::TOTAL_DEALERS, $this->total_dealers);
		if ($this->isColumnModified(CashTableSessionPeer::DEALER_START_POSITION)) $criteria->add(CashTableSessionPeer::DEALER_START_POSITION, $this->dealer_start_position);
		if ($this->isColumnModified(CashTableSessionPeer::ENABLED)) $criteria->add(CashTableSessionPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(CashTableSessionPeer::VISIBLE)) $criteria->add(CashTableSessionPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(CashTableSessionPeer::DELETED)) $criteria->add(CashTableSessionPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(CashTableSessionPeer::CREATED_AT)) $criteria->add(CashTableSessionPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(CashTableSessionPeer::UPDATED_AT)) $criteria->add(CashTableSessionPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CashTableSessionPeer::DATABASE_NAME);

		$criteria->add(CashTableSessionPeer::ID, $this->id);

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

		$copyObj->setCashTableId($this->cash_table_id);

		$copyObj->setOpenedAt($this->opened_at);

		$copyObj->setClosedAt($this->closed_at);

		$copyObj->setUserAdminIdOpen($this->user_admin_id_open);

		$copyObj->setUserAdminIdClose($this->user_admin_id_close);

		$copyObj->setTotalPlayers($this->total_players);

		$copyObj->setTotalDealers($this->total_dealers);

		$copyObj->setDealerStartPosition($this->dealer_start_position);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getCashTableList() as $relObj) {
				$copyObj->addCashTable($relObj->copy($deepCopy));
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
			self::$peer = new CashTableSessionPeer();
		}
		return self::$peer;
	}

	
	public function setCashTable($v)
	{


		if ($v === null) {
			$this->setCashTableId(NULL);
		} else {
			$this->setCashTableId($v->getId());
		}


		$this->aCashTable = $v;
	}


	
	public function getCashTable($con = null)
	{
		if ($this->aCashTable === null && ($this->cash_table_id !== null)) {
						include_once 'apps/backend/lib/model/om/BaseCashTablePeer.php';

			$this->aCashTable = CashTablePeer::retrieveByPK($this->cash_table_id, $con);

			
		}
		return $this->aCashTable;
	}

	
	public function setUserAdminRelatedByUserAdminIdOpen($v)
	{


		if ($v === null) {
			$this->setUserAdminIdOpen(NULL);
		} else {
			$this->setUserAdminIdOpen($v->getId());
		}


		$this->aUserAdminRelatedByUserAdminIdOpen = $v;
	}


	
	public function getUserAdminRelatedByUserAdminIdOpen($con = null)
	{
		if ($this->aUserAdminRelatedByUserAdminIdOpen === null && ($this->user_admin_id_open !== null)) {
						include_once 'apps/backend/lib/model/om/BaseUserAdminPeer.php';

			$this->aUserAdminRelatedByUserAdminIdOpen = UserAdminPeer::retrieveByPK($this->user_admin_id_open, $con);

			
		}
		return $this->aUserAdminRelatedByUserAdminIdOpen;
	}

	
	public function setUserAdminRelatedByUserAdminIdClose($v)
	{


		if ($v === null) {
			$this->setUserAdminIdClose(NULL);
		} else {
			$this->setUserAdminIdClose($v->getId());
		}


		$this->aUserAdminRelatedByUserAdminIdClose = $v;
	}


	
	public function getUserAdminRelatedByUserAdminIdClose($con = null)
	{
		if ($this->aUserAdminRelatedByUserAdminIdClose === null && ($this->user_admin_id_close !== null)) {
						include_once 'apps/backend/lib/model/om/BaseUserAdminPeer.php';

			$this->aUserAdminRelatedByUserAdminIdClose = UserAdminPeer::retrieveByPK($this->user_admin_id_close, $con);

			
		}
		return $this->aUserAdminRelatedByUserAdminIdClose;
	}

	
	public function initCashTableList()
	{
		if ($this->collCashTableList === null) {
			$this->collCashTableList = array();
		}
	}

	
	public function getCashTableList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableList === null) {
			if ($this->isNew()) {
			   $this->collCashTableList = array();
			} else {

				$criteria->add(CashTablePeer::CASH_TABLE_SESSION_ID, $this->getId());

				CashTablePeer::addSelectColumns($criteria);
				$this->collCashTableList = CashTablePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CashTablePeer::CASH_TABLE_SESSION_ID, $this->getId());

				CashTablePeer::addSelectColumns($criteria);
				if (!isset($this->lastCashTableCriteria) || !$this->lastCashTableCriteria->equals($criteria)) {
					$this->collCashTableList = CashTablePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCashTableCriteria = $criteria;
		return $this->collCashTableList;
	}

	
	public function countCashTableList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CashTablePeer::CASH_TABLE_SESSION_ID, $this->getId());

		return CashTablePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCashTable(CashTable $l)
	{
		$this->collCashTableList[] = $l;
		$l->setCashTableSession($this);
	}


	
	public function getCashTableListJoinClub($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableList === null) {
			if ($this->isNew()) {
				$this->collCashTableList = array();
			} else {

				$criteria->add(CashTablePeer::CASH_TABLE_SESSION_ID, $this->getId());

				$this->collCashTableList = CashTablePeer::doSelectJoinClub($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePeer::CASH_TABLE_SESSION_ID, $this->getId());

			if (!isset($this->lastCashTableCriteria) || !$this->lastCashTableCriteria->equals($criteria)) {
				$this->collCashTableList = CashTablePeer::doSelectJoinClub($criteria, $con);
			}
		}
		$this->lastCashTableCriteria = $criteria;

		return $this->collCashTableList;
	}


	
	public function getCashTableListJoinPeople($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableList === null) {
			if ($this->isNew()) {
				$this->collCashTableList = array();
			} else {

				$criteria->add(CashTablePeer::CASH_TABLE_SESSION_ID, $this->getId());

				$this->collCashTableList = CashTablePeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePeer::CASH_TABLE_SESSION_ID, $this->getId());

			if (!isset($this->lastCashTableCriteria) || !$this->lastCashTableCriteria->equals($criteria)) {
				$this->collCashTableList = CashTablePeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastCashTableCriteria = $criteria;

		return $this->collCashTableList;
	}


	
	public function getCashTableListJoinVirtualTable($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableList === null) {
			if ($this->isNew()) {
				$this->collCashTableList = array();
			} else {

				$criteria->add(CashTablePeer::CASH_TABLE_SESSION_ID, $this->getId());

				$this->collCashTableList = CashTablePeer::doSelectJoinVirtualTable($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePeer::CASH_TABLE_SESSION_ID, $this->getId());

			if (!isset($this->lastCashTableCriteria) || !$this->lastCashTableCriteria->equals($criteria)) {
				$this->collCashTableList = CashTablePeer::doSelectJoinVirtualTable($criteria, $con);
			}
		}
		$this->lastCashTableCriteria = $criteria;

		return $this->collCashTableList;
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

				$criteria->add(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $this->getId());

				CashTablePlayerPeer::addSelectColumns($criteria);
				$this->collCashTablePlayerList = CashTablePlayerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $this->getId());

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

		$criteria->add(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $this->getId());

		return CashTablePlayerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCashTablePlayer(CashTablePlayer $l)
	{
		$this->collCashTablePlayerList[] = $l;
		$l->setCashTableSession($this);
	}


	
	public function getCashTablePlayerListJoinCashTable($criteria = null, $con = null)
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

				$criteria->add(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $this->getId());

				$this->collCashTablePlayerList = CashTablePlayerPeer::doSelectJoinCashTable($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerCriteria) || !$this->lastCashTablePlayerCriteria->equals($criteria)) {
				$this->collCashTablePlayerList = CashTablePlayerPeer::doSelectJoinCashTable($criteria, $con);
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

				$criteria->add(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $this->getId());

				$this->collCashTablePlayerList = CashTablePlayerPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $this->getId());

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

				$criteria->add(CashTableDealerPeer::CASH_TABLE_SESSION_ID, $this->getId());

				CashTableDealerPeer::addSelectColumns($criteria);
				$this->collCashTableDealerList = CashTableDealerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CashTableDealerPeer::CASH_TABLE_SESSION_ID, $this->getId());

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

		$criteria->add(CashTableDealerPeer::CASH_TABLE_SESSION_ID, $this->getId());

		return CashTableDealerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCashTableDealer(CashTableDealer $l)
	{
		$this->collCashTableDealerList[] = $l;
		$l->setCashTableSession($this);
	}


	
	public function getCashTableDealerListJoinCashTable($criteria = null, $con = null)
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

				$criteria->add(CashTableDealerPeer::CASH_TABLE_SESSION_ID, $this->getId());

				$this->collCashTableDealerList = CashTableDealerPeer::doSelectJoinCashTable($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTableDealerPeer::CASH_TABLE_SESSION_ID, $this->getId());

			if (!isset($this->lastCashTableDealerCriteria) || !$this->lastCashTableDealerCriteria->equals($criteria)) {
				$this->collCashTableDealerList = CashTableDealerPeer::doSelectJoinCashTable($criteria, $con);
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

				$criteria->add(CashTableDealerPeer::CASH_TABLE_SESSION_ID, $this->getId());

				$this->collCashTableDealerList = CashTableDealerPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTableDealerPeer::CASH_TABLE_SESSION_ID, $this->getId());

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

				$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $this->getId());

				CashTablePlayerBuyinPeer::addSelectColumns($criteria);
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $this->getId());

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

		$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $this->getId());

		return CashTablePlayerBuyinPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCashTablePlayerBuyin(CashTablePlayerBuyin $l)
	{
		$this->collCashTablePlayerBuyinList[] = $l;
		$l->setCashTableSession($this);
	}


	
	public function getCashTablePlayerBuyinListJoinCashTable($criteria = null, $con = null)
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

				$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $this->getId());

				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinCashTable($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerBuyinCriteria) || !$this->lastCashTablePlayerBuyinCriteria->equals($criteria)) {
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinCashTable($criteria, $con);
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

				$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $this->getId());

				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerBuyinCriteria) || !$this->lastCashTablePlayerBuyinCriteria->equals($criteria)) {
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastCashTablePlayerBuyinCriteria = $criteria;

		return $this->collCashTablePlayerBuyinList;
	}

} 