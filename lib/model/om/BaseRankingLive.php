<?php


abstract class BaseRankingLive extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $ranking_name;


	
	protected $ranking_type_id;


	
	protected $email_template_id;


	
	protected $start_date;


	
	protected $finish_date;


	
	protected $is_private = false;


	
	protected $no_ranking = false;


	
	protected $players = 0;


	
	protected $events = 0;


	
	protected $description;


	
	protected $game_style_id;


	
	protected $game_type_id;


	
	protected $ranking_tag;


	
	protected $score_formula_option = 'simple';


	
	protected $score_formula;


	
	protected $file_name_logo;


	
	protected $buyin = 0;


	
	protected $entrance_fee = 0;


	
	protected $guaranteed_prize;


	
	protected $start_time;


	
	protected $is_freeroll;


	
	protected $is_multiday;


	
	protected $blind_time;


	
	protected $stack_chips;


	
	protected $allowed_rebuys = 0;


	
	protected $allowed_addons = 0;


	
	protected $tables_number;


	
	protected $is_ilimited_rebuys;


	
	protected $publish_prize;


	
	protected $prize_split;


	
	protected $rake_percent;


	
	protected $enabled = false;


	
	protected $visible = true;


	
	protected $locked = false;


	
	protected $deleted = false;


	
	protected $buyin_satellite = 0;


	
	protected $entrance_fee_satellite = 0;


	
	protected $guaranteed_prize_satellite;


	
	protected $start_time_satellite;


	
	protected $is_freeroll_satellite;


	
	protected $blind_time_satellite;


	
	protected $stack_chips_satellite;


	
	protected $allowed_rebuys_satellite = 0;


	
	protected $allowed_addons_satellite = 0;


	
	protected $tables_number_satellite;


	
	protected $is_ilimited_rebuys_satellite;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aVirtualTableRelatedByRankingTypeId;

	
	protected $aVirtualTableRelatedByGameStyleId;

	
	protected $aVirtualTableRelatedByGameTypeId;

	
	protected $aEmailTemplate;

	
	protected $collEventLiveList;

	
	protected $lastEventLiveCriteria = null;

	
	protected $collClubRankingLiveList;

	
	protected $lastClubRankingLiveCriteria = null;

	
	protected $collRankingLivePlayerList;

	
	protected $lastRankingLivePlayerCriteria = null;

	
	protected $collRankingLiveHistoryList;

	
	protected $lastRankingLiveHistoryCriteria = null;

	
	protected $collRankingLiveTemplateList;

	
	protected $lastRankingLiveTemplateCriteria = null;

	
	protected $collEventLiveViewList;

	
	protected $lastEventLiveViewCriteria = null;

	
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

	
	public function getEmailTemplateId()
	{

		return $this->email_template_id;
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

	
	public function getNoRanking()
	{

		return $this->no_ranking;
	}

	
	public function getPlayers()
	{

		return $this->players;
	}

	
	public function getEvents()
	{

		return $this->events;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getGameStyleId()
	{

		return $this->game_style_id;
	}

	
	public function getGameTypeId()
	{

		return $this->game_type_id;
	}

	
	public function getRankingTag()
	{

		return $this->ranking_tag;
	}

	
	public function getScoreFormulaOption()
	{

		return $this->score_formula_option;
	}

	
	public function getScoreFormula()
	{

		return $this->score_formula;
	}

	
	public function getFileNameLogo()
	{

		return $this->file_name_logo;
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

	
	public function getIsFreeroll()
	{

		return $this->is_freeroll;
	}

	
	public function getIsMultiday()
	{

		return $this->is_multiday;
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

	
	public function getAllowedRebuys()
	{

		return $this->allowed_rebuys;
	}

	
	public function getAllowedAddons()
	{

		return $this->allowed_addons;
	}

	
	public function getTablesNumber()
	{

		return $this->tables_number;
	}

	
	public function getIsIlimitedRebuys()
	{

		return $this->is_ilimited_rebuys;
	}

	
	public function getPublishPrize()
	{

		return $this->publish_prize;
	}

	
	public function getPrizeSplit()
	{

		return $this->prize_split;
	}

	
	public function getRakePercent()
	{

		return $this->rake_percent;
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

	
	public function getBuyinSatellite()
	{

		return $this->buyin_satellite;
	}

	
	public function getEntranceFeeSatellite()
	{

		return $this->entrance_fee_satellite;
	}

	
	public function getGuaranteedPrizeSatellite()
	{

		return $this->guaranteed_prize_satellite;
	}

	
	public function getStartTimeSatellite($format = 'H:i:s')
	{

		if ($this->start_time_satellite === null || $this->start_time_satellite === '') {
			return null;
		} elseif (!is_int($this->start_time_satellite)) {
						$ts = strtotime($this->start_time_satellite);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [start_time_satellite] as date/time value: " . var_export($this->start_time_satellite, true));
			}
		} else {
			$ts = $this->start_time_satellite;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getIsFreerollSatellite()
	{

		return $this->is_freeroll_satellite;
	}

	
	public function getBlindTimeSatellite($format = 'H:i:s')
	{

		if ($this->blind_time_satellite === null || $this->blind_time_satellite === '') {
			return null;
		} elseif (!is_int($this->blind_time_satellite)) {
						$ts = strtotime($this->blind_time_satellite);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [blind_time_satellite] as date/time value: " . var_export($this->blind_time_satellite, true));
			}
		} else {
			$ts = $this->blind_time_satellite;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getStackChipsSatellite()
	{

		return $this->stack_chips_satellite;
	}

	
	public function getAllowedRebuysSatellite()
	{

		return $this->allowed_rebuys_satellite;
	}

	
	public function getAllowedAddonsSatellite()
	{

		return $this->allowed_addons_satellite;
	}

	
	public function getTablesNumberSatellite()
	{

		return $this->tables_number_satellite;
	}

	
	public function getIsIlimitedRebuysSatellite()
	{

		return $this->is_ilimited_rebuys_satellite;
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
	
	public function setEmailTemplateId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->email_template_id !== $v) {
			$this->email_template_id = $v;
			$this->modifiedColumns[] = RankingLivePeer::EMAIL_TEMPLATE_ID;
		}

		if ($this->aEmailTemplate !== null && $this->aEmailTemplate->getId() !== $v) {
			$this->aEmailTemplate = null;
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
	
	public function setNoRanking($v)
	{

		if ($this->no_ranking !== $v || $v === false) {
			$this->no_ranking = $v;
			$this->modifiedColumns[] = RankingLivePeer::NO_RANKING;
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
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = RankingLivePeer::DESCRIPTION;
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
	
	public function setGameTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->game_type_id !== $v) {
			$this->game_type_id = $v;
			$this->modifiedColumns[] = RankingLivePeer::GAME_TYPE_ID;
		}

		if ($this->aVirtualTableRelatedByGameTypeId !== null && $this->aVirtualTableRelatedByGameTypeId->getId() !== $v) {
			$this->aVirtualTableRelatedByGameTypeId = null;
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
	
	public function setScoreFormulaOption($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->score_formula_option !== $v || $v === 'simple') {
			$this->score_formula_option = $v;
			$this->modifiedColumns[] = RankingLivePeer::SCORE_FORMULA_OPTION;
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
	
	public function setBuyin($v)
	{

		if ($this->buyin !== $v || $v === 0) {
			$this->buyin = $v;
			$this->modifiedColumns[] = RankingLivePeer::BUYIN;
		}

	} 
	
	public function setEntranceFee($v)
	{

		if ($this->entrance_fee !== $v || $v === 0) {
			$this->entrance_fee = $v;
			$this->modifiedColumns[] = RankingLivePeer::ENTRANCE_FEE;
		}

	} 
	
	public function setGuaranteedPrize($v)
	{

		if ($this->guaranteed_prize !== $v) {
			$this->guaranteed_prize = $v;
			$this->modifiedColumns[] = RankingLivePeer::GUARANTEED_PRIZE;
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
			$this->modifiedColumns[] = RankingLivePeer::START_TIME;
		}

	} 
	
	public function setIsFreeroll($v)
	{

		if ($this->is_freeroll !== $v) {
			$this->is_freeroll = $v;
			$this->modifiedColumns[] = RankingLivePeer::IS_FREEROLL;
		}

	} 
	
	public function setIsMultiday($v)
	{

		if ($this->is_multiday !== $v) {
			$this->is_multiday = $v;
			$this->modifiedColumns[] = RankingLivePeer::IS_MULTIDAY;
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
			$this->modifiedColumns[] = RankingLivePeer::BLIND_TIME;
		}

	} 
	
	public function setStackChips($v)
	{

		if ($this->stack_chips !== $v) {
			$this->stack_chips = $v;
			$this->modifiedColumns[] = RankingLivePeer::STACK_CHIPS;
		}

	} 
	
	public function setAllowedRebuys($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->allowed_rebuys !== $v || $v === 0) {
			$this->allowed_rebuys = $v;
			$this->modifiedColumns[] = RankingLivePeer::ALLOWED_REBUYS;
		}

	} 
	
	public function setAllowedAddons($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->allowed_addons !== $v || $v === 0) {
			$this->allowed_addons = $v;
			$this->modifiedColumns[] = RankingLivePeer::ALLOWED_ADDONS;
		}

	} 
	
	public function setTablesNumber($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tables_number !== $v) {
			$this->tables_number = $v;
			$this->modifiedColumns[] = RankingLivePeer::TABLES_NUMBER;
		}

	} 
	
	public function setIsIlimitedRebuys($v)
	{

		if ($this->is_ilimited_rebuys !== $v) {
			$this->is_ilimited_rebuys = $v;
			$this->modifiedColumns[] = RankingLivePeer::IS_ILIMITED_REBUYS;
		}

	} 
	
	public function setPublishPrize($v)
	{

		if ($this->publish_prize !== $v) {
			$this->publish_prize = $v;
			$this->modifiedColumns[] = RankingLivePeer::PUBLISH_PRIZE;
		}

	} 
	
	public function setPrizeSplit($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->prize_split !== $v) {
			$this->prize_split = $v;
			$this->modifiedColumns[] = RankingLivePeer::PRIZE_SPLIT;
		}

	} 
	
	public function setRakePercent($v)
	{

		if ($this->rake_percent !== $v) {
			$this->rake_percent = $v;
			$this->modifiedColumns[] = RankingLivePeer::RAKE_PERCENT;
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
	
	public function setBuyinSatellite($v)
	{

		if ($this->buyin_satellite !== $v || $v === 0) {
			$this->buyin_satellite = $v;
			$this->modifiedColumns[] = RankingLivePeer::BUYIN_SATELLITE;
		}

	} 
	
	public function setEntranceFeeSatellite($v)
	{

		if ($this->entrance_fee_satellite !== $v || $v === 0) {
			$this->entrance_fee_satellite = $v;
			$this->modifiedColumns[] = RankingLivePeer::ENTRANCE_FEE_SATELLITE;
		}

	} 
	
	public function setGuaranteedPrizeSatellite($v)
	{

		if ($this->guaranteed_prize_satellite !== $v) {
			$this->guaranteed_prize_satellite = $v;
			$this->modifiedColumns[] = RankingLivePeer::GUARANTEED_PRIZE_SATELLITE;
		}

	} 
	
	public function setStartTimeSatellite($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [start_time_satellite] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->start_time_satellite !== $ts) {
			$this->start_time_satellite = $ts;
			$this->modifiedColumns[] = RankingLivePeer::START_TIME_SATELLITE;
		}

	} 
	
	public function setIsFreerollSatellite($v)
	{

		if ($this->is_freeroll_satellite !== $v) {
			$this->is_freeroll_satellite = $v;
			$this->modifiedColumns[] = RankingLivePeer::IS_FREEROLL_SATELLITE;
		}

	} 
	
	public function setBlindTimeSatellite($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [blind_time_satellite] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->blind_time_satellite !== $ts) {
			$this->blind_time_satellite = $ts;
			$this->modifiedColumns[] = RankingLivePeer::BLIND_TIME_SATELLITE;
		}

	} 
	
	public function setStackChipsSatellite($v)
	{

		if ($this->stack_chips_satellite !== $v) {
			$this->stack_chips_satellite = $v;
			$this->modifiedColumns[] = RankingLivePeer::STACK_CHIPS_SATELLITE;
		}

	} 
	
	public function setAllowedRebuysSatellite($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->allowed_rebuys_satellite !== $v || $v === 0) {
			$this->allowed_rebuys_satellite = $v;
			$this->modifiedColumns[] = RankingLivePeer::ALLOWED_REBUYS_SATELLITE;
		}

	} 
	
	public function setAllowedAddonsSatellite($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->allowed_addons_satellite !== $v || $v === 0) {
			$this->allowed_addons_satellite = $v;
			$this->modifiedColumns[] = RankingLivePeer::ALLOWED_ADDONS_SATELLITE;
		}

	} 
	
	public function setTablesNumberSatellite($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tables_number_satellite !== $v) {
			$this->tables_number_satellite = $v;
			$this->modifiedColumns[] = RankingLivePeer::TABLES_NUMBER_SATELLITE;
		}

	} 
	
	public function setIsIlimitedRebuysSatellite($v)
	{

		if ($this->is_ilimited_rebuys_satellite !== $v) {
			$this->is_ilimited_rebuys_satellite = $v;
			$this->modifiedColumns[] = RankingLivePeer::IS_ILIMITED_REBUYS_SATELLITE;
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

			$this->email_template_id = $rs->getInt($startcol + 3);

			$this->start_date = $rs->getDate($startcol + 4, null);

			$this->finish_date = $rs->getDate($startcol + 5, null);

			$this->is_private = $rs->getBoolean($startcol + 6);

			$this->no_ranking = $rs->getBoolean($startcol + 7);

			$this->players = $rs->getInt($startcol + 8);

			$this->events = $rs->getInt($startcol + 9);

			$this->description = $rs->getString($startcol + 10);

			$this->game_style_id = $rs->getInt($startcol + 11);

			$this->game_type_id = $rs->getInt($startcol + 12);

			$this->ranking_tag = $rs->getString($startcol + 13);

			$this->score_formula_option = $rs->getString($startcol + 14);

			$this->score_formula = $rs->getString($startcol + 15);

			$this->file_name_logo = $rs->getString($startcol + 16);

			$this->buyin = $rs->getFloat($startcol + 17);

			$this->entrance_fee = $rs->getFloat($startcol + 18);

			$this->guaranteed_prize = $rs->getFloat($startcol + 19);

			$this->start_time = $rs->getTime($startcol + 20, null);

			$this->is_freeroll = $rs->getBoolean($startcol + 21);

			$this->is_multiday = $rs->getBoolean($startcol + 22);

			$this->blind_time = $rs->getTime($startcol + 23, null);

			$this->stack_chips = $rs->getFloat($startcol + 24);

			$this->allowed_rebuys = $rs->getInt($startcol + 25);

			$this->allowed_addons = $rs->getInt($startcol + 26);

			$this->tables_number = $rs->getInt($startcol + 27);

			$this->is_ilimited_rebuys = $rs->getBoolean($startcol + 28);

			$this->publish_prize = $rs->getBoolean($startcol + 29);

			$this->prize_split = $rs->getString($startcol + 30);

			$this->rake_percent = $rs->getFloat($startcol + 31);

			$this->enabled = $rs->getBoolean($startcol + 32);

			$this->visible = $rs->getBoolean($startcol + 33);

			$this->locked = $rs->getBoolean($startcol + 34);

			$this->deleted = $rs->getBoolean($startcol + 35);

			$this->buyin_satellite = $rs->getFloat($startcol + 36);

			$this->entrance_fee_satellite = $rs->getFloat($startcol + 37);

			$this->guaranteed_prize_satellite = $rs->getFloat($startcol + 38);

			$this->start_time_satellite = $rs->getTime($startcol + 39, null);

			$this->is_freeroll_satellite = $rs->getBoolean($startcol + 40);

			$this->blind_time_satellite = $rs->getTime($startcol + 41, null);

			$this->stack_chips_satellite = $rs->getFloat($startcol + 42);

			$this->allowed_rebuys_satellite = $rs->getInt($startcol + 43);

			$this->allowed_addons_satellite = $rs->getInt($startcol + 44);

			$this->tables_number_satellite = $rs->getInt($startcol + 45);

			$this->is_ilimited_rebuys_satellite = $rs->getBoolean($startcol + 46);

			$this->created_at = $rs->getTimestamp($startcol + 47, null);

			$this->updated_at = $rs->getTimestamp($startcol + 48, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 49; 
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

			if ($this->aVirtualTableRelatedByGameTypeId !== null) {
				if ($this->aVirtualTableRelatedByGameTypeId->isModified() || $this->aVirtualTableRelatedByGameTypeId->getCurrentVirtualTableI18n()->isModified()) {
					$affectedRows += $this->aVirtualTableRelatedByGameTypeId->save($con);
				}
				$this->setVirtualTableRelatedByGameTypeId($this->aVirtualTableRelatedByGameTypeId);
			}

			if ($this->aEmailTemplate !== null) {
				if ($this->aEmailTemplate->isModified()) {
					$affectedRows += $this->aEmailTemplate->save($con);
				}
				$this->setEmailTemplate($this->aEmailTemplate);
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

			if ($this->collClubRankingLiveList !== null) {
				foreach($this->collClubRankingLiveList as $referrerFK) {
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

			if ($this->collRankingLiveTemplateList !== null) {
				foreach($this->collRankingLiveTemplateList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventLiveViewList !== null) {
				foreach($this->collEventLiveViewList as $referrerFK) {
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

			if ($this->aVirtualTableRelatedByGameTypeId !== null) {
				if (!$this->aVirtualTableRelatedByGameTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVirtualTableRelatedByGameTypeId->getValidationFailures());
				}
			}

			if ($this->aEmailTemplate !== null) {
				if (!$this->aEmailTemplate->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEmailTemplate->getValidationFailures());
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

				if ($this->collClubRankingLiveList !== null) {
					foreach($this->collClubRankingLiveList as $referrerFK) {
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

				if ($this->collRankingLiveTemplateList !== null) {
					foreach($this->collRankingLiveTemplateList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventLiveViewList !== null) {
					foreach($this->collEventLiveViewList as $referrerFK) {
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
				return $this->getEmailTemplateId();
				break;
			case 4:
				return $this->getStartDate();
				break;
			case 5:
				return $this->getFinishDate();
				break;
			case 6:
				return $this->getIsPrivate();
				break;
			case 7:
				return $this->getNoRanking();
				break;
			case 8:
				return $this->getPlayers();
				break;
			case 9:
				return $this->getEvents();
				break;
			case 10:
				return $this->getDescription();
				break;
			case 11:
				return $this->getGameStyleId();
				break;
			case 12:
				return $this->getGameTypeId();
				break;
			case 13:
				return $this->getRankingTag();
				break;
			case 14:
				return $this->getScoreFormulaOption();
				break;
			case 15:
				return $this->getScoreFormula();
				break;
			case 16:
				return $this->getFileNameLogo();
				break;
			case 17:
				return $this->getBuyin();
				break;
			case 18:
				return $this->getEntranceFee();
				break;
			case 19:
				return $this->getGuaranteedPrize();
				break;
			case 20:
				return $this->getStartTime();
				break;
			case 21:
				return $this->getIsFreeroll();
				break;
			case 22:
				return $this->getIsMultiday();
				break;
			case 23:
				return $this->getBlindTime();
				break;
			case 24:
				return $this->getStackChips();
				break;
			case 25:
				return $this->getAllowedRebuys();
				break;
			case 26:
				return $this->getAllowedAddons();
				break;
			case 27:
				return $this->getTablesNumber();
				break;
			case 28:
				return $this->getIsIlimitedRebuys();
				break;
			case 29:
				return $this->getPublishPrize();
				break;
			case 30:
				return $this->getPrizeSplit();
				break;
			case 31:
				return $this->getRakePercent();
				break;
			case 32:
				return $this->getEnabled();
				break;
			case 33:
				return $this->getVisible();
				break;
			case 34:
				return $this->getLocked();
				break;
			case 35:
				return $this->getDeleted();
				break;
			case 36:
				return $this->getBuyinSatellite();
				break;
			case 37:
				return $this->getEntranceFeeSatellite();
				break;
			case 38:
				return $this->getGuaranteedPrizeSatellite();
				break;
			case 39:
				return $this->getStartTimeSatellite();
				break;
			case 40:
				return $this->getIsFreerollSatellite();
				break;
			case 41:
				return $this->getBlindTimeSatellite();
				break;
			case 42:
				return $this->getStackChipsSatellite();
				break;
			case 43:
				return $this->getAllowedRebuysSatellite();
				break;
			case 44:
				return $this->getAllowedAddonsSatellite();
				break;
			case 45:
				return $this->getTablesNumberSatellite();
				break;
			case 46:
				return $this->getIsIlimitedRebuysSatellite();
				break;
			case 47:
				return $this->getCreatedAt();
				break;
			case 48:
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
			$keys[3]=>$this->getEmailTemplateId(),
			$keys[4]=>$this->getStartDate(),
			$keys[5]=>$this->getFinishDate(),
			$keys[6]=>$this->getIsPrivate(),
			$keys[7]=>$this->getNoRanking(),
			$keys[8]=>$this->getPlayers(),
			$keys[9]=>$this->getEvents(),
			$keys[10]=>$this->getDescription(),
			$keys[11]=>$this->getGameStyleId(),
			$keys[12]=>$this->getGameTypeId(),
			$keys[13]=>$this->getRankingTag(),
			$keys[14]=>$this->getScoreFormulaOption(),
			$keys[15]=>$this->getScoreFormula(),
			$keys[16]=>$this->getFileNameLogo(),
			$keys[17]=>$this->getBuyin(),
			$keys[18]=>$this->getEntranceFee(),
			$keys[19]=>$this->getGuaranteedPrize(),
			$keys[20]=>$this->getStartTime(),
			$keys[21]=>$this->getIsFreeroll(),
			$keys[22]=>$this->getIsMultiday(),
			$keys[23]=>$this->getBlindTime(),
			$keys[24]=>$this->getStackChips(),
			$keys[25]=>$this->getAllowedRebuys(),
			$keys[26]=>$this->getAllowedAddons(),
			$keys[27]=>$this->getTablesNumber(),
			$keys[28]=>$this->getIsIlimitedRebuys(),
			$keys[29]=>$this->getPublishPrize(),
			$keys[30]=>$this->getPrizeSplit(),
			$keys[31]=>$this->getRakePercent(),
			$keys[32]=>$this->getEnabled(),
			$keys[33]=>$this->getVisible(),
			$keys[34]=>$this->getLocked(),
			$keys[35]=>$this->getDeleted(),
			$keys[36]=>$this->getBuyinSatellite(),
			$keys[37]=>$this->getEntranceFeeSatellite(),
			$keys[38]=>$this->getGuaranteedPrizeSatellite(),
			$keys[39]=>$this->getStartTimeSatellite(),
			$keys[40]=>$this->getIsFreerollSatellite(),
			$keys[41]=>$this->getBlindTimeSatellite(),
			$keys[42]=>$this->getStackChipsSatellite(),
			$keys[43]=>$this->getAllowedRebuysSatellite(),
			$keys[44]=>$this->getAllowedAddonsSatellite(),
			$keys[45]=>$this->getTablesNumberSatellite(),
			$keys[46]=>$this->getIsIlimitedRebuysSatellite(),
			$keys[47]=>$this->getCreatedAt(),
			$keys[48]=>$this->getUpdatedAt(),
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
				$this->setEmailTemplateId($value);
				break;
			case 4:
				$this->setStartDate($value);
				break;
			case 5:
				$this->setFinishDate($value);
				break;
			case 6:
				$this->setIsPrivate($value);
				break;
			case 7:
				$this->setNoRanking($value);
				break;
			case 8:
				$this->setPlayers($value);
				break;
			case 9:
				$this->setEvents($value);
				break;
			case 10:
				$this->setDescription($value);
				break;
			case 11:
				$this->setGameStyleId($value);
				break;
			case 12:
				$this->setGameTypeId($value);
				break;
			case 13:
				$this->setRankingTag($value);
				break;
			case 14:
				$this->setScoreFormulaOption($value);
				break;
			case 15:
				$this->setScoreFormula($value);
				break;
			case 16:
				$this->setFileNameLogo($value);
				break;
			case 17:
				$this->setBuyin($value);
				break;
			case 18:
				$this->setEntranceFee($value);
				break;
			case 19:
				$this->setGuaranteedPrize($value);
				break;
			case 20:
				$this->setStartTime($value);
				break;
			case 21:
				$this->setIsFreeroll($value);
				break;
			case 22:
				$this->setIsMultiday($value);
				break;
			case 23:
				$this->setBlindTime($value);
				break;
			case 24:
				$this->setStackChips($value);
				break;
			case 25:
				$this->setAllowedRebuys($value);
				break;
			case 26:
				$this->setAllowedAddons($value);
				break;
			case 27:
				$this->setTablesNumber($value);
				break;
			case 28:
				$this->setIsIlimitedRebuys($value);
				break;
			case 29:
				$this->setPublishPrize($value);
				break;
			case 30:
				$this->setPrizeSplit($value);
				break;
			case 31:
				$this->setRakePercent($value);
				break;
			case 32:
				$this->setEnabled($value);
				break;
			case 33:
				$this->setVisible($value);
				break;
			case 34:
				$this->setLocked($value);
				break;
			case 35:
				$this->setDeleted($value);
				break;
			case 36:
				$this->setBuyinSatellite($value);
				break;
			case 37:
				$this->setEntranceFeeSatellite($value);
				break;
			case 38:
				$this->setGuaranteedPrizeSatellite($value);
				break;
			case 39:
				$this->setStartTimeSatellite($value);
				break;
			case 40:
				$this->setIsFreerollSatellite($value);
				break;
			case 41:
				$this->setBlindTimeSatellite($value);
				break;
			case 42:
				$this->setStackChipsSatellite($value);
				break;
			case 43:
				$this->setAllowedRebuysSatellite($value);
				break;
			case 44:
				$this->setAllowedAddonsSatellite($value);
				break;
			case 45:
				$this->setTablesNumberSatellite($value);
				break;
			case 46:
				$this->setIsIlimitedRebuysSatellite($value);
				break;
			case 47:
				$this->setCreatedAt($value);
				break;
			case 48:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingLivePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRankingName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRankingTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEmailTemplateId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStartDate($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFinishDate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsPrivate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setNoRanking($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPlayers($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEvents($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDescription($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setGameStyleId($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setGameTypeId($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setRankingTag($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setScoreFormulaOption($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setScoreFormula($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setFileNameLogo($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setBuyin($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setEntranceFee($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setGuaranteedPrize($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setStartTime($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setIsFreeroll($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setIsMultiday($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setBlindTime($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setStackChips($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setAllowedRebuys($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setAllowedAddons($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setTablesNumber($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setIsIlimitedRebuys($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setPublishPrize($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setPrizeSplit($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setRakePercent($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setEnabled($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setVisible($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setLocked($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setDeleted($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setBuyinSatellite($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setEntranceFeeSatellite($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setGuaranteedPrizeSatellite($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setStartTimeSatellite($arr[$keys[39]]);
		if (array_key_exists($keys[40], $arr)) $this->setIsFreerollSatellite($arr[$keys[40]]);
		if (array_key_exists($keys[41], $arr)) $this->setBlindTimeSatellite($arr[$keys[41]]);
		if (array_key_exists($keys[42], $arr)) $this->setStackChipsSatellite($arr[$keys[42]]);
		if (array_key_exists($keys[43], $arr)) $this->setAllowedRebuysSatellite($arr[$keys[43]]);
		if (array_key_exists($keys[44], $arr)) $this->setAllowedAddonsSatellite($arr[$keys[44]]);
		if (array_key_exists($keys[45], $arr)) $this->setTablesNumberSatellite($arr[$keys[45]]);
		if (array_key_exists($keys[46], $arr)) $this->setIsIlimitedRebuysSatellite($arr[$keys[46]]);
		if (array_key_exists($keys[47], $arr)) $this->setCreatedAt($arr[$keys[47]]);
		if (array_key_exists($keys[48], $arr)) $this->setUpdatedAt($arr[$keys[48]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RankingLivePeer::DATABASE_NAME);

		if ($this->isColumnModified(RankingLivePeer::ID)) $criteria->add(RankingLivePeer::ID, $this->id);
		if ($this->isColumnModified(RankingLivePeer::RANKING_NAME)) $criteria->add(RankingLivePeer::RANKING_NAME, $this->ranking_name);
		if ($this->isColumnModified(RankingLivePeer::RANKING_TYPE_ID)) $criteria->add(RankingLivePeer::RANKING_TYPE_ID, $this->ranking_type_id);
		if ($this->isColumnModified(RankingLivePeer::EMAIL_TEMPLATE_ID)) $criteria->add(RankingLivePeer::EMAIL_TEMPLATE_ID, $this->email_template_id);
		if ($this->isColumnModified(RankingLivePeer::START_DATE)) $criteria->add(RankingLivePeer::START_DATE, $this->start_date);
		if ($this->isColumnModified(RankingLivePeer::FINISH_DATE)) $criteria->add(RankingLivePeer::FINISH_DATE, $this->finish_date);
		if ($this->isColumnModified(RankingLivePeer::IS_PRIVATE)) $criteria->add(RankingLivePeer::IS_PRIVATE, $this->is_private);
		if ($this->isColumnModified(RankingLivePeer::NO_RANKING)) $criteria->add(RankingLivePeer::NO_RANKING, $this->no_ranking);
		if ($this->isColumnModified(RankingLivePeer::PLAYERS)) $criteria->add(RankingLivePeer::PLAYERS, $this->players);
		if ($this->isColumnModified(RankingLivePeer::EVENTS)) $criteria->add(RankingLivePeer::EVENTS, $this->events);
		if ($this->isColumnModified(RankingLivePeer::DESCRIPTION)) $criteria->add(RankingLivePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(RankingLivePeer::GAME_STYLE_ID)) $criteria->add(RankingLivePeer::GAME_STYLE_ID, $this->game_style_id);
		if ($this->isColumnModified(RankingLivePeer::GAME_TYPE_ID)) $criteria->add(RankingLivePeer::GAME_TYPE_ID, $this->game_type_id);
		if ($this->isColumnModified(RankingLivePeer::RANKING_TAG)) $criteria->add(RankingLivePeer::RANKING_TAG, $this->ranking_tag);
		if ($this->isColumnModified(RankingLivePeer::SCORE_FORMULA_OPTION)) $criteria->add(RankingLivePeer::SCORE_FORMULA_OPTION, $this->score_formula_option);
		if ($this->isColumnModified(RankingLivePeer::SCORE_FORMULA)) $criteria->add(RankingLivePeer::SCORE_FORMULA, $this->score_formula);
		if ($this->isColumnModified(RankingLivePeer::FILE_NAME_LOGO)) $criteria->add(RankingLivePeer::FILE_NAME_LOGO, $this->file_name_logo);
		if ($this->isColumnModified(RankingLivePeer::BUYIN)) $criteria->add(RankingLivePeer::BUYIN, $this->buyin);
		if ($this->isColumnModified(RankingLivePeer::ENTRANCE_FEE)) $criteria->add(RankingLivePeer::ENTRANCE_FEE, $this->entrance_fee);
		if ($this->isColumnModified(RankingLivePeer::GUARANTEED_PRIZE)) $criteria->add(RankingLivePeer::GUARANTEED_PRIZE, $this->guaranteed_prize);
		if ($this->isColumnModified(RankingLivePeer::START_TIME)) $criteria->add(RankingLivePeer::START_TIME, $this->start_time);
		if ($this->isColumnModified(RankingLivePeer::IS_FREEROLL)) $criteria->add(RankingLivePeer::IS_FREEROLL, $this->is_freeroll);
		if ($this->isColumnModified(RankingLivePeer::IS_MULTIDAY)) $criteria->add(RankingLivePeer::IS_MULTIDAY, $this->is_multiday);
		if ($this->isColumnModified(RankingLivePeer::BLIND_TIME)) $criteria->add(RankingLivePeer::BLIND_TIME, $this->blind_time);
		if ($this->isColumnModified(RankingLivePeer::STACK_CHIPS)) $criteria->add(RankingLivePeer::STACK_CHIPS, $this->stack_chips);
		if ($this->isColumnModified(RankingLivePeer::ALLOWED_REBUYS)) $criteria->add(RankingLivePeer::ALLOWED_REBUYS, $this->allowed_rebuys);
		if ($this->isColumnModified(RankingLivePeer::ALLOWED_ADDONS)) $criteria->add(RankingLivePeer::ALLOWED_ADDONS, $this->allowed_addons);
		if ($this->isColumnModified(RankingLivePeer::TABLES_NUMBER)) $criteria->add(RankingLivePeer::TABLES_NUMBER, $this->tables_number);
		if ($this->isColumnModified(RankingLivePeer::IS_ILIMITED_REBUYS)) $criteria->add(RankingLivePeer::IS_ILIMITED_REBUYS, $this->is_ilimited_rebuys);
		if ($this->isColumnModified(RankingLivePeer::PUBLISH_PRIZE)) $criteria->add(RankingLivePeer::PUBLISH_PRIZE, $this->publish_prize);
		if ($this->isColumnModified(RankingLivePeer::PRIZE_SPLIT)) $criteria->add(RankingLivePeer::PRIZE_SPLIT, $this->prize_split);
		if ($this->isColumnModified(RankingLivePeer::RAKE_PERCENT)) $criteria->add(RankingLivePeer::RAKE_PERCENT, $this->rake_percent);
		if ($this->isColumnModified(RankingLivePeer::ENABLED)) $criteria->add(RankingLivePeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(RankingLivePeer::VISIBLE)) $criteria->add(RankingLivePeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(RankingLivePeer::LOCKED)) $criteria->add(RankingLivePeer::LOCKED, $this->locked);
		if ($this->isColumnModified(RankingLivePeer::DELETED)) $criteria->add(RankingLivePeer::DELETED, $this->deleted);
		if ($this->isColumnModified(RankingLivePeer::BUYIN_SATELLITE)) $criteria->add(RankingLivePeer::BUYIN_SATELLITE, $this->buyin_satellite);
		if ($this->isColumnModified(RankingLivePeer::ENTRANCE_FEE_SATELLITE)) $criteria->add(RankingLivePeer::ENTRANCE_FEE_SATELLITE, $this->entrance_fee_satellite);
		if ($this->isColumnModified(RankingLivePeer::GUARANTEED_PRIZE_SATELLITE)) $criteria->add(RankingLivePeer::GUARANTEED_PRIZE_SATELLITE, $this->guaranteed_prize_satellite);
		if ($this->isColumnModified(RankingLivePeer::START_TIME_SATELLITE)) $criteria->add(RankingLivePeer::START_TIME_SATELLITE, $this->start_time_satellite);
		if ($this->isColumnModified(RankingLivePeer::IS_FREEROLL_SATELLITE)) $criteria->add(RankingLivePeer::IS_FREEROLL_SATELLITE, $this->is_freeroll_satellite);
		if ($this->isColumnModified(RankingLivePeer::BLIND_TIME_SATELLITE)) $criteria->add(RankingLivePeer::BLIND_TIME_SATELLITE, $this->blind_time_satellite);
		if ($this->isColumnModified(RankingLivePeer::STACK_CHIPS_SATELLITE)) $criteria->add(RankingLivePeer::STACK_CHIPS_SATELLITE, $this->stack_chips_satellite);
		if ($this->isColumnModified(RankingLivePeer::ALLOWED_REBUYS_SATELLITE)) $criteria->add(RankingLivePeer::ALLOWED_REBUYS_SATELLITE, $this->allowed_rebuys_satellite);
		if ($this->isColumnModified(RankingLivePeer::ALLOWED_ADDONS_SATELLITE)) $criteria->add(RankingLivePeer::ALLOWED_ADDONS_SATELLITE, $this->allowed_addons_satellite);
		if ($this->isColumnModified(RankingLivePeer::TABLES_NUMBER_SATELLITE)) $criteria->add(RankingLivePeer::TABLES_NUMBER_SATELLITE, $this->tables_number_satellite);
		if ($this->isColumnModified(RankingLivePeer::IS_ILIMITED_REBUYS_SATELLITE)) $criteria->add(RankingLivePeer::IS_ILIMITED_REBUYS_SATELLITE, $this->is_ilimited_rebuys_satellite);
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

		$copyObj->setEmailTemplateId($this->email_template_id);

		$copyObj->setStartDate($this->start_date);

		$copyObj->setFinishDate($this->finish_date);

		$copyObj->setIsPrivate($this->is_private);

		$copyObj->setNoRanking($this->no_ranking);

		$copyObj->setPlayers($this->players);

		$copyObj->setEvents($this->events);

		$copyObj->setDescription($this->description);

		$copyObj->setGameStyleId($this->game_style_id);

		$copyObj->setGameTypeId($this->game_type_id);

		$copyObj->setRankingTag($this->ranking_tag);

		$copyObj->setScoreFormulaOption($this->score_formula_option);

		$copyObj->setScoreFormula($this->score_formula);

		$copyObj->setFileNameLogo($this->file_name_logo);

		$copyObj->setBuyin($this->buyin);

		$copyObj->setEntranceFee($this->entrance_fee);

		$copyObj->setGuaranteedPrize($this->guaranteed_prize);

		$copyObj->setStartTime($this->start_time);

		$copyObj->setIsFreeroll($this->is_freeroll);

		$copyObj->setIsMultiday($this->is_multiday);

		$copyObj->setBlindTime($this->blind_time);

		$copyObj->setStackChips($this->stack_chips);

		$copyObj->setAllowedRebuys($this->allowed_rebuys);

		$copyObj->setAllowedAddons($this->allowed_addons);

		$copyObj->setTablesNumber($this->tables_number);

		$copyObj->setIsIlimitedRebuys($this->is_ilimited_rebuys);

		$copyObj->setPublishPrize($this->publish_prize);

		$copyObj->setPrizeSplit($this->prize_split);

		$copyObj->setRakePercent($this->rake_percent);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setLocked($this->locked);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setBuyinSatellite($this->buyin_satellite);

		$copyObj->setEntranceFeeSatellite($this->entrance_fee_satellite);

		$copyObj->setGuaranteedPrizeSatellite($this->guaranteed_prize_satellite);

		$copyObj->setStartTimeSatellite($this->start_time_satellite);

		$copyObj->setIsFreerollSatellite($this->is_freeroll_satellite);

		$copyObj->setBlindTimeSatellite($this->blind_time_satellite);

		$copyObj->setStackChipsSatellite($this->stack_chips_satellite);

		$copyObj->setAllowedRebuysSatellite($this->allowed_rebuys_satellite);

		$copyObj->setAllowedAddonsSatellite($this->allowed_addons_satellite);

		$copyObj->setTablesNumberSatellite($this->tables_number_satellite);

		$copyObj->setIsIlimitedRebuysSatellite($this->is_ilimited_rebuys_satellite);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEventLiveList() as $relObj) {
				$copyObj->addEventLive($relObj->copy($deepCopy));
			}

			foreach($this->getClubRankingLiveList() as $relObj) {
				$copyObj->addClubRankingLive($relObj->copy($deepCopy));
			}

			foreach($this->getRankingLivePlayerList() as $relObj) {
				$copyObj->addRankingLivePlayer($relObj->copy($deepCopy));
			}

			foreach($this->getRankingLiveHistoryList() as $relObj) {
				$copyObj->addRankingLiveHistory($relObj->copy($deepCopy));
			}

			foreach($this->getRankingLiveTemplateList() as $relObj) {
				$copyObj->addRankingLiveTemplate($relObj->copy($deepCopy));
			}

			foreach($this->getEventLiveViewList() as $relObj) {
				$copyObj->addEventLiveView($relObj->copy($deepCopy));
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

	
	public function setVirtualTableRelatedByGameTypeId($v)
	{


		if ($v === null) {
			$this->setGameTypeId(NULL);
		} else {
			$this->setGameTypeId($v->getId());
		}


		$this->aVirtualTableRelatedByGameTypeId = $v;
	}


	
	public function getVirtualTableRelatedByGameTypeId($con = null)
	{
		if ($this->aVirtualTableRelatedByGameTypeId === null && ($this->game_type_id !== null)) {
						include_once 'lib/model/om/BaseVirtualTablePeer.php';

			$this->aVirtualTableRelatedByGameTypeId = VirtualTablePeer::retrieveByPK($this->game_type_id, $con);

			
		}
		return $this->aVirtualTableRelatedByGameTypeId;
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


	
	public function getEventLiveListJoinEmailTemplate($criteria = null, $con = null)
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

				$this->collEventLiveList = EventLivePeer::doSelectJoinEmailTemplate($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePeer::RANKING_LIVE_ID, $this->getId());

			if (!isset($this->lastEventLiveCriteria) || !$this->lastEventLiveCriteria->equals($criteria)) {
				$this->collEventLiveList = EventLivePeer::doSelectJoinEmailTemplate($criteria, $con);
			}
		}
		$this->lastEventLiveCriteria = $criteria;

		return $this->collEventLiveList;
	}

	
	public function initClubRankingLiveList()
	{
		if ($this->collClubRankingLiveList === null) {
			$this->collClubRankingLiveList = array();
		}
	}

	
	public function getClubRankingLiveList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClubRankingLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubRankingLiveList === null) {
			if ($this->isNew()) {
			   $this->collClubRankingLiveList = array();
			} else {

				$criteria->add(ClubRankingLivePeer::RANKING_LIVE_ID, $this->getId());

				ClubRankingLivePeer::addSelectColumns($criteria);
				$this->collClubRankingLiveList = ClubRankingLivePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClubRankingLivePeer::RANKING_LIVE_ID, $this->getId());

				ClubRankingLivePeer::addSelectColumns($criteria);
				if (!isset($this->lastClubRankingLiveCriteria) || !$this->lastClubRankingLiveCriteria->equals($criteria)) {
					$this->collClubRankingLiveList = ClubRankingLivePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClubRankingLiveCriteria = $criteria;
		return $this->collClubRankingLiveList;
	}

	
	public function countClubRankingLiveList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseClubRankingLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ClubRankingLivePeer::RANKING_LIVE_ID, $this->getId());

		return ClubRankingLivePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addClubRankingLive(ClubRankingLive $l)
	{
		$this->collClubRankingLiveList[] = $l;
		$l->setRankingLive($this);
	}


	
	public function getClubRankingLiveListJoinClub($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClubRankingLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubRankingLiveList === null) {
			if ($this->isNew()) {
				$this->collClubRankingLiveList = array();
			} else {

				$criteria->add(ClubRankingLivePeer::RANKING_LIVE_ID, $this->getId());

				$this->collClubRankingLiveList = ClubRankingLivePeer::doSelectJoinClub($criteria, $con);
			}
		} else {
									
			$criteria->add(ClubRankingLivePeer::RANKING_LIVE_ID, $this->getId());

			if (!isset($this->lastClubRankingLiveCriteria) || !$this->lastClubRankingLiveCriteria->equals($criteria)) {
				$this->collClubRankingLiveList = ClubRankingLivePeer::doSelectJoinClub($criteria, $con);
			}
		}
		$this->lastClubRankingLiveCriteria = $criteria;

		return $this->collClubRankingLiveList;
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

				$criteria->add(RankingLivePlayerPeer::RANKING_LIVE_ID, $this->getId());

				RankingLivePlayerPeer::addSelectColumns($criteria);
				$this->collRankingLivePlayerList = RankingLivePlayerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingLivePlayerPeer::RANKING_LIVE_ID, $this->getId());

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

		$criteria->add(RankingLivePlayerPeer::RANKING_LIVE_ID, $this->getId());

		return RankingLivePlayerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingLivePlayer(RankingLivePlayer $l)
	{
		$this->collRankingLivePlayerList[] = $l;
		$l->setRankingLive($this);
	}


	
	public function getRankingLivePlayerListJoinPeople($criteria = null, $con = null)
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

				$criteria->add(RankingLivePlayerPeer::RANKING_LIVE_ID, $this->getId());

				$this->collRankingLivePlayerList = RankingLivePlayerPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(RankingLivePlayerPeer::RANKING_LIVE_ID, $this->getId());

			if (!isset($this->lastRankingLivePlayerCriteria) || !$this->lastRankingLivePlayerCriteria->equals($criteria)) {
				$this->collRankingLivePlayerList = RankingLivePlayerPeer::doSelectJoinPeople($criteria, $con);
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

				$criteria->add(RankingLiveHistoryPeer::RANKING_LIVE_ID, $this->getId());

				RankingLiveHistoryPeer::addSelectColumns($criteria);
				$this->collRankingLiveHistoryList = RankingLiveHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingLiveHistoryPeer::RANKING_LIVE_ID, $this->getId());

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

		$criteria->add(RankingLiveHistoryPeer::RANKING_LIVE_ID, $this->getId());

		return RankingLiveHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingLiveHistory(RankingLiveHistory $l)
	{
		$this->collRankingLiveHistoryList[] = $l;
		$l->setRankingLive($this);
	}


	
	public function getRankingLiveHistoryListJoinPeople($criteria = null, $con = null)
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

				$criteria->add(RankingLiveHistoryPeer::RANKING_LIVE_ID, $this->getId());

				$this->collRankingLiveHistoryList = RankingLiveHistoryPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(RankingLiveHistoryPeer::RANKING_LIVE_ID, $this->getId());

			if (!isset($this->lastRankingLiveHistoryCriteria) || !$this->lastRankingLiveHistoryCriteria->equals($criteria)) {
				$this->collRankingLiveHistoryList = RankingLiveHistoryPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastRankingLiveHistoryCriteria = $criteria;

		return $this->collRankingLiveHistoryList;
	}

	
	public function initRankingLiveTemplateList()
	{
		if ($this->collRankingLiveTemplateList === null) {
			$this->collRankingLiveTemplateList = array();
		}
	}

	
	public function getRankingLiveTemplateList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseRankingLiveTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingLiveTemplateList === null) {
			if ($this->isNew()) {
			   $this->collRankingLiveTemplateList = array();
			} else {

				$criteria->add(RankingLiveTemplatePeer::RANKING_LIVE_ID, $this->getId());

				RankingLiveTemplatePeer::addSelectColumns($criteria);
				$this->collRankingLiveTemplateList = RankingLiveTemplatePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingLiveTemplatePeer::RANKING_LIVE_ID, $this->getId());

				RankingLiveTemplatePeer::addSelectColumns($criteria);
				if (!isset($this->lastRankingLiveTemplateCriteria) || !$this->lastRankingLiveTemplateCriteria->equals($criteria)) {
					$this->collRankingLiveTemplateList = RankingLiveTemplatePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRankingLiveTemplateCriteria = $criteria;
		return $this->collRankingLiveTemplateList;
	}

	
	public function countRankingLiveTemplateList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseRankingLiveTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RankingLiveTemplatePeer::RANKING_LIVE_ID, $this->getId());

		return RankingLiveTemplatePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingLiveTemplate(RankingLiveTemplate $l)
	{
		$this->collRankingLiveTemplateList[] = $l;
		$l->setRankingLive($this);
	}

	
	public function initEventLiveViewList()
	{
		if ($this->collEventLiveViewList === null) {
			$this->collEventLiveViewList = array();
		}
	}

	
	public function getEventLiveViewList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLiveViewPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLiveViewList === null) {
			if ($this->isNew()) {
			   $this->collEventLiveViewList = array();
			} else {

				$criteria->add(EventLiveViewPeer::RANKING_LIVE_ID, $this->getId());

				EventLiveViewPeer::addSelectColumns($criteria);
				$this->collEventLiveViewList = EventLiveViewPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventLiveViewPeer::RANKING_LIVE_ID, $this->getId());

				EventLiveViewPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventLiveViewCriteria) || !$this->lastEventLiveViewCriteria->equals($criteria)) {
					$this->collEventLiveViewList = EventLiveViewPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventLiveViewCriteria = $criteria;
		return $this->collEventLiveViewList;
	}

	
	public function countEventLiveViewList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventLiveViewPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventLiveViewPeer::RANKING_LIVE_ID, $this->getId());

		return EventLiveViewPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventLiveView(EventLiveView $l)
	{
		$this->collEventLiveViewList[] = $l;
		$l->setRankingLive($this);
	}


	
	public function getEventLiveViewListJoinClub($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLiveViewPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLiveViewList === null) {
			if ($this->isNew()) {
				$this->collEventLiveViewList = array();
			} else {

				$criteria->add(EventLiveViewPeer::RANKING_LIVE_ID, $this->getId());

				$this->collEventLiveViewList = EventLiveViewPeer::doSelectJoinClub($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLiveViewPeer::RANKING_LIVE_ID, $this->getId());

			if (!isset($this->lastEventLiveViewCriteria) || !$this->lastEventLiveViewCriteria->equals($criteria)) {
				$this->collEventLiveViewList = EventLiveViewPeer::doSelectJoinClub($criteria, $con);
			}
		}
		$this->lastEventLiveViewCriteria = $criteria;

		return $this->collEventLiveViewList;
	}

} 