<?php


abstract class BaseFile extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $file_name;


	
	protected $file_path;


	
	protected $file_size;


	
	protected $is_image;


	
	protected $deleted;


	
	protected $description;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collEventPhotoList;

	
	protected $lastEventPhotoCriteria = null;

	
	protected $collPartnerList;

	
	protected $lastPartnerCriteria = null;

	
	protected $collEventLivePhotoList;

	
	protected $lastEventLivePhotoCriteria = null;

	
	protected $collClubPhotoList;

	
	protected $lastClubPhotoCriteria = null;

	
	protected $collEmailTemplateList;

	
	protected $lastEmailTemplateCriteria = null;

	
	protected $collEmailMarketingList;

	
	protected $lastEmailMarketingCriteria = null;

	
	protected $collPurchaseList;

	
	protected $lastPurchaseCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getFileName()
	{

		return $this->file_name;
	}

	
	public function getFilePath()
	{

		return $this->file_path;
	}

	
	public function getFileSize()
	{

		return $this->file_size;
	}

	
	public function getIsImage()
	{

		return $this->is_image;
	}

	
	public function getDeleted()
	{

		return $this->deleted;
	}

	
	public function getDescription()
	{

		return $this->description;
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
			$this->modifiedColumns[] = FilePeer::ID;
		}

	} 
	
	public function setFileName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_name !== $v) {
			$this->file_name = $v;
			$this->modifiedColumns[] = FilePeer::FILE_NAME;
		}

	} 
	
	public function setFilePath($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_path !== $v) {
			$this->file_path = $v;
			$this->modifiedColumns[] = FilePeer::FILE_PATH;
		}

	} 
	
	public function setFileSize($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->file_size !== $v) {
			$this->file_size = $v;
			$this->modifiedColumns[] = FilePeer::FILE_SIZE;
		}

	} 
	
	public function setIsImage($v)
	{

		if ($this->is_image !== $v) {
			$this->is_image = $v;
			$this->modifiedColumns[] = FilePeer::IS_IMAGE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = FilePeer::DELETED;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = FilePeer::DESCRIPTION;
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
			$this->modifiedColumns[] = FilePeer::CREATED_AT;
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
			$this->modifiedColumns[] = FilePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->file_name = $rs->getString($startcol + 1);

			$this->file_path = $rs->getString($startcol + 2);

			$this->file_size = $rs->getInt($startcol + 3);

			$this->is_image = $rs->getBoolean($startcol + 4);

			$this->deleted = $rs->getBoolean($startcol + 5);

			$this->description = $rs->getString($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating File object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FilePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(FilePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(FilePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FilePeer::DATABASE_NAME);
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
					$pk = FilePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FilePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collEventPhotoList !== null) {
				foreach($this->collEventPhotoList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPartnerList !== null) {
				foreach($this->collPartnerList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventLivePhotoList !== null) {
				foreach($this->collEventLivePhotoList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClubPhotoList !== null) {
				foreach($this->collClubPhotoList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEmailTemplateList !== null) {
				foreach($this->collEmailTemplateList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEmailMarketingList !== null) {
				foreach($this->collEmailMarketingList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPurchaseList !== null) {
				foreach($this->collPurchaseList as $referrerFK) {
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


			if (($retval = FilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEventPhotoList !== null) {
					foreach($this->collEventPhotoList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPartnerList !== null) {
					foreach($this->collPartnerList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventLivePhotoList !== null) {
					foreach($this->collEventLivePhotoList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClubPhotoList !== null) {
					foreach($this->collClubPhotoList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEmailTemplateList !== null) {
					foreach($this->collEmailTemplateList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEmailMarketingList !== null) {
					foreach($this->collEmailMarketingList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPurchaseList !== null) {
					foreach($this->collPurchaseList as $referrerFK) {
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
		$pos = FilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getFileName();
				break;
			case 2:
				return $this->getFilePath();
				break;
			case 3:
				return $this->getFileSize();
				break;
			case 4:
				return $this->getIsImage();
				break;
			case 5:
				return $this->getDeleted();
				break;
			case 6:
				return $this->getDescription();
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
		$keys = FilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getFileName(),
			$keys[2]=>$this->getFilePath(),
			$keys[3]=>$this->getFileSize(),
			$keys[4]=>$this->getIsImage(),
			$keys[5]=>$this->getDeleted(),
			$keys[6]=>$this->getDescription(),
			$keys[7]=>$this->getCreatedAt(),
			$keys[8]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setFileName($value);
				break;
			case 2:
				$this->setFilePath($value);
				break;
			case 3:
				$this->setFileSize($value);
				break;
			case 4:
				$this->setIsImage($value);
				break;
			case 5:
				$this->setDeleted($value);
				break;
			case 6:
				$this->setDescription($value);
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
		$keys = FilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFileName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFilePath($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFileSize($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsImage($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDeleted($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDescription($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FilePeer::DATABASE_NAME);

		if ($this->isColumnModified(FilePeer::ID)) $criteria->add(FilePeer::ID, $this->id);
		if ($this->isColumnModified(FilePeer::FILE_NAME)) $criteria->add(FilePeer::FILE_NAME, $this->file_name);
		if ($this->isColumnModified(FilePeer::FILE_PATH)) $criteria->add(FilePeer::FILE_PATH, $this->file_path);
		if ($this->isColumnModified(FilePeer::FILE_SIZE)) $criteria->add(FilePeer::FILE_SIZE, $this->file_size);
		if ($this->isColumnModified(FilePeer::IS_IMAGE)) $criteria->add(FilePeer::IS_IMAGE, $this->is_image);
		if ($this->isColumnModified(FilePeer::DELETED)) $criteria->add(FilePeer::DELETED, $this->deleted);
		if ($this->isColumnModified(FilePeer::DESCRIPTION)) $criteria->add(FilePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(FilePeer::CREATED_AT)) $criteria->add(FilePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(FilePeer::UPDATED_AT)) $criteria->add(FilePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FilePeer::DATABASE_NAME);

		$criteria->add(FilePeer::ID, $this->id);

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

		$copyObj->setFileName($this->file_name);

		$copyObj->setFilePath($this->file_path);

		$copyObj->setFileSize($this->file_size);

		$copyObj->setIsImage($this->is_image);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setDescription($this->description);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEventPhotoList() as $relObj) {
				$copyObj->addEventPhoto($relObj->copy($deepCopy));
			}

			foreach($this->getPartnerList() as $relObj) {
				$copyObj->addPartner($relObj->copy($deepCopy));
			}

			foreach($this->getEventLivePhotoList() as $relObj) {
				$copyObj->addEventLivePhoto($relObj->copy($deepCopy));
			}

			foreach($this->getClubPhotoList() as $relObj) {
				$copyObj->addClubPhoto($relObj->copy($deepCopy));
			}

			foreach($this->getEmailTemplateList() as $relObj) {
				$copyObj->addEmailTemplate($relObj->copy($deepCopy));
			}

			foreach($this->getEmailMarketingList() as $relObj) {
				$copyObj->addEmailMarketing($relObj->copy($deepCopy));
			}

			foreach($this->getPurchaseList() as $relObj) {
				$copyObj->addPurchase($relObj->copy($deepCopy));
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
			self::$peer = new FilePeer();
		}
		return self::$peer;
	}

	
	public function initEventPhotoList()
	{
		if ($this->collEventPhotoList === null) {
			$this->collEventPhotoList = array();
		}
	}

	
	public function getEventPhotoList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPhotoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPhotoList === null) {
			if ($this->isNew()) {
			   $this->collEventPhotoList = array();
			} else {

				$criteria->add(EventPhotoPeer::FILE_ID, $this->getId());

				EventPhotoPeer::addSelectColumns($criteria);
				$this->collEventPhotoList = EventPhotoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPhotoPeer::FILE_ID, $this->getId());

				EventPhotoPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventPhotoCriteria) || !$this->lastEventPhotoCriteria->equals($criteria)) {
					$this->collEventPhotoList = EventPhotoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventPhotoCriteria = $criteria;
		return $this->collEventPhotoList;
	}

	
	public function countEventPhotoList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventPhotoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPhotoPeer::FILE_ID, $this->getId());

		return EventPhotoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventPhoto(EventPhoto $l)
	{
		$this->collEventPhotoList[] = $l;
		$l->setFile($this);
	}


	
	public function getEventPhotoListJoinEvent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPhotoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPhotoList === null) {
			if ($this->isNew()) {
				$this->collEventPhotoList = array();
			} else {

				$criteria->add(EventPhotoPeer::FILE_ID, $this->getId());

				$this->collEventPhotoList = EventPhotoPeer::doSelectJoinEvent($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPhotoPeer::FILE_ID, $this->getId());

			if (!isset($this->lastEventPhotoCriteria) || !$this->lastEventPhotoCriteria->equals($criteria)) {
				$this->collEventPhotoList = EventPhotoPeer::doSelectJoinEvent($criteria, $con);
			}
		}
		$this->lastEventPhotoCriteria = $criteria;

		return $this->collEventPhotoList;
	}


	
	public function getEventPhotoListJoinPeople($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPhotoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPhotoList === null) {
			if ($this->isNew()) {
				$this->collEventPhotoList = array();
			} else {

				$criteria->add(EventPhotoPeer::FILE_ID, $this->getId());

				$this->collEventPhotoList = EventPhotoPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPhotoPeer::FILE_ID, $this->getId());

			if (!isset($this->lastEventPhotoCriteria) || !$this->lastEventPhotoCriteria->equals($criteria)) {
				$this->collEventPhotoList = EventPhotoPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastEventPhotoCriteria = $criteria;

		return $this->collEventPhotoList;
	}

	
	public function initPartnerList()
	{
		if ($this->collPartnerList === null) {
			$this->collPartnerList = array();
		}
	}

	
	public function getPartnerList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePartnerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPartnerList === null) {
			if ($this->isNew()) {
			   $this->collPartnerList = array();
			} else {

				$criteria->add(PartnerPeer::FILE_ID, $this->getId());

				PartnerPeer::addSelectColumns($criteria);
				$this->collPartnerList = PartnerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PartnerPeer::FILE_ID, $this->getId());

				PartnerPeer::addSelectColumns($criteria);
				if (!isset($this->lastPartnerCriteria) || !$this->lastPartnerCriteria->equals($criteria)) {
					$this->collPartnerList = PartnerPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPartnerCriteria = $criteria;
		return $this->collPartnerList;
	}

	
	public function countPartnerList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePartnerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PartnerPeer::FILE_ID, $this->getId());

		return PartnerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPartner(Partner $l)
	{
		$this->collPartnerList[] = $l;
		$l->setFile($this);
	}

	
	public function initEventLivePhotoList()
	{
		if ($this->collEventLivePhotoList === null) {
			$this->collEventLivePhotoList = array();
		}
	}

	
	public function getEventLivePhotoList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePhotoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePhotoList === null) {
			if ($this->isNew()) {
			   $this->collEventLivePhotoList = array();
			} else {

				$criteria->add(EventLivePhotoPeer::FILE_ID, $this->getId());

				EventLivePhotoPeer::addSelectColumns($criteria);
				$this->collEventLivePhotoList = EventLivePhotoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventLivePhotoPeer::FILE_ID, $this->getId());

				EventLivePhotoPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventLivePhotoCriteria) || !$this->lastEventLivePhotoCriteria->equals($criteria)) {
					$this->collEventLivePhotoList = EventLivePhotoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventLivePhotoCriteria = $criteria;
		return $this->collEventLivePhotoList;
	}

	
	public function countEventLivePhotoList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePhotoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventLivePhotoPeer::FILE_ID, $this->getId());

		return EventLivePhotoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventLivePhoto(EventLivePhoto $l)
	{
		$this->collEventLivePhotoList[] = $l;
		$l->setFile($this);
	}


	
	public function getEventLivePhotoListJoinEventLive($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePhotoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePhotoList === null) {
			if ($this->isNew()) {
				$this->collEventLivePhotoList = array();
			} else {

				$criteria->add(EventLivePhotoPeer::FILE_ID, $this->getId());

				$this->collEventLivePhotoList = EventLivePhotoPeer::doSelectJoinEventLive($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePhotoPeer::FILE_ID, $this->getId());

			if (!isset($this->lastEventLivePhotoCriteria) || !$this->lastEventLivePhotoCriteria->equals($criteria)) {
				$this->collEventLivePhotoList = EventLivePhotoPeer::doSelectJoinEventLive($criteria, $con);
			}
		}
		$this->lastEventLivePhotoCriteria = $criteria;

		return $this->collEventLivePhotoList;
	}

	
	public function initClubPhotoList()
	{
		if ($this->collClubPhotoList === null) {
			$this->collClubPhotoList = array();
		}
	}

	
	public function getClubPhotoList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClubPhotoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubPhotoList === null) {
			if ($this->isNew()) {
			   $this->collClubPhotoList = array();
			} else {

				$criteria->add(ClubPhotoPeer::FILE_ID, $this->getId());

				ClubPhotoPeer::addSelectColumns($criteria);
				$this->collClubPhotoList = ClubPhotoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClubPhotoPeer::FILE_ID, $this->getId());

				ClubPhotoPeer::addSelectColumns($criteria);
				if (!isset($this->lastClubPhotoCriteria) || !$this->lastClubPhotoCriteria->equals($criteria)) {
					$this->collClubPhotoList = ClubPhotoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClubPhotoCriteria = $criteria;
		return $this->collClubPhotoList;
	}

	
	public function countClubPhotoList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseClubPhotoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ClubPhotoPeer::FILE_ID, $this->getId());

		return ClubPhotoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addClubPhoto(ClubPhoto $l)
	{
		$this->collClubPhotoList[] = $l;
		$l->setFile($this);
	}


	
	public function getClubPhotoListJoinClub($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClubPhotoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubPhotoList === null) {
			if ($this->isNew()) {
				$this->collClubPhotoList = array();
			} else {

				$criteria->add(ClubPhotoPeer::FILE_ID, $this->getId());

				$this->collClubPhotoList = ClubPhotoPeer::doSelectJoinClub($criteria, $con);
			}
		} else {
									
			$criteria->add(ClubPhotoPeer::FILE_ID, $this->getId());

			if (!isset($this->lastClubPhotoCriteria) || !$this->lastClubPhotoCriteria->equals($criteria)) {
				$this->collClubPhotoList = ClubPhotoPeer::doSelectJoinClub($criteria, $con);
			}
		}
		$this->lastClubPhotoCriteria = $criteria;

		return $this->collClubPhotoList;
	}

	
	public function initEmailTemplateList()
	{
		if ($this->collEmailTemplateList === null) {
			$this->collEmailTemplateList = array();
		}
	}

	
	public function getEmailTemplateList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEmailTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailTemplateList === null) {
			if ($this->isNew()) {
			   $this->collEmailTemplateList = array();
			} else {

				$criteria->add(EmailTemplatePeer::FILE_ID, $this->getId());

				EmailTemplatePeer::addSelectColumns($criteria);
				$this->collEmailTemplateList = EmailTemplatePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EmailTemplatePeer::FILE_ID, $this->getId());

				EmailTemplatePeer::addSelectColumns($criteria);
				if (!isset($this->lastEmailTemplateCriteria) || !$this->lastEmailTemplateCriteria->equals($criteria)) {
					$this->collEmailTemplateList = EmailTemplatePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEmailTemplateCriteria = $criteria;
		return $this->collEmailTemplateList;
	}

	
	public function countEmailTemplateList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEmailTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EmailTemplatePeer::FILE_ID, $this->getId());

		return EmailTemplatePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEmailTemplate(EmailTemplate $l)
	{
		$this->collEmailTemplateList[] = $l;
		$l->setFile($this);
	}


	
	public function getEmailTemplateListJoinClub($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEmailTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailTemplateList === null) {
			if ($this->isNew()) {
				$this->collEmailTemplateList = array();
			} else {

				$criteria->add(EmailTemplatePeer::FILE_ID, $this->getId());

				$this->collEmailTemplateList = EmailTemplatePeer::doSelectJoinClub($criteria, $con);
			}
		} else {
									
			$criteria->add(EmailTemplatePeer::FILE_ID, $this->getId());

			if (!isset($this->lastEmailTemplateCriteria) || !$this->lastEmailTemplateCriteria->equals($criteria)) {
				$this->collEmailTemplateList = EmailTemplatePeer::doSelectJoinClub($criteria, $con);
			}
		}
		$this->lastEmailTemplateCriteria = $criteria;

		return $this->collEmailTemplateList;
	}


	
	public function getEmailTemplateListJoinEmailTemplateRelatedByEmailTemplateId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEmailTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailTemplateList === null) {
			if ($this->isNew()) {
				$this->collEmailTemplateList = array();
			} else {

				$criteria->add(EmailTemplatePeer::FILE_ID, $this->getId());

				$this->collEmailTemplateList = EmailTemplatePeer::doSelectJoinEmailTemplateRelatedByEmailTemplateId($criteria, $con);
			}
		} else {
									
			$criteria->add(EmailTemplatePeer::FILE_ID, $this->getId());

			if (!isset($this->lastEmailTemplateCriteria) || !$this->lastEmailTemplateCriteria->equals($criteria)) {
				$this->collEmailTemplateList = EmailTemplatePeer::doSelectJoinEmailTemplateRelatedByEmailTemplateId($criteria, $con);
			}
		}
		$this->lastEmailTemplateCriteria = $criteria;

		return $this->collEmailTemplateList;
	}

	
	public function initEmailMarketingList()
	{
		if ($this->collEmailMarketingList === null) {
			$this->collEmailMarketingList = array();
		}
	}

	
	public function getEmailMarketingList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseEmailMarketingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailMarketingList === null) {
			if ($this->isNew()) {
			   $this->collEmailMarketingList = array();
			} else {

				$criteria->add(EmailMarketingPeer::FILE_ID, $this->getId());

				EmailMarketingPeer::addSelectColumns($criteria);
				$this->collEmailMarketingList = EmailMarketingPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EmailMarketingPeer::FILE_ID, $this->getId());

				EmailMarketingPeer::addSelectColumns($criteria);
				if (!isset($this->lastEmailMarketingCriteria) || !$this->lastEmailMarketingCriteria->equals($criteria)) {
					$this->collEmailMarketingList = EmailMarketingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEmailMarketingCriteria = $criteria;
		return $this->collEmailMarketingList;
	}

	
	public function countEmailMarketingList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseEmailMarketingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EmailMarketingPeer::FILE_ID, $this->getId());

		return EmailMarketingPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEmailMarketing(EmailMarketing $l)
	{
		$this->collEmailMarketingList[] = $l;
		$l->setFile($this);
	}


	
	public function getEmailMarketingListJoinClub($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseEmailMarketingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailMarketingList === null) {
			if ($this->isNew()) {
				$this->collEmailMarketingList = array();
			} else {

				$criteria->add(EmailMarketingPeer::FILE_ID, $this->getId());

				$this->collEmailMarketingList = EmailMarketingPeer::doSelectJoinClub($criteria, $con);
			}
		} else {
									
			$criteria->add(EmailMarketingPeer::FILE_ID, $this->getId());

			if (!isset($this->lastEmailMarketingCriteria) || !$this->lastEmailMarketingCriteria->equals($criteria)) {
				$this->collEmailMarketingList = EmailMarketingPeer::doSelectJoinClub($criteria, $con);
			}
		}
		$this->lastEmailMarketingCriteria = $criteria;

		return $this->collEmailMarketingList;
	}


	
	public function getEmailMarketingListJoinEmailTemplate($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseEmailMarketingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailMarketingList === null) {
			if ($this->isNew()) {
				$this->collEmailMarketingList = array();
			} else {

				$criteria->add(EmailMarketingPeer::FILE_ID, $this->getId());

				$this->collEmailMarketingList = EmailMarketingPeer::doSelectJoinEmailTemplate($criteria, $con);
			}
		} else {
									
			$criteria->add(EmailMarketingPeer::FILE_ID, $this->getId());

			if (!isset($this->lastEmailMarketingCriteria) || !$this->lastEmailMarketingCriteria->equals($criteria)) {
				$this->collEmailMarketingList = EmailMarketingPeer::doSelectJoinEmailTemplate($criteria, $con);
			}
		}
		$this->lastEmailMarketingCriteria = $criteria;

		return $this->collEmailMarketingList;
	}

	
	public function initPurchaseList()
	{
		if ($this->collPurchaseList === null) {
			$this->collPurchaseList = array();
		}
	}

	
	public function getPurchaseList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePurchasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPurchaseList === null) {
			if ($this->isNew()) {
			   $this->collPurchaseList = array();
			} else {

				$criteria->add(PurchasePeer::FILE_ID, $this->getId());

				PurchasePeer::addSelectColumns($criteria);
				$this->collPurchaseList = PurchasePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PurchasePeer::FILE_ID, $this->getId());

				PurchasePeer::addSelectColumns($criteria);
				if (!isset($this->lastPurchaseCriteria) || !$this->lastPurchaseCriteria->equals($criteria)) {
					$this->collPurchaseList = PurchasePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPurchaseCriteria = $criteria;
		return $this->collPurchaseList;
	}

	
	public function countPurchaseList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePurchasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PurchasePeer::FILE_ID, $this->getId());

		return PurchasePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPurchase(Purchase $l)
	{
		$this->collPurchaseList[] = $l;
		$l->setFile($this);
	}


	
	public function getPurchaseListJoinUserSite($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePurchasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPurchaseList === null) {
			if ($this->isNew()) {
				$this->collPurchaseList = array();
			} else {

				$criteria->add(PurchasePeer::FILE_ID, $this->getId());

				$this->collPurchaseList = PurchasePeer::doSelectJoinUserSite($criteria, $con);
			}
		} else {
									
			$criteria->add(PurchasePeer::FILE_ID, $this->getId());

			if (!isset($this->lastPurchaseCriteria) || !$this->lastPurchaseCriteria->equals($criteria)) {
				$this->collPurchaseList = PurchasePeer::doSelectJoinUserSite($criteria, $con);
			}
		}
		$this->lastPurchaseCriteria = $criteria;

		return $this->collPurchaseList;
	}

} 