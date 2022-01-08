<?php


abstract class BaseEventPhoto extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $event_id;


	
	protected $file_id;


	
	protected $people_id;


	
	protected $is_shared;


	
	protected $width;


	
	protected $height;


	
	protected $orientation;


	
	protected $contest_runs;


	
	protected $contest_wins;


	
	protected $contest_ratio;


	
	protected $deleted;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aEvent;

	
	protected $aFile;

	
	protected $aPeople;

	
	protected $collEventPhotoCommentList;

	
	protected $lastEventPhotoCommentCriteria = null;

	
	protected $collEventPhotoContestListRelatedByEventPhotoIdLeft;

	
	protected $lastEventPhotoContestRelatedByEventPhotoIdLeftCriteria = null;

	
	protected $collEventPhotoContestListRelatedByEventPhotoIdRight;

	
	protected $lastEventPhotoContestRelatedByEventPhotoIdRightCriteria = null;

	
	protected $collEventPhotoContestListRelatedByEventPhotoIdWinner;

	
	protected $lastEventPhotoContestRelatedByEventPhotoIdWinnerCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getEventId()
	{

		return $this->event_id;
	}

	
	public function getFileId()
	{

		return $this->file_id;
	}

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getIsShared()
	{

		return $this->is_shared;
	}

	
	public function getWidth()
	{

		return $this->width;
	}

	
	public function getHeight()
	{

		return $this->height;
	}

	
	public function getOrientation()
	{

		return $this->orientation;
	}

	
	public function getContestRuns()
	{

		return $this->contest_runs;
	}

	
	public function getContestWins()
	{

		return $this->contest_wins;
	}

	
	public function getContestRatio()
	{

		return $this->contest_ratio;
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
			$this->modifiedColumns[] = EventPhotoPeer::ID;
		}

	} 
	
	public function setEventId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_id !== $v) {
			$this->event_id = $v;
			$this->modifiedColumns[] = EventPhotoPeer::EVENT_ID;
		}

		if ($this->aEvent !== null && $this->aEvent->getId() !== $v) {
			$this->aEvent = null;
		}

	} 
	
	public function setFileId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->file_id !== $v) {
			$this->file_id = $v;
			$this->modifiedColumns[] = EventPhotoPeer::FILE_ID;
		}

		if ($this->aFile !== null && $this->aFile->getId() !== $v) {
			$this->aFile = null;
		}

	} 
	
	public function setPeopleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = EventPhotoPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setIsShared($v)
	{

		if ($this->is_shared !== $v) {
			$this->is_shared = $v;
			$this->modifiedColumns[] = EventPhotoPeer::IS_SHARED;
		}

	} 
	
	public function setWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->width !== $v) {
			$this->width = $v;
			$this->modifiedColumns[] = EventPhotoPeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->height !== $v) {
			$this->height = $v;
			$this->modifiedColumns[] = EventPhotoPeer::HEIGHT;
		}

	} 
	
	public function setOrientation($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->orientation !== $v) {
			$this->orientation = $v;
			$this->modifiedColumns[] = EventPhotoPeer::ORIENTATION;
		}

	} 
	
	public function setContestRuns($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->contest_runs !== $v) {
			$this->contest_runs = $v;
			$this->modifiedColumns[] = EventPhotoPeer::CONTEST_RUNS;
		}

	} 
	
	public function setContestWins($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->contest_wins !== $v) {
			$this->contest_wins = $v;
			$this->modifiedColumns[] = EventPhotoPeer::CONTEST_WINS;
		}

	} 
	
	public function setContestRatio($v)
	{

		if ($this->contest_ratio !== $v) {
			$this->contest_ratio = $v;
			$this->modifiedColumns[] = EventPhotoPeer::CONTEST_RATIO;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = EventPhotoPeer::DELETED;
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
			$this->modifiedColumns[] = EventPhotoPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EventPhotoPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->event_id = $rs->getInt($startcol + 1);

			$this->file_id = $rs->getInt($startcol + 2);

			$this->people_id = $rs->getInt($startcol + 3);

			$this->is_shared = $rs->getBoolean($startcol + 4);

			$this->width = $rs->getInt($startcol + 5);

			$this->height = $rs->getInt($startcol + 6);

			$this->orientation = $rs->getString($startcol + 7);

			$this->contest_runs = $rs->getInt($startcol + 8);

			$this->contest_wins = $rs->getInt($startcol + 9);

			$this->contest_ratio = $rs->getFloat($startcol + 10);

			$this->deleted = $rs->getBoolean($startcol + 11);

			$this->created_at = $rs->getTimestamp($startcol + 12, null);

			$this->updated_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EventPhoto object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventPhotoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventPhotoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EventPhotoPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EventPhotoPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(EventPhotoPeer::DATABASE_NAME);

		$tableName = EventPhotoPeer::TABLE_NAME;
		
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


												
			if ($this->aEvent !== null) {
				if ($this->aEvent->isModified()) {
					$affectedRows += $this->aEvent->save($con);
				}
				$this->setEvent($this->aEvent);
			}

			if ($this->aFile !== null) {
				if ($this->aFile->isModified()) {
					$affectedRows += $this->aFile->save($con);
				}
				$this->setFile($this->aFile);
			}

			if ($this->aPeople !== null) {
				if ($this->aPeople->isModified()) {
					$affectedRows += $this->aPeople->save($con);
				}
				$this->setPeople($this->aPeople);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventPhotoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EventPhotoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collEventPhotoCommentList !== null) {
				foreach($this->collEventPhotoCommentList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventPhotoContestListRelatedByEventPhotoIdLeft !== null) {
				foreach($this->collEventPhotoContestListRelatedByEventPhotoIdLeft as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventPhotoContestListRelatedByEventPhotoIdRight !== null) {
				foreach($this->collEventPhotoContestListRelatedByEventPhotoIdRight as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventPhotoContestListRelatedByEventPhotoIdWinner !== null) {
				foreach($this->collEventPhotoContestListRelatedByEventPhotoIdWinner as $referrerFK) {
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


												
			if ($this->aEvent !== null) {
				if (!$this->aEvent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEvent->getValidationFailures());
				}
			}

			if ($this->aFile !== null) {
				if (!$this->aFile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFile->getValidationFailures());
				}
			}

			if ($this->aPeople !== null) {
				if (!$this->aPeople->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPeople->getValidationFailures());
				}
			}


			if (($retval = EventPhotoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEventPhotoCommentList !== null) {
					foreach($this->collEventPhotoCommentList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventPhotoContestListRelatedByEventPhotoIdLeft !== null) {
					foreach($this->collEventPhotoContestListRelatedByEventPhotoIdLeft as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventPhotoContestListRelatedByEventPhotoIdRight !== null) {
					foreach($this->collEventPhotoContestListRelatedByEventPhotoIdRight as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventPhotoContestListRelatedByEventPhotoIdWinner !== null) {
					foreach($this->collEventPhotoContestListRelatedByEventPhotoIdWinner as $referrerFK) {
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
		$pos = EventPhotoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getEventId();
				break;
			case 2:
				return $this->getFileId();
				break;
			case 3:
				return $this->getPeopleId();
				break;
			case 4:
				return $this->getIsShared();
				break;
			case 5:
				return $this->getWidth();
				break;
			case 6:
				return $this->getHeight();
				break;
			case 7:
				return $this->getOrientation();
				break;
			case 8:
				return $this->getContestRuns();
				break;
			case 9:
				return $this->getContestWins();
				break;
			case 10:
				return $this->getContestRatio();
				break;
			case 11:
				return $this->getDeleted();
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
		$keys = EventPhotoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getEventId(),
			$keys[2]=>$this->getFileId(),
			$keys[3]=>$this->getPeopleId(),
			$keys[4]=>$this->getIsShared(),
			$keys[5]=>$this->getWidth(),
			$keys[6]=>$this->getHeight(),
			$keys[7]=>$this->getOrientation(),
			$keys[8]=>$this->getContestRuns(),
			$keys[9]=>$this->getContestWins(),
			$keys[10]=>$this->getContestRatio(),
			$keys[11]=>$this->getDeleted(),
			$keys[12]=>$this->getCreatedAt(),
			$keys[13]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventPhotoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setEventId($value);
				break;
			case 2:
				$this->setFileId($value);
				break;
			case 3:
				$this->setPeopleId($value);
				break;
			case 4:
				$this->setIsShared($value);
				break;
			case 5:
				$this->setWidth($value);
				break;
			case 6:
				$this->setHeight($value);
				break;
			case 7:
				$this->setOrientation($value);
				break;
			case 8:
				$this->setContestRuns($value);
				break;
			case 9:
				$this->setContestWins($value);
				break;
			case 10:
				$this->setContestRatio($value);
				break;
			case 11:
				$this->setDeleted($value);
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
		$keys = EventPhotoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEventId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFileId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPeopleId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsShared($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setWidth($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setHeight($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setOrientation($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setContestRuns($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setContestWins($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setContestRatio($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setDeleted($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventPhotoPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventPhotoPeer::ID)) $criteria->add(EventPhotoPeer::ID, $this->id);
		if ($this->isColumnModified(EventPhotoPeer::EVENT_ID)) $criteria->add(EventPhotoPeer::EVENT_ID, $this->event_id);
		if ($this->isColumnModified(EventPhotoPeer::FILE_ID)) $criteria->add(EventPhotoPeer::FILE_ID, $this->file_id);
		if ($this->isColumnModified(EventPhotoPeer::PEOPLE_ID)) $criteria->add(EventPhotoPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(EventPhotoPeer::IS_SHARED)) $criteria->add(EventPhotoPeer::IS_SHARED, $this->is_shared);
		if ($this->isColumnModified(EventPhotoPeer::WIDTH)) $criteria->add(EventPhotoPeer::WIDTH, $this->width);
		if ($this->isColumnModified(EventPhotoPeer::HEIGHT)) $criteria->add(EventPhotoPeer::HEIGHT, $this->height);
		if ($this->isColumnModified(EventPhotoPeer::ORIENTATION)) $criteria->add(EventPhotoPeer::ORIENTATION, $this->orientation);
		if ($this->isColumnModified(EventPhotoPeer::CONTEST_RUNS)) $criteria->add(EventPhotoPeer::CONTEST_RUNS, $this->contest_runs);
		if ($this->isColumnModified(EventPhotoPeer::CONTEST_WINS)) $criteria->add(EventPhotoPeer::CONTEST_WINS, $this->contest_wins);
		if ($this->isColumnModified(EventPhotoPeer::CONTEST_RATIO)) $criteria->add(EventPhotoPeer::CONTEST_RATIO, $this->contest_ratio);
		if ($this->isColumnModified(EventPhotoPeer::DELETED)) $criteria->add(EventPhotoPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(EventPhotoPeer::CREATED_AT)) $criteria->add(EventPhotoPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EventPhotoPeer::UPDATED_AT)) $criteria->add(EventPhotoPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventPhotoPeer::DATABASE_NAME);

		$criteria->add(EventPhotoPeer::ID, $this->id);

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

		$copyObj->setEventId($this->event_id);

		$copyObj->setFileId($this->file_id);

		$copyObj->setPeopleId($this->people_id);

		$copyObj->setIsShared($this->is_shared);

		$copyObj->setWidth($this->width);

		$copyObj->setHeight($this->height);

		$copyObj->setOrientation($this->orientation);

		$copyObj->setContestRuns($this->contest_runs);

		$copyObj->setContestWins($this->contest_wins);

		$copyObj->setContestRatio($this->contest_ratio);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEventPhotoCommentList() as $relObj) {
				$copyObj->addEventPhotoComment($relObj->copy($deepCopy));
			}

			foreach($this->getEventPhotoContestListRelatedByEventPhotoIdLeft() as $relObj) {
				$copyObj->addEventPhotoContestRelatedByEventPhotoIdLeft($relObj->copy($deepCopy));
			}

			foreach($this->getEventPhotoContestListRelatedByEventPhotoIdRight() as $relObj) {
				$copyObj->addEventPhotoContestRelatedByEventPhotoIdRight($relObj->copy($deepCopy));
			}

			foreach($this->getEventPhotoContestListRelatedByEventPhotoIdWinner() as $relObj) {
				$copyObj->addEventPhotoContestRelatedByEventPhotoIdWinner($relObj->copy($deepCopy));
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
			self::$peer = new EventPhotoPeer();
		}
		return self::$peer;
	}

	
	public function setEvent($v)
	{


		if ($v === null) {
			$this->setEventId(NULL);
		} else {
			$this->setEventId($v->getId());
		}


		$this->aEvent = $v;
	}


	
	public function getEvent($con = null)
	{
		if ($this->aEvent === null && ($this->event_id !== null)) {
						include_once 'lib/model/om/BaseEventPeer.php';

			$this->aEvent = EventPeer::retrieveByPK($this->event_id, $con);

			
		}
		return $this->aEvent;
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

				$criteria->add(EventPhotoCommentPeer::EVENT_PHOTO_ID, $this->getId());

				EventPhotoCommentPeer::addSelectColumns($criteria);
				$this->collEventPhotoCommentList = EventPhotoCommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPhotoCommentPeer::EVENT_PHOTO_ID, $this->getId());

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

		$criteria->add(EventPhotoCommentPeer::EVENT_PHOTO_ID, $this->getId());

		return EventPhotoCommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventPhotoComment(EventPhotoComment $l)
	{
		$this->collEventPhotoCommentList[] = $l;
		$l->setEventPhoto($this);
	}


	
	public function getEventPhotoCommentListJoinPeople($criteria = null, $con = null)
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

				$criteria->add(EventPhotoCommentPeer::EVENT_PHOTO_ID, $this->getId());

				$this->collEventPhotoCommentList = EventPhotoCommentPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPhotoCommentPeer::EVENT_PHOTO_ID, $this->getId());

			if (!isset($this->lastEventPhotoCommentCriteria) || !$this->lastEventPhotoCommentCriteria->equals($criteria)) {
				$this->collEventPhotoCommentList = EventPhotoCommentPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastEventPhotoCommentCriteria = $criteria;

		return $this->collEventPhotoCommentList;
	}

	
	public function initEventPhotoContestListRelatedByEventPhotoIdLeft()
	{
		if ($this->collEventPhotoContestListRelatedByEventPhotoIdLeft === null) {
			$this->collEventPhotoContestListRelatedByEventPhotoIdLeft = array();
		}
	}

	
	public function getEventPhotoContestListRelatedByEventPhotoIdLeft($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPhotoContestPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPhotoContestListRelatedByEventPhotoIdLeft === null) {
			if ($this->isNew()) {
			   $this->collEventPhotoContestListRelatedByEventPhotoIdLeft = array();
			} else {

				$criteria->add(EventPhotoContestPeer::EVENT_PHOTO_ID_LEFT, $this->getId());

				EventPhotoContestPeer::addSelectColumns($criteria);
				$this->collEventPhotoContestListRelatedByEventPhotoIdLeft = EventPhotoContestPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPhotoContestPeer::EVENT_PHOTO_ID_LEFT, $this->getId());

				EventPhotoContestPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventPhotoContestRelatedByEventPhotoIdLeftCriteria) || !$this->lastEventPhotoContestRelatedByEventPhotoIdLeftCriteria->equals($criteria)) {
					$this->collEventPhotoContestListRelatedByEventPhotoIdLeft = EventPhotoContestPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventPhotoContestRelatedByEventPhotoIdLeftCriteria = $criteria;
		return $this->collEventPhotoContestListRelatedByEventPhotoIdLeft;
	}

	
	public function countEventPhotoContestListRelatedByEventPhotoIdLeft($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventPhotoContestPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPhotoContestPeer::EVENT_PHOTO_ID_LEFT, $this->getId());

		return EventPhotoContestPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventPhotoContestRelatedByEventPhotoIdLeft(EventPhotoContest $l)
	{
		$this->collEventPhotoContestListRelatedByEventPhotoIdLeft[] = $l;
		$l->setEventPhotoRelatedByEventPhotoIdLeft($this);
	}

	
	public function initEventPhotoContestListRelatedByEventPhotoIdRight()
	{
		if ($this->collEventPhotoContestListRelatedByEventPhotoIdRight === null) {
			$this->collEventPhotoContestListRelatedByEventPhotoIdRight = array();
		}
	}

	
	public function getEventPhotoContestListRelatedByEventPhotoIdRight($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPhotoContestPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPhotoContestListRelatedByEventPhotoIdRight === null) {
			if ($this->isNew()) {
			   $this->collEventPhotoContestListRelatedByEventPhotoIdRight = array();
			} else {

				$criteria->add(EventPhotoContestPeer::EVENT_PHOTO_ID_RIGHT, $this->getId());

				EventPhotoContestPeer::addSelectColumns($criteria);
				$this->collEventPhotoContestListRelatedByEventPhotoIdRight = EventPhotoContestPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPhotoContestPeer::EVENT_PHOTO_ID_RIGHT, $this->getId());

				EventPhotoContestPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventPhotoContestRelatedByEventPhotoIdRightCriteria) || !$this->lastEventPhotoContestRelatedByEventPhotoIdRightCriteria->equals($criteria)) {
					$this->collEventPhotoContestListRelatedByEventPhotoIdRight = EventPhotoContestPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventPhotoContestRelatedByEventPhotoIdRightCriteria = $criteria;
		return $this->collEventPhotoContestListRelatedByEventPhotoIdRight;
	}

	
	public function countEventPhotoContestListRelatedByEventPhotoIdRight($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventPhotoContestPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPhotoContestPeer::EVENT_PHOTO_ID_RIGHT, $this->getId());

		return EventPhotoContestPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventPhotoContestRelatedByEventPhotoIdRight(EventPhotoContest $l)
	{
		$this->collEventPhotoContestListRelatedByEventPhotoIdRight[] = $l;
		$l->setEventPhotoRelatedByEventPhotoIdRight($this);
	}

	
	public function initEventPhotoContestListRelatedByEventPhotoIdWinner()
	{
		if ($this->collEventPhotoContestListRelatedByEventPhotoIdWinner === null) {
			$this->collEventPhotoContestListRelatedByEventPhotoIdWinner = array();
		}
	}

	
	public function getEventPhotoContestListRelatedByEventPhotoIdWinner($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPhotoContestPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPhotoContestListRelatedByEventPhotoIdWinner === null) {
			if ($this->isNew()) {
			   $this->collEventPhotoContestListRelatedByEventPhotoIdWinner = array();
			} else {

				$criteria->add(EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER, $this->getId());

				EventPhotoContestPeer::addSelectColumns($criteria);
				$this->collEventPhotoContestListRelatedByEventPhotoIdWinner = EventPhotoContestPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER, $this->getId());

				EventPhotoContestPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventPhotoContestRelatedByEventPhotoIdWinnerCriteria) || !$this->lastEventPhotoContestRelatedByEventPhotoIdWinnerCriteria->equals($criteria)) {
					$this->collEventPhotoContestListRelatedByEventPhotoIdWinner = EventPhotoContestPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventPhotoContestRelatedByEventPhotoIdWinnerCriteria = $criteria;
		return $this->collEventPhotoContestListRelatedByEventPhotoIdWinner;
	}

	
	public function countEventPhotoContestListRelatedByEventPhotoIdWinner($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventPhotoContestPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER, $this->getId());

		return EventPhotoContestPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventPhotoContestRelatedByEventPhotoIdWinner(EventPhotoContest $l)
	{
		$this->collEventPhotoContestListRelatedByEventPhotoIdWinner[] = $l;
		$l->setEventPhotoRelatedByEventPhotoIdWinner($this);
	}

} 