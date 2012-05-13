<?php


abstract class BaseEmailTemplate extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $template_name;


	
	protected $description;


	
	protected $file_id;


	
	protected $club_id;


	
	protected $email_template_id;


	
	protected $is_available_for_use;


	
	protected $is_available_for_sale;


	
	protected $tag_name;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aFile;

	
	protected $aClub;

	
	protected $aEmailTemplateRelatedByEmailTemplateId;

	
	protected $collEmailTemplateListRelatedByEmailTemplateId;

	
	protected $lastEmailTemplateRelatedByEmailTemplateIdCriteria = null;

	
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

	
	public function getFileId()
	{

		return $this->file_id;
	}

	
	public function getClubId()
	{

		return $this->club_id;
	}

	
	public function getEmailTemplateId()
	{

		return $this->email_template_id;
	}

	
	public function getIsAvailableForUse()
	{

		return $this->is_available_for_use;
	}

	
	public function getIsAvailableForSale()
	{

		return $this->is_available_for_sale;
	}

	
	public function getTagName()
	{

		return $this->tag_name;
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
			$this->modifiedColumns[] = EmailTemplatePeer::ID;
		}

	} 
	
	public function setTemplateName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->template_name !== $v) {
			$this->template_name = $v;
			$this->modifiedColumns[] = EmailTemplatePeer::TEMPLATE_NAME;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = EmailTemplatePeer::DESCRIPTION;
		}

	} 
	
	public function setFileId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->file_id !== $v) {
			$this->file_id = $v;
			$this->modifiedColumns[] = EmailTemplatePeer::FILE_ID;
		}

		if ($this->aFile !== null && $this->aFile->getId() !== $v) {
			$this->aFile = null;
		}

	} 
	
	public function setClubId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->club_id !== $v) {
			$this->club_id = $v;
			$this->modifiedColumns[] = EmailTemplatePeer::CLUB_ID;
		}

		if ($this->aClub !== null && $this->aClub->getId() !== $v) {
			$this->aClub = null;
		}

	} 
	
	public function setEmailTemplateId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->email_template_id !== $v) {
			$this->email_template_id = $v;
			$this->modifiedColumns[] = EmailTemplatePeer::EMAIL_TEMPLATE_ID;
		}

		if ($this->aEmailTemplateRelatedByEmailTemplateId !== null && $this->aEmailTemplateRelatedByEmailTemplateId->getId() !== $v) {
			$this->aEmailTemplateRelatedByEmailTemplateId = null;
		}

	} 
	
	public function setIsAvailableForUse($v)
	{

		if ($this->is_available_for_use !== $v) {
			$this->is_available_for_use = $v;
			$this->modifiedColumns[] = EmailTemplatePeer::IS_AVAILABLE_FOR_USE;
		}

	} 
	
	public function setIsAvailableForSale($v)
	{

		if ($this->is_available_for_sale !== $v) {
			$this->is_available_for_sale = $v;
			$this->modifiedColumns[] = EmailTemplatePeer::IS_AVAILABLE_FOR_SALE;
		}

	} 
	
	public function setTagName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag_name !== $v) {
			$this->tag_name = $v;
			$this->modifiedColumns[] = EmailTemplatePeer::TAG_NAME;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = EmailTemplatePeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = EmailTemplatePeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = EmailTemplatePeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = EmailTemplatePeer::LOCKED;
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
			$this->modifiedColumns[] = EmailTemplatePeer::CREATED_AT;
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
			$this->modifiedColumns[] = EmailTemplatePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->template_name = $rs->getString($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->file_id = $rs->getInt($startcol + 3);

			$this->club_id = $rs->getInt($startcol + 4);

			$this->email_template_id = $rs->getInt($startcol + 5);

			$this->is_available_for_use = $rs->getBoolean($startcol + 6);

			$this->is_available_for_sale = $rs->getBoolean($startcol + 7);

			$this->tag_name = $rs->getString($startcol + 8);

			$this->enabled = $rs->getBoolean($startcol + 9);

			$this->visible = $rs->getBoolean($startcol + 10);

			$this->deleted = $rs->getBoolean($startcol + 11);

			$this->locked = $rs->getBoolean($startcol + 12);

			$this->created_at = $rs->getTimestamp($startcol + 13, null);

			$this->updated_at = $rs->getTimestamp($startcol + 14, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 15; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EmailTemplate object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailTemplatePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EmailTemplatePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EmailTemplatePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EmailTemplatePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailTemplatePeer::DATABASE_NAME);
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


												
			if ($this->aFile !== null) {
				if ($this->aFile->isModified()) {
					$affectedRows += $this->aFile->save($con);
				}
				$this->setFile($this->aFile);
			}

			if ($this->aClub !== null) {
				if ($this->aClub->isModified()) {
					$affectedRows += $this->aClub->save($con);
				}
				$this->setClub($this->aClub);
			}

			if ($this->aEmailTemplateRelatedByEmailTemplateId !== null) {
				if ($this->aEmailTemplateRelatedByEmailTemplateId->isModified()) {
					$affectedRows += $this->aEmailTemplateRelatedByEmailTemplateId->save($con);
				}
				$this->setEmailTemplateRelatedByEmailTemplateId($this->aEmailTemplateRelatedByEmailTemplateId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EmailTemplatePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EmailTemplatePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collEmailTemplateListRelatedByEmailTemplateId !== null) {
				foreach($this->collEmailTemplateListRelatedByEmailTemplateId as $referrerFK) {
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


												
			if ($this->aFile !== null) {
				if (!$this->aFile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFile->getValidationFailures());
				}
			}

			if ($this->aClub !== null) {
				if (!$this->aClub->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aClub->getValidationFailures());
				}
			}

			if ($this->aEmailTemplateRelatedByEmailTemplateId !== null) {
				if (!$this->aEmailTemplateRelatedByEmailTemplateId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEmailTemplateRelatedByEmailTemplateId->getValidationFailures());
				}
			}


			if (($retval = EmailTemplatePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getFileId();
				break;
			case 4:
				return $this->getClubId();
				break;
			case 5:
				return $this->getEmailTemplateId();
				break;
			case 6:
				return $this->getIsAvailableForUse();
				break;
			case 7:
				return $this->getIsAvailableForSale();
				break;
			case 8:
				return $this->getTagName();
				break;
			case 9:
				return $this->getEnabled();
				break;
			case 10:
				return $this->getVisible();
				break;
			case 11:
				return $this->getDeleted();
				break;
			case 12:
				return $this->getLocked();
				break;
			case 13:
				return $this->getCreatedAt();
				break;
			case 14:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailTemplatePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getTemplateName(),
			$keys[2]=>$this->getDescription(),
			$keys[3]=>$this->getFileId(),
			$keys[4]=>$this->getClubId(),
			$keys[5]=>$this->getEmailTemplateId(),
			$keys[6]=>$this->getIsAvailableForUse(),
			$keys[7]=>$this->getIsAvailableForSale(),
			$keys[8]=>$this->getTagName(),
			$keys[9]=>$this->getEnabled(),
			$keys[10]=>$this->getVisible(),
			$keys[11]=>$this->getDeleted(),
			$keys[12]=>$this->getLocked(),
			$keys[13]=>$this->getCreatedAt(),
			$keys[14]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setFileId($value);
				break;
			case 4:
				$this->setClubId($value);
				break;
			case 5:
				$this->setEmailTemplateId($value);
				break;
			case 6:
				$this->setIsAvailableForUse($value);
				break;
			case 7:
				$this->setIsAvailableForSale($value);
				break;
			case 8:
				$this->setTagName($value);
				break;
			case 9:
				$this->setEnabled($value);
				break;
			case 10:
				$this->setVisible($value);
				break;
			case 11:
				$this->setDeleted($value);
				break;
			case 12:
				$this->setLocked($value);
				break;
			case 13:
				$this->setCreatedAt($value);
				break;
			case 14:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailTemplatePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTemplateName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFileId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setClubId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEmailTemplateId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsAvailableForUse($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsAvailableForSale($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setTagName($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEnabled($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setVisible($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setDeleted($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setLocked($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUpdatedAt($arr[$keys[14]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailTemplatePeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailTemplatePeer::ID)) $criteria->add(EmailTemplatePeer::ID, $this->id);
		if ($this->isColumnModified(EmailTemplatePeer::TEMPLATE_NAME)) $criteria->add(EmailTemplatePeer::TEMPLATE_NAME, $this->template_name);
		if ($this->isColumnModified(EmailTemplatePeer::DESCRIPTION)) $criteria->add(EmailTemplatePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(EmailTemplatePeer::FILE_ID)) $criteria->add(EmailTemplatePeer::FILE_ID, $this->file_id);
		if ($this->isColumnModified(EmailTemplatePeer::CLUB_ID)) $criteria->add(EmailTemplatePeer::CLUB_ID, $this->club_id);
		if ($this->isColumnModified(EmailTemplatePeer::EMAIL_TEMPLATE_ID)) $criteria->add(EmailTemplatePeer::EMAIL_TEMPLATE_ID, $this->email_template_id);
		if ($this->isColumnModified(EmailTemplatePeer::IS_AVAILABLE_FOR_USE)) $criteria->add(EmailTemplatePeer::IS_AVAILABLE_FOR_USE, $this->is_available_for_use);
		if ($this->isColumnModified(EmailTemplatePeer::IS_AVAILABLE_FOR_SALE)) $criteria->add(EmailTemplatePeer::IS_AVAILABLE_FOR_SALE, $this->is_available_for_sale);
		if ($this->isColumnModified(EmailTemplatePeer::TAG_NAME)) $criteria->add(EmailTemplatePeer::TAG_NAME, $this->tag_name);
		if ($this->isColumnModified(EmailTemplatePeer::ENABLED)) $criteria->add(EmailTemplatePeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(EmailTemplatePeer::VISIBLE)) $criteria->add(EmailTemplatePeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(EmailTemplatePeer::DELETED)) $criteria->add(EmailTemplatePeer::DELETED, $this->deleted);
		if ($this->isColumnModified(EmailTemplatePeer::LOCKED)) $criteria->add(EmailTemplatePeer::LOCKED, $this->locked);
		if ($this->isColumnModified(EmailTemplatePeer::CREATED_AT)) $criteria->add(EmailTemplatePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EmailTemplatePeer::UPDATED_AT)) $criteria->add(EmailTemplatePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EmailTemplatePeer::DATABASE_NAME);

		$criteria->add(EmailTemplatePeer::ID, $this->id);

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

		$copyObj->setFileId($this->file_id);

		$copyObj->setClubId($this->club_id);

		$copyObj->setEmailTemplateId($this->email_template_id);

		$copyObj->setIsAvailableForUse($this->is_available_for_use);

		$copyObj->setIsAvailableForSale($this->is_available_for_sale);

		$copyObj->setTagName($this->tag_name);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEmailTemplateListRelatedByEmailTemplateId() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addEmailTemplateRelatedByEmailTemplateId($relObj->copy($deepCopy));
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
			self::$peer = new EmailTemplatePeer();
		}
		return self::$peer;
	}

	
	public function setFile($v)
	{


		if ($v === null) {
			$this->setFileId(NULL);
		} else {
			$this->setFileId($v->getId());
		}


		$this->aFile = $v;
	}


	
	public function getFile($con = null)
	{
		if ($this->aFile === null && ($this->file_id !== null)) {
						include_once 'lib/model/om/BaseFilePeer.php';

			$this->aFile = FilePeer::retrieveByPK($this->file_id, $con);

			
		}
		return $this->aFile;
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

	
	public function setEmailTemplateRelatedByEmailTemplateId($v)
	{


		if ($v === null) {
			$this->setEmailTemplateId(NULL);
		} else {
			$this->setEmailTemplateId($v->getId());
		}


		$this->aEmailTemplateRelatedByEmailTemplateId = $v;
	}


	
	public function getEmailTemplateRelatedByEmailTemplateId($con = null)
	{
		if ($this->aEmailTemplateRelatedByEmailTemplateId === null && ($this->email_template_id !== null)) {
						include_once 'lib/model/om/BaseEmailTemplatePeer.php';

			$this->aEmailTemplateRelatedByEmailTemplateId = EmailTemplatePeer::retrieveByPK($this->email_template_id, $con);

			
		}
		return $this->aEmailTemplateRelatedByEmailTemplateId;
	}

	
	public function initEmailTemplateListRelatedByEmailTemplateId()
	{
		if ($this->collEmailTemplateListRelatedByEmailTemplateId === null) {
			$this->collEmailTemplateListRelatedByEmailTemplateId = array();
		}
	}

	
	public function getEmailTemplateListRelatedByEmailTemplateId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEmailTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailTemplateListRelatedByEmailTemplateId === null) {
			if ($this->isNew()) {
			   $this->collEmailTemplateListRelatedByEmailTemplateId = array();
			} else {

				$criteria->add(EmailTemplatePeer::EMAIL_TEMPLATE_ID, $this->getId());

				EmailTemplatePeer::addSelectColumns($criteria);
				$this->collEmailTemplateListRelatedByEmailTemplateId = EmailTemplatePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EmailTemplatePeer::EMAIL_TEMPLATE_ID, $this->getId());

				EmailTemplatePeer::addSelectColumns($criteria);
				if (!isset($this->lastEmailTemplateRelatedByEmailTemplateIdCriteria) || !$this->lastEmailTemplateRelatedByEmailTemplateIdCriteria->equals($criteria)) {
					$this->collEmailTemplateListRelatedByEmailTemplateId = EmailTemplatePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEmailTemplateRelatedByEmailTemplateIdCriteria = $criteria;
		return $this->collEmailTemplateListRelatedByEmailTemplateId;
	}

	
	public function countEmailTemplateListRelatedByEmailTemplateId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEmailTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EmailTemplatePeer::EMAIL_TEMPLATE_ID, $this->getId());

		return EmailTemplatePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEmailTemplateRelatedByEmailTemplateId(EmailTemplate $l)
	{
		$this->collEmailTemplateListRelatedByEmailTemplateId[] = $l;
		$l->setEmailTemplateRelatedByEmailTemplateId($this);
	}


	
	public function getEmailTemplateListRelatedByEmailTemplateIdJoinFile($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEmailTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailTemplateListRelatedByEmailTemplateId === null) {
			if ($this->isNew()) {
				$this->collEmailTemplateListRelatedByEmailTemplateId = array();
			} else {

				$criteria->add(EmailTemplatePeer::EMAIL_TEMPLATE_ID, $this->getId());

				$this->collEmailTemplateListRelatedByEmailTemplateId = EmailTemplatePeer::doSelectJoinFile($criteria, $con);
			}
		} else {
									
			$criteria->add(EmailTemplatePeer::EMAIL_TEMPLATE_ID, $this->getId());

			if (!isset($this->lastEmailTemplateRelatedByEmailTemplateIdCriteria) || !$this->lastEmailTemplateRelatedByEmailTemplateIdCriteria->equals($criteria)) {
				$this->collEmailTemplateListRelatedByEmailTemplateId = EmailTemplatePeer::doSelectJoinFile($criteria, $con);
			}
		}
		$this->lastEmailTemplateRelatedByEmailTemplateIdCriteria = $criteria;

		return $this->collEmailTemplateListRelatedByEmailTemplateId;
	}


	
	public function getEmailTemplateListRelatedByEmailTemplateIdJoinClub($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEmailTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailTemplateListRelatedByEmailTemplateId === null) {
			if ($this->isNew()) {
				$this->collEmailTemplateListRelatedByEmailTemplateId = array();
			} else {

				$criteria->add(EmailTemplatePeer::EMAIL_TEMPLATE_ID, $this->getId());

				$this->collEmailTemplateListRelatedByEmailTemplateId = EmailTemplatePeer::doSelectJoinClub($criteria, $con);
			}
		} else {
									
			$criteria->add(EmailTemplatePeer::EMAIL_TEMPLATE_ID, $this->getId());

			if (!isset($this->lastEmailTemplateRelatedByEmailTemplateIdCriteria) || !$this->lastEmailTemplateRelatedByEmailTemplateIdCriteria->equals($criteria)) {
				$this->collEmailTemplateListRelatedByEmailTemplateId = EmailTemplatePeer::doSelectJoinClub($criteria, $con);
			}
		}
		$this->lastEmailTemplateRelatedByEmailTemplateIdCriteria = $criteria;

		return $this->collEmailTemplateListRelatedByEmailTemplateId;
	}

} 