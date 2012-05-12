<?php


abstract class BaseCashTable extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $club_id;


	
	protected $cash_table_name;


	
	protected $table_status = 'closed';


	
	protected $players = 0;


	
	protected $seats;


	
	protected $entrance_fee;


	
	protected $buyin;


	
	protected $comments;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aClub;

	
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

			$this->cash_table_name = $rs->getString($startcol + 2);

			$this->table_status = $rs->getString($startcol + 3);

			$this->players = $rs->getInt($startcol + 4);

			$this->seats = $rs->getInt($startcol + 5);

			$this->entrance_fee = $rs->getFloat($startcol + 6);

			$this->buyin = $rs->getFloat($startcol + 7);

			$this->comments = $rs->getString($startcol + 8);

			$this->enabled = $rs->getBoolean($startcol + 9);

			$this->visible = $rs->getBoolean($startcol + 10);

			$this->deleted = $rs->getBoolean($startcol + 11);

			$this->locked = $rs->getBoolean($startcol + 12);

			$this->created_at = $rs->getTimestamp($startcol + 13, null);

			$this->updated_at = $rs->getTimestamp($startcol + 14, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 15; 
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


												
			if ($this->aClub !== null) {
				if ($this->aClub->isModified()) {
					$affectedRows += $this->aClub->save($con);
				}
				$this->setClub($this->aClub);
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


			if (($retval = CashTablePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
				return $this->getCashTableName();
				break;
			case 3:
				return $this->getTableStatus();
				break;
			case 4:
				return $this->getPlayers();
				break;
			case 5:
				return $this->getSeats();
				break;
			case 6:
				return $this->getEntranceFee();
				break;
			case 7:
				return $this->getBuyin();
				break;
			case 8:
				return $this->getComments();
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
				return $this->getLocked();
				break;
			case 13:
				return $this->getCreatedAt();
				break;
			case 14:
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
			$keys[2]=>$this->getCashTableName(),
			$keys[3]=>$this->getTableStatus(),
			$keys[4]=>$this->getPlayers(),
			$keys[5]=>$this->getSeats(),
			$keys[6]=>$this->getEntranceFee(),
			$keys[7]=>$this->getBuyin(),
			$keys[8]=>$this->getComments(),
			$keys[9]=>$this->getEnabled(),
			$keys[10]=>$this->getVisible(),
			$keys[11]=>$this->getDeleted(),
			$keys[12]=>$this->getLocked(),
			$keys[13]=>$this->getCreatedAt(),
			$keys[14]=>$this->getUpdatedAt(),
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
				$this->setCashTableName($value);
				break;
			case 3:
				$this->setTableStatus($value);
				break;
			case 4:
				$this->setPlayers($value);
				break;
			case 5:
				$this->setSeats($value);
				break;
			case 6:
				$this->setEntranceFee($value);
				break;
			case 7:
				$this->setBuyin($value);
				break;
			case 8:
				$this->setComments($value);
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
				$this->setLocked($value);
				break;
			case 13:
				$this->setCreatedAt($value);
				break;
			case 14:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CashTablePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setClubId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCashTableName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTableStatus($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPlayers($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSeats($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEntranceFee($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setBuyin($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setComments($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEnabled($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setVisible($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setDeleted($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setLocked($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUpdatedAt($arr[$keys[14]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CashTablePeer::DATABASE_NAME);

		if ($this->isColumnModified(CashTablePeer::ID)) $criteria->add(CashTablePeer::ID, $this->id);
		if ($this->isColumnModified(CashTablePeer::CLUB_ID)) $criteria->add(CashTablePeer::CLUB_ID, $this->club_id);
		if ($this->isColumnModified(CashTablePeer::CASH_TABLE_NAME)) $criteria->add(CashTablePeer::CASH_TABLE_NAME, $this->cash_table_name);
		if ($this->isColumnModified(CashTablePeer::TABLE_STATUS)) $criteria->add(CashTablePeer::TABLE_STATUS, $this->table_status);
		if ($this->isColumnModified(CashTablePeer::PLAYERS)) $criteria->add(CashTablePeer::PLAYERS, $this->players);
		if ($this->isColumnModified(CashTablePeer::SEATS)) $criteria->add(CashTablePeer::SEATS, $this->seats);
		if ($this->isColumnModified(CashTablePeer::ENTRANCE_FEE)) $criteria->add(CashTablePeer::ENTRANCE_FEE, $this->entrance_fee);
		if ($this->isColumnModified(CashTablePeer::BUYIN)) $criteria->add(CashTablePeer::BUYIN, $this->buyin);
		if ($this->isColumnModified(CashTablePeer::COMMENTS)) $criteria->add(CashTablePeer::COMMENTS, $this->comments);
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

		$copyObj->setCashTableName($this->cash_table_name);

		$copyObj->setTableStatus($this->table_status);

		$copyObj->setPlayers($this->players);

		$copyObj->setSeats($this->seats);

		$copyObj->setEntranceFee($this->entrance_fee);

		$copyObj->setBuyin($this->buyin);

		$copyObj->setComments($this->comments);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


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

} 