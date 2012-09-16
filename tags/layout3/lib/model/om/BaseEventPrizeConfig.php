<?php


abstract class BaseEventPrizeConfig extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $event_id;


	
	protected $event_position;


	
	protected $prize_value;


	
	protected $is_percent;

	
	protected $aEvent;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getEventId()
	{

		return $this->event_id;
	}

	
	public function getEventPosition()
	{

		return $this->event_position;
	}

	
	public function getPrizeValue()
	{

		return $this->prize_value;
	}

	
	public function getIsPercent()
	{

		return $this->is_percent;
	}

	
	public function setEventId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_id !== $v) {
			$this->event_id = $v;
			$this->modifiedColumns[] = EventPrizeConfigPeer::EVENT_ID;
		}

		if ($this->aEvent !== null && $this->aEvent->getId() !== $v) {
			$this->aEvent = null;
		}

	} 
	
	public function setEventPosition($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_position !== $v) {
			$this->event_position = $v;
			$this->modifiedColumns[] = EventPrizeConfigPeer::EVENT_POSITION;
		}

	} 
	
	public function setPrizeValue($v)
	{

		if ($this->prize_value !== $v) {
			$this->prize_value = $v;
			$this->modifiedColumns[] = EventPrizeConfigPeer::PRIZE_VALUE;
		}

	} 
	
	public function setIsPercent($v)
	{

		if ($this->is_percent !== $v) {
			$this->is_percent = $v;
			$this->modifiedColumns[] = EventPrizeConfigPeer::IS_PERCENT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->event_id = $rs->getInt($startcol + 0);

			$this->event_position = $rs->getInt($startcol + 1);

			$this->prize_value = $rs->getFloat($startcol + 2);

			$this->is_percent = $rs->getBoolean($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EventPrizeConfig object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventPrizeConfigPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventPrizeConfigPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventPrizeConfigPeer::DATABASE_NAME);
		}

		$tableName = EventPrizeConfigPeer::TABLE_NAME;
		
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


												
			if ($this->aEvent !== null) {
				if ($this->aEvent->isModified()) {
					$affectedRows += $this->aEvent->save($con);
				}
				$this->setEvent($this->aEvent);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventPrizeConfigPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += EventPrizeConfigPeer::doUpdate($this, $con);
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


												
			if ($this->aEvent !== null) {
				if (!$this->aEvent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEvent->getValidationFailures());
				}
			}


			if (($retval = EventPrizeConfigPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventPrizeConfigPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getEventId();
				break;
			case 1:
				return $this->getEventPosition();
				break;
			case 2:
				return $this->getPrizeValue();
				break;
			case 3:
				return $this->getIsPercent();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventPrizeConfigPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getEventId(),
			$keys[1]=>$this->getEventPosition(),
			$keys[2]=>$this->getPrizeValue(),
			$keys[3]=>$this->getIsPercent(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventPrizeConfigPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setEventId($value);
				break;
			case 1:
				$this->setEventPosition($value);
				break;
			case 2:
				$this->setPrizeValue($value);
				break;
			case 3:
				$this->setIsPercent($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventPrizeConfigPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setEventId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEventPosition($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPrizeValue($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsPercent($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventPrizeConfigPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventPrizeConfigPeer::EVENT_ID)) $criteria->add(EventPrizeConfigPeer::EVENT_ID, $this->event_id);
		if ($this->isColumnModified(EventPrizeConfigPeer::EVENT_POSITION)) $criteria->add(EventPrizeConfigPeer::EVENT_POSITION, $this->event_position);
		if ($this->isColumnModified(EventPrizeConfigPeer::PRIZE_VALUE)) $criteria->add(EventPrizeConfigPeer::PRIZE_VALUE, $this->prize_value);
		if ($this->isColumnModified(EventPrizeConfigPeer::IS_PERCENT)) $criteria->add(EventPrizeConfigPeer::IS_PERCENT, $this->is_percent);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventPrizeConfigPeer::DATABASE_NAME);

		$criteria->add(EventPrizeConfigPeer::EVENT_ID, $this->event_id);
		$criteria->add(EventPrizeConfigPeer::EVENT_POSITION, $this->event_position);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getEventId();

		$pks[1] = $this->getEventPosition();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setEventId($keys[0]);

		$this->setEventPosition($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPrizeValue($this->prize_value);

		$copyObj->setIsPercent($this->is_percent);


		$copyObj->setNew(true);

		$copyObj->setEventId(NULL); 
		$copyObj->setEventPosition(NULL); 
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
			self::$peer = new EventPrizeConfigPeer();
		}
		return self::$peer;
	}

	
	public function setEvent($v)
	{


		if ($v === null) {
			$this->setEventId(NULL);
		} else {
			$this->setEventId($v->getId());
		}


		$this->aEvent = $v;
	}


	
	public function getEvent($con = null)
	{
		if ($this->aEvent === null && ($this->event_id !== null)) {
						include_once 'lib/model/om/BaseEventPeer.php';

			$this->aEvent = EventPeer::retrieveByPK($this->event_id, $con);

			
		}
		return $this->aEvent;
	}

} 