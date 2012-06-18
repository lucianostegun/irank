<?php


abstract class BaseEventLiveView extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $ranking_live_id;


	
	protected $club_id;


	
	protected $event_name;


	
	protected $event_date;


	
	protected $start_time;


	
	protected $event_date_time;


	
	protected $step_number;


	
	protected $step_day;


	
	protected $comments;


	
	protected $description;


	
	protected $is_freeroll;


	
	protected $is_multiday;


	
	protected $is_satellite;


	
	protected $buyin;


	
	protected $entrance_fee;


	
	protected $guaranteed_prize;


	
	protected $blind_time;


	
	protected $stack_chips;


	
	protected $players = 0;


	
	protected $allowed_rebuys = 0;


	
	protected $allowed_addons = 0;


	
	protected $is_ilimited_rebuys;


	
	protected $saved_result;


	
	protected $suppress_schedule;


	
	protected $schedule_start_date;


	
	protected $enrollment_start_date;


	
	protected $enrollment_mode;


	
	protected $suppress_ranking;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aRankingLive;

	
	protected $aClub;

	
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

	
	public function getClubId()
	{

		return $this->club_id;
	}

	
	public function getEventName()
	{

		return $this->event_name;
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

	
	public function getStepNumber()
	{

		return $this->step_number;
	}

	
	public function getStepDay()
	{

		return $this->step_day;
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

	
	public function getIsMultiday()
	{

		return $this->is_multiday;
	}

	
	public function getIsSatellite()
	{

		return $this->is_satellite;
	}

	
	public function getBuyin()
	{

		return $this->buyin;
	}

	
	public function getEntranceFee()
	{

		return $this->entrance_fee;
	}

	
	public function getGuaranteedPrize()
	{

		return $this->guaranteed_prize;
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

	
	public function getSuppressSchedule()
	{

		return $this->suppress_schedule;
	}

	
	public function getScheduleStartDate($format = 'Y-m-d')
	{

		if ($this->schedule_start_date === null || $this->schedule_start_date === '') {
			return null;
		} elseif (!is_int($this->schedule_start_date)) {
						$ts = strtotime($this->schedule_start_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [schedule_start_date] as date/time value: " . var_export($this->schedule_start_date, true));
			}
		} else {
			$ts = $this->schedule_start_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getEnrollmentStartDate($format = 'Y-m-d')
	{

		if ($this->enrollment_start_date === null || $this->enrollment_start_date === '') {
			return null;
		} elseif (!is_int($this->enrollment_start_date)) {
						$ts = strtotime($this->enrollment_start_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [enrollment_start_date] as date/time value: " . var_export($this->enrollment_start_date, true));
			}
		} else {
			$ts = $this->enrollment_start_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getEnrollmentMode()
	{

		return $this->enrollment_mode;
	}

	
	public function getSuppressRanking()
	{

		return $this->suppress_ranking;
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
			$this->modifiedColumns[] = EventLiveViewPeer::ID;
		}

	} 
	
	public function setRankingLiveId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_live_id !== $v) {
			$this->ranking_live_id = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::RANKING_LIVE_ID;
		}

		if ($this->aRankingLive !== null && $this->aRankingLive->getId() !== $v) {
			$this->aRankingLive = null;
		}

	} 
	
	public function setClubId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->club_id !== $v) {
			$this->club_id = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::CLUB_ID;
		}

		if ($this->aClub !== null && $this->aClub->getId() !== $v) {
			$this->aClub = null;
		}

	} 
	
	public function setEventName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->event_name !== $v) {
			$this->event_name = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::EVENT_NAME;
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
			$this->modifiedColumns[] = EventLiveViewPeer::EVENT_DATE;
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
			$this->modifiedColumns[] = EventLiveViewPeer::START_TIME;
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
			$this->modifiedColumns[] = EventLiveViewPeer::EVENT_DATE_TIME;
		}

	} 
	
	public function setStepNumber($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->step_number !== $v) {
			$this->step_number = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::STEP_NUMBER;
		}

	} 
	
	public function setStepDay($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->step_day !== $v) {
			$this->step_day = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::STEP_DAY;
		}

	} 
	
	public function setComments($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comments !== $v) {
			$this->comments = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::COMMENTS;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::DESCRIPTION;
		}

	} 
	
	public function setIsFreeroll($v)
	{

		if ($this->is_freeroll !== $v) {
			$this->is_freeroll = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::IS_FREEROLL;
		}

	} 
	
	public function setIsMultiday($v)
	{

		if ($this->is_multiday !== $v) {
			$this->is_multiday = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::IS_MULTIDAY;
		}

	} 
	
	public function setIsSatellite($v)
	{

		if ($this->is_satellite !== $v) {
			$this->is_satellite = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::IS_SATELLITE;
		}

	} 
	
	public function setBuyin($v)
	{

		if ($this->buyin !== $v) {
			$this->buyin = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::BUYIN;
		}

	} 
	
	public function setEntranceFee($v)
	{

		if ($this->entrance_fee !== $v) {
			$this->entrance_fee = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::ENTRANCE_FEE;
		}

	} 
	
	public function setGuaranteedPrize($v)
	{

		if ($this->guaranteed_prize !== $v) {
			$this->guaranteed_prize = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::GUARANTEED_PRIZE;
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
			$this->modifiedColumns[] = EventLiveViewPeer::BLIND_TIME;
		}

	} 
	
	public function setStackChips($v)
	{

		if ($this->stack_chips !== $v) {
			$this->stack_chips = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::STACK_CHIPS;
		}

	} 
	
	public function setPlayers($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->players !== $v || $v === 0) {
			$this->players = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::PLAYERS;
		}

	} 
	
	public function setAllowedRebuys($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->allowed_rebuys !== $v || $v === 0) {
			$this->allowed_rebuys = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::ALLOWED_REBUYS;
		}

	} 
	
	public function setAllowedAddons($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->allowed_addons !== $v || $v === 0) {
			$this->allowed_addons = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::ALLOWED_ADDONS;
		}

	} 
	
	public function setIsIlimitedRebuys($v)
	{

		if ($this->is_ilimited_rebuys !== $v) {
			$this->is_ilimited_rebuys = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::IS_ILIMITED_REBUYS;
		}

	} 
	
	public function setSavedResult($v)
	{

		if ($this->saved_result !== $v) {
			$this->saved_result = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::SAVED_RESULT;
		}

	} 
	
	public function setSuppressSchedule($v)
	{

		if ($this->suppress_schedule !== $v) {
			$this->suppress_schedule = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::SUPPRESS_SCHEDULE;
		}

	} 
	
	public function setScheduleStartDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [schedule_start_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->schedule_start_date !== $ts) {
			$this->schedule_start_date = $ts;
			$this->modifiedColumns[] = EventLiveViewPeer::SCHEDULE_START_DATE;
		}

	} 
	
	public function setEnrollmentStartDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [enrollment_start_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->enrollment_start_date !== $ts) {
			$this->enrollment_start_date = $ts;
			$this->modifiedColumns[] = EventLiveViewPeer::ENROLLMENT_START_DATE;
		}

	} 
	
	public function setEnrollmentMode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->enrollment_mode !== $v) {
			$this->enrollment_mode = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::ENROLLMENT_MODE;
		}

	} 
	
	public function setSuppressRanking($v)
	{

		if ($this->suppress_ranking !== $v) {
			$this->suppress_ranking = $v;
			$this->modifiedColumns[] = EventLiveViewPeer::SUPPRESS_RANKING;
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
			$this->modifiedColumns[] = EventLiveViewPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EventLiveViewPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->ranking_live_id = $rs->getInt($startcol + 1);

			$this->club_id = $rs->getInt($startcol + 2);

			$this->event_name = $rs->getString($startcol + 3);

			$this->event_date = $rs->getDate($startcol + 4, null);

			$this->start_time = $rs->getTime($startcol + 5, null);

			$this->event_date_time = $rs->getTimestamp($startcol + 6, null);

			$this->step_number = $rs->getString($startcol + 7);

			$this->step_day = $rs->getString($startcol + 8);

			$this->comments = $rs->getString($startcol + 9);

			$this->description = $rs->getString($startcol + 10);

			$this->is_freeroll = $rs->getBoolean($startcol + 11);

			$this->is_multiday = $rs->getBoolean($startcol + 12);

			$this->is_satellite = $rs->getBoolean($startcol + 13);

			$this->buyin = $rs->getFloat($startcol + 14);

			$this->entrance_fee = $rs->getFloat($startcol + 15);

			$this->guaranteed_prize = $rs->getFloat($startcol + 16);

			$this->blind_time = $rs->getTime($startcol + 17, null);

			$this->stack_chips = $rs->getFloat($startcol + 18);

			$this->players = $rs->getInt($startcol + 19);

			$this->allowed_rebuys = $rs->getInt($startcol + 20);

			$this->allowed_addons = $rs->getInt($startcol + 21);

			$this->is_ilimited_rebuys = $rs->getBoolean($startcol + 22);

			$this->saved_result = $rs->getBoolean($startcol + 23);

			$this->suppress_schedule = $rs->getBoolean($startcol + 24);

			$this->schedule_start_date = $rs->getDate($startcol + 25, null);

			$this->enrollment_start_date = $rs->getDate($startcol + 26, null);

			$this->enrollment_mode = $rs->getString($startcol + 27);

			$this->suppress_ranking = $rs->getBoolean($startcol + 28);

			$this->created_at = $rs->getTimestamp($startcol + 29, null);

			$this->updated_at = $rs->getTimestamp($startcol + 30, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 31; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EventLiveView object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventLiveViewPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventLiveViewPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EventLiveViewPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EventLiveViewPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventLiveViewPeer::DATABASE_NAME);
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
					$pk = EventLiveViewPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += EventLiveViewPeer::doUpdate($this, $con);
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


			if (($retval = EventLiveViewPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventLiveViewPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getClubId();
				break;
			case 3:
				return $this->getEventName();
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
				return $this->getStepNumber();
				break;
			case 8:
				return $this->getStepDay();
				break;
			case 9:
				return $this->getComments();
				break;
			case 10:
				return $this->getDescription();
				break;
			case 11:
				return $this->getIsFreeroll();
				break;
			case 12:
				return $this->getIsMultiday();
				break;
			case 13:
				return $this->getIsSatellite();
				break;
			case 14:
				return $this->getBuyin();
				break;
			case 15:
				return $this->getEntranceFee();
				break;
			case 16:
				return $this->getGuaranteedPrize();
				break;
			case 17:
				return $this->getBlindTime();
				break;
			case 18:
				return $this->getStackChips();
				break;
			case 19:
				return $this->getPlayers();
				break;
			case 20:
				return $this->getAllowedRebuys();
				break;
			case 21:
				return $this->getAllowedAddons();
				break;
			case 22:
				return $this->getIsIlimitedRebuys();
				break;
			case 23:
				return $this->getSavedResult();
				break;
			case 24:
				return $this->getSuppressSchedule();
				break;
			case 25:
				return $this->getScheduleStartDate();
				break;
			case 26:
				return $this->getEnrollmentStartDate();
				break;
			case 27:
				return $this->getEnrollmentMode();
				break;
			case 28:
				return $this->getSuppressRanking();
				break;
			case 29:
				return $this->getCreatedAt();
				break;
			case 30:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventLiveViewPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getRankingLiveId(),
			$keys[2]=>$this->getClubId(),
			$keys[3]=>$this->getEventName(),
			$keys[4]=>$this->getEventDate(),
			$keys[5]=>$this->getStartTime(),
			$keys[6]=>$this->getEventDateTime(),
			$keys[7]=>$this->getStepNumber(),
			$keys[8]=>$this->getStepDay(),
			$keys[9]=>$this->getComments(),
			$keys[10]=>$this->getDescription(),
			$keys[11]=>$this->getIsFreeroll(),
			$keys[12]=>$this->getIsMultiday(),
			$keys[13]=>$this->getIsSatellite(),
			$keys[14]=>$this->getBuyin(),
			$keys[15]=>$this->getEntranceFee(),
			$keys[16]=>$this->getGuaranteedPrize(),
			$keys[17]=>$this->getBlindTime(),
			$keys[18]=>$this->getStackChips(),
			$keys[19]=>$this->getPlayers(),
			$keys[20]=>$this->getAllowedRebuys(),
			$keys[21]=>$this->getAllowedAddons(),
			$keys[22]=>$this->getIsIlimitedRebuys(),
			$keys[23]=>$this->getSavedResult(),
			$keys[24]=>$this->getSuppressSchedule(),
			$keys[25]=>$this->getScheduleStartDate(),
			$keys[26]=>$this->getEnrollmentStartDate(),
			$keys[27]=>$this->getEnrollmentMode(),
			$keys[28]=>$this->getSuppressRanking(),
			$keys[29]=>$this->getCreatedAt(),
			$keys[30]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventLiveViewPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setClubId($value);
				break;
			case 3:
				$this->setEventName($value);
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
				$this->setStepNumber($value);
				break;
			case 8:
				$this->setStepDay($value);
				break;
			case 9:
				$this->setComments($value);
				break;
			case 10:
				$this->setDescription($value);
				break;
			case 11:
				$this->setIsFreeroll($value);
				break;
			case 12:
				$this->setIsMultiday($value);
				break;
			case 13:
				$this->setIsSatellite($value);
				break;
			case 14:
				$this->setBuyin($value);
				break;
			case 15:
				$this->setEntranceFee($value);
				break;
			case 16:
				$this->setGuaranteedPrize($value);
				break;
			case 17:
				$this->setBlindTime($value);
				break;
			case 18:
				$this->setStackChips($value);
				break;
			case 19:
				$this->setPlayers($value);
				break;
			case 20:
				$this->setAllowedRebuys($value);
				break;
			case 21:
				$this->setAllowedAddons($value);
				break;
			case 22:
				$this->setIsIlimitedRebuys($value);
				break;
			case 23:
				$this->setSavedResult($value);
				break;
			case 24:
				$this->setSuppressSchedule($value);
				break;
			case 25:
				$this->setScheduleStartDate($value);
				break;
			case 26:
				$this->setEnrollmentStartDate($value);
				break;
			case 27:
				$this->setEnrollmentMode($value);
				break;
			case 28:
				$this->setSuppressRanking($value);
				break;
			case 29:
				$this->setCreatedAt($value);
				break;
			case 30:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventLiveViewPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRankingLiveId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setClubId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEventName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEventDate($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setStartTime($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEventDateTime($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setStepNumber($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setStepDay($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setComments($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDescription($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setIsFreeroll($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setIsMultiday($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIsSatellite($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setBuyin($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setEntranceFee($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setGuaranteedPrize($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setBlindTime($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setStackChips($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setPlayers($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setAllowedRebuys($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setAllowedAddons($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setIsIlimitedRebuys($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setSavedResult($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setSuppressSchedule($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setScheduleStartDate($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setEnrollmentStartDate($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setEnrollmentMode($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setSuppressRanking($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setCreatedAt($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setUpdatedAt($arr[$keys[30]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventLiveViewPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventLiveViewPeer::ID)) $criteria->add(EventLiveViewPeer::ID, $this->id);
		if ($this->isColumnModified(EventLiveViewPeer::RANKING_LIVE_ID)) $criteria->add(EventLiveViewPeer::RANKING_LIVE_ID, $this->ranking_live_id);
		if ($this->isColumnModified(EventLiveViewPeer::CLUB_ID)) $criteria->add(EventLiveViewPeer::CLUB_ID, $this->club_id);
		if ($this->isColumnModified(EventLiveViewPeer::EVENT_NAME)) $criteria->add(EventLiveViewPeer::EVENT_NAME, $this->event_name);
		if ($this->isColumnModified(EventLiveViewPeer::EVENT_DATE)) $criteria->add(EventLiveViewPeer::EVENT_DATE, $this->event_date);
		if ($this->isColumnModified(EventLiveViewPeer::START_TIME)) $criteria->add(EventLiveViewPeer::START_TIME, $this->start_time);
		if ($this->isColumnModified(EventLiveViewPeer::EVENT_DATE_TIME)) $criteria->add(EventLiveViewPeer::EVENT_DATE_TIME, $this->event_date_time);
		if ($this->isColumnModified(EventLiveViewPeer::STEP_NUMBER)) $criteria->add(EventLiveViewPeer::STEP_NUMBER, $this->step_number);
		if ($this->isColumnModified(EventLiveViewPeer::STEP_DAY)) $criteria->add(EventLiveViewPeer::STEP_DAY, $this->step_day);
		if ($this->isColumnModified(EventLiveViewPeer::COMMENTS)) $criteria->add(EventLiveViewPeer::COMMENTS, $this->comments);
		if ($this->isColumnModified(EventLiveViewPeer::DESCRIPTION)) $criteria->add(EventLiveViewPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(EventLiveViewPeer::IS_FREEROLL)) $criteria->add(EventLiveViewPeer::IS_FREEROLL, $this->is_freeroll);
		if ($this->isColumnModified(EventLiveViewPeer::IS_MULTIDAY)) $criteria->add(EventLiveViewPeer::IS_MULTIDAY, $this->is_multiday);
		if ($this->isColumnModified(EventLiveViewPeer::IS_SATELLITE)) $criteria->add(EventLiveViewPeer::IS_SATELLITE, $this->is_satellite);
		if ($this->isColumnModified(EventLiveViewPeer::BUYIN)) $criteria->add(EventLiveViewPeer::BUYIN, $this->buyin);
		if ($this->isColumnModified(EventLiveViewPeer::ENTRANCE_FEE)) $criteria->add(EventLiveViewPeer::ENTRANCE_FEE, $this->entrance_fee);
		if ($this->isColumnModified(EventLiveViewPeer::GUARANTEED_PRIZE)) $criteria->add(EventLiveViewPeer::GUARANTEED_PRIZE, $this->guaranteed_prize);
		if ($this->isColumnModified(EventLiveViewPeer::BLIND_TIME)) $criteria->add(EventLiveViewPeer::BLIND_TIME, $this->blind_time);
		if ($this->isColumnModified(EventLiveViewPeer::STACK_CHIPS)) $criteria->add(EventLiveViewPeer::STACK_CHIPS, $this->stack_chips);
		if ($this->isColumnModified(EventLiveViewPeer::PLAYERS)) $criteria->add(EventLiveViewPeer::PLAYERS, $this->players);
		if ($this->isColumnModified(EventLiveViewPeer::ALLOWED_REBUYS)) $criteria->add(EventLiveViewPeer::ALLOWED_REBUYS, $this->allowed_rebuys);
		if ($this->isColumnModified(EventLiveViewPeer::ALLOWED_ADDONS)) $criteria->add(EventLiveViewPeer::ALLOWED_ADDONS, $this->allowed_addons);
		if ($this->isColumnModified(EventLiveViewPeer::IS_ILIMITED_REBUYS)) $criteria->add(EventLiveViewPeer::IS_ILIMITED_REBUYS, $this->is_ilimited_rebuys);
		if ($this->isColumnModified(EventLiveViewPeer::SAVED_RESULT)) $criteria->add(EventLiveViewPeer::SAVED_RESULT, $this->saved_result);
		if ($this->isColumnModified(EventLiveViewPeer::SUPPRESS_SCHEDULE)) $criteria->add(EventLiveViewPeer::SUPPRESS_SCHEDULE, $this->suppress_schedule);
		if ($this->isColumnModified(EventLiveViewPeer::SCHEDULE_START_DATE)) $criteria->add(EventLiveViewPeer::SCHEDULE_START_DATE, $this->schedule_start_date);
		if ($this->isColumnModified(EventLiveViewPeer::ENROLLMENT_START_DATE)) $criteria->add(EventLiveViewPeer::ENROLLMENT_START_DATE, $this->enrollment_start_date);
		if ($this->isColumnModified(EventLiveViewPeer::ENROLLMENT_MODE)) $criteria->add(EventLiveViewPeer::ENROLLMENT_MODE, $this->enrollment_mode);
		if ($this->isColumnModified(EventLiveViewPeer::SUPPRESS_RANKING)) $criteria->add(EventLiveViewPeer::SUPPRESS_RANKING, $this->suppress_ranking);
		if ($this->isColumnModified(EventLiveViewPeer::CREATED_AT)) $criteria->add(EventLiveViewPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EventLiveViewPeer::UPDATED_AT)) $criteria->add(EventLiveViewPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventLiveViewPeer::DATABASE_NAME);

		$criteria->add(EventLiveViewPeer::ID, $this->id);

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

		$copyObj->setClubId($this->club_id);

		$copyObj->setEventName($this->event_name);

		$copyObj->setEventDate($this->event_date);

		$copyObj->setStartTime($this->start_time);

		$copyObj->setEventDateTime($this->event_date_time);

		$copyObj->setStepNumber($this->step_number);

		$copyObj->setStepDay($this->step_day);

		$copyObj->setComments($this->comments);

		$copyObj->setDescription($this->description);

		$copyObj->setIsFreeroll($this->is_freeroll);

		$copyObj->setIsMultiday($this->is_multiday);

		$copyObj->setIsSatellite($this->is_satellite);

		$copyObj->setBuyin($this->buyin);

		$copyObj->setEntranceFee($this->entrance_fee);

		$copyObj->setGuaranteedPrize($this->guaranteed_prize);

		$copyObj->setBlindTime($this->blind_time);

		$copyObj->setStackChips($this->stack_chips);

		$copyObj->setPlayers($this->players);

		$copyObj->setAllowedRebuys($this->allowed_rebuys);

		$copyObj->setAllowedAddons($this->allowed_addons);

		$copyObj->setIsIlimitedRebuys($this->is_ilimited_rebuys);

		$copyObj->setSavedResult($this->saved_result);

		$copyObj->setSuppressSchedule($this->suppress_schedule);

		$copyObj->setScheduleStartDate($this->schedule_start_date);

		$copyObj->setEnrollmentStartDate($this->enrollment_start_date);

		$copyObj->setEnrollmentMode($this->enrollment_mode);

		$copyObj->setSuppressRanking($this->suppress_ranking);

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
			self::$peer = new EventLiveViewPeer();
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

} 