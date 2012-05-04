<?php


abstract class BasePeople extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $people_type_id;


	
	protected $first_name;


	
	protected $last_name;


	
	protected $full_name;


	
	protected $email_address;


	
	protected $birthday;


	
	protected $default_language;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aVirtualTable;

	
	protected $collUserSiteList;

	
	protected $lastUserSiteCriteria = null;

	
	protected $collRankingPlayerList;

	
	protected $lastRankingPlayerCriteria = null;

	
	protected $collRankingHistoryList;

	
	protected $lastRankingHistoryCriteria = null;

	
	protected $collEventPlayerList;

	
	protected $lastEventPlayerCriteria = null;

	
	protected $collUserSiteOptionList;

	
	protected $lastUserSiteOptionCriteria = null;

	
	protected $collEventCommentList;

	
	protected $lastEventCommentCriteria = null;

	
	protected $collEventPhotoList;

	
	protected $lastEventPhotoCriteria = null;

	
	protected $collEventPhotoCommentList;

	
	protected $lastEventPhotoCommentCriteria = null;

	
	protected $collUserAdminList;

	
	protected $lastUserAdminCriteria = null;

	
	protected $collEventLivePlayerList;

	
	protected $lastEventLivePlayerCriteria = null;

	
	protected $collRankingLivePlayerList;

	
	protected $lastRankingLivePlayerCriteria = null;

	
	protected $collRankingLiveHistoryList;

	
	protected $lastRankingLiveHistoryCriteria = null;

	
	protected $colliRankRankingList;

	
	protected $lastiRankRankingCriteria = null;

	
	protected $collEventLivePlayerScoreList;

	
	protected $lastEventLivePlayerScoreCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPeopleTypeId()
	{

		return $this->people_type_id;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
	}

	
	public function getFullName()
	{

		return $this->full_name;
	}

	
	public function getEmailAddress()
	{

		return $this->email_address;
	}

	
	public function getBirthday($format = 'Y-m-d')
	{

		if ($this->birthday === null || $this->birthday === '') {
			return null;
		} elseif (!is_int($this->birthday)) {
						$ts = strtotime($this->birthday);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [birthday] as date/time value: " . var_export($this->birthday, true));
			}
		} else {
			$ts = $this->birthday;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDefaultLanguage()
	{

		return $this->default_language;
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
			$this->modifiedColumns[] = PeoplePeer::ID;
		}

	} 
	
	public function setPeopleTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_type_id !== $v) {
			$this->people_type_id = $v;
			$this->modifiedColumns[] = PeoplePeer::PEOPLE_TYPE_ID;
		}

		if ($this->aVirtualTable !== null && $this->aVirtualTable->getId() !== $v) {
			$this->aVirtualTable = null;
		}

	} 
	
	public function setFirstName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = PeoplePeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = PeoplePeer::LAST_NAME;
		}

	} 
	
	public function setFullName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->full_name !== $v) {
			$this->full_name = $v;
			$this->modifiedColumns[] = PeoplePeer::FULL_NAME;
		}

	} 
	
	public function setEmailAddress($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email_address !== $v) {
			$this->email_address = $v;
			$this->modifiedColumns[] = PeoplePeer::EMAIL_ADDRESS;
		}

	} 
	
	public function setBirthday($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [birthday] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->birthday !== $ts) {
			$this->birthday = $ts;
			$this->modifiedColumns[] = PeoplePeer::BIRTHDAY;
		}

	} 
	
	public function setDefaultLanguage($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->default_language !== $v) {
			$this->default_language = $v;
			$this->modifiedColumns[] = PeoplePeer::DEFAULT_LANGUAGE;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = PeoplePeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = PeoplePeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = PeoplePeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = PeoplePeer::LOCKED;
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
			$this->modifiedColumns[] = PeoplePeer::CREATED_AT;
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
			$this->modifiedColumns[] = PeoplePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->people_type_id = $rs->getInt($startcol + 1);

			$this->first_name = $rs->getString($startcol + 2);

			$this->last_name = $rs->getString($startcol + 3);

			$this->full_name = $rs->getString($startcol + 4);

			$this->email_address = $rs->getString($startcol + 5);

			$this->birthday = $rs->getDate($startcol + 6, null);

			$this->default_language = $rs->getString($startcol + 7);

			$this->enabled = $rs->getBoolean($startcol + 8);

			$this->visible = $rs->getBoolean($startcol + 9);

			$this->deleted = $rs->getBoolean($startcol + 10);

			$this->locked = $rs->getBoolean($startcol + 11);

			$this->created_at = $rs->getTimestamp($startcol + 12, null);

			$this->updated_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating People object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PeoplePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PeoplePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PeoplePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PeoplePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PeoplePeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PeoplePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PeoplePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collUserSiteList !== null) {
				foreach($this->collUserSiteList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRankingPlayerList !== null) {
				foreach($this->collRankingPlayerList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRankingHistoryList !== null) {
				foreach($this->collRankingHistoryList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventPlayerList !== null) {
				foreach($this->collEventPlayerList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserSiteOptionList !== null) {
				foreach($this->collUserSiteOptionList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventCommentList !== null) {
				foreach($this->collEventCommentList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventPhotoList !== null) {
				foreach($this->collEventPhotoList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventPhotoCommentList !== null) {
				foreach($this->collEventPhotoCommentList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserAdminList !== null) {
				foreach($this->collUserAdminList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventLivePlayerList !== null) {
				foreach($this->collEventLivePlayerList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRankingLivePlayerList !== null) {
				foreach($this->collRankingLivePlayerList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRankingLiveHistoryList !== null) {
				foreach($this->collRankingLiveHistoryList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colliRankRankingList !== null) {
				foreach($this->colliRankRankingList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventLivePlayerScoreList !== null) {
				foreach($this->collEventLivePlayerScoreList as $referrerFK) {
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


												
			if ($this->aVirtualTable !== null) {
				if (!$this->aVirtualTable->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVirtualTable->getValidationFailures());
				}
			}


			if (($retval = PeoplePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collUserSiteList !== null) {
					foreach($this->collUserSiteList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRankingPlayerList !== null) {
					foreach($this->collRankingPlayerList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRankingHistoryList !== null) {
					foreach($this->collRankingHistoryList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventPlayerList !== null) {
					foreach($this->collEventPlayerList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserSiteOptionList !== null) {
					foreach($this->collUserSiteOptionList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventCommentList !== null) {
					foreach($this->collEventCommentList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventPhotoList !== null) {
					foreach($this->collEventPhotoList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventPhotoCommentList !== null) {
					foreach($this->collEventPhotoCommentList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserAdminList !== null) {
					foreach($this->collUserAdminList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventLivePlayerList !== null) {
					foreach($this->collEventLivePlayerList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRankingLivePlayerList !== null) {
					foreach($this->collRankingLivePlayerList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRankingLiveHistoryList !== null) {
					foreach($this->collRankingLiveHistoryList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colliRankRankingList !== null) {
					foreach($this->colliRankRankingList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventLivePlayerScoreList !== null) {
					foreach($this->collEventLivePlayerScoreList as $referrerFK) {
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
		$pos = PeoplePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPeopleTypeId();
				break;
			case 2:
				return $this->getFirstName();
				break;
			case 3:
				return $this->getLastName();
				break;
			case 4:
				return $this->getFullName();
				break;
			case 5:
				return $this->getEmailAddress();
				break;
			case 6:
				return $this->getBirthday();
				break;
			case 7:
				return $this->getDefaultLanguage();
				break;
			case 8:
				return $this->getEnabled();
				break;
			case 9:
				return $this->getVisible();
				break;
			case 10:
				return $this->getDeleted();
				break;
			case 11:
				return $this->getLocked();
				break;
			case 12:
				return $this->getCreatedAt();
				break;
			case 13:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PeoplePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getPeopleTypeId(),
			$keys[2]=>$this->getFirstName(),
			$keys[3]=>$this->getLastName(),
			$keys[4]=>$this->getFullName(),
			$keys[5]=>$this->getEmailAddress(),
			$keys[6]=>$this->getBirthday(),
			$keys[7]=>$this->getDefaultLanguage(),
			$keys[8]=>$this->getEnabled(),
			$keys[9]=>$this->getVisible(),
			$keys[10]=>$this->getDeleted(),
			$keys[11]=>$this->getLocked(),
			$keys[12]=>$this->getCreatedAt(),
			$keys[13]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PeoplePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPeopleTypeId($value);
				break;
			case 2:
				$this->setFirstName($value);
				break;
			case 3:
				$this->setLastName($value);
				break;
			case 4:
				$this->setFullName($value);
				break;
			case 5:
				$this->setEmailAddress($value);
				break;
			case 6:
				$this->setBirthday($value);
				break;
			case 7:
				$this->setDefaultLanguage($value);
				break;
			case 8:
				$this->setEnabled($value);
				break;
			case 9:
				$this->setVisible($value);
				break;
			case 10:
				$this->setDeleted($value);
				break;
			case 11:
				$this->setLocked($value);
				break;
			case 12:
				$this->setCreatedAt($value);
				break;
			case 13:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PeoplePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFirstName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLastName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFullName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEmailAddress($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setBirthday($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDefaultLanguage($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEnabled($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setVisible($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDeleted($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLocked($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PeoplePeer::DATABASE_NAME);

		if ($this->isColumnModified(PeoplePeer::ID)) $criteria->add(PeoplePeer::ID, $this->id);
		if ($this->isColumnModified(PeoplePeer::PEOPLE_TYPE_ID)) $criteria->add(PeoplePeer::PEOPLE_TYPE_ID, $this->people_type_id);
		if ($this->isColumnModified(PeoplePeer::FIRST_NAME)) $criteria->add(PeoplePeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(PeoplePeer::LAST_NAME)) $criteria->add(PeoplePeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(PeoplePeer::FULL_NAME)) $criteria->add(PeoplePeer::FULL_NAME, $this->full_name);
		if ($this->isColumnModified(PeoplePeer::EMAIL_ADDRESS)) $criteria->add(PeoplePeer::EMAIL_ADDRESS, $this->email_address);
		if ($this->isColumnModified(PeoplePeer::BIRTHDAY)) $criteria->add(PeoplePeer::BIRTHDAY, $this->birthday);
		if ($this->isColumnModified(PeoplePeer::DEFAULT_LANGUAGE)) $criteria->add(PeoplePeer::DEFAULT_LANGUAGE, $this->default_language);
		if ($this->isColumnModified(PeoplePeer::ENABLED)) $criteria->add(PeoplePeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(PeoplePeer::VISIBLE)) $criteria->add(PeoplePeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(PeoplePeer::DELETED)) $criteria->add(PeoplePeer::DELETED, $this->deleted);
		if ($this->isColumnModified(PeoplePeer::LOCKED)) $criteria->add(PeoplePeer::LOCKED, $this->locked);
		if ($this->isColumnModified(PeoplePeer::CREATED_AT)) $criteria->add(PeoplePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PeoplePeer::UPDATED_AT)) $criteria->add(PeoplePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PeoplePeer::DATABASE_NAME);

		$criteria->add(PeoplePeer::ID, $this->id);

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

		$copyObj->setPeopleTypeId($this->people_type_id);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setFullName($this->full_name);

		$copyObj->setEmailAddress($this->email_address);

		$copyObj->setBirthday($this->birthday);

		$copyObj->setDefaultLanguage($this->default_language);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getUserSiteList() as $relObj) {
				$copyObj->addUserSite($relObj->copy($deepCopy));
			}

			foreach($this->getRankingPlayerList() as $relObj) {
				$copyObj->addRankingPlayer($relObj->copy($deepCopy));
			}

			foreach($this->getRankingHistoryList() as $relObj) {
				$copyObj->addRankingHistory($relObj->copy($deepCopy));
			}

			foreach($this->getEventPlayerList() as $relObj) {
				$copyObj->addEventPlayer($relObj->copy($deepCopy));
			}

			foreach($this->getUserSiteOptionList() as $relObj) {
				$copyObj->addUserSiteOption($relObj->copy($deepCopy));
			}

			foreach($this->getEventCommentList() as $relObj) {
				$copyObj->addEventComment($relObj->copy($deepCopy));
			}

			foreach($this->getEventPhotoList() as $relObj) {
				$copyObj->addEventPhoto($relObj->copy($deepCopy));
			}

			foreach($this->getEventPhotoCommentList() as $relObj) {
				$copyObj->addEventPhotoComment($relObj->copy($deepCopy));
			}

			foreach($this->getUserAdminList() as $relObj) {
				$copyObj->addUserAdmin($relObj->copy($deepCopy));
			}

			foreach($this->getEventLivePlayerList() as $relObj) {
				$copyObj->addEventLivePlayer($relObj->copy($deepCopy));
			}

			foreach($this->getRankingLivePlayerList() as $relObj) {
				$copyObj->addRankingLivePlayer($relObj->copy($deepCopy));
			}

			foreach($this->getRankingLiveHistoryList() as $relObj) {
				$copyObj->addRankingLiveHistory($relObj->copy($deepCopy));
			}

			foreach($this->getiRankRankingList() as $relObj) {
				$copyObj->addiRankRanking($relObj->copy($deepCopy));
			}

			foreach($this->getEventLivePlayerScoreList() as $relObj) {
				$copyObj->addEventLivePlayerScore($relObj->copy($deepCopy));
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
			self::$peer = new PeoplePeer();
		}
		return self::$peer;
	}

	
	public function setVirtualTable($v)
	{


		if ($v === null) {
			$this->setPeopleTypeId(NULL);
		} else {
			$this->setPeopleTypeId($v->getId());
		}


		$this->aVirtualTable = $v;
	}


	
	public function getVirtualTable($con = null)
	{
		if ($this->aVirtualTable === null && ($this->people_type_id !== null)) {
						include_once 'lib/model/om/BaseVirtualTablePeer.php';

			$this->aVirtualTable = VirtualTablePeer::retrieveByPK($this->people_type_id, $con);

			
		}
		return $this->aVirtualTable;
	}

	
	public function initUserSiteList()
	{
		if ($this->collUserSiteList === null) {
			$this->collUserSiteList = array();
		}
	}

	
	public function getUserSiteList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserSitePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserSiteList === null) {
			if ($this->isNew()) {
			   $this->collUserSiteList = array();
			} else {

				$criteria->add(UserSitePeer::PEOPLE_ID, $this->getId());

				UserSitePeer::addSelectColumns($criteria);
				$this->collUserSiteList = UserSitePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserSitePeer::PEOPLE_ID, $this->getId());

				UserSitePeer::addSelectColumns($criteria);
				if (!isset($this->lastUserSiteCriteria) || !$this->lastUserSiteCriteria->equals($criteria)) {
					$this->collUserSiteList = UserSitePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserSiteCriteria = $criteria;
		return $this->collUserSiteList;
	}

	
	public function countUserSiteList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUserSitePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserSitePeer::PEOPLE_ID, $this->getId());

		return UserSitePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserSite(UserSite $l)
	{
		$this->collUserSiteList[] = $l;
		$l->setPeople($this);
	}

	
	public function initRankingPlayerList()
	{
		if ($this->collRankingPlayerList === null) {
			$this->collRankingPlayerList = array();
		}
	}

	
	public function getRankingPlayerList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingPlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingPlayerList === null) {
			if ($this->isNew()) {
			   $this->collRankingPlayerList = array();
			} else {

				$criteria->add(RankingPlayerPeer::PEOPLE_ID, $this->getId());

				RankingPlayerPeer::addSelectColumns($criteria);
				$this->collRankingPlayerList = RankingPlayerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingPlayerPeer::PEOPLE_ID, $this->getId());

				RankingPlayerPeer::addSelectColumns($criteria);
				if (!isset($this->lastRankingPlayerCriteria) || !$this->lastRankingPlayerCriteria->equals($criteria)) {
					$this->collRankingPlayerList = RankingPlayerPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRankingPlayerCriteria = $criteria;
		return $this->collRankingPlayerList;
	}

	
	public function countRankingPlayerList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRankingPlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RankingPlayerPeer::PEOPLE_ID, $this->getId());

		return RankingPlayerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingPlayer(RankingPlayer $l)
	{
		$this->collRankingPlayerList[] = $l;
		$l->setPeople($this);
	}


	
	public function getRankingPlayerListJoinRanking($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingPlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingPlayerList === null) {
			if ($this->isNew()) {
				$this->collRankingPlayerList = array();
			} else {

				$criteria->add(RankingPlayerPeer::PEOPLE_ID, $this->getId());

				$this->collRankingPlayerList = RankingPlayerPeer::doSelectJoinRanking($criteria, $con);
			}
		} else {
									
			$criteria->add(RankingPlayerPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastRankingPlayerCriteria) || !$this->lastRankingPlayerCriteria->equals($criteria)) {
				$this->collRankingPlayerList = RankingPlayerPeer::doSelectJoinRanking($criteria, $con);
			}
		}
		$this->lastRankingPlayerCriteria = $criteria;

		return $this->collRankingPlayerList;
	}

	
	public function initRankingHistoryList()
	{
		if ($this->collRankingHistoryList === null) {
			$this->collRankingHistoryList = array();
		}
	}

	
	public function getRankingHistoryList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingHistoryList === null) {
			if ($this->isNew()) {
			   $this->collRankingHistoryList = array();
			} else {

				$criteria->add(RankingHistoryPeer::PEOPLE_ID, $this->getId());

				RankingHistoryPeer::addSelectColumns($criteria);
				$this->collRankingHistoryList = RankingHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingHistoryPeer::PEOPLE_ID, $this->getId());

				RankingHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastRankingHistoryCriteria) || !$this->lastRankingHistoryCriteria->equals($criteria)) {
					$this->collRankingHistoryList = RankingHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRankingHistoryCriteria = $criteria;
		return $this->collRankingHistoryList;
	}

	
	public function countRankingHistoryList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRankingHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RankingHistoryPeer::PEOPLE_ID, $this->getId());

		return RankingHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingHistory(RankingHistory $l)
	{
		$this->collRankingHistoryList[] = $l;
		$l->setPeople($this);
	}


	
	public function getRankingHistoryListJoinRanking($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingHistoryList === null) {
			if ($this->isNew()) {
				$this->collRankingHistoryList = array();
			} else {

				$criteria->add(RankingHistoryPeer::PEOPLE_ID, $this->getId());

				$this->collRankingHistoryList = RankingHistoryPeer::doSelectJoinRanking($criteria, $con);
			}
		} else {
									
			$criteria->add(RankingHistoryPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastRankingHistoryCriteria) || !$this->lastRankingHistoryCriteria->equals($criteria)) {
				$this->collRankingHistoryList = RankingHistoryPeer::doSelectJoinRanking($criteria, $con);
			}
		}
		$this->lastRankingHistoryCriteria = $criteria;

		return $this->collRankingHistoryList;
	}

	
	public function initEventPlayerList()
	{
		if ($this->collEventPlayerList === null) {
			$this->collEventPlayerList = array();
		}
	}

	
	public function getEventPlayerList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPlayerList === null) {
			if ($this->isNew()) {
			   $this->collEventPlayerList = array();
			} else {

				$criteria->add(EventPlayerPeer::PEOPLE_ID, $this->getId());

				EventPlayerPeer::addSelectColumns($criteria);
				$this->collEventPlayerList = EventPlayerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPlayerPeer::PEOPLE_ID, $this->getId());

				EventPlayerPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventPlayerCriteria) || !$this->lastEventPlayerCriteria->equals($criteria)) {
					$this->collEventPlayerList = EventPlayerPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventPlayerCriteria = $criteria;
		return $this->collEventPlayerList;
	}

	
	public function countEventPlayerList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventPlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPlayerPeer::PEOPLE_ID, $this->getId());

		return EventPlayerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventPlayer(EventPlayer $l)
	{
		$this->collEventPlayerList[] = $l;
		$l->setPeople($this);
	}


	
	public function getEventPlayerListJoinEvent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPlayerList === null) {
			if ($this->isNew()) {
				$this->collEventPlayerList = array();
			} else {

				$criteria->add(EventPlayerPeer::PEOPLE_ID, $this->getId());

				$this->collEventPlayerList = EventPlayerPeer::doSelectJoinEvent($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPlayerPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastEventPlayerCriteria) || !$this->lastEventPlayerCriteria->equals($criteria)) {
				$this->collEventPlayerList = EventPlayerPeer::doSelectJoinEvent($criteria, $con);
			}
		}
		$this->lastEventPlayerCriteria = $criteria;

		return $this->collEventPlayerList;
	}

	
	public function initUserSiteOptionList()
	{
		if ($this->collUserSiteOptionList === null) {
			$this->collUserSiteOptionList = array();
		}
	}

	
	public function getUserSiteOptionList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserSiteOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserSiteOptionList === null) {
			if ($this->isNew()) {
			   $this->collUserSiteOptionList = array();
			} else {

				$criteria->add(UserSiteOptionPeer::PEOPLE_ID, $this->getId());

				UserSiteOptionPeer::addSelectColumns($criteria);
				$this->collUserSiteOptionList = UserSiteOptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserSiteOptionPeer::PEOPLE_ID, $this->getId());

				UserSiteOptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserSiteOptionCriteria) || !$this->lastUserSiteOptionCriteria->equals($criteria)) {
					$this->collUserSiteOptionList = UserSiteOptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserSiteOptionCriteria = $criteria;
		return $this->collUserSiteOptionList;
	}

	
	public function countUserSiteOptionList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUserSiteOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserSiteOptionPeer::PEOPLE_ID, $this->getId());

		return UserSiteOptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserSiteOption(UserSiteOption $l)
	{
		$this->collUserSiteOptionList[] = $l;
		$l->setPeople($this);
	}


	
	public function getUserSiteOptionListJoinVirtualTable($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserSiteOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserSiteOptionList === null) {
			if ($this->isNew()) {
				$this->collUserSiteOptionList = array();
			} else {

				$criteria->add(UserSiteOptionPeer::PEOPLE_ID, $this->getId());

				$this->collUserSiteOptionList = UserSiteOptionPeer::doSelectJoinVirtualTable($criteria, $con);
			}
		} else {
									
			$criteria->add(UserSiteOptionPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastUserSiteOptionCriteria) || !$this->lastUserSiteOptionCriteria->equals($criteria)) {
				$this->collUserSiteOptionList = UserSiteOptionPeer::doSelectJoinVirtualTable($criteria, $con);
			}
		}
		$this->lastUserSiteOptionCriteria = $criteria;

		return $this->collUserSiteOptionList;
	}

	
	public function initEventCommentList()
	{
		if ($this->collEventCommentList === null) {
			$this->collEventCommentList = array();
		}
	}

	
	public function getEventCommentList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventCommentList === null) {
			if ($this->isNew()) {
			   $this->collEventCommentList = array();
			} else {

				$criteria->add(EventCommentPeer::PEOPLE_ID, $this->getId());

				EventCommentPeer::addSelectColumns($criteria);
				$this->collEventCommentList = EventCommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventCommentPeer::PEOPLE_ID, $this->getId());

				EventCommentPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventCommentCriteria) || !$this->lastEventCommentCriteria->equals($criteria)) {
					$this->collEventCommentList = EventCommentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventCommentCriteria = $criteria;
		return $this->collEventCommentList;
	}

	
	public function countEventCommentList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventCommentPeer::PEOPLE_ID, $this->getId());

		return EventCommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventComment(EventComment $l)
	{
		$this->collEventCommentList[] = $l;
		$l->setPeople($this);
	}


	
	public function getEventCommentListJoinEvent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventCommentList === null) {
			if ($this->isNew()) {
				$this->collEventCommentList = array();
			} else {

				$criteria->add(EventCommentPeer::PEOPLE_ID, $this->getId());

				$this->collEventCommentList = EventCommentPeer::doSelectJoinEvent($criteria, $con);
			}
		} else {
									
			$criteria->add(EventCommentPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastEventCommentCriteria) || !$this->lastEventCommentCriteria->equals($criteria)) {
				$this->collEventCommentList = EventCommentPeer::doSelectJoinEvent($criteria, $con);
			}
		}
		$this->lastEventCommentCriteria = $criteria;

		return $this->collEventCommentList;
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

				$criteria->add(EventPhotoPeer::PEOPLE_ID, $this->getId());

				EventPhotoPeer::addSelectColumns($criteria);
				$this->collEventPhotoList = EventPhotoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPhotoPeer::PEOPLE_ID, $this->getId());

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

		$criteria->add(EventPhotoPeer::PEOPLE_ID, $this->getId());

		return EventPhotoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventPhoto(EventPhoto $l)
	{
		$this->collEventPhotoList[] = $l;
		$l->setPeople($this);
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

				$criteria->add(EventPhotoPeer::PEOPLE_ID, $this->getId());

				$this->collEventPhotoList = EventPhotoPeer::doSelectJoinEvent($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPhotoPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastEventPhotoCriteria) || !$this->lastEventPhotoCriteria->equals($criteria)) {
				$this->collEventPhotoList = EventPhotoPeer::doSelectJoinEvent($criteria, $con);
			}
		}
		$this->lastEventPhotoCriteria = $criteria;

		return $this->collEventPhotoList;
	}


	
	public function getEventPhotoListJoinFile($criteria = null, $con = null)
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

				$criteria->add(EventPhotoPeer::PEOPLE_ID, $this->getId());

				$this->collEventPhotoList = EventPhotoPeer::doSelectJoinFile($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPhotoPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastEventPhotoCriteria) || !$this->lastEventPhotoCriteria->equals($criteria)) {
				$this->collEventPhotoList = EventPhotoPeer::doSelectJoinFile($criteria, $con);
			}
		}
		$this->lastEventPhotoCriteria = $criteria;

		return $this->collEventPhotoList;
	}

	
	public function initEventPhotoCommentList()
	{
		if ($this->collEventPhotoCommentList === null) {
			$this->collEventPhotoCommentList = array();
		}
	}

	
	public function getEventPhotoCommentList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPhotoCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPhotoCommentList === null) {
			if ($this->isNew()) {
			   $this->collEventPhotoCommentList = array();
			} else {

				$criteria->add(EventPhotoCommentPeer::PEOPLE_ID, $this->getId());

				EventPhotoCommentPeer::addSelectColumns($criteria);
				$this->collEventPhotoCommentList = EventPhotoCommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPhotoCommentPeer::PEOPLE_ID, $this->getId());

				EventPhotoCommentPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventPhotoCommentCriteria) || !$this->lastEventPhotoCommentCriteria->equals($criteria)) {
					$this->collEventPhotoCommentList = EventPhotoCommentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventPhotoCommentCriteria = $criteria;
		return $this->collEventPhotoCommentList;
	}

	
	public function countEventPhotoCommentList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventPhotoCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPhotoCommentPeer::PEOPLE_ID, $this->getId());

		return EventPhotoCommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventPhotoComment(EventPhotoComment $l)
	{
		$this->collEventPhotoCommentList[] = $l;
		$l->setPeople($this);
	}


	
	public function getEventPhotoCommentListJoinEventPhoto($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPhotoCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPhotoCommentList === null) {
			if ($this->isNew()) {
				$this->collEventPhotoCommentList = array();
			} else {

				$criteria->add(EventPhotoCommentPeer::PEOPLE_ID, $this->getId());

				$this->collEventPhotoCommentList = EventPhotoCommentPeer::doSelectJoinEventPhoto($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPhotoCommentPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastEventPhotoCommentCriteria) || !$this->lastEventPhotoCommentCriteria->equals($criteria)) {
				$this->collEventPhotoCommentList = EventPhotoCommentPeer::doSelectJoinEventPhoto($criteria, $con);
			}
		}
		$this->lastEventPhotoCommentCriteria = $criteria;

		return $this->collEventPhotoCommentList;
	}

	
	public function initUserAdminList()
	{
		if ($this->collUserAdminList === null) {
			$this->collUserAdminList = array();
		}
	}

	
	public function getUserAdminList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseUserAdminPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserAdminList === null) {
			if ($this->isNew()) {
			   $this->collUserAdminList = array();
			} else {

				$criteria->add(UserAdminPeer::PEOPLE_ID, $this->getId());

				UserAdminPeer::addSelectColumns($criteria);
				$this->collUserAdminList = UserAdminPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserAdminPeer::PEOPLE_ID, $this->getId());

				UserAdminPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserAdminCriteria) || !$this->lastUserAdminCriteria->equals($criteria)) {
					$this->collUserAdminList = UserAdminPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserAdminCriteria = $criteria;
		return $this->collUserAdminList;
	}

	
	public function countUserAdminList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseUserAdminPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserAdminPeer::PEOPLE_ID, $this->getId());

		return UserAdminPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserAdmin(UserAdmin $l)
	{
		$this->collUserAdminList[] = $l;
		$l->setPeople($this);
	}


	
	public function getUserAdminListJoinClub($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseUserAdminPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserAdminList === null) {
			if ($this->isNew()) {
				$this->collUserAdminList = array();
			} else {

				$criteria->add(UserAdminPeer::PEOPLE_ID, $this->getId());

				$this->collUserAdminList = UserAdminPeer::doSelectJoinClub($criteria, $con);
			}
		} else {
									
			$criteria->add(UserAdminPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastUserAdminCriteria) || !$this->lastUserAdminCriteria->equals($criteria)) {
				$this->collUserAdminList = UserAdminPeer::doSelectJoinClub($criteria, $con);
			}
		}
		$this->lastUserAdminCriteria = $criteria;

		return $this->collUserAdminList;
	}

	
	public function initEventLivePlayerList()
	{
		if ($this->collEventLivePlayerList === null) {
			$this->collEventLivePlayerList = array();
		}
	}

	
	public function getEventLivePlayerList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePlayerList === null) {
			if ($this->isNew()) {
			   $this->collEventLivePlayerList = array();
			} else {

				$criteria->add(EventLivePlayerPeer::PEOPLE_ID, $this->getId());

				EventLivePlayerPeer::addSelectColumns($criteria);
				$this->collEventLivePlayerList = EventLivePlayerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventLivePlayerPeer::PEOPLE_ID, $this->getId());

				EventLivePlayerPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventLivePlayerCriteria) || !$this->lastEventLivePlayerCriteria->equals($criteria)) {
					$this->collEventLivePlayerList = EventLivePlayerPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventLivePlayerCriteria = $criteria;
		return $this->collEventLivePlayerList;
	}

	
	public function countEventLivePlayerList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventLivePlayerPeer::PEOPLE_ID, $this->getId());

		return EventLivePlayerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventLivePlayer(EventLivePlayer $l)
	{
		$this->collEventLivePlayerList[] = $l;
		$l->setPeople($this);
	}


	
	public function getEventLivePlayerListJoinEventLive($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePlayerList === null) {
			if ($this->isNew()) {
				$this->collEventLivePlayerList = array();
			} else {

				$criteria->add(EventLivePlayerPeer::PEOPLE_ID, $this->getId());

				$this->collEventLivePlayerList = EventLivePlayerPeer::doSelectJoinEventLive($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePlayerPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastEventLivePlayerCriteria) || !$this->lastEventLivePlayerCriteria->equals($criteria)) {
				$this->collEventLivePlayerList = EventLivePlayerPeer::doSelectJoinEventLive($criteria, $con);
			}
		}
		$this->lastEventLivePlayerCriteria = $criteria;

		return $this->collEventLivePlayerList;
	}

	
	public function initRankingLivePlayerList()
	{
		if ($this->collRankingLivePlayerList === null) {
			$this->collRankingLivePlayerList = array();
		}
	}

	
	public function getRankingLivePlayerList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingLivePlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingLivePlayerList === null) {
			if ($this->isNew()) {
			   $this->collRankingLivePlayerList = array();
			} else {

				$criteria->add(RankingLivePlayerPeer::PEOPLE_ID, $this->getId());

				RankingLivePlayerPeer::addSelectColumns($criteria);
				$this->collRankingLivePlayerList = RankingLivePlayerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingLivePlayerPeer::PEOPLE_ID, $this->getId());

				RankingLivePlayerPeer::addSelectColumns($criteria);
				if (!isset($this->lastRankingLivePlayerCriteria) || !$this->lastRankingLivePlayerCriteria->equals($criteria)) {
					$this->collRankingLivePlayerList = RankingLivePlayerPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRankingLivePlayerCriteria = $criteria;
		return $this->collRankingLivePlayerList;
	}

	
	public function countRankingLivePlayerList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRankingLivePlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RankingLivePlayerPeer::PEOPLE_ID, $this->getId());

		return RankingLivePlayerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingLivePlayer(RankingLivePlayer $l)
	{
		$this->collRankingLivePlayerList[] = $l;
		$l->setPeople($this);
	}


	
	public function getRankingLivePlayerListJoinRankingLive($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingLivePlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingLivePlayerList === null) {
			if ($this->isNew()) {
				$this->collRankingLivePlayerList = array();
			} else {

				$criteria->add(RankingLivePlayerPeer::PEOPLE_ID, $this->getId());

				$this->collRankingLivePlayerList = RankingLivePlayerPeer::doSelectJoinRankingLive($criteria, $con);
			}
		} else {
									
			$criteria->add(RankingLivePlayerPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastRankingLivePlayerCriteria) || !$this->lastRankingLivePlayerCriteria->equals($criteria)) {
				$this->collRankingLivePlayerList = RankingLivePlayerPeer::doSelectJoinRankingLive($criteria, $con);
			}
		}
		$this->lastRankingLivePlayerCriteria = $criteria;

		return $this->collRankingLivePlayerList;
	}

	
	public function initRankingLiveHistoryList()
	{
		if ($this->collRankingLiveHistoryList === null) {
			$this->collRankingLiveHistoryList = array();
		}
	}

	
	public function getRankingLiveHistoryList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingLiveHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingLiveHistoryList === null) {
			if ($this->isNew()) {
			   $this->collRankingLiveHistoryList = array();
			} else {

				$criteria->add(RankingLiveHistoryPeer::PEOPLE_ID, $this->getId());

				RankingLiveHistoryPeer::addSelectColumns($criteria);
				$this->collRankingLiveHistoryList = RankingLiveHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingLiveHistoryPeer::PEOPLE_ID, $this->getId());

				RankingLiveHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastRankingLiveHistoryCriteria) || !$this->lastRankingLiveHistoryCriteria->equals($criteria)) {
					$this->collRankingLiveHistoryList = RankingLiveHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRankingLiveHistoryCriteria = $criteria;
		return $this->collRankingLiveHistoryList;
	}

	
	public function countRankingLiveHistoryList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRankingLiveHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RankingLiveHistoryPeer::PEOPLE_ID, $this->getId());

		return RankingLiveHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingLiveHistory(RankingLiveHistory $l)
	{
		$this->collRankingLiveHistoryList[] = $l;
		$l->setPeople($this);
	}


	
	public function getRankingLiveHistoryListJoinRankingLive($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingLiveHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingLiveHistoryList === null) {
			if ($this->isNew()) {
				$this->collRankingLiveHistoryList = array();
			} else {

				$criteria->add(RankingLiveHistoryPeer::PEOPLE_ID, $this->getId());

				$this->collRankingLiveHistoryList = RankingLiveHistoryPeer::doSelectJoinRankingLive($criteria, $con);
			}
		} else {
									
			$criteria->add(RankingLiveHistoryPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastRankingLiveHistoryCriteria) || !$this->lastRankingLiveHistoryCriteria->equals($criteria)) {
				$this->collRankingLiveHistoryList = RankingLiveHistoryPeer::doSelectJoinRankingLive($criteria, $con);
			}
		}
		$this->lastRankingLiveHistoryCriteria = $criteria;

		return $this->collRankingLiveHistoryList;
	}

	
	public function initiRankRankingList()
	{
		if ($this->colliRankRankingList === null) {
			$this->colliRankRankingList = array();
		}
	}

	
	public function getiRankRankingList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseiRankRankingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colliRankRankingList === null) {
			if ($this->isNew()) {
			   $this->colliRankRankingList = array();
			} else {

				$criteria->add(iRankRankingPeer::PEOPLE_ID, $this->getId());

				iRankRankingPeer::addSelectColumns($criteria);
				$this->colliRankRankingList = iRankRankingPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(iRankRankingPeer::PEOPLE_ID, $this->getId());

				iRankRankingPeer::addSelectColumns($criteria);
				if (!isset($this->lastiRankRankingCriteria) || !$this->lastiRankRankingCriteria->equals($criteria)) {
					$this->colliRankRankingList = iRankRankingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastiRankRankingCriteria = $criteria;
		return $this->colliRankRankingList;
	}

	
	public function countiRankRankingList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseiRankRankingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(iRankRankingPeer::PEOPLE_ID, $this->getId());

		return iRankRankingPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addiRankRanking(iRankRanking $l)
	{
		$this->colliRankRankingList[] = $l;
		$l->setPeople($this);
	}

	
	public function initEventLivePlayerScoreList()
	{
		if ($this->collEventLivePlayerScoreList === null) {
			$this->collEventLivePlayerScoreList = array();
		}
	}

	
	public function getEventLivePlayerScoreList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerScorePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePlayerScoreList === null) {
			if ($this->isNew()) {
			   $this->collEventLivePlayerScoreList = array();
			} else {

				$criteria->add(EventLivePlayerScorePeer::PEOPLE_ID, $this->getId());

				EventLivePlayerScorePeer::addSelectColumns($criteria);
				$this->collEventLivePlayerScoreList = EventLivePlayerScorePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventLivePlayerScorePeer::PEOPLE_ID, $this->getId());

				EventLivePlayerScorePeer::addSelectColumns($criteria);
				if (!isset($this->lastEventLivePlayerScoreCriteria) || !$this->lastEventLivePlayerScoreCriteria->equals($criteria)) {
					$this->collEventLivePlayerScoreList = EventLivePlayerScorePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventLivePlayerScoreCriteria = $criteria;
		return $this->collEventLivePlayerScoreList;
	}

	
	public function countEventLivePlayerScoreList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerScorePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventLivePlayerScorePeer::PEOPLE_ID, $this->getId());

		return EventLivePlayerScorePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventLivePlayerScore(EventLivePlayerScore $l)
	{
		$this->collEventLivePlayerScoreList[] = $l;
		$l->setPeople($this);
	}


	
	public function getEventLivePlayerScoreListJoinEventLive($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerScorePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePlayerScoreList === null) {
			if ($this->isNew()) {
				$this->collEventLivePlayerScoreList = array();
			} else {

				$criteria->add(EventLivePlayerScorePeer::PEOPLE_ID, $this->getId());

				$this->collEventLivePlayerScoreList = EventLivePlayerScorePeer::doSelectJoinEventLive($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePlayerScorePeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastEventLivePlayerScoreCriteria) || !$this->lastEventLivePlayerScoreCriteria->equals($criteria)) {
				$this->collEventLivePlayerScoreList = EventLivePlayerScorePeer::doSelectJoinEventLive($criteria, $con);
			}
		}
		$this->lastEventLivePlayerScoreCriteria = $criteria;

		return $this->collEventLivePlayerScoreList;
	}

} 