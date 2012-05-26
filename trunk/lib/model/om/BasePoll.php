<?php


abstract class BasePoll extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $question;


	
	protected $poll_image;


	
	protected $locked;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collPollAnswerList;

	
	protected $lastPollAnswerCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getQuestion()
	{

		return $this->question;
	}

	
	public function getPollImage()
	{

		return $this->poll_image;
	}

	
	public function getLocked()
	{

		return $this->locked;
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
			$this->modifiedColumns[] = PollPeer::ID;
		}

	} 
	
	public function setQuestion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->question !== $v) {
			$this->question = $v;
			$this->modifiedColumns[] = PollPeer::QUESTION;
		}

	} 
	
	public function setPollImage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->poll_image !== $v) {
			$this->poll_image = $v;
			$this->modifiedColumns[] = PollPeer::POLL_IMAGE;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = PollPeer::LOCKED;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = PollPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = PollPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = PollPeer::DELETED;
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
			$this->modifiedColumns[] = PollPeer::CREATED_AT;
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
			$this->modifiedColumns[] = PollPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->question = $rs->getString($startcol + 1);

			$this->poll_image = $rs->getString($startcol + 2);

			$this->locked = $rs->getBoolean($startcol + 3);

			$this->enabled = $rs->getBoolean($startcol + 4);

			$this->visible = $rs->getBoolean($startcol + 5);

			$this->deleted = $rs->getBoolean($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Poll object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PollPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PollPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PollPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PollPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PollPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PollPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PollPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPollAnswerList !== null) {
				foreach($this->collPollAnswerList as $referrerFK) {
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


			if (($retval = PollPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPollAnswerList !== null) {
					foreach($this->collPollAnswerList as $referrerFK) {
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
		$pos = PollPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPollImage();
				break;
			case 3:
				return $this->getLocked();
				break;
			case 4:
				return $this->getEnabled();
				break;
			case 5:
				return $this->getVisible();
				break;
			case 6:
				return $this->getDeleted();
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
		$keys = PollPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getQuestion(),
			$keys[2]=>$this->getPollImage(),
			$keys[3]=>$this->getLocked(),
			$keys[4]=>$this->getEnabled(),
			$keys[5]=>$this->getVisible(),
			$keys[6]=>$this->getDeleted(),
			$keys[7]=>$this->getCreatedAt(),
			$keys[8]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PollPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPollImage($value);
				break;
			case 3:
				$this->setLocked($value);
				break;
			case 4:
				$this->setEnabled($value);
				break;
			case 5:
				$this->setVisible($value);
				break;
			case 6:
				$this->setDeleted($value);
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
		$keys = PollPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setQuestion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPollImage($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLocked($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEnabled($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setVisible($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDeleted($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PollPeer::DATABASE_NAME);

		if ($this->isColumnModified(PollPeer::ID)) $criteria->add(PollPeer::ID, $this->id);
		if ($this->isColumnModified(PollPeer::QUESTION)) $criteria->add(PollPeer::QUESTION, $this->question);
		if ($this->isColumnModified(PollPeer::POLL_IMAGE)) $criteria->add(PollPeer::POLL_IMAGE, $this->poll_image);
		if ($this->isColumnModified(PollPeer::LOCKED)) $criteria->add(PollPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(PollPeer::ENABLED)) $criteria->add(PollPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(PollPeer::VISIBLE)) $criteria->add(PollPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(PollPeer::DELETED)) $criteria->add(PollPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(PollPeer::CREATED_AT)) $criteria->add(PollPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PollPeer::UPDATED_AT)) $criteria->add(PollPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PollPeer::DATABASE_NAME);

		$criteria->add(PollPeer::ID, $this->id);

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

		$copyObj->setPollImage($this->poll_image);

		$copyObj->setLocked($this->locked);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPollAnswerList() as $relObj) {
				$copyObj->addPollAnswer($relObj->copy($deepCopy));
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
			self::$peer = new PollPeer();
		}
		return self::$peer;
	}

	
	public function initPollAnswerList()
	{
		if ($this->collPollAnswerList === null) {
			$this->collPollAnswerList = array();
		}
	}

	
	public function getPollAnswerList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePollAnswerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPollAnswerList === null) {
			if ($this->isNew()) {
			   $this->collPollAnswerList = array();
			} else {

				$criteria->add(PollAnswerPeer::POLL_ID, $this->getId());

				PollAnswerPeer::addSelectColumns($criteria);
				$this->collPollAnswerList = PollAnswerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PollAnswerPeer::POLL_ID, $this->getId());

				PollAnswerPeer::addSelectColumns($criteria);
				if (!isset($this->lastPollAnswerCriteria) || !$this->lastPollAnswerCriteria->equals($criteria)) {
					$this->collPollAnswerList = PollAnswerPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPollAnswerCriteria = $criteria;
		return $this->collPollAnswerList;
	}

	
	public function countPollAnswerList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePollAnswerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PollAnswerPeer::POLL_ID, $this->getId());

		return PollAnswerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPollAnswer(PollAnswer $l)
	{
		$this->collPollAnswerList[] = $l;
		$l->setPoll($this);
	}

} 