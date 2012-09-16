<?php


abstract class BaseEmailMarketing extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $description;


	
	protected $file_id;


	
	protected $club_id;


	
	protected $email_template_id;


	
	protected $email_subject;


	
	protected $schedule_date;


	
	protected $sending_status = 'pending';


	
	protected $last_sent_date;


	
	protected $class_name;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aFile;

	
	protected $aClub;

	
	protected $aEmailTemplate;

	
	protected $collEmailMarketingPeopleList;

	
	protected $lastEmailMarketingPeopleCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
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

	
	public function getEmailSubject()
	{

		return $this->email_subject;
	}

	
	public function getScheduleDate($format = 'Y-m-d')
	{

		if ($this->schedule_date === null || $this->schedule_date === '') {
			return null;
		} elseif (!is_int($this->schedule_date)) {
						$ts = strtotime($this->schedule_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [schedule_date] as date/time value: " . var_export($this->schedule_date, true));
			}
		} else {
			$ts = $this->schedule_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getSendingStatus()
	{

		return $this->sending_status;
	}

	
	public function getLastSentDate($format = 'Y-m-d H:i:s')
	{

		if ($this->last_sent_date === null || $this->last_sent_date === '') {
			return null;
		} elseif (!is_int($this->last_sent_date)) {
						$ts = strtotime($this->last_sent_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [last_sent_date] as date/time value: " . var_export($this->last_sent_date, true));
			}
		} else {
			$ts = $this->last_sent_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getClassName()
	{

		return $this->class_name;
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
			$this->modifiedColumns[] = EmailMarketingPeer::ID;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = EmailMarketingPeer::DESCRIPTION;
		}

	} 
	
	public function setFileId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->file_id !== $v) {
			$this->file_id = $v;
			$this->modifiedColumns[] = EmailMarketingPeer::FILE_ID;
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
			$this->modifiedColumns[] = EmailMarketingPeer::CLUB_ID;
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
			$this->modifiedColumns[] = EmailMarketingPeer::EMAIL_TEMPLATE_ID;
		}

		if ($this->aEmailTemplate !== null && $this->aEmailTemplate->getId() !== $v) {
			$this->aEmailTemplate = null;
		}

	} 
	
	public function setEmailSubject($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email_subject !== $v) {
			$this->email_subject = $v;
			$this->modifiedColumns[] = EmailMarketingPeer::EMAIL_SUBJECT;
		}

	} 
	
	public function setScheduleDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [schedule_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->schedule_date !== $ts) {
			$this->schedule_date = $ts;
			$this->modifiedColumns[] = EmailMarketingPeer::SCHEDULE_DATE;
		}

	} 
	
	public function setSendingStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sending_status !== $v || $v === 'pending') {
			$this->sending_status = $v;
			$this->modifiedColumns[] = EmailMarketingPeer::SENDING_STATUS;
		}

	} 
	
	public function setLastSentDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [last_sent_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->last_sent_date !== $ts) {
			$this->last_sent_date = $ts;
			$this->modifiedColumns[] = EmailMarketingPeer::LAST_SENT_DATE;
		}

	} 
	
	public function setClassName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->class_name !== $v) {
			$this->class_name = $v;
			$this->modifiedColumns[] = EmailMarketingPeer::CLASS_NAME;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = EmailMarketingPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = EmailMarketingPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = EmailMarketingPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = EmailMarketingPeer::LOCKED;
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
			$this->modifiedColumns[] = EmailMarketingPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EmailMarketingPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->description = $rs->getString($startcol + 1);

			$this->file_id = $rs->getInt($startcol + 2);

			$this->club_id = $rs->getInt($startcol + 3);

			$this->email_template_id = $rs->getInt($startcol + 4);

			$this->email_subject = $rs->getString($startcol + 5);

			$this->schedule_date = $rs->getDate($startcol + 6, null);

			$this->sending_status = $rs->getString($startcol + 7);

			$this->last_sent_date = $rs->getTimestamp($startcol + 8, null);

			$this->class_name = $rs->getString($startcol + 9);

			$this->enabled = $rs->getBoolean($startcol + 10);

			$this->visible = $rs->getBoolean($startcol + 11);

			$this->deleted = $rs->getBoolean($startcol + 12);

			$this->locked = $rs->getBoolean($startcol + 13);

			$this->created_at = $rs->getTimestamp($startcol + 14, null);

			$this->updated_at = $rs->getTimestamp($startcol + 15, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EmailMarketing object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailMarketingPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EmailMarketingPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EmailMarketingPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EmailMarketingPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailMarketingPeer::DATABASE_NAME);
		}

		$tableName = EmailMarketingPeer::TABLE_NAME;
		
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

			if ($this->aEmailTemplate !== null) {
				if ($this->aEmailTemplate->isModified()) {
					$affectedRows += $this->aEmailTemplate->save($con);
				}
				$this->setEmailTemplate($this->aEmailTemplate);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EmailMarketingPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EmailMarketingPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collEmailMarketingPeopleList !== null) {
				foreach($this->collEmailMarketingPeopleList as $referrerFK) {
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

			if ($this->aEmailTemplate !== null) {
				if (!$this->aEmailTemplate->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEmailTemplate->getValidationFailures());
				}
			}


			if (($retval = EmailMarketingPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEmailMarketingPeopleList !== null) {
					foreach($this->collEmailMarketingPeopleList as $referrerFK) {
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
		$pos = EmailMarketingPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDescription();
				break;
			case 2:
				return $this->getFileId();
				break;
			case 3:
				return $this->getClubId();
				break;
			case 4:
				return $this->getEmailTemplateId();
				break;
			case 5:
				return $this->getEmailSubject();
				break;
			case 6:
				return $this->getScheduleDate();
				break;
			case 7:
				return $this->getSendingStatus();
				break;
			case 8:
				return $this->getLastSentDate();
				break;
			case 9:
				return $this->getClassName();
				break;
			case 10:
				return $this->getEnabled();
				break;
			case 11:
				return $this->getVisible();
				break;
			case 12:
				return $this->getDeleted();
				break;
			case 13:
				return $this->getLocked();
				break;
			case 14:
				return $this->getCreatedAt();
				break;
			case 15:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailMarketingPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getDescription(),
			$keys[2]=>$this->getFileId(),
			$keys[3]=>$this->getClubId(),
			$keys[4]=>$this->getEmailTemplateId(),
			$keys[5]=>$this->getEmailSubject(),
			$keys[6]=>$this->getScheduleDate(),
			$keys[7]=>$this->getSendingStatus(),
			$keys[8]=>$this->getLastSentDate(),
			$keys[9]=>$this->getClassName(),
			$keys[10]=>$this->getEnabled(),
			$keys[11]=>$this->getVisible(),
			$keys[12]=>$this->getDeleted(),
			$keys[13]=>$this->getLocked(),
			$keys[14]=>$this->getCreatedAt(),
			$keys[15]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailMarketingPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDescription($value);
				break;
			case 2:
				$this->setFileId($value);
				break;
			case 3:
				$this->setClubId($value);
				break;
			case 4:
				$this->setEmailTemplateId($value);
				break;
			case 5:
				$this->setEmailSubject($value);
				break;
			case 6:
				$this->setScheduleDate($value);
				break;
			case 7:
				$this->setSendingStatus($value);
				break;
			case 8:
				$this->setLastSentDate($value);
				break;
			case 9:
				$this->setClassName($value);
				break;
			case 10:
				$this->setEnabled($value);
				break;
			case 11:
				$this->setVisible($value);
				break;
			case 12:
				$this->setDeleted($value);
				break;
			case 13:
				$this->setLocked($value);
				break;
			case 14:
				$this->setCreatedAt($value);
				break;
			case 15:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailMarketingPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescription($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFileId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setClubId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEmailTemplateId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEmailSubject($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setScheduleDate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSendingStatus($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLastSentDate($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setClassName($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setEnabled($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setVisible($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setDeleted($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setLocked($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCreatedAt($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setUpdatedAt($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailMarketingPeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailMarketingPeer::ID)) $criteria->add(EmailMarketingPeer::ID, $this->id);
		if ($this->isColumnModified(EmailMarketingPeer::DESCRIPTION)) $criteria->add(EmailMarketingPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(EmailMarketingPeer::FILE_ID)) $criteria->add(EmailMarketingPeer::FILE_ID, $this->file_id);
		if ($this->isColumnModified(EmailMarketingPeer::CLUB_ID)) $criteria->add(EmailMarketingPeer::CLUB_ID, $this->club_id);
		if ($this->isColumnModified(EmailMarketingPeer::EMAIL_TEMPLATE_ID)) $criteria->add(EmailMarketingPeer::EMAIL_TEMPLATE_ID, $this->email_template_id);
		if ($this->isColumnModified(EmailMarketingPeer::EMAIL_SUBJECT)) $criteria->add(EmailMarketingPeer::EMAIL_SUBJECT, $this->email_subject);
		if ($this->isColumnModified(EmailMarketingPeer::SCHEDULE_DATE)) $criteria->add(EmailMarketingPeer::SCHEDULE_DATE, $this->schedule_date);
		if ($this->isColumnModified(EmailMarketingPeer::SENDING_STATUS)) $criteria->add(EmailMarketingPeer::SENDING_STATUS, $this->sending_status);
		if ($this->isColumnModified(EmailMarketingPeer::LAST_SENT_DATE)) $criteria->add(EmailMarketingPeer::LAST_SENT_DATE, $this->last_sent_date);
		if ($this->isColumnModified(EmailMarketingPeer::CLASS_NAME)) $criteria->add(EmailMarketingPeer::CLASS_NAME, $this->class_name);
		if ($this->isColumnModified(EmailMarketingPeer::ENABLED)) $criteria->add(EmailMarketingPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(EmailMarketingPeer::VISIBLE)) $criteria->add(EmailMarketingPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(EmailMarketingPeer::DELETED)) $criteria->add(EmailMarketingPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(EmailMarketingPeer::LOCKED)) $criteria->add(EmailMarketingPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(EmailMarketingPeer::CREATED_AT)) $criteria->add(EmailMarketingPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EmailMarketingPeer::UPDATED_AT)) $criteria->add(EmailMarketingPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EmailMarketingPeer::DATABASE_NAME);

		$criteria->add(EmailMarketingPeer::ID, $this->id);

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

		$copyObj->setDescription($this->description);

		$copyObj->setFileId($this->file_id);

		$copyObj->setClubId($this->club_id);

		$copyObj->setEmailTemplateId($this->email_template_id);

		$copyObj->setEmailSubject($this->email_subject);

		$copyObj->setScheduleDate($this->schedule_date);

		$copyObj->setSendingStatus($this->sending_status);

		$copyObj->setLastSentDate($this->last_sent_date);

		$copyObj->setClassName($this->class_name);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEmailMarketingPeopleList() as $relObj) {
				$copyObj->addEmailMarketingPeople($relObj->copy($deepCopy));
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
			self::$peer = new EmailMarketingPeer();
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

	
	public function setEmailTemplate($v)
	{


		if ($v === null) {
			$this->setEmailTemplateId(NULL);
		} else {
			$this->setEmailTemplateId($v->getId());
		}


		$this->aEmailTemplate = $v;
	}


	
	public function getEmailTemplate($con = null)
	{
		if ($this->aEmailTemplate === null && ($this->email_template_id !== null)) {
						include_once 'lib/model/om/BaseEmailTemplatePeer.php';

			$this->aEmailTemplate = EmailTemplatePeer::retrieveByPK($this->email_template_id, $con);

			
		}
		return $this->aEmailTemplate;
	}

	
	public function initEmailMarketingPeopleList()
	{
		if ($this->collEmailMarketingPeopleList === null) {
			$this->collEmailMarketingPeopleList = array();
		}
	}

	
	public function getEmailMarketingPeopleList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseEmailMarketingPeoplePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailMarketingPeopleList === null) {
			if ($this->isNew()) {
			   $this->collEmailMarketingPeopleList = array();
			} else {

				$criteria->add(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, $this->getId());

				EmailMarketingPeoplePeer::addSelectColumns($criteria);
				$this->collEmailMarketingPeopleList = EmailMarketingPeoplePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, $this->getId());

				EmailMarketingPeoplePeer::addSelectColumns($criteria);
				if (!isset($this->lastEmailMarketingPeopleCriteria) || !$this->lastEmailMarketingPeopleCriteria->equals($criteria)) {
					$this->collEmailMarketingPeopleList = EmailMarketingPeoplePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEmailMarketingPeopleCriteria = $criteria;
		return $this->collEmailMarketingPeopleList;
	}

	
	public function countEmailMarketingPeopleList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseEmailMarketingPeoplePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, $this->getId());

		return EmailMarketingPeoplePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEmailMarketingPeople(EmailMarketingPeople $l)
	{
		$this->collEmailMarketingPeopleList[] = $l;
		$l->setEmailMarketing($this);
	}


	
	public function getEmailMarketingPeopleListJoinPeople($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseEmailMarketingPeoplePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailMarketingPeopleList === null) {
			if ($this->isNew()) {
				$this->collEmailMarketingPeopleList = array();
			} else {

				$criteria->add(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, $this->getId());

				$this->collEmailMarketingPeopleList = EmailMarketingPeoplePeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, $this->getId());

			if (!isset($this->lastEmailMarketingPeopleCriteria) || !$this->lastEmailMarketingPeopleCriteria->equals($criteria)) {
				$this->collEmailMarketingPeopleList = EmailMarketingPeoplePeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastEmailMarketingPeopleCriteria = $criteria;

		return $this->collEmailMarketingPeopleList;
	}

} 