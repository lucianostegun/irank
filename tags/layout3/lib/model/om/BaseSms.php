<?php


abstract class BaseSms extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $club_id;


	
	protected $people_id;


	
	protected $token;


	
	protected $text_message;


	
	protected $total_messages = 0;


	
	protected $success_messages = 0;


	
	protected $error_messages = 0;


	
	protected $class_name;


	
	protected $object_id;


	
	protected $created_at;

	
	protected $aClub;

	
	protected $aPeople;

	
	protected $collEventLivePlayerDisclosureSmsList;

	
	protected $lastEventLivePlayerDisclosureSmsCriteria = null;

	
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

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getToken()
	{

		return $this->token;
	}

	
	public function getTextMessage()
	{

		return $this->text_message;
	}

	
	public function getTotalMessages()
	{

		return $this->total_messages;
	}

	
	public function getSuccessMessages()
	{

		return $this->success_messages;
	}

	
	public function getErrorMessages()
	{

		return $this->error_messages;
	}

	
	public function getClassName()
	{

		return $this->class_name;
	}

	
	public function getObjectId()
	{

		return $this->object_id;
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
	
	public function setClubId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->club_id !== $v) {
			$this->club_id = $v;
			$this->modifiedColumns[] = SmsPeer::CLUB_ID;
		}

		if ($this->aClub !== null && $this->aClub->getId() !== $v) {
			$this->aClub = null;
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
	
	public function setToken($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->token !== $v) {
			$this->token = $v;
			$this->modifiedColumns[] = SmsPeer::TOKEN;
		}

	} 
	
	public function setTextMessage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->text_message !== $v) {
			$this->text_message = $v;
			$this->modifiedColumns[] = SmsPeer::TEXT_MESSAGE;
		}

	} 
	
	public function setTotalMessages($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_messages !== $v || $v === 0) {
			$this->total_messages = $v;
			$this->modifiedColumns[] = SmsPeer::TOTAL_MESSAGES;
		}

	} 
	
	public function setSuccessMessages($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->success_messages !== $v || $v === 0) {
			$this->success_messages = $v;
			$this->modifiedColumns[] = SmsPeer::SUCCESS_MESSAGES;
		}

	} 
	
	public function setErrorMessages($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->error_messages !== $v || $v === 0) {
			$this->error_messages = $v;
			$this->modifiedColumns[] = SmsPeer::ERROR_MESSAGES;
		}

	} 
	
	public function setClassName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->class_name !== $v) {
			$this->class_name = $v;
			$this->modifiedColumns[] = SmsPeer::CLASS_NAME;
		}

	} 
	
	public function setObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->object_id !== $v) {
			$this->object_id = $v;
			$this->modifiedColumns[] = SmsPeer::OBJECT_ID;
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

			$this->club_id = $rs->getInt($startcol + 1);

			$this->people_id = $rs->getInt($startcol + 2);

			$this->token = $rs->getString($startcol + 3);

			$this->text_message = $rs->getString($startcol + 4);

			$this->total_messages = $rs->getInt($startcol + 5);

			$this->success_messages = $rs->getInt($startcol + 6);

			$this->error_messages = $rs->getInt($startcol + 7);

			$this->class_name = $rs->getString($startcol + 8);

			$this->object_id = $rs->getInt($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
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


												
			if ($this->aClub !== null) {
				if ($this->aClub->isModified()) {
					$affectedRows += $this->aClub->save($con);
				}
				$this->setClub($this->aClub);
			}

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


												
			if ($this->aClub !== null) {
				if (!$this->aClub->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aClub->getValidationFailures());
				}
			}

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
				return $this->getClubId();
				break;
			case 2:
				return $this->getPeopleId();
				break;
			case 3:
				return $this->getToken();
				break;
			case 4:
				return $this->getTextMessage();
				break;
			case 5:
				return $this->getTotalMessages();
				break;
			case 6:
				return $this->getSuccessMessages();
				break;
			case 7:
				return $this->getErrorMessages();
				break;
			case 8:
				return $this->getClassName();
				break;
			case 9:
				return $this->getObjectId();
				break;
			case 10:
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
			$keys[1]=>$this->getClubId(),
			$keys[2]=>$this->getPeopleId(),
			$keys[3]=>$this->getToken(),
			$keys[4]=>$this->getTextMessage(),
			$keys[5]=>$this->getTotalMessages(),
			$keys[6]=>$this->getSuccessMessages(),
			$keys[7]=>$this->getErrorMessages(),
			$keys[8]=>$this->getClassName(),
			$keys[9]=>$this->getObjectId(),
			$keys[10]=>$this->getCreatedAt(),
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
				$this->setClubId($value);
				break;
			case 2:
				$this->setPeopleId($value);
				break;
			case 3:
				$this->setToken($value);
				break;
			case 4:
				$this->setTextMessage($value);
				break;
			case 5:
				$this->setTotalMessages($value);
				break;
			case 6:
				$this->setSuccessMessages($value);
				break;
			case 7:
				$this->setErrorMessages($value);
				break;
			case 8:
				$this->setClassName($value);
				break;
			case 9:
				$this->setObjectId($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SmsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setClubId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPeopleId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setToken($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTextMessage($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTotalMessages($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSuccessMessages($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setErrorMessages($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setClassName($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setObjectId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SmsPeer::DATABASE_NAME);

		if ($this->isColumnModified(SmsPeer::ID)) $criteria->add(SmsPeer::ID, $this->id);
		if ($this->isColumnModified(SmsPeer::CLUB_ID)) $criteria->add(SmsPeer::CLUB_ID, $this->club_id);
		if ($this->isColumnModified(SmsPeer::PEOPLE_ID)) $criteria->add(SmsPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(SmsPeer::TOKEN)) $criteria->add(SmsPeer::TOKEN, $this->token);
		if ($this->isColumnModified(SmsPeer::TEXT_MESSAGE)) $criteria->add(SmsPeer::TEXT_MESSAGE, $this->text_message);
		if ($this->isColumnModified(SmsPeer::TOTAL_MESSAGES)) $criteria->add(SmsPeer::TOTAL_MESSAGES, $this->total_messages);
		if ($this->isColumnModified(SmsPeer::SUCCESS_MESSAGES)) $criteria->add(SmsPeer::SUCCESS_MESSAGES, $this->success_messages);
		if ($this->isColumnModified(SmsPeer::ERROR_MESSAGES)) $criteria->add(SmsPeer::ERROR_MESSAGES, $this->error_messages);
		if ($this->isColumnModified(SmsPeer::CLASS_NAME)) $criteria->add(SmsPeer::CLASS_NAME, $this->class_name);
		if ($this->isColumnModified(SmsPeer::OBJECT_ID)) $criteria->add(SmsPeer::OBJECT_ID, $this->object_id);
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

		$copyObj->setClubId($this->club_id);

		$copyObj->setPeopleId($this->people_id);

		$copyObj->setToken($this->token);

		$copyObj->setTextMessage($this->text_message);

		$copyObj->setTotalMessages($this->total_messages);

		$copyObj->setSuccessMessages($this->success_messages);

		$copyObj->setErrorMessages($this->error_messages);

		$copyObj->setClassName($this->class_name);

		$copyObj->setObjectId($this->object_id);

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