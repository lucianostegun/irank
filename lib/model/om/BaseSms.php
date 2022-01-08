<?php


abstract class BaseSms extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $people_id;


	
	protected $phone_number;


	
	protected $message;


	
	protected $status_code;


	
	protected $status_message;


	
	protected $message_id;


	
	protected $created_at;

	
	protected $aPeople;

	
	protected $collEventLivePlayerDisclosureSmsList;

	
	protected $lastEventLivePlayerDisclosureSmsCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getPhoneNumber()
	{

		return $this->phone_number;
	}

	
	public function getMessage()
	{

		return $this->message;
	}

	
	public function getStatusCode()
	{

		return $this->status_code;
	}

	
	public function getStatusMessage()
	{

		return $this->status_message;
	}

	
	public function getMessageId()
	{

		return $this->message_id;
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

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SmsPeer::ID;
		}

	} 
	
	public function setPeopleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = SmsPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setPhoneNumber($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->phone_number !== $v) {
			$this->phone_number = $v;
			$this->modifiedColumns[] = SmsPeer::PHONE_NUMBER;
		}

	} 
	
	public function setMessage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->message !== $v) {
			$this->message = $v;
			$this->modifiedColumns[] = SmsPeer::MESSAGE;
		}

	} 
	
	public function setStatusCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->status_code !== $v) {
			$this->status_code = $v;
			$this->modifiedColumns[] = SmsPeer::STATUS_CODE;
		}

	} 
	
	public function setStatusMessage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->status_message !== $v) {
			$this->status_message = $v;
			$this->modifiedColumns[] = SmsPeer::STATUS_MESSAGE;
		}

	} 
	
	public function setMessageId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->message_id !== $v) {
			$this->message_id = $v;
			$this->modifiedColumns[] = SmsPeer::MESSAGE_ID;
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
			$this->modifiedColumns[] = SmsPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->people_id = $rs->getInt($startcol + 1);

			$this->phone_number = $rs->getString($startcol + 2);

			$this->message = $rs->getString($startcol + 3);

			$this->status_code = $rs->getString($startcol + 4);

			$this->status_message = $rs->getString($startcol + 5);

			$this->message_id = $rs->getString($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Sms object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SmsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SmsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SmsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(SmsPeer::DATABASE_NAME);

		$tableName = SmsPeer::TABLE_NAME;
		
		try{
			
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
		}catch(PropelException $e) {
			
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


												
			if ($this->aPeople !== null) {
				if ($this->aPeople->isModified()) {
					$affectedRows += $this->aPeople->save($con);
				}
				$this->setPeople($this->aPeople);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SmsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SmsPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collEventLivePlayerDisclosureSmsList !== null) {
				foreach($this->collEventLivePlayerDisclosureSmsList as $referrerFK) {
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


												
			if ($this->aPeople !== null) {
				if (!$this->aPeople->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPeople->getValidationFailures());
				}
			}


			if (($retval = SmsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEventLivePlayerDisclosureSmsList !== null) {
					foreach($this->collEventLivePlayerDisclosureSmsList as $referrerFK) {
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
		$pos = SmsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPeopleId();
				break;
			case 2:
				return $this->getPhoneNumber();
				break;
			case 3:
				return $this->getMessage();
				break;
			case 4:
				return $this->getStatusCode();
				break;
			case 5:
				return $this->getStatusMessage();
				break;
			case 6:
				return $this->getMessageId();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SmsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getPeopleId(),
			$keys[2]=>$this->getPhoneNumber(),
			$keys[3]=>$this->getMessage(),
			$keys[4]=>$this->getStatusCode(),
			$keys[5]=>$this->getStatusMessage(),
			$keys[6]=>$this->getMessageId(),
			$keys[7]=>$this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SmsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPeopleId($value);
				break;
			case 2:
				$this->setPhoneNumber($value);
				break;
			case 3:
				$this->setMessage($value);
				break;
			case 4:
				$this->setStatusCode($value);
				break;
			case 5:
				$this->setStatusMessage($value);
				break;
			case 6:
				$this->setMessageId($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SmsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPhoneNumber($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMessage($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStatusCode($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setStatusMessage($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setMessageId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SmsPeer::DATABASE_NAME);

		if ($this->isColumnModified(SmsPeer::ID)) $criteria->add(SmsPeer::ID, $this->id);
		if ($this->isColumnModified(SmsPeer::PEOPLE_ID)) $criteria->add(SmsPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(SmsPeer::PHONE_NUMBER)) $criteria->add(SmsPeer::PHONE_NUMBER, $this->phone_number);
		if ($this->isColumnModified(SmsPeer::MESSAGE)) $criteria->add(SmsPeer::MESSAGE, $this->message);
		if ($this->isColumnModified(SmsPeer::STATUS_CODE)) $criteria->add(SmsPeer::STATUS_CODE, $this->status_code);
		if ($this->isColumnModified(SmsPeer::STATUS_MESSAGE)) $criteria->add(SmsPeer::STATUS_MESSAGE, $this->status_message);
		if ($this->isColumnModified(SmsPeer::MESSAGE_ID)) $criteria->add(SmsPeer::MESSAGE_ID, $this->message_id);
		if ($this->isColumnModified(SmsPeer::CREATED_AT)) $criteria->add(SmsPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SmsPeer::DATABASE_NAME);

		$criteria->add(SmsPeer::ID, $this->id);

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

		$copyObj->setPeopleId($this->people_id);

		$copyObj->setPhoneNumber($this->phone_number);

		$copyObj->setMessage($this->message);

		$copyObj->setStatusCode($this->status_code);

		$copyObj->setStatusMessage($this->status_message);

		$copyObj->setMessageId($this->message_id);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEventLivePlayerDisclosureSmsList() as $relObj) {
				$copyObj->addEventLivePlayerDisclosureSms($relObj->copy($deepCopy));
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
			self::$peer = new SmsPeer();
		}
		return self::$peer;
	}

	
	public function setPeople($v)
	{


		if ($v === null) {
			$this->setPeopleId(NULL);
		} else {
			$this->setPeopleId($v->getId());
		}


		$this->aPeople = $v;
	}


	
	public function getPeople($con = null)
	{
		if ($this->aPeople === null && ($this->people_id !== null)) {
						include_once 'lib/model/om/BasePeoplePeer.php';

			$this->aPeople = PeoplePeer::retrieveByPK($this->people_id, $con);

			
		}
		return $this->aPeople;
	}

	
	public function initEventLivePlayerDisclosureSmsList()
	{
		if ($this->collEventLivePlayerDisclosureSmsList === null) {
			$this->collEventLivePlayerDisclosureSmsList = array();
		}
	}

	
	public function getEventLivePlayerDisclosureSmsList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerDisclosureSmsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePlayerDisclosureSmsList === null) {
			if ($this->isNew()) {
			   $this->collEventLivePlayerDisclosureSmsList = array();
			} else {

				$criteria->add(EventLivePlayerDisclosureSmsPeer::SMS_ID, $this->getId());

				EventLivePlayerDisclosureSmsPeer::addSelectColumns($criteria);
				$this->collEventLivePlayerDisclosureSmsList = EventLivePlayerDisclosureSmsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventLivePlayerDisclosureSmsPeer::SMS_ID, $this->getId());

				EventLivePlayerDisclosureSmsPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventLivePlayerDisclosureSmsCriteria) || !$this->lastEventLivePlayerDisclosureSmsCriteria->equals($criteria)) {
					$this->collEventLivePlayerDisclosureSmsList = EventLivePlayerDisclosureSmsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventLivePlayerDisclosureSmsCriteria = $criteria;
		return $this->collEventLivePlayerDisclosureSmsList;
	}

	
	public function countEventLivePlayerDisclosureSmsList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerDisclosureSmsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventLivePlayerDisclosureSmsPeer::SMS_ID, $this->getId());

		return EventLivePlayerDisclosureSmsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventLivePlayerDisclosureSms(EventLivePlayerDisclosureSms $l)
	{
		$this->collEventLivePlayerDisclosureSmsList[] = $l;
		$l->setSms($this);
	}


	
	public function getEventLivePlayerDisclosureSmsListJoinEventLive($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerDisclosureSmsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePlayerDisclosureSmsList === null) {
			if ($this->isNew()) {
				$this->collEventLivePlayerDisclosureSmsList = array();
			} else {

				$criteria->add(EventLivePlayerDisclosureSmsPeer::SMS_ID, $this->getId());

				$this->collEventLivePlayerDisclosureSmsList = EventLivePlayerDisclosureSmsPeer::doSelectJoinEventLive($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePlayerDisclosureSmsPeer::SMS_ID, $this->getId());

			if (!isset($this->lastEventLivePlayerDisclosureSmsCriteria) || !$this->lastEventLivePlayerDisclosureSmsCriteria->equals($criteria)) {
				$this->collEventLivePlayerDisclosureSmsList = EventLivePlayerDisclosureSmsPeer::doSelectJoinEventLive($criteria, $con);
			}
		}
		$this->lastEventLivePlayerDisclosureSmsCriteria = $criteria;

		return $this->collEventLivePlayerDisclosureSmsList;
	}


	
	public function getEventLivePlayerDisclosureSmsListJoinPeople($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerDisclosureSmsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePlayerDisclosureSmsList === null) {
			if ($this->isNew()) {
				$this->collEventLivePlayerDisclosureSmsList = array();
			} else {

				$criteria->add(EventLivePlayerDisclosureSmsPeer::SMS_ID, $this->getId());

				$this->collEventLivePlayerDisclosureSmsList = EventLivePlayerDisclosureSmsPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePlayerDisclosureSmsPeer::SMS_ID, $this->getId());

			if (!isset($this->lastEventLivePlayerDisclosureSmsCriteria) || !$this->lastEventLivePlayerDisclosureSmsCriteria->equals($criteria)) {
				$this->collEventLivePlayerDisclosureSmsList = EventLivePlayerDisclosureSmsPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastEventLivePlayerDisclosureSmsCriteria = $criteria;

		return $this->collEventLivePlayerDisclosureSmsList;
	}

} 