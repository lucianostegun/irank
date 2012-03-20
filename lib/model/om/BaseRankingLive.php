<?php


abstract class BaseRankingLive extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $ranking_name;


	
	protected $ranking_type_id;


	
	protected $start_date;


	
	protected $finish_date;


	
	protected $is_private = false;


	
	protected $players = 0;


	
	protected $events = 0;


	
	protected $default_buyin = 0;


	
	protected $game_style_id;


	
	protected $ranking_tag;


	
	protected $score_formula;


	
	protected $file_name_logo;


	
	protected $enabled = false;


	
	protected $visible = true;


	
	protected $locked = false;


	
	protected $deleted = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aVirtualTableRelatedByRankingTypeId;

	
	protected $aVirtualTableRelatedByGameStyleId;

	
	protected $collEventLiveList;

	
	protected $lastEventLiveCriteria = null;

	
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

	
	public function getRankingTypeId()
	{

		return $this->ranking_type_id;
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

	
	public function getPlayers()
	{

		return $this->players;
	}

	
	public function getEvents()
	{

		return $this->events;
	}

	
	public function getDefaultBuyin()
	{

		return $this->default_buyin;
	}

	
	public function getGameStyleId()
	{

		return $this->game_style_id;
	}

	
	public function getRankingTag()
	{

		return $this->ranking_tag;
	}

	
	public function getScoreFormula()
	{

		return $this->score_formula;
	}

	
	public function getFileNameLogo()
	{

		return $this->file_name_logo;
	}

	
	public function getEnabled()
	{

		return $this->enabled;
	}

	
	public function getVisible()
	{

		return $this->visible;
	}

	
	public function getLocked()
	{

		return $this->locked;
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
			$this->modifiedColumns[] = RankingLivePeer::ID;
		}

	} 
	
	public function setRankingName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ranking_name !== $v) {
			$this->ranking_name = $v;
			$this->modifiedColumns[] = RankingLivePeer::RANKING_NAME;
		}

	} 
	
	public function setRankingTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_type_id !== $v) {
			$this->ranking_type_id = $v;
			$this->modifiedColumns[] = RankingLivePeer::RANKING_TYPE_ID;
		}

		if ($this->aVirtualTableRelatedByRankingTypeId !== null && $this->aVirtualTableRelatedByRankingTypeId->getId() !== $v) {
			$this->aVirtualTableRelatedByRankingTypeId = null;
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
			$this->modifiedColumns[] = RankingLivePeer::START_DATE;
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
			$this->modifiedColumns[] = RankingLivePeer::FINISH_DATE;
		}

	} 
	
	public function setIsPrivate($v)
	{

		if ($this->is_private !== $v || $v === false) {
			$this->is_private = $v;
			$this->modifiedColumns[] = RankingLivePeer::IS_PRIVATE;
		}

	} 
	
	public function setPlayers($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->players !== $v || $v === 0) {
			$this->players = $v;
			$this->modifiedColumns[] = RankingLivePeer::PLAYERS;
		}

	} 
	
	public function setEvents($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->events !== $v || $v === 0) {
			$this->events = $v;
			$this->modifiedColumns[] = RankingLivePeer::EVENTS;
		}

	} 
	
	public function setDefaultBuyin($v)
	{

		if ($this->default_buyin !== $v || $v === 0) {
			$this->default_buyin = $v;
			$this->modifiedColumns[] = RankingLivePeer::DEFAULT_BUYIN;
		}

	} 
	
	public function setGameStyleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->game_style_id !== $v) {
			$this->game_style_id = $v;
			$this->modifiedColumns[] = RankingLivePeer::GAME_STYLE_ID;
		}

		if ($this->aVirtualTableRelatedByGameStyleId !== null && $this->aVirtualTableRelatedByGameStyleId->getId() !== $v) {
			$this->aVirtualTableRelatedByGameStyleId = null;
		}

	} 
	
	public function setRankingTag($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ranking_tag !== $v) {
			$this->ranking_tag = $v;
			$this->modifiedColumns[] = RankingLivePeer::RANKING_TAG;
		}

	} 
	
	public function setScoreFormula($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->score_formula !== $v) {
			$this->score_formula = $v;
			$this->modifiedColumns[] = RankingLivePeer::SCORE_FORMULA;
		}

	} 
	
	public function setFileNameLogo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_name_logo !== $v) {
			$this->file_name_logo = $v;
			$this->modifiedColumns[] = RankingLivePeer::FILE_NAME_LOGO;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v || $v === false) {
			$this->enabled = $v;
			$this->modifiedColumns[] = RankingLivePeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v || $v === true) {
			$this->visible = $v;
			$this->modifiedColumns[] = RankingLivePeer::VISIBLE;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v || $v === false) {
			$this->locked = $v;
			$this->modifiedColumns[] = RankingLivePeer::LOCKED;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v || $v === false) {
			$this->deleted = $v;
			$this->modifiedColumns[] = RankingLivePeer::DELETED;
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
			$this->modifiedColumns[] = RankingLivePeer::CREATED_AT;
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
			$this->modifiedColumns[] = RankingLivePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->ranking_name = $rs->getString($startcol + 1);

			$this->ranking_type_id = $rs->getInt($startcol + 2);

			$this->start_date = $rs->getDate($startcol + 3, null);

			$this->finish_date = $rs->getDate($startcol + 4, null);

			$this->is_private = $rs->getBoolean($startcol + 5);

			$this->players = $rs->getInt($startcol + 6);

			$this->events = $rs->getInt($startcol + 7);

			$this->default_buyin = $rs->getFloat($startcol + 8);

			$this->game_style_id = $rs->getInt($startcol + 9);

			$this->ranking_tag = $rs->getString($startcol + 10);

			$this->score_formula = $rs->getString($startcol + 11);

			$this->file_name_logo = $rs->getString($startcol + 12);

			$this->enabled = $rs->getBoolean($startcol + 13);

			$this->visible = $rs->getBoolean($startcol + 14);

			$this->locked = $rs->getBoolean($startcol + 15);

			$this->deleted = $rs->getBoolean($startcol + 16);

			$this->created_at = $rs->getTimestamp($startcol + 17, null);

			$this->updated_at = $rs->getTimestamp($startcol + 18, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 19; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RankingLive object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingLivePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RankingLivePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(RankingLivePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(RankingLivePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingLivePeer::DATABASE_NAME);
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


												
			if ($this->aVirtualTableRelatedByRankingTypeId !== null) {
				if ($this->aVirtualTableRelatedByRankingTypeId->isModified() || $this->aVirtualTableRelatedByRankingTypeId->getCurrentVirtualTableI18n()->isModified()) {
					$affectedRows += $this->aVirtualTableRelatedByRankingTypeId->save($con);
				}
				$this->setVirtualTableRelatedByRankingTypeId($this->aVirtualTableRelatedByRankingTypeId);
			}

			if ($this->aVirtualTableRelatedByGameStyleId !== null) {
				if ($this->aVirtualTableRelatedByGameStyleId->isModified() || $this->aVirtualTableRelatedByGameStyleId->getCurrentVirtualTableI18n()->isModified()) {
					$affectedRows += $this->aVirtualTableRelatedByGameStyleId->save($con);
				}
				$this->setVirtualTableRelatedByGameStyleId($this->aVirtualTableRelatedByGameStyleId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RankingLivePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RankingLivePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collEventLiveList !== null) {
				foreach($this->collEventLiveList as $referrerFK) {
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


			if (($retval = RankingLivePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEventLiveList !== null) {
					foreach($this->collEventLiveList as $referrerFK) {
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
		$pos = RankingLivePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getRankingTypeId();
				break;
			case 3:
				return $this->getStartDate();
				break;
			case 4:
				return $this->getFinishDate();
				break;
			case 5:
				return $this->getIsPrivate();
				break;
			case 6:
				return $this->getPlayers();
				break;
			case 7:
				return $this->getEvents();
				break;
			case 8:
				return $this->getDefaultBuyin();
				break;
			case 9:
				return $this->getGameStyleId();
				break;
			case 10:
				return $this->getRankingTag();
				break;
			case 11:
				return $this->getScoreFormula();
				break;
			case 12:
				return $this->getFileNameLogo();
				break;
			case 13:
				return $this->getEnabled();
				break;
			case 14:
				return $this->getVisible();
				break;
			case 15:
				return $this->getLocked();
				break;
			case 16:
				return $this->getDeleted();
				break;
			case 17:
				return $this->getCreatedAt();
				break;
			case 18:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingLivePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getRankingName(),
			$keys[2]=>$this->getRankingTypeId(),
			$keys[3]=>$this->getStartDate(),
			$keys[4]=>$this->getFinishDate(),
			$keys[5]=>$this->getIsPrivate(),
			$keys[6]=>$this->getPlayers(),
			$keys[7]=>$this->getEvents(),
			$keys[8]=>$this->getDefaultBuyin(),
			$keys[9]=>$this->getGameStyleId(),
			$keys[10]=>$this->getRankingTag(),
			$keys[11]=>$this->getScoreFormula(),
			$keys[12]=>$this->getFileNameLogo(),
			$keys[13]=>$this->getEnabled(),
			$keys[14]=>$this->getVisible(),
			$keys[15]=>$this->getLocked(),
			$keys[16]=>$this->getDeleted(),
			$keys[17]=>$this->getCreatedAt(),
			$keys[18]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingLivePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setRankingTypeId($value);
				break;
			case 3:
				$this->setStartDate($value);
				break;
			case 4:
				$this->setFinishDate($value);
				break;
			case 5:
				$this->setIsPrivate($value);
				break;
			case 6:
				$this->setPlayers($value);
				break;
			case 7:
				$this->setEvents($value);
				break;
			case 8:
				$this->setDefaultBuyin($value);
				break;
			case 9:
				$this->setGameStyleId($value);
				break;
			case 10:
				$this->setRankingTag($value);
				break;
			case 11:
				$this->setScoreFormula($value);
				break;
			case 12:
				$this->setFileNameLogo($value);
				break;
			case 13:
				$this->setEnabled($value);
				break;
			case 14:
				$this->setVisible($value);
				break;
			case 15:
				$this->setLocked($value);
				break;
			case 16:
				$this->setDeleted($value);
				break;
			case 17:
				$this->setCreatedAt($value);
				break;
			case 18:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingLivePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRankingName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRankingTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setStartDate($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFinishDate($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsPrivate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPlayers($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEvents($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDefaultBuyin($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setGameStyleId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setRankingTag($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setScoreFormula($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setFileNameLogo($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setEnabled($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setVisible($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setLocked($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setDeleted($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCreatedAt($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setUpdatedAt($arr[$keys[18]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RankingLivePeer::DATABASE_NAME);

		if ($this->isColumnModified(RankingLivePeer::ID)) $criteria->add(RankingLivePeer::ID, $this->id);
		if ($this->isColumnModified(RankingLivePeer::RANKING_NAME)) $criteria->add(RankingLivePeer::RANKING_NAME, $this->ranking_name);
		if ($this->isColumnModified(RankingLivePeer::RANKING_TYPE_ID)) $criteria->add(RankingLivePeer::RANKING_TYPE_ID, $this->ranking_type_id);
		if ($this->isColumnModified(RankingLivePeer::START_DATE)) $criteria->add(RankingLivePeer::START_DATE, $this->start_date);
		if ($this->isColumnModified(RankingLivePeer::FINISH_DATE)) $criteria->add(RankingLivePeer::FINISH_DATE, $this->finish_date);
		if ($this->isColumnModified(RankingLivePeer::IS_PRIVATE)) $criteria->add(RankingLivePeer::IS_PRIVATE, $this->is_private);
		if ($this->isColumnModified(RankingLivePeer::PLAYERS)) $criteria->add(RankingLivePeer::PLAYERS, $this->players);
		if ($this->isColumnModified(RankingLivePeer::EVENTS)) $criteria->add(RankingLivePeer::EVENTS, $this->events);
		if ($this->isColumnModified(RankingLivePeer::DEFAULT_BUYIN)) $criteria->add(RankingLivePeer::DEFAULT_BUYIN, $this->default_buyin);
		if ($this->isColumnModified(RankingLivePeer::GAME_STYLE_ID)) $criteria->add(RankingLivePeer::GAME_STYLE_ID, $this->game_style_id);
		if ($this->isColumnModified(RankingLivePeer::RANKING_TAG)) $criteria->add(RankingLivePeer::RANKING_TAG, $this->ranking_tag);
		if ($this->isColumnModified(RankingLivePeer::SCORE_FORMULA)) $criteria->add(RankingLivePeer::SCORE_FORMULA, $this->score_formula);
		if ($this->isColumnModified(RankingLivePeer::FILE_NAME_LOGO)) $criteria->add(RankingLivePeer::FILE_NAME_LOGO, $this->file_name_logo);
		if ($this->isColumnModified(RankingLivePeer::ENABLED)) $criteria->add(RankingLivePeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(RankingLivePeer::VISIBLE)) $criteria->add(RankingLivePeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(RankingLivePeer::LOCKED)) $criteria->add(RankingLivePeer::LOCKED, $this->locked);
		if ($this->isColumnModified(RankingLivePeer::DELETED)) $criteria->add(RankingLivePeer::DELETED, $this->deleted);
		if ($this->isColumnModified(RankingLivePeer::CREATED_AT)) $criteria->add(RankingLivePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RankingLivePeer::UPDATED_AT)) $criteria->add(RankingLivePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RankingLivePeer::DATABASE_NAME);

		$criteria->add(RankingLivePeer::ID, $this->id);

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

		$copyObj->setRankingTypeId($this->ranking_type_id);

		$copyObj->setStartDate($this->start_date);

		$copyObj->setFinishDate($this->finish_date);

		$copyObj->setIsPrivate($this->is_private);

		$copyObj->setPlayers($this->players);

		$copyObj->setEvents($this->events);

		$copyObj->setDefaultBuyin($this->default_buyin);

		$copyObj->setGameStyleId($this->game_style_id);

		$copyObj->setRankingTag($this->ranking_tag);

		$copyObj->setScoreFormula($this->score_formula);

		$copyObj->setFileNameLogo($this->file_name_logo);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setLocked($this->locked);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEventLiveList() as $relObj) {
				$copyObj->addEventLive($relObj->copy($deepCopy));
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
			self::$peer = new RankingLivePeer();
		}
		return self::$peer;
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

	
	public function initEventLiveList()
	{
		if ($this->collEventLiveList === null) {
			$this->collEventLiveList = array();
		}
	}

	
	public function getEventLiveList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLiveList === null) {
			if ($this->isNew()) {
			   $this->collEventLiveList = array();
			} else {

				$criteria->add(EventLivePeer::RANKING_LIVE_ID, $this->getId());

				EventLivePeer::addSelectColumns($criteria);
				$this->collEventLiveList = EventLivePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventLivePeer::RANKING_LIVE_ID, $this->getId());

				EventLivePeer::addSelectColumns($criteria);
				if (!isset($this->lastEventLiveCriteria) || !$this->lastEventLiveCriteria->equals($criteria)) {
					$this->collEventLiveList = EventLivePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventLiveCriteria = $criteria;
		return $this->collEventLiveList;
	}

	
	public function countEventLiveList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventLivePeer::RANKING_LIVE_ID, $this->getId());

		return EventLivePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventLive(EventLive $l)
	{
		$this->collEventLiveList[] = $l;
		$l->setRankingLive($this);
	}


	
	public function getEventLiveListJoinClub($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLiveList === null) {
			if ($this->isNew()) {
				$this->collEventLiveList = array();
			} else {

				$criteria->add(EventLivePeer::RANKING_LIVE_ID, $this->getId());

				$this->collEventLiveList = EventLivePeer::doSelectJoinClub($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePeer::RANKING_LIVE_ID, $this->getId());

			if (!isset($this->lastEventLiveCriteria) || !$this->lastEventLiveCriteria->equals($criteria)) {
				$this->collEventLiveList = EventLivePeer::doSelectJoinClub($criteria, $con);
			}
		}
		$this->lastEventLiveCriteria = $criteria;

		return $this->collEventLiveList;
	}

} 