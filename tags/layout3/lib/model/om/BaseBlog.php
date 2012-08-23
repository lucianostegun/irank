<?php


abstract class BaseBlog extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $title;


	
	protected $short_title;


	
	protected $caption;


	
	protected $blog_category_id;


	
	protected $permalink;


	
	protected $tags;


	
	protected $people_id;


	
	protected $content;


	
	protected $glossary;


	
	protected $is_draft = true;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aVirtualTable;

	
	protected $aPeople;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getShortTitle()
	{

		return $this->short_title;
	}

	
	public function getCaption()
	{

		return $this->caption;
	}

	
	public function getBlogCategoryId()
	{

		return $this->blog_category_id;
	}

	
	public function getPermalink()
	{

		return $this->permalink;
	}

	
	public function getTags()
	{

		return $this->tags;
	}

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getContent()
	{

		return $this->content;
	}

	
	public function getGlossary()
	{

		return $this->glossary;
	}

	
	public function getIsDraft()
	{

		return $this->is_draft;
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
			$this->modifiedColumns[] = BlogPeer::ID;
		}

	} 
	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = BlogPeer::TITLE;
		}

	} 
	
	public function setShortTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->short_title !== $v) {
			$this->short_title = $v;
			$this->modifiedColumns[] = BlogPeer::SHORT_TITLE;
		}

	} 
	
	public function setCaption($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->caption !== $v) {
			$this->caption = $v;
			$this->modifiedColumns[] = BlogPeer::CAPTION;
		}

	} 
	
	public function setBlogCategoryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->blog_category_id !== $v) {
			$this->blog_category_id = $v;
			$this->modifiedColumns[] = BlogPeer::BLOG_CATEGORY_ID;
		}

		if ($this->aVirtualTable !== null && $this->aVirtualTable->getId() !== $v) {
			$this->aVirtualTable = null;
		}

	} 
	
	public function setPermalink($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->permalink !== $v) {
			$this->permalink = $v;
			$this->modifiedColumns[] = BlogPeer::PERMALINK;
		}

	} 
	
	public function setTags($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tags !== $v) {
			$this->tags = $v;
			$this->modifiedColumns[] = BlogPeer::TAGS;
		}

	} 
	
	public function setPeopleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = BlogPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setContent($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = BlogPeer::CONTENT;
		}

	} 
	
	public function setGlossary($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->glossary !== $v) {
			$this->glossary = $v;
			$this->modifiedColumns[] = BlogPeer::GLOSSARY;
		}

	} 
	
	public function setIsDraft($v)
	{

		if ($this->is_draft !== $v || $v === true) {
			$this->is_draft = $v;
			$this->modifiedColumns[] = BlogPeer::IS_DRAFT;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = BlogPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = BlogPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = BlogPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = BlogPeer::LOCKED;
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
			$this->modifiedColumns[] = BlogPeer::CREATED_AT;
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
			$this->modifiedColumns[] = BlogPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->short_title = $rs->getString($startcol + 2);

			$this->caption = $rs->getString($startcol + 3);

			$this->blog_category_id = $rs->getInt($startcol + 4);

			$this->permalink = $rs->getString($startcol + 5);

			$this->tags = $rs->getString($startcol + 6);

			$this->people_id = $rs->getInt($startcol + 7);

			$this->content = $rs->getString($startcol + 8);

			$this->glossary = $rs->getString($startcol + 9);

			$this->is_draft = $rs->getBoolean($startcol + 10);

			$this->enabled = $rs->getBoolean($startcol + 11);

			$this->visible = $rs->getBoolean($startcol + 12);

			$this->deleted = $rs->getBoolean($startcol + 13);

			$this->locked = $rs->getBoolean($startcol + 14);

			$this->created_at = $rs->getTimestamp($startcol + 15, null);

			$this->updated_at = $rs->getTimestamp($startcol + 16, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 17; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Blog object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BlogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BlogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(BlogPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(BlogPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BlogPeer::DATABASE_NAME);
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


												
			if ($this->aVirtualTable !== null) {
				if ($this->aVirtualTable->isModified() || $this->aVirtualTable->getCurrentVirtualTableI18n()->isModified()) {
					$affectedRows += $this->aVirtualTable->save($con);
				}
				$this->setVirtualTable($this->aVirtualTable);
			}

			if ($this->aPeople !== null) {
				if ($this->aPeople->isModified()) {
					$affectedRows += $this->aPeople->save($con);
				}
				$this->setPeople($this->aPeople);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = BlogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += BlogPeer::doUpdate($this, $con);
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


												
			if ($this->aVirtualTable !== null) {
				if (!$this->aVirtualTable->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVirtualTable->getValidationFailures());
				}
			}

			if ($this->aPeople !== null) {
				if (!$this->aPeople->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPeople->getValidationFailures());
				}
			}


			if (($retval = BlogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BlogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getShortTitle();
				break;
			case 3:
				return $this->getCaption();
				break;
			case 4:
				return $this->getBlogCategoryId();
				break;
			case 5:
				return $this->getPermalink();
				break;
			case 6:
				return $this->getTags();
				break;
			case 7:
				return $this->getPeopleId();
				break;
			case 8:
				return $this->getContent();
				break;
			case 9:
				return $this->getGlossary();
				break;
			case 10:
				return $this->getIsDraft();
				break;
			case 11:
				return $this->getEnabled();
				break;
			case 12:
				return $this->getVisible();
				break;
			case 13:
				return $this->getDeleted();
				break;
			case 14:
				return $this->getLocked();
				break;
			case 15:
				return $this->getCreatedAt();
				break;
			case 16:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BlogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getTitle(),
			$keys[2]=>$this->getShortTitle(),
			$keys[3]=>$this->getCaption(),
			$keys[4]=>$this->getBlogCategoryId(),
			$keys[5]=>$this->getPermalink(),
			$keys[6]=>$this->getTags(),
			$keys[7]=>$this->getPeopleId(),
			$keys[8]=>$this->getContent(),
			$keys[9]=>$this->getGlossary(),
			$keys[10]=>$this->getIsDraft(),
			$keys[11]=>$this->getEnabled(),
			$keys[12]=>$this->getVisible(),
			$keys[13]=>$this->getDeleted(),
			$keys[14]=>$this->getLocked(),
			$keys[15]=>$this->getCreatedAt(),
			$keys[16]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BlogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setShortTitle($value);
				break;
			case 3:
				$this->setCaption($value);
				break;
			case 4:
				$this->setBlogCategoryId($value);
				break;
			case 5:
				$this->setPermalink($value);
				break;
			case 6:
				$this->setTags($value);
				break;
			case 7:
				$this->setPeopleId($value);
				break;
			case 8:
				$this->setContent($value);
				break;
			case 9:
				$this->setGlossary($value);
				break;
			case 10:
				$this->setIsDraft($value);
				break;
			case 11:
				$this->setEnabled($value);
				break;
			case 12:
				$this->setVisible($value);
				break;
			case 13:
				$this->setDeleted($value);
				break;
			case 14:
				$this->setLocked($value);
				break;
			case 15:
				$this->setCreatedAt($value);
				break;
			case 16:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BlogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setShortTitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaption($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setBlogCategoryId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPermalink($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTags($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPeopleId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setContent($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setGlossary($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setIsDraft($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setEnabled($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setVisible($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setDeleted($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setLocked($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCreatedAt($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setUpdatedAt($arr[$keys[16]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(BlogPeer::DATABASE_NAME);

		if ($this->isColumnModified(BlogPeer::ID)) $criteria->add(BlogPeer::ID, $this->id);
		if ($this->isColumnModified(BlogPeer::TITLE)) $criteria->add(BlogPeer::TITLE, $this->title);
		if ($this->isColumnModified(BlogPeer::SHORT_TITLE)) $criteria->add(BlogPeer::SHORT_TITLE, $this->short_title);
		if ($this->isColumnModified(BlogPeer::CAPTION)) $criteria->add(BlogPeer::CAPTION, $this->caption);
		if ($this->isColumnModified(BlogPeer::BLOG_CATEGORY_ID)) $criteria->add(BlogPeer::BLOG_CATEGORY_ID, $this->blog_category_id);
		if ($this->isColumnModified(BlogPeer::PERMALINK)) $criteria->add(BlogPeer::PERMALINK, $this->permalink);
		if ($this->isColumnModified(BlogPeer::TAGS)) $criteria->add(BlogPeer::TAGS, $this->tags);
		if ($this->isColumnModified(BlogPeer::PEOPLE_ID)) $criteria->add(BlogPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(BlogPeer::CONTENT)) $criteria->add(BlogPeer::CONTENT, $this->content);
		if ($this->isColumnModified(BlogPeer::GLOSSARY)) $criteria->add(BlogPeer::GLOSSARY, $this->glossary);
		if ($this->isColumnModified(BlogPeer::IS_DRAFT)) $criteria->add(BlogPeer::IS_DRAFT, $this->is_draft);
		if ($this->isColumnModified(BlogPeer::ENABLED)) $criteria->add(BlogPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(BlogPeer::VISIBLE)) $criteria->add(BlogPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(BlogPeer::DELETED)) $criteria->add(BlogPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(BlogPeer::LOCKED)) $criteria->add(BlogPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(BlogPeer::CREATED_AT)) $criteria->add(BlogPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(BlogPeer::UPDATED_AT)) $criteria->add(BlogPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BlogPeer::DATABASE_NAME);

		$criteria->add(BlogPeer::ID, $this->id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setShortTitle($this->short_title);

		$copyObj->setCaption($this->caption);

		$copyObj->setBlogCategoryId($this->blog_category_id);

		$copyObj->setPermalink($this->permalink);

		$copyObj->setTags($this->tags);

		$copyObj->setPeopleId($this->people_id);

		$copyObj->setContent($this->content);

		$copyObj->setGlossary($this->glossary);

		$copyObj->setIsDraft($this->is_draft);

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
			self::$peer = new BlogPeer();
		}
		return self::$peer;
	}

	
	public function setVirtualTable($v)
	{


		if ($v === null) {
			$this->setBlogCategoryId(NULL);
		} else {
			$this->setBlogCategoryId($v->getId());
		}


		$this->aVirtualTable = $v;
	}


	
	public function getVirtualTable($con = null)
	{
		if ($this->aVirtualTable === null && ($this->blog_category_id !== null)) {
						include_once 'lib/model/om/BaseVirtualTablePeer.php';

			$this->aVirtualTable = VirtualTablePeer::retrieveByPK($this->blog_category_id, $con);

			
		}
		return $this->aVirtualTable;
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