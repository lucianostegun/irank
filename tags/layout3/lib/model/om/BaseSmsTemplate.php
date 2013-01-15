<?php


abstract class BaseSmsTemplate extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $template_name;


	
	protected $description;


	
	protected $content;


	
	protected $tag_name;


	
	protected $order_seq;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collSmsOptionList;

	
	protected $lastSmsOptionCriteria = null;

	
	protected $collSmsRankingOptionList;

	
	protected $lastSmsRankingOptionCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTemplateName()
	{

		return $this->template_name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getContent()
	{

		return $this->content;
	}

	
	public function getTagName()
	{

		return $this->tag_name;
	}

	
	public function getOrderSeq()
	{

		return $this->order_seq;
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
			$this->modifiedColumns[] = SmsTemplatePeer::ID;
		}

	} 
	
	public function setTemplateName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->template_name !== $v) {
			$this->template_name = $v;
			$this->modifiedColumns[] = SmsTemplatePeer::TEMPLATE_NAME;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = SmsTemplatePeer::DESCRIPTION;
		}

	} 
	
	public function setContent($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = SmsTemplatePeer::CONTENT;
		}

	} 
	
	public function setTagName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag_name !== $v) {
			$this->tag_name = $v;
			$this->modifiedColumns[] = SmsTemplatePeer::TAG_NAME;
		}

	} 
	
	public function setOrderSeq($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->order_seq !== $v) {
			$this->order_seq = $v;
			$this->modifiedColumns[] = SmsTemplatePeer::ORDER_SEQ;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = SmsTemplatePeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = SmsTemplatePeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = SmsTemplatePeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = SmsTemplatePeer::LOCKED;
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
			$this->modifiedColumns[] = SmsTemplatePeer::CREATED_AT;
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
			$this->modifiedColumns[] = SmsTemplatePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->template_name = $rs->getString($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->content = $rs->getString($startcol + 3);

			$this->tag_name = $rs->getString($startcol + 4);

			$this->order_seq = $rs->getInt($startcol + 5);

			$this->enabled = $rs->getBoolean($startcol + 6);

			$this->visible = $rs->getBoolean($startcol + 7);

			$this->deleted = $rs->getBoolean($startcol + 8);

			$this->locked = $rs->getBoolean($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SmsTemplate object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SmsTemplatePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SmsTemplatePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SmsTemplatePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SmsTemplatePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(SmsTemplatePeer::DATABASE_NAME);

		$tableName = SmsTemplatePeer::TABLE_NAME;
		
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SmsTemplatePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SmsTemplatePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collSmsOptionList !== null) {
				foreach($this->collSmsOptionList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSmsRankingOptionList !== null) {
				foreach($this->collSmsRankingOptionList as $referrerFK) {
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


			if (($retval = SmsTemplatePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSmsOptionList !== null) {
					foreach($this->collSmsOptionList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSmsRankingOptionList !== null) {
					foreach($this->collSmsRankingOptionList as $referrerFK) {
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
		$pos = SmsTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTemplateName();
				break;
			case 2:
				return $this->getDescription();
				break;
			case 3:
				return $this->getContent();
				break;
			case 4:
				return $this->getTagName();
				break;
			case 5:
				return $this->getOrderSeq();
				break;
			case 6:
				return $this->getEnabled();
				break;
			case 7:
				return $this->getVisible();
				break;
			case 8:
				return $this->getDeleted();
				break;
			case 9:
				return $this->getLocked();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			case 11:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SmsTemplatePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getTemplateName(),
			$keys[2]=>$this->getDescription(),
			$keys[3]=>$this->getContent(),
			$keys[4]=>$this->getTagName(),
			$keys[5]=>$this->getOrderSeq(),
			$keys[6]=>$this->getEnabled(),
			$keys[7]=>$this->getVisible(),
			$keys[8]=>$this->getDeleted(),
			$keys[9]=>$this->getLocked(),
			$keys[10]=>$this->getCreatedAt(),
			$keys[11]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SmsTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTemplateName($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setContent($value);
				break;
			case 4:
				$this->setTagName($value);
				break;
			case 5:
				$this->setOrderSeq($value);
				break;
			case 6:
				$this->setEnabled($value);
				break;
			case 7:
				$this->setVisible($value);
				break;
			case 8:
				$this->setDeleted($value);
				break;
			case 9:
				$this->setLocked($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
			case 11:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SmsTemplatePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTemplateName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setContent($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTagName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setOrderSeq($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEnabled($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setVisible($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDeleted($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setLocked($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SmsTemplatePeer::DATABASE_NAME);

		if ($this->isColumnModified(SmsTemplatePeer::ID)) $criteria->add(SmsTemplatePeer::ID, $this->id);
		if ($this->isColumnModified(SmsTemplatePeer::TEMPLATE_NAME)) $criteria->add(SmsTemplatePeer::TEMPLATE_NAME, $this->template_name);
		if ($this->isColumnModified(SmsTemplatePeer::DESCRIPTION)) $criteria->add(SmsTemplatePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(SmsTemplatePeer::CONTENT)) $criteria->add(SmsTemplatePeer::CONTENT, $this->content);
		if ($this->isColumnModified(SmsTemplatePeer::TAG_NAME)) $criteria->add(SmsTemplatePeer::TAG_NAME, $this->tag_name);
		if ($this->isColumnModified(SmsTemplatePeer::ORDER_SEQ)) $criteria->add(SmsTemplatePeer::ORDER_SEQ, $this->order_seq);
		if ($this->isColumnModified(SmsTemplatePeer::ENABLED)) $criteria->add(SmsTemplatePeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(SmsTemplatePeer::VISIBLE)) $criteria->add(SmsTemplatePeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(SmsTemplatePeer::DELETED)) $criteria->add(SmsTemplatePeer::DELETED, $this->deleted);
		if ($this->isColumnModified(SmsTemplatePeer::LOCKED)) $criteria->add(SmsTemplatePeer::LOCKED, $this->locked);
		if ($this->isColumnModified(SmsTemplatePeer::CREATED_AT)) $criteria->add(SmsTemplatePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SmsTemplatePeer::UPDATED_AT)) $criteria->add(SmsTemplatePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SmsTemplatePeer::DATABASE_NAME);

		$criteria->add(SmsTemplatePeer::ID, $this->id);

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

		$copyObj->setTemplateName($this->template_name);

		$copyObj->setDescription($this->description);

		$copyObj->setContent($this->content);

		$copyObj->setTagName($this->tag_name);

		$copyObj->setOrderSeq($this->order_seq);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getSmsOptionList() as $relObj) {
				$copyObj->addSmsOption($relObj->copy($deepCopy));
			}

			foreach($this->getSmsRankingOptionList() as $relObj) {
				$copyObj->addSmsRankingOption($relObj->copy($deepCopy));
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
			self::$peer = new SmsTemplatePeer();
		}
		return self::$peer;
	}

	
	public function initSmsOptionList()
	{
		if ($this->collSmsOptionList === null) {
			$this->collSmsOptionList = array();
		}
	}

	
	public function getSmsOptionList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSmsOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSmsOptionList === null) {
			if ($this->isNew()) {
			   $this->collSmsOptionList = array();
			} else {

				$criteria->add(SmsOptionPeer::SMS_TEMPLATE_ID, $this->getId());

				SmsOptionPeer::addSelectColumns($criteria);
				$this->collSmsOptionList = SmsOptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SmsOptionPeer::SMS_TEMPLATE_ID, $this->getId());

				SmsOptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastSmsOptionCriteria) || !$this->lastSmsOptionCriteria->equals($criteria)) {
					$this->collSmsOptionList = SmsOptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSmsOptionCriteria = $criteria;
		return $this->collSmsOptionList;
	}

	
	public function countSmsOptionList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSmsOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SmsOptionPeer::SMS_TEMPLATE_ID, $this->getId());

		return SmsOptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSmsOption(SmsOption $l)
	{
		$this->collSmsOptionList[] = $l;
		$l->setSmsTemplate($this);
	}


	
	public function getSmsOptionListJoinPeople($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSmsOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSmsOptionList === null) {
			if ($this->isNew()) {
				$this->collSmsOptionList = array();
			} else {

				$criteria->add(SmsOptionPeer::SMS_TEMPLATE_ID, $this->getId());

				$this->collSmsOptionList = SmsOptionPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(SmsOptionPeer::SMS_TEMPLATE_ID, $this->getId());

			if (!isset($this->lastSmsOptionCriteria) || !$this->lastSmsOptionCriteria->equals($criteria)) {
				$this->collSmsOptionList = SmsOptionPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastSmsOptionCriteria = $criteria;

		return $this->collSmsOptionList;
	}

	
	public function initSmsRankingOptionList()
	{
		if ($this->collSmsRankingOptionList === null) {
			$this->collSmsRankingOptionList = array();
		}
	}

	
	public function getSmsRankingOptionList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSmsRankingOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSmsRankingOptionList === null) {
			if ($this->isNew()) {
			   $this->collSmsRankingOptionList = array();
			} else {

				$criteria->add(SmsRankingOptionPeer::SMS_TEMPLATE_ID, $this->getId());

				SmsRankingOptionPeer::addSelectColumns($criteria);
				$this->collSmsRankingOptionList = SmsRankingOptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SmsRankingOptionPeer::SMS_TEMPLATE_ID, $this->getId());

				SmsRankingOptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastSmsRankingOptionCriteria) || !$this->lastSmsRankingOptionCriteria->equals($criteria)) {
					$this->collSmsRankingOptionList = SmsRankingOptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSmsRankingOptionCriteria = $criteria;
		return $this->collSmsRankingOptionList;
	}

	
	public function countSmsRankingOptionList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSmsRankingOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SmsRankingOptionPeer::SMS_TEMPLATE_ID, $this->getId());

		return SmsRankingOptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSmsRankingOption(SmsRankingOption $l)
	{
		$this->collSmsRankingOptionList[] = $l;
		$l->setSmsTemplate($this);
	}


	
	public function getSmsRankingOptionListJoinPeople($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSmsRankingOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSmsRankingOptionList === null) {
			if ($this->isNew()) {
				$this->collSmsRankingOptionList = array();
			} else {

				$criteria->add(SmsRankingOptionPeer::SMS_TEMPLATE_ID, $this->getId());

				$this->collSmsRankingOptionList = SmsRankingOptionPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(SmsRankingOptionPeer::SMS_TEMPLATE_ID, $this->getId());

			if (!isset($this->lastSmsRankingOptionCriteria) || !$this->lastSmsRankingOptionCriteria->equals($criteria)) {
				$this->collSmsRankingOptionList = SmsRankingOptionPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastSmsRankingOptionCriteria = $criteria;

		return $this->collSmsRankingOptionList;
	}


	
	public function getSmsRankingOptionListJoinRanking($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSmsRankingOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSmsRankingOptionList === null) {
			if ($this->isNew()) {
				$this->collSmsRankingOptionList = array();
			} else {

				$criteria->add(SmsRankingOptionPeer::SMS_TEMPLATE_ID, $this->getId());

				$this->collSmsRankingOptionList = SmsRankingOptionPeer::doSelectJoinRanking($criteria, $con);
			}
		} else {
									
			$criteria->add(SmsRankingOptionPeer::SMS_TEMPLATE_ID, $this->getId());

			if (!isset($this->lastSmsRankingOptionCriteria) || !$this->lastSmsRankingOptionCriteria->equals($criteria)) {
				$this->collSmsRankingOptionList = SmsRankingOptionPeer::doSelectJoinRanking($criteria, $con);
			}
		}
		$this->lastSmsRankingOptionCriteria = $criteria;

		return $this->collSmsRankingOptionList;
	}

} 