<?php


abstract class BaseRanking extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $ranking_name;


	
	protected $user_site_id;


	
	protected $ranking_type_id;


	
	protected $game_style_id;


	
	protected $start_date;


	
	protected $finish_date;


	
	protected $is_private;


	
	protected $default_buyin;


	
	protected $members;


	
	protected $events;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aUserSite;

	
	protected $aVirtualTableRelatedByRankingTypeId;

	
	protected $aVirtualTableRelatedByGameStyleId;

	
	protected $collRankingMemberList;

	
	protected $lastRankingMemberCriteria = null;

	
	protected $collEventList;

	
	protected $lastEventCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getRankingName()
	{

		return $this->ranking_name;
	}

	
	public function getUserSiteId()
	{

		return $this->user_site_id;
	}

	
	public function getRankingTypeId()
	{

		return $this->ranking_type_id;
	}

	
	public function getGameStyleId()
	{

		return $this->game_style_id;
	}

	
	public function getStartDate($format = 'Y-m-d')
	{

		if ($this->start_date === null || $this->start_date === '') {
			return null;
		} elseif (!is_int($this->start_date)) {
						$ts = strtotime($this->start_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [start_date] as date/time value: " . var_export($this->start_date, true));
			}
		} else {
			$ts = $this->start_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getFinishDate($format = 'Y-m-d')
	{

		if ($this->finish_date === null || $this->finish_date === '') {
			return null;
		} elseif (!is_int($this->finish_date)) {
						$ts = strtotime($this->finish_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [finish_date] as date/time value: " . var_export($this->finish_date, true));
			}
		} else {
			$ts = $this->finish_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getIsPrivate()
	{

		return $this->is_private;
	}

	
	public function getDefaultBuyin()
	{

		return $this->default_buyin;
	}

	
	public function getMembers()
	{

		return $this->members;
	}

	
	public function getEvents()
	{

		return $this->events;
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
			$this->modifiedColumns[] = RankingPeer::ID;
		}

	} 
	
	public function setRankingName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ranking_name !== $v) {
			$this->ranking_name = $v;
			$this->modifiedColumns[] = RankingPeer::RANKING_NAME;
		}

	} 
	
	public function setUserSiteId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_site_id !== $v) {
			$this->user_site_id = $v;
			$this->modifiedColumns[] = RankingPeer::USER_SITE_ID;
		}

		if ($this->aUserSite !== null && $this->aUserSite->getId() !== $v) {
			$this->aUserSite = null;
		}

	} 
	
	public function setRankingTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_type_id !== $v) {
			$this->ranking_type_id = $v;
			$this->modifiedColumns[] = RankingPeer::RANKING_TYPE_ID;
		}

		if ($this->aVirtualTableRelatedByRankingTypeId !== null && $this->aVirtualTableRelatedByRankingTypeId->getId() !== $v) {
			$this->aVirtualTableRelatedByRankingTypeId = null;
		}

	} 
	
	public function setGameStyleId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->game_style_id !== $v) {
			$this->game_style_id = $v;
			$this->modifiedColumns[] = RankingPeer::GAME_STYLE_ID;
		}

		if ($this->aVirtualTableRelatedByGameStyleId !== null && $this->aVirtualTableRelatedByGameStyleId->getId() !== $v) {
			$this->aVirtualTableRelatedByGameStyleId = null;
		}

	} 
	
	public function setStartDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [start_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->start_date !== $ts) {
			$this->start_date = $ts;
			$this->modifiedColumns[] = RankingPeer::START_DATE;
		}

	} 
	
	public function setFinishDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [finish_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->finish_date !== $ts) {
			$this->finish_date = $ts;
			$this->modifiedColumns[] = RankingPeer::FINISH_DATE;
		}

	} 
	
	public function setIsPrivate($v)
	{

		if ($this->is_private !== $v) {
			$this->is_private = $v;
			$this->modifiedColumns[] = RankingPeer::IS_PRIVATE;
		}

	} 
	
	public function setDefaultBuyin($v)
	{

		if ($this->default_buyin !== $v) {
			$this->default_buyin = $v;
			$this->modifiedColumns[] = RankingPeer::DEFAULT_BUYIN;
		}

	} 
	
	public function setMembers($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->members !== $v) {
			$this->members = $v;
			$this->modifiedColumns[] = RankingPeer::MEMBERS;
		}

	} 
	
	public function setEvents($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->events !== $v) {
			$this->events = $v;
			$this->modifiedColumns[] = RankingPeer::EVENTS;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = RankingPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = RankingPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = RankingPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = RankingPeer::LOCKED;
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
			$this->modifiedColumns[] = RankingPeer::CREATED_AT;
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
			$this->modifiedColumns[] = RankingPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->ranking_name = $rs->getString($startcol + 1);

			$this->user_site_id = $rs->getInt($startcol + 2);

			$this->ranking_type_id = $rs->getInt($startcol + 3);

			$this->game_style_id = $rs->getInt($startcol + 4);

			$this->start_date = $rs->getDate($startcol + 5, null);

			$this->finish_date = $rs->getDate($startcol + 6, null);

			$this->is_private = $rs->getBoolean($startcol + 7);

			$this->default_buyin = $rs->getFloat($startcol + 8);

			$this->members = $rs->getInt($startcol + 9);

			$this->events = $rs->getInt($startcol + 10);

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
			throw new PropelException("Error populating Ranking object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RankingPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(RankingPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(RankingPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingPeer::DATABASE_NAME);
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


												
			if ($this->aUserSite !== null) {
				if ($this->aUserSite->isModified()) {
					$affectedRows += $this->aUserSite->save($con);
				}
				$this->setUserSite($this->aUserSite);
			}

			if ($this->aVirtualTableRelatedByRankingTypeId !== null) {
				if ($this->aVirtualTableRelatedByRankingTypeId->isModified()) {
					$affectedRows += $this->aVirtualTableRelatedByRankingTypeId->save($con);
				}
				$this->setVirtualTableRelatedByRankingTypeId($this->aVirtualTableRelatedByRankingTypeId);
			}

			if ($this->aVirtualTableRelatedByGameStyleId !== null) {
				if ($this->aVirtualTableRelatedByGameStyleId->isModified()) {
					$affectedRows += $this->aVirtualTableRelatedByGameStyleId->save($con);
				}
				$this->setVirtualTableRelatedByGameStyleId($this->aVirtualTableRelatedByGameStyleId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RankingPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RankingPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collRankingMemberList !== null) {
				foreach($this->collRankingMemberList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventList !== null) {
				foreach($this->collEventList as $referrerFK) {
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


												
			if ($this->aUserSite !== null) {
				if (!$this->aUserSite->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserSite->getValidationFailures());
				}
			}

			if ($this->aVirtualTableRelatedByRankingTypeId !== null) {
				if (!$this->aVirtualTableRelatedByRankingTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVirtualTableRelatedByRankingTypeId->getValidationFailures());
				}
			}

			if ($this->aVirtualTableRelatedByGameStyleId !== null) {
				if (!$this->aVirtualTableRelatedByGameStyleId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVirtualTableRelatedByGameStyleId->getValidationFailures());
				}
			}


			if (($retval = RankingPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRankingMemberList !== null) {
					foreach($this->collRankingMemberList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventList !== null) {
					foreach($this->collEventList as $referrerFK) {
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
		$pos = RankingPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getRankingName();
				break;
			case 2:
				return $this->getUserSiteId();
				break;
			case 3:
				return $this->getRankingTypeId();
				break;
			case 4:
				return $this->getGameStyleId();
				break;
			case 5:
				return $this->getStartDate();
				break;
			case 6:
				return $this->getFinishDate();
				break;
			case 7:
				return $this->getIsPrivate();
				break;
			case 8:
				return $this->getDefaultBuyin();
				break;
			case 9:
				return $this->getMembers();
				break;
			case 10:
				return $this->getEvents();
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
		$keys = RankingPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getRankingName(),
			$keys[2]=>$this->getUserSiteId(),
			$keys[3]=>$this->getRankingTypeId(),
			$keys[4]=>$this->getGameStyleId(),
			$keys[5]=>$this->getStartDate(),
			$keys[6]=>$this->getFinishDate(),
			$keys[7]=>$this->getIsPrivate(),
			$keys[8]=>$this->getDefaultBuyin(),
			$keys[9]=>$this->getMembers(),
			$keys[10]=>$this->getEvents(),
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
		$pos = RankingPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setRankingName($value);
				break;
			case 2:
				$this->setUserSiteId($value);
				break;
			case 3:
				$this->setRankingTypeId($value);
				break;
			case 4:
				$this->setGameStyleId($value);
				break;
			case 5:
				$this->setStartDate($value);
				break;
			case 6:
				$this->setFinishDate($value);
				break;
			case 7:
				$this->setIsPrivate($value);
				break;
			case 8:
				$this->setDefaultBuyin($value);
				break;
			case 9:
				$this->setMembers($value);
				break;
			case 10:
				$this->setEvents($value);
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
		$keys = RankingPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRankingName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserSiteId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRankingTypeId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setGameStyleId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setStartDate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFinishDate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsPrivate($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDefaultBuyin($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setMembers($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setEvents($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setEnabled($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setVisible($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setDeleted($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setLocked($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCreatedAt($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setUpdatedAt($arr[$keys[16]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RankingPeer::DATABASE_NAME);

		if ($this->isColumnModified(RankingPeer::ID)) $criteria->add(RankingPeer::ID, $this->id);
		if ($this->isColumnModified(RankingPeer::RANKING_NAME)) $criteria->add(RankingPeer::RANKING_NAME, $this->ranking_name);
		if ($this->isColumnModified(RankingPeer::USER_SITE_ID)) $criteria->add(RankingPeer::USER_SITE_ID, $this->user_site_id);
		if ($this->isColumnModified(RankingPeer::RANKING_TYPE_ID)) $criteria->add(RankingPeer::RANKING_TYPE_ID, $this->ranking_type_id);
		if ($this->isColumnModified(RankingPeer::GAME_STYLE_ID)) $criteria->add(RankingPeer::GAME_STYLE_ID, $this->game_style_id);
		if ($this->isColumnModified(RankingPeer::START_DATE)) $criteria->add(RankingPeer::START_DATE, $this->start_date);
		if ($this->isColumnModified(RankingPeer::FINISH_DATE)) $criteria->add(RankingPeer::FINISH_DATE, $this->finish_date);
		if ($this->isColumnModified(RankingPeer::IS_PRIVATE)) $criteria->add(RankingPeer::IS_PRIVATE, $this->is_private);
		if ($this->isColumnModified(RankingPeer::DEFAULT_BUYIN)) $criteria->add(RankingPeer::DEFAULT_BUYIN, $this->default_buyin);
		if ($this->isColumnModified(RankingPeer::MEMBERS)) $criteria->add(RankingPeer::MEMBERS, $this->members);
		if ($this->isColumnModified(RankingPeer::EVENTS)) $criteria->add(RankingPeer::EVENTS, $this->events);
		if ($this->isColumnModified(RankingPeer::ENABLED)) $criteria->add(RankingPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(RankingPeer::VISIBLE)) $criteria->add(RankingPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(RankingPeer::DELETED)) $criteria->add(RankingPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(RankingPeer::LOCKED)) $criteria->add(RankingPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(RankingPeer::CREATED_AT)) $criteria->add(RankingPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RankingPeer::UPDATED_AT)) $criteria->add(RankingPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RankingPeer::DATABASE_NAME);

		$criteria->add(RankingPeer::ID, $this->id);

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

		$copyObj->setRankingName($this->ranking_name);

		$copyObj->setUserSiteId($this->user_site_id);

		$copyObj->setRankingTypeId($this->ranking_type_id);

		$copyObj->setGameStyleId($this->game_style_id);

		$copyObj->setStartDate($this->start_date);

		$copyObj->setFinishDate($this->finish_date);

		$copyObj->setIsPrivate($this->is_private);

		$copyObj->setDefaultBuyin($this->default_buyin);

		$copyObj->setMembers($this->members);

		$copyObj->setEvents($this->events);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getRankingMemberList() as $relObj) {
				$copyObj->addRankingMember($relObj->copy($deepCopy));
			}

			foreach($this->getEventList() as $relObj) {
				$copyObj->addEvent($relObj->copy($deepCopy));
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
			self::$peer = new RankingPeer();
		}
		return self::$peer;
	}

	
	public function setUserSite($v)
	{


		if ($v === null) {
			$this->setUserSiteId(NULL);
		} else {
			$this->setUserSiteId($v->getId());
		}


		$this->aUserSite = $v;
	}


	
	public function getUserSite($con = null)
	{
		if ($this->aUserSite === null && ($this->user_site_id !== null)) {
						include_once 'lib/model/om/BaseUserSitePeer.php';

			$this->aUserSite = UserSitePeer::retrieveByPK($this->user_site_id, $con);

			
		}
		return $this->aUserSite;
	}

	
	public function setVirtualTableRelatedByRankingTypeId($v)
	{


		if ($v === null) {
			$this->setRankingTypeId(NULL);
		} else {
			$this->setRankingTypeId($v->getId());
		}


		$this->aVirtualTableRelatedByRankingTypeId = $v;
	}


	
	public function getVirtualTableRelatedByRankingTypeId($con = null)
	{
		if ($this->aVirtualTableRelatedByRankingTypeId === null && ($this->ranking_type_id !== null)) {
						include_once 'lib/model/om/BaseVirtualTablePeer.php';

			$this->aVirtualTableRelatedByRankingTypeId = VirtualTablePeer::retrieveByPK($this->ranking_type_id, $con);

			
		}
		return $this->aVirtualTableRelatedByRankingTypeId;
	}

	
	public function setVirtualTableRelatedByGameStyleId($v)
	{


		if ($v === null) {
			$this->setGameStyleId(NULL);
		} else {
			$this->setGameStyleId($v->getId());
		}


		$this->aVirtualTableRelatedByGameStyleId = $v;
	}


	
	public function getVirtualTableRelatedByGameStyleId($con = null)
	{
		if ($this->aVirtualTableRelatedByGameStyleId === null && ($this->game_style_id !== null)) {
						include_once 'lib/model/om/BaseVirtualTablePeer.php';

			$this->aVirtualTableRelatedByGameStyleId = VirtualTablePeer::retrieveByPK($this->game_style_id, $con);

			
		}
		return $this->aVirtualTableRelatedByGameStyleId;
	}

	
	public function initRankingMemberList()
	{
		if ($this->collRankingMemberList === null) {
			$this->collRankingMemberList = array();
		}
	}

	
	public function getRankingMemberList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingMemberPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingMemberList === null) {
			if ($this->isNew()) {
			   $this->collRankingMemberList = array();
			} else {

				$criteria->add(RankingMemberPeer::RANKING_ID, $this->getId());

				RankingMemberPeer::addSelectColumns($criteria);
				$this->collRankingMemberList = RankingMemberPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingMemberPeer::RANKING_ID, $this->getId());

				RankingMemberPeer::addSelectColumns($criteria);
				if (!isset($this->lastRankingMemberCriteria) || !$this->lastRankingMemberCriteria->equals($criteria)) {
					$this->collRankingMemberList = RankingMemberPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRankingMemberCriteria = $criteria;
		return $this->collRankingMemberList;
	}

	
	public function countRankingMemberList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRankingMemberPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RankingMemberPeer::RANKING_ID, $this->getId());

		return RankingMemberPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingMember(RankingMember $l)
	{
		$this->collRankingMemberList[] = $l;
		$l->setRanking($this);
	}


	
	public function getRankingMemberListJoinPeople($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingMemberPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingMemberList === null) {
			if ($this->isNew()) {
				$this->collRankingMemberList = array();
			} else {

				$criteria->add(RankingMemberPeer::RANKING_ID, $this->getId());

				$this->collRankingMemberList = RankingMemberPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(RankingMemberPeer::RANKING_ID, $this->getId());

			if (!isset($this->lastRankingMemberCriteria) || !$this->lastRankingMemberCriteria->equals($criteria)) {
				$this->collRankingMemberList = RankingMemberPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastRankingMemberCriteria = $criteria;

		return $this->collRankingMemberList;
	}

	
	public function initEventList()
	{
		if ($this->collEventList === null) {
			$this->collEventList = array();
		}
	}

	
	public function getEventList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventList === null) {
			if ($this->isNew()) {
			   $this->collEventList = array();
			} else {

				$criteria->add(EventPeer::RANKING_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				$this->collEventList = EventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPeer::RANKING_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventCriteria) || !$this->lastEventCriteria->equals($criteria)) {
					$this->collEventList = EventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventCriteria = $criteria;
		return $this->collEventList;
	}

	
	public function countEventList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPeer::RANKING_ID, $this->getId());

		return EventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEvent(Event $l)
	{
		$this->collEventList[] = $l;
		$l->setRanking($this);
	}

} 