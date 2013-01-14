<?php


abstract class BaseEmailMarketingPeople extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $email_marketing_id;


	
	protected $people_id;


	
	protected $email_log_id;


	
	protected $random_code;


	
	protected $created_at;

	
	protected $aEmailMarketing;

	
	protected $aPeople;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getEmailMarketingId()
	{

		return $this->email_marketing_id;
	}

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getEmailLogId()
	{

		return $this->email_log_id;
	}

	
	public function getRandomCode()
	{

		return $this->random_code;
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

	
	public function setEmailMarketingId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->email_marketing_id !== $v) {
			$this->email_marketing_id = $v;
			$this->modifiedColumns[] = EmailMarketingPeoplePeer::EMAIL_MARKETING_ID;
		}

		if ($this->aEmailMarketing !== null && $this->aEmailMarketing->getId() !== $v) {
			$this->aEmailMarketing = null;
		}

	} 
	
	public function setPeopleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = EmailMarketingPeoplePeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setEmailLogId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->email_log_id !== $v) {
			$this->email_log_id = $v;
			$this->modifiedColumns[] = EmailMarketingPeoplePeer::EMAIL_LOG_ID;
		}

	} 
	
	public function setRandomCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->random_code !== $v) {
			$this->random_code = $v;
			$this->modifiedColumns[] = EmailMarketingPeoplePeer::RANDOM_CODE;
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
			$this->modifiedColumns[] = EmailMarketingPeoplePeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->email_marketing_id = $rs->getInt($startcol + 0);

			$this->people_id = $rs->getInt($startcol + 1);

			$this->email_log_id = $rs->getInt($startcol + 2);

			$this->random_code = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EmailMarketingPeople object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailMarketingPeoplePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EmailMarketingPeoplePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EmailMarketingPeoplePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(EmailMarketingPeoplePeer::DATABASE_NAME);

		$tableName = EmailMarketingPeoplePeer::TABLE_NAME;
		
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


												
			if ($this->aEmailMarketing !== null) {
				if ($this->aEmailMarketing->isModified()) {
					$affectedRows += $this->aEmailMarketing->save($con);
				}
				$this->setEmailMarketing($this->aEmailMarketing);
			}

			if ($this->aPeople !== null) {
				if ($this->aPeople->isModified()) {
					$affectedRows += $this->aPeople->save($con);
				}
				$this->setPeople($this->aPeople);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EmailMarketingPeoplePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += EmailMarketingPeoplePeer::doUpdate($this, $con);
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


												
			if ($this->aEmailMarketing !== null) {
				if (!$this->aEmailMarketing->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEmailMarketing->getValidationFailures());
				}
			}

			if ($this->aPeople !== null) {
				if (!$this->aPeople->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPeople->getValidationFailures());
				}
			}


			if (($retval = EmailMarketingPeoplePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailMarketingPeoplePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getEmailMarketingId();
				break;
			case 1:
				return $this->getPeopleId();
				break;
			case 2:
				return $this->getEmailLogId();
				break;
			case 3:
				return $this->getRandomCode();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailMarketingPeoplePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getEmailMarketingId(),
			$keys[1]=>$this->getPeopleId(),
			$keys[2]=>$this->getEmailLogId(),
			$keys[3]=>$this->getRandomCode(),
			$keys[4]=>$this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailMarketingPeoplePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setEmailMarketingId($value);
				break;
			case 1:
				$this->setPeopleId($value);
				break;
			case 2:
				$this->setEmailLogId($value);
				break;
			case 3:
				$this->setRandomCode($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailMarketingPeoplePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setEmailMarketingId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEmailLogId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRandomCode($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailMarketingPeoplePeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID)) $criteria->add(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, $this->email_marketing_id);
		if ($this->isColumnModified(EmailMarketingPeoplePeer::PEOPLE_ID)) $criteria->add(EmailMarketingPeoplePeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(EmailMarketingPeoplePeer::EMAIL_LOG_ID)) $criteria->add(EmailMarketingPeoplePeer::EMAIL_LOG_ID, $this->email_log_id);
		if ($this->isColumnModified(EmailMarketingPeoplePeer::RANDOM_CODE)) $criteria->add(EmailMarketingPeoplePeer::RANDOM_CODE, $this->random_code);
		if ($this->isColumnModified(EmailMarketingPeoplePeer::CREATED_AT)) $criteria->add(EmailMarketingPeoplePeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EmailMarketingPeoplePeer::DATABASE_NAME);

		$criteria->add(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, $this->email_marketing_id);
		$criteria->add(EmailMarketingPeoplePeer::PEOPLE_ID, $this->people_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getEmailMarketingId();

		$pks[1] = $this->getPeopleId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setEmailMarketingId($keys[0]);

		$this->setPeopleId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setEmailLogId($this->email_log_id);

		$copyObj->setRandomCode($this->random_code);

		$copyObj->setCreatedAt($this->created_at);


		$copyObj->setNew(true);

		$copyObj->setEmailMarketingId(NULL); 
		$copyObj->setPeopleId(NULL); 
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
			self::$peer = new EmailMarketingPeoplePeer();
		}
		return self::$peer;
	}

	
	public function setEmailMarketing($v)
	{


		if ($v === null) {
			$this->setEmailMarketingId(NULL);
		} else {
			$this->setEmailMarketingId($v->getId());
		}


		$this->aEmailMarketing = $v;
	}


	
	public function getEmailMarketing($con = null)
	{
		if ($this->aEmailMarketing === null && ($this->email_marketing_id !== null)) {
						include_once 'apps/backend/lib/model/om/BaseEmailMarketingPeer.php';

			$this->aEmailMarketing = EmailMarketingPeer::retrieveByPK($this->email_marketing_id, $con);

			
		}
		return $this->aEmailMarketing;
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

} 