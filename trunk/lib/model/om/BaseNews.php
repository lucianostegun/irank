<?php


abstract class BaseNews extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $news_date;


	
	protected $news_title;


	
	protected $internal_link;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collNewsI18nList;

	
	protected $lastNewsI18nCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getNewsDate($format = 'Y-m-d')
	{

		if ($this->news_date === null || $this->news_date === '') {
			return null;
		} elseif (!is_int($this->news_date)) {
						$ts = strtotime($this->news_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [news_date] as date/time value: " . var_export($this->news_date, true));
			}
		} else {
			$ts = $this->news_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getNewsTitle()
	{

		return $this->news_title;
	}

	
	public function getInternalLink()
	{

		return $this->internal_link;
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
			$this->modifiedColumns[] = NewsPeer::ID;
		}

	} 
	
	public function setNewsDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [news_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->news_date !== $ts) {
			$this->news_date = $ts;
			$this->modifiedColumns[] = NewsPeer::NEWS_DATE;
		}

	} 
	
	public function setNewsTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->news_title !== $v) {
			$this->news_title = $v;
			$this->modifiedColumns[] = NewsPeer::NEWS_TITLE;
		}

	} 
	
	public function setInternalLink($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->internal_link !== $v) {
			$this->internal_link = $v;
			$this->modifiedColumns[] = NewsPeer::INTERNAL_LINK;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = NewsPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = NewsPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = NewsPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = NewsPeer::LOCKED;
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
			$this->modifiedColumns[] = NewsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = NewsPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->news_date = $rs->getDate($startcol + 1, null);

			$this->news_title = $rs->getString($startcol + 2);

			$this->internal_link = $rs->getString($startcol + 3);

			$this->enabled = $rs->getBoolean($startcol + 4);

			$this->visible = $rs->getBoolean($startcol + 5);

			$this->deleted = $rs->getBoolean($startcol + 6);

			$this->locked = $rs->getBoolean($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating News object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NewsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			NewsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(NewsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(NewsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NewsPeer::DATABASE_NAME);
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
					$pk = NewsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += NewsPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collNewsI18nList !== null) {
				foreach($this->collNewsI18nList as $referrerFK) {
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


			if (($retval = NewsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collNewsI18nList !== null) {
					foreach($this->collNewsI18nList as $referrerFK) {
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
		$pos = NewsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getNewsDate();
				break;
			case 2:
				return $this->getNewsTitle();
				break;
			case 3:
				return $this->getInternalLink();
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
				return $this->getLocked();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NewsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getNewsDate(),
			$keys[2]=>$this->getNewsTitle(),
			$keys[3]=>$this->getInternalLink(),
			$keys[4]=>$this->getEnabled(),
			$keys[5]=>$this->getVisible(),
			$keys[6]=>$this->getDeleted(),
			$keys[7]=>$this->getLocked(),
			$keys[8]=>$this->getCreatedAt(),
			$keys[9]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NewsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setNewsDate($value);
				break;
			case 2:
				$this->setNewsTitle($value);
				break;
			case 3:
				$this->setInternalLink($value);
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
				$this->setLocked($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NewsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNewsDate($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNewsTitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setInternalLink($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEnabled($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setVisible($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDeleted($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLocked($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(NewsPeer::DATABASE_NAME);

		if ($this->isColumnModified(NewsPeer::ID)) $criteria->add(NewsPeer::ID, $this->id);
		if ($this->isColumnModified(NewsPeer::NEWS_DATE)) $criteria->add(NewsPeer::NEWS_DATE, $this->news_date);
		if ($this->isColumnModified(NewsPeer::NEWS_TITLE)) $criteria->add(NewsPeer::NEWS_TITLE, $this->news_title);
		if ($this->isColumnModified(NewsPeer::INTERNAL_LINK)) $criteria->add(NewsPeer::INTERNAL_LINK, $this->internal_link);
		if ($this->isColumnModified(NewsPeer::ENABLED)) $criteria->add(NewsPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(NewsPeer::VISIBLE)) $criteria->add(NewsPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(NewsPeer::DELETED)) $criteria->add(NewsPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(NewsPeer::LOCKED)) $criteria->add(NewsPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(NewsPeer::CREATED_AT)) $criteria->add(NewsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(NewsPeer::UPDATED_AT)) $criteria->add(NewsPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(NewsPeer::DATABASE_NAME);

		$criteria->add(NewsPeer::ID, $this->id);

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

		$copyObj->setNewsDate($this->news_date);

		$copyObj->setNewsTitle($this->news_title);

		$copyObj->setInternalLink($this->internal_link);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getNewsI18nList() as $relObj) {
				$copyObj->addNewsI18n($relObj->copy($deepCopy));
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
			self::$peer = new NewsPeer();
		}
		return self::$peer;
	}

	
	public function initNewsI18nList()
	{
		if ($this->collNewsI18nList === null) {
			$this->collNewsI18nList = array();
		}
	}

	
	public function getNewsI18nList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNewsI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNewsI18nList === null) {
			if ($this->isNew()) {
			   $this->collNewsI18nList = array();
			} else {

				$criteria->add(NewsI18nPeer::NEWS_ID, $this->getId());

				NewsI18nPeer::addSelectColumns($criteria);
				$this->collNewsI18nList = NewsI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NewsI18nPeer::NEWS_ID, $this->getId());

				NewsI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastNewsI18nCriteria) || !$this->lastNewsI18nCriteria->equals($criteria)) {
					$this->collNewsI18nList = NewsI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNewsI18nCriteria = $criteria;
		return $this->collNewsI18nList;
	}

	
	public function countNewsI18nList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseNewsI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(NewsI18nPeer::NEWS_ID, $this->getId());

		return NewsI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNewsI18n(NewsI18n $l)
	{
		$this->collNewsI18nList[] = $l;
		$l->setNews($this);
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getNewsTitleI18n()
  {
    $obj = $this->getCurrentNewsI18n();

    return ($obj ? $obj->getNewsTitleI18n() : null);
  }

  public function setNewsTitleI18n($value)
  {
    $this->getCurrentNewsI18n()->setNewsTitleI18n($value);
  }

  public function getDescriptionI18n()
  {
    $obj = $this->getCurrentNewsI18n();

    return ($obj ? $obj->getDescriptionI18n() : null);
  }

  public function setDescriptionI18n($value)
  {
    $this->getCurrentNewsI18n()->setDescriptionI18n($value);
  }

  protected $current_i18n = array();

  public function getCurrentNewsI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = NewsI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setNewsI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setNewsI18nForCulture(new NewsI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setNewsI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addNewsI18n($object);
  }

} 