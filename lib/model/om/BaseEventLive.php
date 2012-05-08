<?php


abstract class BaseEventLive extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $ranking_live_id;


	
	protected $event_name;


	
	protected $event_short_name;


	
	protected $event_date;


	
	protected $start_time;


	
	protected $event_date_time;


	
	protected $comments;


	
	protected $description;


	
	protected $is_freeroll;


	
	protected $club_id;


	
	protected $buyin;


	
	protected $entrance_fee;


	
	protected $rake_percent;


	
	protected $blind_time;


	
	protected $stack_chips;


	
	protected $players = 0;


	
	protected $allowed_rebuys = 0;


	
	protected $allowed_addons = 0;


	
	protected $is_ilimited_rebuys;


	
	protected $saved_result;


	
	protected $total_rebuys;


	
	protected $publish_prize;


	
	protected $suppress_schedule;


	
	protected $prize_split;


	
	protected $visit_count = 0;


	
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

	
	protected $collEventLivePhotoList;

	
	protected $lastEventLivePhotoCriteria = null;

	
	protected $collEventLivePlayerScoreList;

	
	protected $lastEventLivePlayerScoreCriteria = null;

	
	protected $collEventLivePlayerDisclosureEmailList;

	
	protected $lastEventLivePlayerDisclosureEmailCriteria = null;

	
	protected $collEventLivePlayerDisclosureSmsList;

	
	protected $lastEventLivePlayerDisclosureSmsCriteria = null;

	
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

	
	public function getEventDateTime($format = 'Y-m-d H:i:s')
	{

		if ($this->event_date_time === null || $this->event_date_time === '') {
			return null;
		} elseif (!is_int($this->event_date_time)) {
						$ts = strtotime($this->event_date_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [event_date_time] as date/time value: " . var_export($this->event_date_time, true));
			}
		} else {
			$ts = $this->event_date_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getComments()
	{

		return $this->comments;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getIsFreeroll()
	{

		return $this->is_freeroll;
	}

	
	public function getClubId()
	{

		return $this->club_id;
	}

	
	public function getBuyin()
	{

		return $this->buyin;
	}

	
	public function getEntranceFee()
	{

		return $this->entrance_fee;
	}

	
	public function getRakePercent()
	{

		return $this->rake_percent;
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

	
	public function getSavedResult()
	{

		return $this->saved_result;
	}

	
	public function getTotalRebuys()
	{

		return $this->total_rebuys;
	}

	
	public function getPublishPrize()
	{

		return $this->publish_prize;
	}

	
	public function getSuppressSchedule()
	{

		return $this->suppress_schedule;
	}

	
	public function getPrizeSplit()
	{

		return $this->prize_split;
	}

	
	public function getVisitCount()
	{

		return $this->visit_count;
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
	
	public function setEventDateTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [event_date_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->event_date_time !== $ts) {
			$this->event_date_time = $ts;
			$this->modifiedColumns[] = EventLivePeer::EVENT_DATE_TIME;
		}

	} 
	
	public function setComments($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comments !== $v) {
			$this->comments = $v;
			$this->modifiedColumns[] = EventLivePeer::COMMENTS;
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
	
	public function setIsFreeroll($v)
	{

		if ($this->is_freeroll !== $v) {
			$this->is_freeroll = $v;
			$this->modifiedColumns[] = EventLivePeer::IS_FREEROLL;
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
	
	public function setEntranceFee($v)
	{

		if ($this->entrance_fee !== $v) {
			$this->entrance_fee = $v;
			$this->modifiedColumns[] = EventLivePeer::ENTRANCE_FEE;
		}

	} 
	
	public function setRakePercent($v)
	{

		if ($this->rake_percent !== $v) {
			$this->rake_percent = $v;
			$this->modifiedColumns[] = EventLivePeer::RAKE_PERCENT;
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

		if ($this->players !== $v || $v === 0) {
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
	
	public function setSavedResult($v)
	{

		if ($this->saved_result !== $v) {
			$this->saved_result = $v;
			$this->modifiedColumns[] = EventLivePeer::SAVED_RESULT;
		}

	} 
	
	public function setTotalRebuys($v)
	{

		if ($this->total_rebuys !== $v) {
			$this->total_rebuys = $v;
			$this->modifiedColumns[] = EventLivePeer::TOTAL_REBUYS;
		}

	} 
	
	public function setPublishPrize($v)
	{

		if ($this->publish_prize !== $v) {
			$this->publish_prize = $v;
			$this->modifiedColumns[] = EventLivePeer::PUBLISH_PRIZE;
		}

	} 
	
	public function setSuppressSchedule($v)
	{

		if ($this->suppress_schedule !== $v) {
			$this->suppress_schedule = $v;
			$this->modifiedColumns[] = EventLivePeer::SUPPRESS_SCHEDULE;
		}

	} 
	
	public function setPrizeSplit($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->prize_split !== $v) {
			$this->prize_split = $v;
			$this->modifiedColumns[] = EventLivePeer::PRIZE_SPLIT;
		}

	} 
	
	public function setVisitCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->visit_count !== $v || $v === 0) {
			$this->visit_count = $v;
			$this->modifiedColumns[] = EventLivePeer::VISIT_COUNT;
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

			$this->event_date_time = $rs->getTimestamp($startcol + 6, null);

			$this->comments = $rs->getString($startcol + 7);

			$this->description = $rs->getString($startcol + 8);

			$this->is_freeroll = $rs->getBoolean($startcol + 9);

			$this->club_id = $rs->getInt($startcol + 10);

			$this->buyin = $rs->getFloat($startcol + 11);

			$this->entrance_fee = $rs->getFloat($startcol + 12);

			$this->rake_percent = $rs->getFloat($startcol + 13);

			$this->blind_time = $rs->getTime($startcol + 14, null);

			$this->stack_chips = $rs->getFloat($startcol + 15);

			$this->players = $rs->getInt($startcol + 16);

			$this->allowed_rebuys = $rs->getInt($startcol + 17);

			$this->allowed_addons = $rs->getInt($startcol + 18);

			$this->is_ilimited_rebuys = $rs->getBoolean($startcol + 19);

			$this->saved_result = $rs->getBoolean($startcol + 20);

			$this->total_rebuys = $rs->getFloat($startcol + 21);

			$this->publish_prize = $rs->getBoolean($startcol + 22);

			$this->suppress_schedule = $rs->getBoolean($startcol + 23);

			$this->prize_split = $rs->getString($startcol + 24);

			$this->visit_count = $rs->getInt($startcol + 25);

			$this->enabled = $rs->getBoolean($startcol + 26);

			$this->visible = $rs->getBoolean($startcol + 27);

			$this->deleted = $rs->getBoolean($startcol + 28);

			$this->locked = $rs->getBoolean($startcol + 29);

			$this->created_at = $rs->getTimestamp($startcol + 30, null);

			$this->updated_at = $rs->getTimestamp($startcol + 31, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 32; 
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

			if ($this->collEventLivePhotoList !== null) {
				foreach($this->collEventLivePhotoList as $referrerFK) {
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

			if ($this->collEventLivePlayerDisclosureEmailList !== null) {
				foreach($this->collEventLivePlayerDisclosureEmailList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventLivePlayerDisclosureSmsList !== null) {
				foreach($this->collEventLivePlayerDisclosureSmsList as $referrerFK) {
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

				if ($this->collEventLivePhotoList !== null) {
					foreach($this->collEventLivePhotoList as $referrerFK) {
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

				if ($this->collEventLivePlayerDisclosureEmailList !== null) {
					foreach($this->collEventLivePlayerDisclosureEmailList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventLivePlayerDisclosureSmsList !== null) {
					foreach($this->collEventLivePlayerDisclosureSmsList as $referrerFK) {
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
				return $this->getEventDateTime();
				break;
			case 7:
				return $this->getComments();
				break;
			case 8:
				return $this->getDescription();
				break;
			case 9:
				return $this->getIsFreeroll();
				break;
			case 10:
				return $this->getClubId();
				break;
			case 11:
				return $this->getBuyin();
				break;
			case 12:
				return $this->getEntranceFee();
				break;
			case 13:
				return $this->getRakePercent();
				break;
			case 14:
				return $this->getBlindTime();
				break;
			case 15:
				return $this->getStackChips();
				break;
			case 16:
				return $this->getPlayers();
				break;
			case 17:
				return $this->getAllowedRebuys();
				break;
			case 18:
				return $this->getAllowedAddons();
				break;
			case 19:
				return $this->getIsIlimitedRebuys();
				break;
			case 20:
				return $this->getSavedResult();
				break;
			case 21:
				return $this->getTotalRebuys();
				break;
			case 22:
				return $this->getPublishPrize();
				break;
			case 23:
				return $this->getSuppressSchedule();
				break;
			case 24:
				return $this->getPrizeSplit();
				break;
			case 25:
				return $this->getVisitCount();
				break;
			case 26:
				return $this->getEnabled();
				break;
			case 27:
				return $this->getVisible();
				break;
			case 28:
				return $this->getDeleted();
				break;
			case 29:
				return $this->getLocked();
				break;
			case 30:
				return $this->getCreatedAt();
				break;
			case 31:
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
			$keys[6]=>$this->getEventDateTime(),
			$keys[7]=>$this->getComments(),
			$keys[8]=>$this->getDescription(),
			$keys[9]=>$this->getIsFreeroll(),
			$keys[10]=>$this->getClubId(),
			$keys[11]=>$this->getBuyin(),
			$keys[12]=>$this->getEntranceFee(),
			$keys[13]=>$this->getRakePercent(),
			$keys[14]=>$this->getBlindTime(),
			$keys[15]=>$this->getStackChips(),
			$keys[16]=>$this->getPlayers(),
			$keys[17]=>$this->getAllowedRebuys(),
			$keys[18]=>$this->getAllowedAddons(),
			$keys[19]=>$this->getIsIlimitedRebuys(),
			$keys[20]=>$this->getSavedResult(),
			$keys[21]=>$this->getTotalRebuys(),
			$keys[22]=>$this->getPublishPrize(),
			$keys[23]=>$this->getSuppressSchedule(),
			$keys[24]=>$this->getPrizeSplit(),
			$keys[25]=>$this->getVisitCount(),
			$keys[26]=>$this->getEnabled(),
			$keys[27]=>$this->getVisible(),
			$keys[28]=>$this->getDeleted(),
			$keys[29]=>$this->getLocked(),
			$keys[30]=>$this->getCreatedAt(),
			$keys[31]=>$this->getUpdatedAt(),
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
				$this->setEventDateTime($value);
				break;
			case 7:
				$this->setComments($value);
				break;
			case 8:
				$this->setDescription($value);
				break;
			case 9:
				$this->setIsFreeroll($value);
				break;
			case 10:
				$this->setClubId($value);
				break;
			case 11:
				$this->setBuyin($value);
				break;
			case 12:
				$this->setEntranceFee($value);
				break;
			case 13:
				$this->setRakePercent($value);
				break;
			case 14:
				$this->setBlindTime($value);
				break;
			case 15:
				$this->setStackChips($value);
				break;
			case 16:
				$this->setPlayers($value);
				break;
			case 17:
				$this->setAllowedRebuys($value);
				break;
			case 18:
				$this->setAllowedAddons($value);
				break;
			case 19:
				$this->setIsIlimitedRebuys($value);
				break;
			case 20:
				$this->setSavedResult($value);
				break;
			case 21:
				$this->setTotalRebuys($value);
				break;
			case 22:
				$this->setPublishPrize($value);
				break;
			case 23:
				$this->setSuppressSchedule($value);
				break;
			case 24:
				$this->setPrizeSplit($value);
				break;
			case 25:
				$this->setVisitCount($value);
				break;
			case 26:
				$this->setEnabled($value);
				break;
			case 27:
				$this->setVisible($value);
				break;
			case 28:
				$this->setDeleted($value);
				break;
			case 29:
				$this->setLocked($value);
				break;
			case 30:
				$this->setCreatedAt($value);
				break;
			case 31:
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
		if (array_key_exists($keys[6], $arr)) $this->setEventDateTime($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setComments($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDescription($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setIsFreeroll($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setClubId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setBuyin($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setEntranceFee($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setRakePercent($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setBlindTime($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setStackChips($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setPlayers($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setAllowedRebuys($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setAllowedAddons($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setIsIlimitedRebuys($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setSavedResult($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setTotalRebuys($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setPublishPrize($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setSuppressSchedule($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setPrizeSplit($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setVisitCount($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setEnabled($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setVisible($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setDeleted($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setLocked($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setCreatedAt($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setUpdatedAt($arr[$keys[31]]);
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
		if ($this->isColumnModified(EventLivePeer::EVENT_DATE_TIME)) $criteria->add(EventLivePeer::EVENT_DATE_TIME, $this->event_date_time);
		if ($this->isColumnModified(EventLivePeer::COMMENTS)) $criteria->add(EventLivePeer::COMMENTS, $this->comments);
		if ($this->isColumnModified(EventLivePeer::DESCRIPTION)) $criteria->add(EventLivePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(EventLivePeer::IS_FREEROLL)) $criteria->add(EventLivePeer::IS_FREEROLL, $this->is_freeroll);
		if ($this->isColumnModified(EventLivePeer::CLUB_ID)) $criteria->add(EventLivePeer::CLUB_ID, $this->club_id);
		if ($this->isColumnModified(EventLivePeer::BUYIN)) $criteria->add(EventLivePeer::BUYIN, $this->buyin);
		if ($this->isColumnModified(EventLivePeer::ENTRANCE_FEE)) $criteria->add(EventLivePeer::ENTRANCE_FEE, $this->entrance_fee);
		if ($this->isColumnModified(EventLivePeer::RAKE_PERCENT)) $criteria->add(EventLivePeer::RAKE_PERCENT, $this->rake_percent);
		if ($this->isColumnModified(EventLivePeer::BLIND_TIME)) $criteria->add(EventLivePeer::BLIND_TIME, $this->blind_time);
		if ($this->isColumnModified(EventLivePeer::STACK_CHIPS)) $criteria->add(EventLivePeer::STACK_CHIPS, $this->stack_chips);
		if ($this->isColumnModified(EventLivePeer::PLAYERS)) $criteria->add(EventLivePeer::PLAYERS, $this->players);
		if ($this->isColumnModified(EventLivePeer::ALLOWED_REBUYS)) $criteria->add(EventLivePeer::ALLOWED_REBUYS, $this->allowed_rebuys);
		if ($this->isColumnModified(EventLivePeer::ALLOWED_ADDONS)) $criteria->add(EventLivePeer::ALLOWED_ADDONS, $this->allowed_addons);
		if ($this->isColumnModified(EventLivePeer::IS_ILIMITED_REBUYS)) $criteria->add(EventLivePeer::IS_ILIMITED_REBUYS, $this->is_ilimited_rebuys);
		if ($this->isColumnModified(EventLivePeer::SAVED_RESULT)) $criteria->add(EventLivePeer::SAVED_RESULT, $this->saved_result);
		if ($this->isColumnModified(EventLivePeer::TOTAL_REBUYS)) $criteria->add(EventLivePeer::TOTAL_REBUYS, $this->total_rebuys);
		if ($this->isColumnModified(EventLivePeer::PUBLISH_PRIZE)) $criteria->add(EventLivePeer::PUBLISH_PRIZE, $this->publish_prize);
		if ($this->isColumnModified(EventLivePeer::SUPPRESS_SCHEDULE)) $criteria->add(EventLivePeer::SUPPRESS_SCHEDULE, $this->suppress_schedule);
		if ($this->isColumnModified(EventLivePeer::PRIZE_SPLIT)) $criteria->add(EventLivePeer::PRIZE_SPLIT, $this->prize_split);
		if ($this->isColumnModified(EventLivePeer::VISIT_COUNT)) $criteria->add(EventLivePeer::VISIT_COUNT, $this->visit_count);
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

		$copyObj->setEventDateTime($this->event_date_time);

		$copyObj->setComments($this->comments);

		$copyObj->setDescription($this->description);

		$copyObj->setIsFreeroll($this->is_freeroll);

		$copyObj->setClubId($this->club_id);

		$copyObj->setBuyin($this->buyin);

		$copyObj->setEntranceFee($this->entrance_fee);

		$copyObj->setRakePercent($this->rake_percent);

		$copyObj->setBlindTime($this->blind_time);

		$copyObj->setStackChips($this->stack_chips);

		$copyObj->setPlayers($this->players);

		$copyObj->setAllowedRebuys($this->allowed_rebuys);

		$copyObj->setAllowedAddons($this->allowed_addons);

		$copyObj->setIsIlimitedRebuys($this->is_ilimited_rebuys);

		$copyObj->setSavedResult($this->saved_result);

		$copyObj->setTotalRebuys($this->total_rebuys);

		$copyObj->setPublishPrize($this->publish_prize);

		$copyObj->setSuppressSchedule($this->suppress_schedule);

		$copyObj->setPrizeSplit($this->prize_split);

		$copyObj->setVisitCount($this->visit_count);

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

			foreach($this->getEventLivePhotoList() as $relObj) {
				$copyObj->addEventLivePhoto($relObj->copy($deepCopy));
			}

			foreach($this->getEventLivePlayerScoreList() as $relObj) {
				$copyObj->addEventLivePlayerScore($relObj->copy($deepCopy));
			}

			foreach($this->getEventLivePlayerDisclosureEmailList() as $relObj) {
				$copyObj->addEventLivePlayerDisclosureEmail($relObj->copy($deepCopy));
			}

			foreach($this->getEventLivePlayerDisclosureSmsList() as $relObj) {
				$copyObj->addEventLivePlayerDisclosureSms($relObj->copy($deepCopy));
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

				$criteria->add(EventLivePhotoPeer::EVENT_LIVE_ID, $this->getId());

				EventLivePhotoPeer::addSelectColumns($criteria);
				$this->collEventLivePhotoList = EventLivePhotoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventLivePhotoPeer::EVENT_LIVE_ID, $this->getId());

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

		$criteria->add(EventLivePhotoPeer::EVENT_LIVE_ID, $this->getId());

		return EventLivePhotoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventLivePhoto(EventLivePhoto $l)
	{
		$this->collEventLivePhotoList[] = $l;
		$l->setEventLive($this);
	}


	
	public function getEventLivePhotoListJoinFile($criteria = null, $con = null)
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

				$criteria->add(EventLivePhotoPeer::EVENT_LIVE_ID, $this->getId());

				$this->collEventLivePhotoList = EventLivePhotoPeer::doSelectJoinFile($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePhotoPeer::EVENT_LIVE_ID, $this->getId());

			if (!isset($this->lastEventLivePhotoCriteria) || !$this->lastEventLivePhotoCriteria->equals($criteria)) {
				$this->collEventLivePhotoList = EventLivePhotoPeer::doSelectJoinFile($criteria, $con);
			}
		}
		$this->lastEventLivePhotoCriteria = $criteria;

		return $this->collEventLivePhotoList;
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

				$criteria->add(EventLivePlayerScorePeer::EVENT_LIVE_ID, $this->getId());

				EventLivePlayerScorePeer::addSelectColumns($criteria);
				$this->collEventLivePlayerScoreList = EventLivePlayerScorePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventLivePlayerScorePeer::EVENT_LIVE_ID, $this->getId());

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

		$criteria->add(EventLivePlayerScorePeer::EVENT_LIVE_ID, $this->getId());

		return EventLivePlayerScorePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventLivePlayerScore(EventLivePlayerScore $l)
	{
		$this->collEventLivePlayerScoreList[] = $l;
		$l->setEventLive($this);
	}


	
	public function getEventLivePlayerScoreListJoinPeople($criteria = null, $con = null)
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

				$criteria->add(EventLivePlayerScorePeer::EVENT_LIVE_ID, $this->getId());

				$this->collEventLivePlayerScoreList = EventLivePlayerScorePeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePlayerScorePeer::EVENT_LIVE_ID, $this->getId());

			if (!isset($this->lastEventLivePlayerScoreCriteria) || !$this->lastEventLivePlayerScoreCriteria->equals($criteria)) {
				$this->collEventLivePlayerScoreList = EventLivePlayerScorePeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastEventLivePlayerScoreCriteria = $criteria;

		return $this->collEventLivePlayerScoreList;
	}

	
	public function initEventLivePlayerDisclosureEmailList()
	{
		if ($this->collEventLivePlayerDisclosureEmailList === null) {
			$this->collEventLivePlayerDisclosureEmailList = array();
		}
	}

	
	public function getEventLivePlayerDisclosureEmailList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerDisclosureEmailPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePlayerDisclosureEmailList === null) {
			if ($this->isNew()) {
			   $this->collEventLivePlayerDisclosureEmailList = array();
			} else {

				$criteria->add(EventLivePlayerDisclosureEmailPeer::EVENT_LIVE_ID, $this->getId());

				EventLivePlayerDisclosureEmailPeer::addSelectColumns($criteria);
				$this->collEventLivePlayerDisclosureEmailList = EventLivePlayerDisclosureEmailPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventLivePlayerDisclosureEmailPeer::EVENT_LIVE_ID, $this->getId());

				EventLivePlayerDisclosureEmailPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventLivePlayerDisclosureEmailCriteria) || !$this->lastEventLivePlayerDisclosureEmailCriteria->equals($criteria)) {
					$this->collEventLivePlayerDisclosureEmailList = EventLivePlayerDisclosureEmailPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventLivePlayerDisclosureEmailCriteria = $criteria;
		return $this->collEventLivePlayerDisclosureEmailList;
	}

	
	public function countEventLivePlayerDisclosureEmailList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerDisclosureEmailPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventLivePlayerDisclosureEmailPeer::EVENT_LIVE_ID, $this->getId());

		return EventLivePlayerDisclosureEmailPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventLivePlayerDisclosureEmail(EventLivePlayerDisclosureEmail $l)
	{
		$this->collEventLivePlayerDisclosureEmailList[] = $l;
		$l->setEventLive($this);
	}


	
	public function getEventLivePlayerDisclosureEmailListJoinPeople($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerDisclosureEmailPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePlayerDisclosureEmailList === null) {
			if ($this->isNew()) {
				$this->collEventLivePlayerDisclosureEmailList = array();
			} else {

				$criteria->add(EventLivePlayerDisclosureEmailPeer::EVENT_LIVE_ID, $this->getId());

				$this->collEventLivePlayerDisclosureEmailList = EventLivePlayerDisclosureEmailPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePlayerDisclosureEmailPeer::EVENT_LIVE_ID, $this->getId());

			if (!isset($this->lastEventLivePlayerDisclosureEmailCriteria) || !$this->lastEventLivePlayerDisclosureEmailCriteria->equals($criteria)) {
				$this->collEventLivePlayerDisclosureEmailList = EventLivePlayerDisclosureEmailPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastEventLivePlayerDisclosureEmailCriteria = $criteria;

		return $this->collEventLivePlayerDisclosureEmailList;
	}

	
	public function initEventLivePlayerDisclosureSmsList()
	{
		if ($this->collEventLivePlayerDisclosureSmsList === null) {
			$this->collEventLivePlayerDisclosureSmsList = array();
		}
	}

	
	public function getEventLivePlayerDisclosureSmsList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerDisclosureSmsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePlayerDisclosureSmsList === null) {
			if ($this->isNew()) {
			   $this->collEventLivePlayerDisclosureSmsList = array();
			} else {

				$criteria->add(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, $this->getId());

				EventLivePlayerDisclosureSmsPeer::addSelectColumns($criteria);
				$this->collEventLivePlayerDisclosureSmsList = EventLivePlayerDisclosureSmsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, $this->getId());

				EventLivePlayerDisclosureSmsPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventLivePlayerDisclosureSmsCriteria) || !$this->lastEventLivePlayerDisclosureSmsCriteria->equals($criteria)) {
					$this->collEventLivePlayerDisclosureSmsList = EventLivePlayerDisclosureSmsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventLivePlayerDisclosureSmsCriteria = $criteria;
		return $this->collEventLivePlayerDisclosureSmsList;
	}

	
	public function countEventLivePlayerDisclosureSmsList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerDisclosureSmsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, $this->getId());

		return EventLivePlayerDisclosureSmsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventLivePlayerDisclosureSms(EventLivePlayerDisclosureSms $l)
	{
		$this->collEventLivePlayerDisclosureSmsList[] = $l;
		$l->setEventLive($this);
	}


	
	public function getEventLivePlayerDisclosureSmsListJoinPeople($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerDisclosureSmsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePlayerDisclosureSmsList === null) {
			if ($this->isNew()) {
				$this->collEventLivePlayerDisclosureSmsList = array();
			} else {

				$criteria->add(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, $this->getId());

				$this->collEventLivePlayerDisclosureSmsList = EventLivePlayerDisclosureSmsPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, $this->getId());

			if (!isset($this->lastEventLivePlayerDisclosureSmsCriteria) || !$this->lastEventLivePlayerDisclosureSmsCriteria->equals($criteria)) {
				$this->collEventLivePlayerDisclosureSmsList = EventLivePlayerDisclosureSmsPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastEventLivePlayerDisclosureSmsCriteria = $criteria;

		return $this->collEventLivePlayerDisclosureSmsList;
	}


	
	public function getEventLivePlayerDisclosureSmsListJoinSms($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePlayerDisclosureSmsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLivePlayerDisclosureSmsList === null) {
			if ($this->isNew()) {
				$this->collEventLivePlayerDisclosureSmsList = array();
			} else {

				$criteria->add(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, $this->getId());

				$this->collEventLivePlayerDisclosureSmsList = EventLivePlayerDisclosureSmsPeer::doSelectJoinSms($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, $this->getId());

			if (!isset($this->lastEventLivePlayerDisclosureSmsCriteria) || !$this->lastEventLivePlayerDisclosureSmsCriteria->equals($criteria)) {
				$this->collEventLivePlayerDisclosureSmsList = EventLivePlayerDisclosureSmsPeer::doSelectJoinSms($criteria, $con);
			}
		}
		$this->lastEventLivePlayerDisclosureSmsCriteria = $criteria;

		return $this->collEventLivePlayerDisclosureSmsList;
	}

} 