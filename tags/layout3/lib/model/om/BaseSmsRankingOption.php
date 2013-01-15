<?php


abstract class BaseSmsRankingOption extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $people_id;


	
	protected $ranking_id;


	
	protected $sms_template_id;


	
	protected $lock_send;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aPeople;

	
	protected $aRanking;

	
	protected $aSmsTemplate;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getRankingId()
	{

		return $this->ranking_id;
	}

	
	public function getSmsTemplateId()
	{

		return $this->sms_template_id;
	}

	
	public function getLockSend()
	{

		return $this->lock_send;
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

	
	public function setPeopleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = SmsRankingOptionPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setRankingId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_id !== $v) {
			$this->ranking_id = $v;
			$this->modifiedColumns[] = SmsRankingOptionPeer::RANKING_ID;
		}

		if ($this->aRanking !== null && $this->aRanking->getId() !== $v) {
			$this->aRanking = null;
		}

	} 
	
	public function setSmsTemplateId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sms_template_id !== $v) {
			$this->sms_template_id = $v;
			$this->modifiedColumns[] = SmsRankingOptionPeer::SMS_TEMPLATE_ID;
		}

		if ($this->aSmsTemplate !== null && $this->aSmsTemplate->getId() !== $v) {
			$this->aSmsTemplate = null;
		}

	} 
	
	public function setLockSend($v)
	{

		if ($this->lock_send !== $v) {
			$this->lock_send = $v;
			$this->modifiedColumns[] = SmsRankingOptionPeer::LOCK_SEND;
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
			$this->modifiedColumns[] = SmsRankingOptionPeer::CREATED_AT;
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
			$this->modifiedColumns[] = SmsRankingOptionPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->people_id = $rs->getInt($startcol + 0);

			$this->ranking_id = $rs->getInt($startcol + 1);

			$this->sms_template_id = $rs->getInt($startcol + 2);

			$this->lock_send = $rs->getBoolean($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SmsRankingOption object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SmsRankingOptionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SmsRankingOptionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SmsRankingOptionPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SmsRankingOptionPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(SmsRankingOptionPeer::DATABASE_NAME);

		$tableName = SmsRankingOptionPeer::TABLE_NAME;
		
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

			if ($this->aRanking !== null) {
				if ($this->aRanking->isModified()) {
					$affectedRows += $this->aRanking->save($con);
				}
				$this->setRanking($this->aRanking);
			}

			if ($this->aSmsTemplate !== null) {
				if ($this->aSmsTemplate->isModified()) {
					$affectedRows += $this->aSmsTemplate->save($con);
				}
				$this->setSmsTemplate($this->aSmsTemplate);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SmsRankingOptionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SmsRankingOptionPeer::doUpdate($this, $con);
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


												
			if ($this->aPeople !== null) {
				if (!$this->aPeople->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPeople->getValidationFailures());
				}
			}

			if ($this->aRanking !== null) {
				if (!$this->aRanking->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRanking->getValidationFailures());
				}
			}

			if ($this->aSmsTemplate !== null) {
				if (!$this->aSmsTemplate->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSmsTemplate->getValidationFailures());
				}
			}


			if (($retval = SmsRankingOptionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SmsRankingOptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getPeopleId();
				break;
			case 1:
				return $this->getRankingId();
				break;
			case 2:
				return $this->getSmsTemplateId();
				break;
			case 3:
				return $this->getLockSend();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SmsRankingOptionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getPeopleId(),
			$keys[1]=>$this->getRankingId(),
			$keys[2]=>$this->getSmsTemplateId(),
			$keys[3]=>$this->getLockSend(),
			$keys[4]=>$this->getCreatedAt(),
			$keys[5]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SmsRankingOptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setPeopleId($value);
				break;
			case 1:
				$this->setRankingId($value);
				break;
			case 2:
				$this->setSmsTemplateId($value);
				break;
			case 3:
				$this->setLockSend($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SmsRankingOptionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setPeopleId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRankingId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSmsTemplateId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLockSend($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SmsRankingOptionPeer::DATABASE_NAME);

		if ($this->isColumnModified(SmsRankingOptionPeer::PEOPLE_ID)) $criteria->add(SmsRankingOptionPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(SmsRankingOptionPeer::RANKING_ID)) $criteria->add(SmsRankingOptionPeer::RANKING_ID, $this->ranking_id);
		if ($this->isColumnModified(SmsRankingOptionPeer::SMS_TEMPLATE_ID)) $criteria->add(SmsRankingOptionPeer::SMS_TEMPLATE_ID, $this->sms_template_id);
		if ($this->isColumnModified(SmsRankingOptionPeer::LOCK_SEND)) $criteria->add(SmsRankingOptionPeer::LOCK_SEND, $this->lock_send);
		if ($this->isColumnModified(SmsRankingOptionPeer::CREATED_AT)) $criteria->add(SmsRankingOptionPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SmsRankingOptionPeer::UPDATED_AT)) $criteria->add(SmsRankingOptionPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SmsRankingOptionPeer::DATABASE_NAME);

		$criteria->add(SmsRankingOptionPeer::PEOPLE_ID, $this->people_id);
		$criteria->add(SmsRankingOptionPeer::RANKING_ID, $this->ranking_id);
		$criteria->add(SmsRankingOptionPeer::SMS_TEMPLATE_ID, $this->sms_template_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getPeopleId();

		$pks[1] = $this->getRankingId();

		$pks[2] = $this->getSmsTemplateId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setPeopleId($keys[0]);

		$this->setRankingId($keys[1]);

		$this->setSmsTemplateId($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setLockSend($this->lock_send);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setPeopleId(NULL); 
		$copyObj->setRankingId(NULL); 
		$copyObj->setSmsTemplateId(NULL); 
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
			self::$peer = new SmsRankingOptionPeer();
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

	
	public function setRanking($v)
	{


		if ($v === null) {
			$this->setRankingId(NULL);
		} else {
			$this->setRankingId($v->getId());
		}


		$this->aRanking = $v;
	}


	
	public function getRanking($con = null)
	{
		if ($this->aRanking === null && ($this->ranking_id !== null)) {
						include_once 'lib/model/om/BaseRankingPeer.php';

			$this->aRanking = RankingPeer::retrieveByPK($this->ranking_id, $con);

			
		}
		return $this->aRanking;
	}

	
	public function setSmsTemplate($v)
	{


		if ($v === null) {
			$this->setSmsTemplateId(NULL);
		} else {
			$this->setSmsTemplateId($v->getId());
		}


		$this->aSmsTemplate = $v;
	}


	
	public function getSmsTemplate($con = null)
	{
		if ($this->aSmsTemplate === null && ($this->sms_template_id !== null)) {
						include_once 'lib/model/om/BaseSmsTemplatePeer.php';

			$this->aSmsTemplate = SmsTemplatePeer::retrieveByPK($this->sms_template_id, $con);

			
		}
		return $this->aSmsTemplate;
	}

} 