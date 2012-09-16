<?php


abstract class BaseFaq extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $question;


	
	protected $order_seq;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collFaqI18nList;

	
	protected $lastFaqI18nCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getQuestion()
	{

		return $this->question;
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
			$this->modifiedColumns[] = FaqPeer::ID;
		}

	} 
	
	public function setQuestion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->question !== $v) {
			$this->question = $v;
			$this->modifiedColumns[] = FaqPeer::QUESTION;
		}

	} 
	
	public function setOrderSeq($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->order_seq !== $v) {
			$this->order_seq = $v;
			$this->modifiedColumns[] = FaqPeer::ORDER_SEQ;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = FaqPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = FaqPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = FaqPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = FaqPeer::LOCKED;
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
			$this->modifiedColumns[] = FaqPeer::CREATED_AT;
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
			$this->modifiedColumns[] = FaqPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->question = $rs->getString($startcol + 1);

			$this->order_seq = $rs->getInt($startcol + 2);

			$this->enabled = $rs->getBoolean($startcol + 3);

			$this->visible = $rs->getBoolean($startcol + 4);

			$this->deleted = $rs->getBoolean($startcol + 5);

			$this->locked = $rs->getBoolean($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Faq object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FaqPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FaqPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(FaqPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(FaqPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FaqPeer::DATABASE_NAME);
		}

		$tableName = FaqPeer::TABLE_NAME;
		
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FaqPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FaqPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collFaqI18nList !== null) {
				foreach($this->collFaqI18nList as $referrerFK) {
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


			if (($retval = FaqPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFaqI18nList !== null) {
					foreach($this->collFaqI18nList as $referrerFK) {
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
		$pos = FaqPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getQuestion();
				break;
			case 2:
				return $this->getOrderSeq();
				break;
			case 3:
				return $this->getEnabled();
				break;
			case 4:
				return $this->getVisible();
				break;
			case 5:
				return $this->getDeleted();
				break;
			case 6:
				return $this->getLocked();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FaqPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getQuestion(),
			$keys[2]=>$this->getOrderSeq(),
			$keys[3]=>$this->getEnabled(),
			$keys[4]=>$this->getVisible(),
			$keys[5]=>$this->getDeleted(),
			$keys[6]=>$this->getLocked(),
			$keys[7]=>$this->getCreatedAt(),
			$keys[8]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FaqPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setQuestion($value);
				break;
			case 2:
				$this->setOrderSeq($value);
				break;
			case 3:
				$this->setEnabled($value);
				break;
			case 4:
				$this->setVisible($value);
				break;
			case 5:
				$this->setDeleted($value);
				break;
			case 6:
				$this->setLocked($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FaqPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setQuestion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setOrderSeq($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEnabled($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setVisible($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDeleted($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLocked($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FaqPeer::DATABASE_NAME);

		if ($this->isColumnModified(FaqPeer::ID)) $criteria->add(FaqPeer::ID, $this->id);
		if ($this->isColumnModified(FaqPeer::QUESTION)) $criteria->add(FaqPeer::QUESTION, $this->question);
		if ($this->isColumnModified(FaqPeer::ORDER_SEQ)) $criteria->add(FaqPeer::ORDER_SEQ, $this->order_seq);
		if ($this->isColumnModified(FaqPeer::ENABLED)) $criteria->add(FaqPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(FaqPeer::VISIBLE)) $criteria->add(FaqPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(FaqPeer::DELETED)) $criteria->add(FaqPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(FaqPeer::LOCKED)) $criteria->add(FaqPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(FaqPeer::CREATED_AT)) $criteria->add(FaqPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(FaqPeer::UPDATED_AT)) $criteria->add(FaqPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FaqPeer::DATABASE_NAME);

		$criteria->add(FaqPeer::ID, $this->id);

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

		$copyObj->setQuestion($this->question);

		$copyObj->setOrderSeq($this->order_seq);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getFaqI18nList() as $relObj) {
				$copyObj->addFaqI18n($relObj->copy($deepCopy));
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
			self::$peer = new FaqPeer();
		}
		return self::$peer;
	}

	
	public function initFaqI18nList()
	{
		if ($this->collFaqI18nList === null) {
			$this->collFaqI18nList = array();
		}
	}

	
	public function getFaqI18nList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFaqI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFaqI18nList === null) {
			if ($this->isNew()) {
			   $this->collFaqI18nList = array();
			} else {

				$criteria->add(FaqI18nPeer::FAQ_ID, $this->getId());

				FaqI18nPeer::addSelectColumns($criteria);
				$this->collFaqI18nList = FaqI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FaqI18nPeer::FAQ_ID, $this->getId());

				FaqI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastFaqI18nCriteria) || !$this->lastFaqI18nCriteria->equals($criteria)) {
					$this->collFaqI18nList = FaqI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFaqI18nCriteria = $criteria;
		return $this->collFaqI18nList;
	}

	
	public function countFaqI18nList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseFaqI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FaqI18nPeer::FAQ_ID, $this->getId());

		return FaqI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFaqI18n(FaqI18n $l)
	{
		$this->collFaqI18nList[] = $l;
		$l->setFaq($this);
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getQuestionI18n()
  {
    $obj = $this->getCurrentFaqI18n();

    return ($obj ? $obj->getQuestionI18n() : null);
  }

  public function setQuestionI18n($value)
  {
    $this->getCurrentFaqI18n()->setQuestionI18n($value);
  }

  public function getAnswerI18n()
  {
    $obj = $this->getCurrentFaqI18n();

    return ($obj ? $obj->getAnswerI18n() : null);
  }

  public function setAnswerI18n($value)
  {
    $this->getCurrentFaqI18n()->setAnswerI18n($value);
  }

  protected $current_i18n = array();

  public function getCurrentFaqI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = FaqI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setFaqI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setFaqI18nForCulture(new FaqI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setFaqI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addFaqI18n($object);
  }

} 