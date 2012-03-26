<?php


abstract class BaseEventLive extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $ranking_live_id;


	
	protected $event_name;


	
	protected $event_short_name;


	
	protected $event_date;


	
	protected $start_time;


	
	protected $event_datetime;


	
	protected $description;


	
	protected $club_id;


	
	protected $buyin;


	
	protected $blind_time;


	
	protected $stack_chips;


	
	protected $players;


	
	protected $allowed_rebuys = 0;


	
	protected $allowed_addons = 0;


	
	protected $is_ilimited_rebuys;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aRankingLive;

	
	protected $aClub;

	
	protected $collEventLivePlayerList;

	
	protected $lastEventLivePlayerCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getRankingLiveId()
	{

		return $this->ranking_live_id;
	}

	
	public function getEventName()
	{

		return $this->event_name;
	}

	
	public function getEventShortName()
	{

		return $this->event_short_name;
	}

	
	public function getEventDate($format = 'Y-m-d')
	{

		if ($this->event_date === null || $this->event_date === '') {
			return null;
		} elseif (!is_int($this->event_date)) {
						$ts = strtotime($this->event_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [event_date] as date/time value: " . var_export($this->event_date, true));
			}
		} else {
			$ts = $this->event_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getStartTime($format = 'H:i:s')
	{

		if ($this->start_time === null || $this->start_time === '') {
			return null;
		} elseif (!is_int($this->start_time)) {
						$ts = strtotime($this->start_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [start_time] as date/time value: " . var_export($this->start_time, true));
			}
		} else {
			$ts = $this->start_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getEventDatetime($format = 'Y-m-d H:i:s')
	{

		if ($this->event_datetime === null || $this->event_datetime === '') {
			return null;
		} elseif (!is_int($this->event_datetime)) {
						$ts = strtotime($this->event_datetime);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [event_datetime] as date/time value: " . var_export($this->event_datetime, true));
			}
		} else {
			$ts = $this->event_datetime;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getClubId()
	{

		return $this->club_id;
	}

	
	public function getBuyin()
	{

		return $this->buyin;
	}

	
	public function getBlindTime($format = 'H:i:s')
	{

		if ($this->blind_time === null || $this->blind_time === '') {
			return null;
		} elseif (!is_int($this->blind_time)) {
						$ts = strtotime($this->blind_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [blind_time] as date/time value: " . var_export($this->blind_time, true));
			}
		} else {
			$ts = $this->blind_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getStackChips()
	{

		return $this->stack_chips;
	}

	
	public function getPlayers()
	{

		return $this->players;
	}

	
	public function getAllowedRebuys()
	{

		return $this->allowed_rebuys;
	}

	
	public function getAllowedAddons()
	{

		return $this->allowed_addons;
	}

	
	public function getIsIlimitedRebuys()
	{

		return $this->is_ilimited_rebuys;
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
			$this->modifiedColumns[] = EventLivePeer::ID;
		}

	} 
	
	public function setRankingLiveId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_live_id !== $v) {
			$this->ranking_live_id = $v;
			$this->modifiedColumns[] = EventLivePeer::RANKING_LIVE_ID;
		}

		if ($this->aRankingLive !== null && $this->aRankingLive->getId() !== $v) {
			$this->aRankingLive = null;
		}

	} 
	
	public function setEventName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->event_name !== $v) {
			$this->event_name = $v;
			$this->modifiedColumns[] = EventLivePeer::EVENT_NAME;
		}

	} 
	
	public function setEventShortName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->event_short_name !== $v) {
			$this->event_short_name = $v;
			$this->modifiedColumns[] = EventLivePeer::EVENT_SHORT_NAME;
		}

	} 
	
	public function setEventDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [event_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->event_date !== $ts) {
			$this->event_date = $ts;
			$this->modifiedColumns[] = EventLivePeer::EVENT_DATE;
		}

	} 
	
	public function setStartTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [start_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->start_time !== $ts) {
			$this->start_time = $ts;
			$this->modifiedColumns[] = EventLivePeer::START_TIME;
		}

	} 
	
	public function setEventDatetime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [event_datetime] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->event_datetime !== $ts) {
			$this->event_datetime = $ts;
			$this->modifiedColumns[] = EventLivePeer::EVENT_DATETIME;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = EventLivePeer::DESCRIPTION;
		}

	} 
	
	public function setClubId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->club_id !== $v) {
			$this->club_id = $v;
			$this->modifiedColumns[] = EventLivePeer::CLUB_ID;
		}

		if ($this->aClub !== null && $this->aClub->getId() !== $v) {
			$this->aClub = null;
		}

	} 
	
	public function setBuyin($v)
	{

		if ($this->buyin !== $v) {
			$this->buyin = $v;
			$this->modifiedColumns[] = EventLivePeer::BUYIN;
		}

	} 
	
	public function setBlindTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [blind_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->blind_time !== $ts) {
			$this->blind_time = $ts;
			$this->modifiedColumns[] = EventLivePeer::BLIND_TIME;
		}

	} 
	
	public function setStackChips($v)
	{

		if ($this->stack_chips !== $v) {
			$this->stack_chips = $v;
			$this->modifiedColumns[] = EventLivePeer::STACK_CHIPS;
		}

	} 
	
	public function setPlayers($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->players !== $v) {
			$this->players = $v;
			$this->modifiedColumns[] = EventLivePeer::PLAYERS;
		}

	} 
	
	public function setAllowedRebuys($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->allowed_rebuys !== $v || $v === 0) {
			$this->allowed_rebuys = $v;
			$this->modifiedColumns[] = EventLivePeer::ALLOWED_REBUYS;
		}

	} 
	
	public function setAllowedAddons($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->allowed_addons !== $v || $v === 0) {
			$this->allowed_addons = $v;
			$this->modifiedColumns[] = EventLivePeer::ALLOWED_ADDONS;
		}

	} 
	
	public function setIsIlimitedRebuys($v)
	{

		if ($this->is_ilimited_rebuys !== $v) {
			$this->is_ilimited_rebuys = $v;
			$this->modifiedColumns[] = EventLivePeer::IS_ILIMITED_REBUYS;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = EventLivePeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = EventLivePeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = EventLivePeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = EventLivePeer::LOCKED;
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
			$this->modifiedColumns[] = EventLivePeer::CREATED_AT;
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
			$this->modifiedColumns[] = EventLivePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->ranking_live_id = $rs->getInt($startcol + 1);

			$this->event_name = $rs->getString($startcol + 2);

			$this->event_short_name = $rs->getString($startcol + 3);

			$this->event_date = $rs->getDate($startcol + 4, null);

			$this->start_time = $rs->getTime($startcol + 5, null);

			$this->event_datetime = $rs->getTimestamp($startcol + 6, null);

			$this->description = $rs->getString($startcol + 7);

			$this->club_id = $rs->getInt($startcol + 8);

			$this->buyin = $rs->getFloat($startcol + 9);

			$this->blind_time = $rs->getTime($startcol + 10, null);

			$this->stack_chips = $rs->getFloat($startcol + 11);

			$this->players = $rs->getInt($startcol + 12);

			$this->allowed_rebuys = $rs->getInt($startcol + 13);

			$this->allowed_addons = $rs->getInt($startcol + 14);

			$this->is_ilimited_rebuys = $rs->getBoolean($startcol + 15);

			$this->enabled = $rs->getBoolean($startcol + 16);

			$this->visible = $rs->getBoolean($startcol + 17);

			$this->deleted = $rs->getBoolean($startcol + 18);

			$this->locked = $rs->getBoolean($startcol + 19);

			$this->created_at = $rs->getTimestamp($startcol + 20, null);

			$this->updated_at = $rs->getTimestamp($startcol + 21, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 22; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EventLive object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventLivePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventLivePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EventLivePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EventLivePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventLivePeer::DATABASE_NAME);
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


												
			if ($this->aRankingLive !== null) {
				if ($this->aRankingLive->isModified()) {
					$affectedRows += $this->aRankingLive->save($con);
				}
				$this->setRankingLive($this->aRankingLive);
			}

			if ($this->aClub !== null) {
				if ($this->aClub->isModified()) {
					$affectedRows += $this->aClub->save($con);
				}
				$this->setClub($this->aClub);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventLivePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EventLivePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collEventLivePlayerList !== null) {
				foreach($this->collEventLivePlayerList as $referrerFK) {
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


												
			if ($this->aRankingLive !== null) {
				if (!$this->aRankingLive->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRankingLive->getValidationFailures());
				}
			}

			if ($this->aClub !== null) {
				if (!$this->aClub->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aClub->getValidationFailures());
				}
			}


			if (($retval = EventLivePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEventLivePlayerList !== null) {
					foreach($this->collEventLivePlayerList as $referrerFK) {
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
		$pos = EventLivePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getRankingLiveId();
				break;
			case 2:
				return $this->getEventName();
				break;
			case 3:
				return $this->getEventShortName();
				break;
			case 4:
				return $this->getEventDate();
				break;
			case 5:
				return $this->getStartTime();
				break;
			case 6:
				return $this->getEventDatetime();
				break;
			case 7:
				return $this->getDescription();
				break;
			case 8:
				return $this->getClubId();
				break;
			case 9:
				return $this->getBuyin();
				break;
			case 10:
				return $this->getBlindTime();
				break;
			case 11:
				return $this->getStackChips();
				break;
			case 12:
				return $this->getPlayers();
				break;
			case 13:
				return $this->getAllowedRebuys();
				break;
			case 14:
				return $this->getAllowedAddons();
				break;
			case 15:
				return $this->getIsIlimitedRebuys();
				break;
			case 16:
				return $this->getEnabled();
				break;
			case 17:
				return $this->getVisible();
				break;
			case 18:
				return $this->getDeleted();
				break;
			case 19:
				return $this->getLocked();
				break;
			case 20:
				return $this->getCreatedAt();
				break;
			case 21:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventLivePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getRankingLiveId(),
			$keys[2]=>$this->getEventName(),
			$keys[3]=>$this->getEventShortName(),
			$keys[4]=>$this->getEventDate(),
			$keys[5]=>$this->getStartTime(),
			$keys[6]=>$this->getEventDatetime(),
			$keys[7]=>$this->getDescription(),
			$keys[8]=>$this->getClubId(),
			$keys[9]=>$this->getBuyin(),
			$keys[10]=>$this->getBlindTime(),
			$keys[11]=>$this->getStackChips(),
			$keys[12]=>$this->getPlayers(),
			$keys[13]=>$this->getAllowedRebuys(),
			$keys[14]=>$this->getAllowedAddons(),
			$keys[15]=>$this->getIsIlimitedRebuys(),
			$keys[16]=>$this->getEnabled(),
			$keys[17]=>$this->getVisible(),
			$keys[18]=>$this->getDeleted(),
			$keys[19]=>$this->getLocked(),
			$keys[20]=>$this->getCreatedAt(),
			$keys[21]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventLivePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setRankingLiveId($value);
				break;
			case 2:
				$this->setEventName($value);
				break;
			case 3:
				$this->setEventShortName($value);
				break;
			case 4:
				$this->setEventDate($value);
				break;
			case 5:
				$this->setStartTime($value);
				break;
			case 6:
				$this->setEventDatetime($value);
				break;
			case 7:
				$this->setDescription($value);
				break;
			case 8:
				$this->setClubId($value);
				break;
			case 9:
				$this->setBuyin($value);
				break;
			case 10:
				$this->setBlindTime($value);
				break;
			case 11:
				$this->setStackChips($value);
				break;
			case 12:
				$this->setPlayers($value);
				break;
			case 13:
				$this->setAllowedRebuys($value);
				break;
			case 14:
				$this->setAllowedAddons($value);
				break;
			case 15:
				$this->setIsIlimitedRebuys($value);
				break;
			case 16:
				$this->setEnabled($value);
				break;
			case 17:
				$this->setVisible($value);
				break;
			case 18:
				$this->setDeleted($value);
				break;
			case 19:
				$this->setLocked($value);
				break;
			case 20:
				$this->setCreatedAt($value);
				break;
			case 21:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventLivePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRankingLiveId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEventName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEventShortName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEventDate($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setStartTime($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEventDatetime($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDescription($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setClubId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setBuyin($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setBlindTime($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setStackChips($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setPlayers($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setAllowedRebuys($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setAllowedAddons($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setIsIlimitedRebuys($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setEnabled($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setVisible($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setDeleted($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setLocked($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCreatedAt($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setUpdatedAt($arr[$keys[21]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventLivePeer::DATABASE_NAME);

		if ($this->isColumnModified(EventLivePeer::ID)) $criteria->add(EventLivePeer::ID, $this->id);
		if ($this->isColumnModified(EventLivePeer::RANKING_LIVE_ID)) $criteria->add(EventLivePeer::RANKING_LIVE_ID, $this->ranking_live_id);
		if ($this->isColumnModified(EventLivePeer::EVENT_NAME)) $criteria->add(EventLivePeer::EVENT_NAME, $this->event_name);
		if ($this->isColumnModified(EventLivePeer::EVENT_SHORT_NAME)) $criteria->add(EventLivePeer::EVENT_SHORT_NAME, $this->event_short_name);
		if ($this->isColumnModified(EventLivePeer::EVENT_DATE)) $criteria->add(EventLivePeer::EVENT_DATE, $this->event_date);
		if ($this->isColumnModified(EventLivePeer::START_TIME)) $criteria->add(EventLivePeer::START_TIME, $this->start_time);
		if ($this->isColumnModified(EventLivePeer::EVENT_DATETIME)) $criteria->add(EventLivePeer::EVENT_DATETIME, $this->event_datetime);
		if ($this->isColumnModified(EventLivePeer::DESCRIPTION)) $criteria->add(EventLivePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(EventLivePeer::CLUB_ID)) $criteria->add(EventLivePeer::CLUB_ID, $this->club_id);
		if ($this->isColumnModified(EventLivePeer::BUYIN)) $criteria->add(EventLivePeer::BUYIN, $this->buyin);
		if ($this->isColumnModified(EventLivePeer::BLIND_TIME)) $criteria->add(EventLivePeer::BLIND_TIME, $this->blind_time);
		if ($this->isColumnModified(EventLivePeer::STACK_CHIPS)) $criteria->add(EventLivePeer::STACK_CHIPS, $this->stack_chips);
		if ($this->isColumnModified(EventLivePeer::PLAYERS)) $criteria->add(EventLivePeer::PLAYERS, $this->players);
		if ($this->isColumnModified(EventLivePeer::ALLOWED_REBUYS)) $criteria->add(EventLivePeer::ALLOWED_REBUYS, $this->allowed_rebuys);
		if ($this->isColumnModified(EventLivePeer::ALLOWED_ADDONS)) $criteria->add(EventLivePeer::ALLOWED_ADDONS, $this->allowed_addons);
		if ($this->isColumnModified(EventLivePeer::IS_ILIMITED_REBUYS)) $criteria->add(EventLivePeer::IS_ILIMITED_REBUYS, $this->is_ilimited_rebuys);
		if ($this->isColumnModified(EventLivePeer::ENABLED)) $criteria->add(EventLivePeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(EventLivePeer::VISIBLE)) $criteria->add(EventLivePeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(EventLivePeer::DELETED)) $criteria->add(EventLivePeer::DELETED, $this->deleted);
		if ($this->isColumnModified(EventLivePeer::LOCKED)) $criteria->add(EventLivePeer::LOCKED, $this->locked);
		if ($this->isColumnModified(EventLivePeer::CREATED_AT)) $criteria->add(EventLivePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EventLivePeer::UPDATED_AT)) $criteria->add(EventLivePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventLivePeer::DATABASE_NAME);

		$criteria->add(EventLivePeer::ID, $this->id);

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

		$copyObj->setRankingLiveId($this->ranking_live_id);

		$copyObj->setEventName($this->event_name);

		$copyObj->setEventShortName($this->event_short_name);

		$copyObj->setEventDate($this->event_date);

		$copyObj->setStartTime($this->start_time);

		$copyObj->setEventDatetime($this->event_datetime);

		$copyObj->setDescription($this->description);

		$copyObj->setClubId($this->club_id);

		$copyObj->setBuyin($this->buyin);

		$copyObj->setBlindTime($this->blind_time);

		$copyObj->setStackChips($this->stack_chips);

		$copyObj->setPlayers($this->players);

		$copyObj->setAllowedRebuys($this->allowed_rebuys);

		$copyObj->setAllowedAddons($this->allowed_addons);

		$copyObj->setIsIlimitedRebuys($this->is_ilimited_rebuys);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEventLivePlayerList() as $relObj) {
				$copyObj->addEventLivePlayer($relObj->copy($deepCopy));
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
			self::$peer = new EventLivePeer();
		}
		return self::$peer;
	}

	
	public function setRankingLive($v)
	{


		if ($v === null) {
			$this->setRankingLiveId(NULL);
		} else {
			$this->setRankingLiveId($v->getId());
		}


		$this->aRankingLive = $v;
	}


	
	public function getRankingLive($con = null)
	{
		if ($this->aRankingLive === null && ($this->ranking_live_id !== null)) {
						include_once 'lib/model/om/BaseRankingLivePeer.php';

			$this->aRankingLive = RankingLivePeer::retrieveByPK($this->ranking_live_id, $con);

			
		}
		return $this->aRankingLive;
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

				$criteria->add(EventLivePlayerPeer::EVENT_LIVE_ID, $this->getId());

				EventLivePlayerPeer::addSelectColumns($criteria);
				$this->collEventLivePlayerList = EventLivePlayerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventLivePlayerPeer::EVENT_LIVE_ID, $this->getId());

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

		$criteria->add(EventLivePlayerPeer::EVENT_LIVE_ID, $this->getId());

		return EventLivePlayerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventLivePlayer(EventLivePlayer $l)
	{
		$this->collEventLivePlayerList[] = $l;
		$l->setEventLive($this);
	}


	
	public function getEventLivePlayerListJoinPeople($criteria = null, $con = null)
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

				$criteria->add(EventLivePlayerPeer::EVENT_LIVE_ID, $this->getId());

				$this->collEventLivePlayerList = EventLivePlayerPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePlayerPeer::EVENT_LIVE_ID, $this->getId());

			if (!isset($this->lastEventLivePlayerCriteria) || !$this->lastEventLivePlayerCriteria->equals($criteria)) {
				$this->collEventLivePlayerList = EventLivePlayerPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastEventLivePlayerCriteria = $criteria;

		return $this->collEventLivePlayerList;
	}

} 