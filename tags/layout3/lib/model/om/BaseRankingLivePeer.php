<?php


abstract class BaseRankingLivePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ranking_live';

	
	const CLASS_DEFAULT = 'lib.model.RankingLive';

	
	const NUM_COLUMNS = 49;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'ranking_live.ID';

	
	const RANKING_NAME = 'ranking_live.RANKING_NAME';

	
	const RANKING_TYPE_ID = 'ranking_live.RANKING_TYPE_ID';

	
	const EMAIL_TEMPLATE_ID = 'ranking_live.EMAIL_TEMPLATE_ID';

	
	const START_DATE = 'ranking_live.START_DATE';

	
	const FINISH_DATE = 'ranking_live.FINISH_DATE';

	
	const IS_PRIVATE = 'ranking_live.IS_PRIVATE';

	
	const NO_RANKING = 'ranking_live.NO_RANKING';

	
	const PLAYERS = 'ranking_live.PLAYERS';

	
	const EVENTS = 'ranking_live.EVENTS';

	
	const DESCRIPTION = 'ranking_live.DESCRIPTION';

	
	const GAME_STYLE_ID = 'ranking_live.GAME_STYLE_ID';

	
	const GAME_TYPE_ID = 'ranking_live.GAME_TYPE_ID';

	
	const RANKING_TAG = 'ranking_live.RANKING_TAG';

	
	const SCORE_FORMULA_OPTION = 'ranking_live.SCORE_FORMULA_OPTION';

	
	const SCORE_FORMULA = 'ranking_live.SCORE_FORMULA';

	
	const FILE_NAME_LOGO = 'ranking_live.FILE_NAME_LOGO';

	
	const BUYIN = 'ranking_live.BUYIN';

	
	const ENTRANCE_FEE = 'ranking_live.ENTRANCE_FEE';

	
	const GUARANTEED_PRIZE = 'ranking_live.GUARANTEED_PRIZE';

	
	const START_TIME = 'ranking_live.START_TIME';

	
	const IS_FREEROLL = 'ranking_live.IS_FREEROLL';

	
	const IS_MULTIDAY = 'ranking_live.IS_MULTIDAY';

	
	const BLIND_TIME = 'ranking_live.BLIND_TIME';

	
	const STACK_CHIPS = 'ranking_live.STACK_CHIPS';

	
	const ALLOWED_REBUYS = 'ranking_live.ALLOWED_REBUYS';

	
	const ALLOWED_ADDONS = 'ranking_live.ALLOWED_ADDONS';

	
	const TABLES_NUMBER = 'ranking_live.TABLES_NUMBER';

	
	const IS_ILIMITED_REBUYS = 'ranking_live.IS_ILIMITED_REBUYS';

	
	const PUBLISH_PRIZE = 'ranking_live.PUBLISH_PRIZE';

	
	const PRIZE_SPLIT = 'ranking_live.PRIZE_SPLIT';

	
	const RAKE_PERCENT = 'ranking_live.RAKE_PERCENT';

	
	const ENABLED = 'ranking_live.ENABLED';

	
	const VISIBLE = 'ranking_live.VISIBLE';

	
	const LOCKED = 'ranking_live.LOCKED';

	
	const DELETED = 'ranking_live.DELETED';

	
	const BUYIN_SATELLITE = 'ranking_live.BUYIN_SATELLITE';

	
	const ENTRANCE_FEE_SATELLITE = 'ranking_live.ENTRANCE_FEE_SATELLITE';

	
	const GUARANTEED_PRIZE_SATELLITE = 'ranking_live.GUARANTEED_PRIZE_SATELLITE';

	
	const START_TIME_SATELLITE = 'ranking_live.START_TIME_SATELLITE';

	
	const IS_FREEROLL_SATELLITE = 'ranking_live.IS_FREEROLL_SATELLITE';

	
	const BLIND_TIME_SATELLITE = 'ranking_live.BLIND_TIME_SATELLITE';

	
	const STACK_CHIPS_SATELLITE = 'ranking_live.STACK_CHIPS_SATELLITE';

	
	const ALLOWED_REBUYS_SATELLITE = 'ranking_live.ALLOWED_REBUYS_SATELLITE';

	
	const ALLOWED_ADDONS_SATELLITE = 'ranking_live.ALLOWED_ADDONS_SATELLITE';

	
	const TABLES_NUMBER_SATELLITE = 'ranking_live.TABLES_NUMBER_SATELLITE';

	
	const IS_ILIMITED_REBUYS_SATELLITE = 'ranking_live.IS_ILIMITED_REBUYS_SATELLITE';

	
	const CREATED_AT = 'ranking_live.CREATED_AT';

	
	const UPDATED_AT = 'ranking_live.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'RankingName', 'RankingTypeId', 'EmailTemplateId', 'StartDate', 'FinishDate', 'IsPrivate', 'NoRanking', 'Players', 'Events', 'Description', 'GameStyleId', 'GameTypeId', 'RankingTag', 'ScoreFormulaOption', 'ScoreFormula', 'FileNameLogo', 'Buyin', 'EntranceFee', 'GuaranteedPrize', 'StartTime', 'IsFreeroll', 'IsMultiday', 'BlindTime', 'StackChips', 'AllowedRebuys', 'AllowedAddons', 'TablesNumber', 'IsIlimitedRebuys', 'PublishPrize', 'PrizeSplit', 'RakePercent', 'Enabled', 'Visible', 'Locked', 'Deleted', 'BuyinSatellite', 'EntranceFeeSatellite', 'GuaranteedPrizeSatellite', 'StartTimeSatellite', 'IsFreerollSatellite', 'BlindTimeSatellite', 'StackChipsSatellite', 'AllowedRebuysSatellite', 'AllowedAddonsSatellite', 'TablesNumberSatellite', 'IsIlimitedRebuysSatellite', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (RankingLivePeer::ID, RankingLivePeer::RANKING_NAME, RankingLivePeer::RANKING_TYPE_ID, RankingLivePeer::EMAIL_TEMPLATE_ID, RankingLivePeer::START_DATE, RankingLivePeer::FINISH_DATE, RankingLivePeer::IS_PRIVATE, RankingLivePeer::NO_RANKING, RankingLivePeer::PLAYERS, RankingLivePeer::EVENTS, RankingLivePeer::DESCRIPTION, RankingLivePeer::GAME_STYLE_ID, RankingLivePeer::GAME_TYPE_ID, RankingLivePeer::RANKING_TAG, RankingLivePeer::SCORE_FORMULA_OPTION, RankingLivePeer::SCORE_FORMULA, RankingLivePeer::FILE_NAME_LOGO, RankingLivePeer::BUYIN, RankingLivePeer::ENTRANCE_FEE, RankingLivePeer::GUARANTEED_PRIZE, RankingLivePeer::START_TIME, RankingLivePeer::IS_FREEROLL, RankingLivePeer::IS_MULTIDAY, RankingLivePeer::BLIND_TIME, RankingLivePeer::STACK_CHIPS, RankingLivePeer::ALLOWED_REBUYS, RankingLivePeer::ALLOWED_ADDONS, RankingLivePeer::TABLES_NUMBER, RankingLivePeer::IS_ILIMITED_REBUYS, RankingLivePeer::PUBLISH_PRIZE, RankingLivePeer::PRIZE_SPLIT, RankingLivePeer::RAKE_PERCENT, RankingLivePeer::ENABLED, RankingLivePeer::VISIBLE, RankingLivePeer::LOCKED, RankingLivePeer::DELETED, RankingLivePeer::BUYIN_SATELLITE, RankingLivePeer::ENTRANCE_FEE_SATELLITE, RankingLivePeer::GUARANTEED_PRIZE_SATELLITE, RankingLivePeer::START_TIME_SATELLITE, RankingLivePeer::IS_FREEROLL_SATELLITE, RankingLivePeer::BLIND_TIME_SATELLITE, RankingLivePeer::STACK_CHIPS_SATELLITE, RankingLivePeer::ALLOWED_REBUYS_SATELLITE, RankingLivePeer::ALLOWED_ADDONS_SATELLITE, RankingLivePeer::TABLES_NUMBER_SATELLITE, RankingLivePeer::IS_ILIMITED_REBUYS_SATELLITE, RankingLivePeer::CREATED_AT, RankingLivePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'ranking_name', 'ranking_type_id', 'email_template_id', 'start_date', 'finish_date', 'is_private', 'no_ranking', 'players', 'events', 'description', 'game_style_id', 'game_type_id', 'ranking_tag', 'score_formula_option', 'score_formula', 'file_name_logo', 'buyin', 'entrance_fee', 'guaranteed_prize', 'start_time', 'is_freeroll', 'is_multiday', 'blind_time', 'stack_chips', 'allowed_rebuys', 'allowed_addons', 'tables_number', 'is_ilimited_rebuys', 'publish_prize', 'prize_split', 'rake_percent', 'enabled', 'visible', 'locked', 'deleted', 'buyin_satellite', 'entrance_fee_satellite', 'guaranteed_prize_satellite', 'start_time_satellite', 'is_freeroll_satellite', 'blind_time_satellite', 'stack_chips_satellite', 'allowed_rebuys_satellite', 'allowed_addons_satellite', 'tables_number_satellite', 'is_ilimited_rebuys_satellite', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'RANKING_NAME'=>'', 'RANKING_TYPE_ID'=>'', 'EMAIL_TEMPLATE_ID'=>'', 'START_DATE'=>'', 'FINISH_DATE'=>'', 'IS_PRIVATE'=>'', 'NO_RANKING'=>'', 'PLAYERS'=>'', 'EVENTS'=>'', 'DESCRIPTION'=>'', 'GAME_STYLE_ID'=>'', 'GAME_TYPE_ID'=>'', 'RANKING_TAG'=>'', 'SCORE_FORMULA_OPTION'=>'', 'SCORE_FORMULA'=>'', 'FILE_NAME_LOGO'=>'', 'BUYIN'=>'', 'ENTRANCE_FEE'=>'', 'GUARANTEED_PRIZE'=>'', 'START_TIME'=>'', 'IS_FREEROLL'=>'', 'IS_MULTIDAY'=>'', 'BLIND_TIME'=>'', 'STACK_CHIPS'=>'', 'ALLOWED_REBUYS'=>'', 'ALLOWED_ADDONS'=>'', 'TABLES_NUMBER'=>'', 'IS_ILIMITED_REBUYS'=>'', 'PUBLISH_PRIZE'=>'', 'PRIZE_SPLIT'=>'', 'RAKE_PERCENT'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'LOCKED'=>'', 'DELETED'=>'', 'BUYIN_SATELLITE'=>'', 'ENTRANCE_FEE_SATELLITE'=>'', 'GUARANTEED_PRIZE_SATELLITE'=>'', 'START_TIME_SATELLITE'=>'', 'IS_FREEROLL_SATELLITE'=>'', 'BLIND_TIME_SATELLITE'=>'', 'STACK_CHIPS_SATELLITE'=>'', 'ALLOWED_REBUYS_SATELLITE'=>'', 'ALLOWED_ADDONS_SATELLITE'=>'', 'TABLES_NUMBER_SATELLITE'=>'', 'IS_ILIMITED_REBUYS_SATELLITE'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'RankingName'=>1, 'RankingTypeId'=>2, 'EmailTemplateId'=>3, 'StartDate'=>4, 'FinishDate'=>5, 'IsPrivate'=>6, 'NoRanking'=>7, 'Players'=>8, 'Events'=>9, 'Description'=>10, 'GameStyleId'=>11, 'GameTypeId'=>12, 'RankingTag'=>13, 'ScoreFormulaOption'=>14, 'ScoreFormula'=>15, 'FileNameLogo'=>16, 'Buyin'=>17, 'EntranceFee'=>18, 'GuaranteedPrize'=>19, 'StartTime'=>20, 'IsFreeroll'=>21, 'IsMultiday'=>22, 'BlindTime'=>23, 'StackChips'=>24, 'AllowedRebuys'=>25, 'AllowedAddons'=>26, 'TablesNumber'=>27, 'IsIlimitedRebuys'=>28, 'PublishPrize'=>29, 'PrizeSplit'=>30, 'RakePercent'=>31, 'Enabled'=>32, 'Visible'=>33, 'Locked'=>34, 'Deleted'=>35, 'BuyinSatellite'=>36, 'EntranceFeeSatellite'=>37, 'GuaranteedPrizeSatellite'=>38, 'StartTimeSatellite'=>39, 'IsFreerollSatellite'=>40, 'BlindTimeSatellite'=>41, 'StackChipsSatellite'=>42, 'AllowedRebuysSatellite'=>43, 'AllowedAddonsSatellite'=>44, 'TablesNumberSatellite'=>45, 'IsIlimitedRebuysSatellite'=>46, 'CreatedAt'=>47, 'UpdatedAt'=>48, ),
		BasePeer::TYPE_COLNAME=>array (RankingLivePeer::ID=>0, RankingLivePeer::RANKING_NAME=>1, RankingLivePeer::RANKING_TYPE_ID=>2, RankingLivePeer::EMAIL_TEMPLATE_ID=>3, RankingLivePeer::START_DATE=>4, RankingLivePeer::FINISH_DATE=>5, RankingLivePeer::IS_PRIVATE=>6, RankingLivePeer::NO_RANKING=>7, RankingLivePeer::PLAYERS=>8, RankingLivePeer::EVENTS=>9, RankingLivePeer::DESCRIPTION=>10, RankingLivePeer::GAME_STYLE_ID=>11, RankingLivePeer::GAME_TYPE_ID=>12, RankingLivePeer::RANKING_TAG=>13, RankingLivePeer::SCORE_FORMULA_OPTION=>14, RankingLivePeer::SCORE_FORMULA=>15, RankingLivePeer::FILE_NAME_LOGO=>16, RankingLivePeer::BUYIN=>17, RankingLivePeer::ENTRANCE_FEE=>18, RankingLivePeer::GUARANTEED_PRIZE=>19, RankingLivePeer::START_TIME=>20, RankingLivePeer::IS_FREEROLL=>21, RankingLivePeer::IS_MULTIDAY=>22, RankingLivePeer::BLIND_TIME=>23, RankingLivePeer::STACK_CHIPS=>24, RankingLivePeer::ALLOWED_REBUYS=>25, RankingLivePeer::ALLOWED_ADDONS=>26, RankingLivePeer::TABLES_NUMBER=>27, RankingLivePeer::IS_ILIMITED_REBUYS=>28, RankingLivePeer::PUBLISH_PRIZE=>29, RankingLivePeer::PRIZE_SPLIT=>30, RankingLivePeer::RAKE_PERCENT=>31, RankingLivePeer::ENABLED=>32, RankingLivePeer::VISIBLE=>33, RankingLivePeer::LOCKED=>34, RankingLivePeer::DELETED=>35, RankingLivePeer::BUYIN_SATELLITE=>36, RankingLivePeer::ENTRANCE_FEE_SATELLITE=>37, RankingLivePeer::GUARANTEED_PRIZE_SATELLITE=>38, RankingLivePeer::START_TIME_SATELLITE=>39, RankingLivePeer::IS_FREEROLL_SATELLITE=>40, RankingLivePeer::BLIND_TIME_SATELLITE=>41, RankingLivePeer::STACK_CHIPS_SATELLITE=>42, RankingLivePeer::ALLOWED_REBUYS_SATELLITE=>43, RankingLivePeer::ALLOWED_ADDONS_SATELLITE=>44, RankingLivePeer::TABLES_NUMBER_SATELLITE=>45, RankingLivePeer::IS_ILIMITED_REBUYS_SATELLITE=>46, RankingLivePeer::CREATED_AT=>47, RankingLivePeer::UPDATED_AT=>48, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'ranking_name'=>1, 'ranking_type_id'=>2, 'email_template_id'=>3, 'start_date'=>4, 'finish_date'=>5, 'is_private'=>6, 'no_ranking'=>7, 'players'=>8, 'events'=>9, 'description'=>10, 'game_style_id'=>11, 'game_type_id'=>12, 'ranking_tag'=>13, 'score_formula_option'=>14, 'score_formula'=>15, 'file_name_logo'=>16, 'buyin'=>17, 'entrance_fee'=>18, 'guaranteed_prize'=>19, 'start_time'=>20, 'is_freeroll'=>21, 'is_multiday'=>22, 'blind_time'=>23, 'stack_chips'=>24, 'allowed_rebuys'=>25, 'allowed_addons'=>26, 'tables_number'=>27, 'is_ilimited_rebuys'=>28, 'publish_prize'=>29, 'prize_split'=>30, 'rake_percent'=>31, 'enabled'=>32, 'visible'=>33, 'locked'=>34, 'deleted'=>35, 'buyin_satellite'=>36, 'entrance_fee_satellite'=>37, 'guaranteed_prize_satellite'=>38, 'start_time_satellite'=>39, 'is_freeroll_satellite'=>40, 'blind_time_satellite'=>41, 'stack_chips_satellite'=>42, 'allowed_rebuys_satellite'=>43, 'allowed_addons_satellite'=>44, 'tables_number_satellite'=>45, 'is_ilimited_rebuys_satellite'=>46, 'created_at'=>47, 'updated_at'=>48, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/RankingLiveMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.RankingLiveMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RankingLivePeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(RankingLivePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RankingLivePeer::ID);

		$criteria->addSelectColumn(RankingLivePeer::RANKING_NAME);

		$criteria->addSelectColumn(RankingLivePeer::RANKING_TYPE_ID);

		$criteria->addSelectColumn(RankingLivePeer::EMAIL_TEMPLATE_ID);

		$criteria->addSelectColumn(RankingLivePeer::START_DATE);

		$criteria->addSelectColumn(RankingLivePeer::FINISH_DATE);

		$criteria->addSelectColumn(RankingLivePeer::IS_PRIVATE);

		$criteria->addSelectColumn(RankingLivePeer::NO_RANKING);

		$criteria->addSelectColumn(RankingLivePeer::PLAYERS);

		$criteria->addSelectColumn(RankingLivePeer::EVENTS);

		$criteria->addSelectColumn(RankingLivePeer::DESCRIPTION);

		$criteria->addSelectColumn(RankingLivePeer::GAME_STYLE_ID);

		$criteria->addSelectColumn(RankingLivePeer::GAME_TYPE_ID);

		$criteria->addSelectColumn(RankingLivePeer::RANKING_TAG);

		$criteria->addSelectColumn(RankingLivePeer::SCORE_FORMULA_OPTION);

		$criteria->addSelectColumn(RankingLivePeer::SCORE_FORMULA);

		$criteria->addSelectColumn(RankingLivePeer::FILE_NAME_LOGO);

		$criteria->addSelectColumn(RankingLivePeer::BUYIN);

		$criteria->addSelectColumn(RankingLivePeer::ENTRANCE_FEE);

		$criteria->addSelectColumn(RankingLivePeer::GUARANTEED_PRIZE);

		$criteria->addSelectColumn(RankingLivePeer::START_TIME);

		$criteria->addSelectColumn(RankingLivePeer::IS_FREEROLL);

		$criteria->addSelectColumn(RankingLivePeer::IS_MULTIDAY);

		$criteria->addSelectColumn(RankingLivePeer::BLIND_TIME);

		$criteria->addSelectColumn(RankingLivePeer::STACK_CHIPS);

		$criteria->addSelectColumn(RankingLivePeer::ALLOWED_REBUYS);

		$criteria->addSelectColumn(RankingLivePeer::ALLOWED_ADDONS);

		$criteria->addSelectColumn(RankingLivePeer::TABLES_NUMBER);

		$criteria->addSelectColumn(RankingLivePeer::IS_ILIMITED_REBUYS);

		$criteria->addSelectColumn(RankingLivePeer::PUBLISH_PRIZE);

		$criteria->addSelectColumn(RankingLivePeer::PRIZE_SPLIT);

		$criteria->addSelectColumn(RankingLivePeer::RAKE_PERCENT);

		$criteria->addSelectColumn(RankingLivePeer::ENABLED);

		$criteria->addSelectColumn(RankingLivePeer::VISIBLE);

		$criteria->addSelectColumn(RankingLivePeer::LOCKED);

		$criteria->addSelectColumn(RankingLivePeer::DELETED);

		$criteria->addSelectColumn(RankingLivePeer::BUYIN_SATELLITE);

		$criteria->addSelectColumn(RankingLivePeer::ENTRANCE_FEE_SATELLITE);

		$criteria->addSelectColumn(RankingLivePeer::GUARANTEED_PRIZE_SATELLITE);

		$criteria->addSelectColumn(RankingLivePeer::START_TIME_SATELLITE);

		$criteria->addSelectColumn(RankingLivePeer::IS_FREEROLL_SATELLITE);

		$criteria->addSelectColumn(RankingLivePeer::BLIND_TIME_SATELLITE);

		$criteria->addSelectColumn(RankingLivePeer::STACK_CHIPS_SATELLITE);

		$criteria->addSelectColumn(RankingLivePeer::ALLOWED_REBUYS_SATELLITE);

		$criteria->addSelectColumn(RankingLivePeer::ALLOWED_ADDONS_SATELLITE);

		$criteria->addSelectColumn(RankingLivePeer::TABLES_NUMBER_SATELLITE);

		$criteria->addSelectColumn(RankingLivePeer::IS_ILIMITED_REBUYS_SATELLITE);

		$criteria->addSelectColumn(RankingLivePeer::CREATED_AT);

		$criteria->addSelectColumn(RankingLivePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(ranking_live.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT ranking_live.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RankingLivePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = RankingLivePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RankingLivePeer::populateObjects(RankingLivePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RankingLivePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RankingLivePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinVirtualTableRelatedByRankingTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLivePeer::RANKING_TYPE_ID, VirtualTablePeer::ID);

		$rs = RankingLivePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinVirtualTableRelatedByGameStyleId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLivePeer::GAME_STYLE_ID, VirtualTablePeer::ID);

		$rs = RankingLivePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinVirtualTableRelatedByGameTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLivePeer::GAME_TYPE_ID, VirtualTablePeer::ID);

		$rs = RankingLivePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinEmailTemplate(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);

		$rs = RankingLivePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinVirtualTableRelatedByRankingTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingLivePeer::addSelectColumns($c);
		$startcol = (RankingLivePeer::NUM_COLUMNS - RankingLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VirtualTablePeer::addSelectColumns($c);

		$c->addJoin(RankingLivePeer::RANKING_TYPE_ID, VirtualTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VirtualTablePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getVirtualTableRelatedByRankingTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRankingLiveRelatedByRankingTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingLiveListRelatedByRankingTypeId();
				$obj2->addRankingLiveRelatedByRankingTypeId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinVirtualTableRelatedByGameStyleId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingLivePeer::addSelectColumns($c);
		$startcol = (RankingLivePeer::NUM_COLUMNS - RankingLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VirtualTablePeer::addSelectColumns($c);

		$c->addJoin(RankingLivePeer::GAME_STYLE_ID, VirtualTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VirtualTablePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getVirtualTableRelatedByGameStyleId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRankingLiveRelatedByGameStyleId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingLiveListRelatedByGameStyleId();
				$obj2->addRankingLiveRelatedByGameStyleId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinVirtualTableRelatedByGameTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingLivePeer::addSelectColumns($c);
		$startcol = (RankingLivePeer::NUM_COLUMNS - RankingLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VirtualTablePeer::addSelectColumns($c);

		$c->addJoin(RankingLivePeer::GAME_TYPE_ID, VirtualTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VirtualTablePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getVirtualTableRelatedByGameTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRankingLiveRelatedByGameTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingLiveListRelatedByGameTypeId();
				$obj2->addRankingLiveRelatedByGameTypeId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinEmailTemplate(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingLivePeer::addSelectColumns($c);
		$startcol = (RankingLivePeer::NUM_COLUMNS - RankingLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EmailTemplatePeer::addSelectColumns($c);

		$c->addJoin(RankingLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EmailTemplatePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEmailTemplate(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRankingLive($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingLiveList();
				$obj2->addRankingLive($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLivePeer::RANKING_TYPE_ID, VirtualTablePeer::ID);

		$criteria->addJoin(RankingLivePeer::GAME_STYLE_ID, VirtualTablePeer::ID);

		$criteria->addJoin(RankingLivePeer::GAME_TYPE_ID, VirtualTablePeer::ID);

		$criteria->addJoin(RankingLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);

		$rs = RankingLivePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingLivePeer::addSelectColumns($c);
		$startcol2 = (RankingLivePeer::NUM_COLUMNS - RankingLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VirtualTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VirtualTablePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VirtualTablePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VirtualTablePeer::NUM_COLUMNS;

		EmailTemplatePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + EmailTemplatePeer::NUM_COLUMNS;

		$c->addJoin(RankingLivePeer::RANKING_TYPE_ID, VirtualTablePeer::ID);

		$c->addJoin(RankingLivePeer::GAME_STYLE_ID, VirtualTablePeer::ID);

		$c->addJoin(RankingLivePeer::GAME_TYPE_ID, VirtualTablePeer::ID);

		$c->addJoin(RankingLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLivePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getVirtualTableRelatedByRankingTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRankingLiveRelatedByRankingTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingLiveListRelatedByRankingTypeId();
				$obj2->addRankingLiveRelatedByRankingTypeId($obj1);
			}


					
			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVirtualTableRelatedByGameStyleId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRankingLiveRelatedByGameStyleId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRankingLiveListRelatedByGameStyleId();
				$obj3->addRankingLiveRelatedByGameStyleId($obj1);
			}


					
			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVirtualTableRelatedByGameTypeId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addRankingLiveRelatedByGameTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initRankingLiveListRelatedByGameTypeId();
				$obj4->addRankingLiveRelatedByGameTypeId($obj1);
			}


					
			$omClass = EmailTemplatePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getEmailTemplate(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addRankingLive($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initRankingLiveList();
				$obj5->addRankingLive($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptVirtualTableRelatedByRankingTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);

		$rs = RankingLivePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptVirtualTableRelatedByGameStyleId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);

		$rs = RankingLivePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptVirtualTableRelatedByGameTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);

		$rs = RankingLivePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptEmailTemplate(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLivePeer::RANKING_TYPE_ID, VirtualTablePeer::ID);

		$criteria->addJoin(RankingLivePeer::GAME_STYLE_ID, VirtualTablePeer::ID);

		$criteria->addJoin(RankingLivePeer::GAME_TYPE_ID, VirtualTablePeer::ID);

		$rs = RankingLivePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptVirtualTableRelatedByRankingTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingLivePeer::addSelectColumns($c);
		$startcol2 = (RankingLivePeer::NUM_COLUMNS - RankingLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EmailTemplatePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EmailTemplatePeer::NUM_COLUMNS;

		$c->addJoin(RankingLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EmailTemplatePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEmailTemplate(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRankingLive($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingLiveList();
				$obj2->addRankingLive($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptVirtualTableRelatedByGameStyleId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingLivePeer::addSelectColumns($c);
		$startcol2 = (RankingLivePeer::NUM_COLUMNS - RankingLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EmailTemplatePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EmailTemplatePeer::NUM_COLUMNS;

		$c->addJoin(RankingLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EmailTemplatePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEmailTemplate(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRankingLive($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingLiveList();
				$obj2->addRankingLive($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptVirtualTableRelatedByGameTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingLivePeer::addSelectColumns($c);
		$startcol2 = (RankingLivePeer::NUM_COLUMNS - RankingLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EmailTemplatePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EmailTemplatePeer::NUM_COLUMNS;

		$c->addJoin(RankingLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EmailTemplatePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEmailTemplate(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRankingLive($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingLiveList();
				$obj2->addRankingLive($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptEmailTemplate(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingLivePeer::addSelectColumns($c);
		$startcol2 = (RankingLivePeer::NUM_COLUMNS - RankingLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VirtualTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VirtualTablePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VirtualTablePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(RankingLivePeer::RANKING_TYPE_ID, VirtualTablePeer::ID);

		$c->addJoin(RankingLivePeer::GAME_STYLE_ID, VirtualTablePeer::ID);

		$c->addJoin(RankingLivePeer::GAME_TYPE_ID, VirtualTablePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getVirtualTableRelatedByRankingTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRankingLiveRelatedByRankingTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingLiveListRelatedByRankingTypeId();
				$obj2->addRankingLiveRelatedByRankingTypeId($obj1);
			}

			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVirtualTableRelatedByGameStyleId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRankingLiveRelatedByGameStyleId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRankingLiveListRelatedByGameStyleId();
				$obj3->addRankingLiveRelatedByGameStyleId($obj1);
			}

			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVirtualTableRelatedByGameTypeId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addRankingLiveRelatedByGameTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initRankingLiveListRelatedByGameTypeId();
				$obj4->addRankingLiveRelatedByGameTypeId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return RankingLivePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(RankingLivePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(RankingLivePeer::ID);
			$selectCriteria->add(RankingLivePeer::ID, $criteria->remove(RankingLivePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(RankingLivePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(RankingLivePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof RankingLive) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RankingLivePeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(RankingLive $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RankingLivePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RankingLivePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(RankingLivePeer::DATABASE_NAME, RankingLivePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RankingLivePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(RankingLivePeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(RankingLivePeer::ID, $pk);


		$v = RankingLivePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(RankingLivePeer::ID, $pks, Criteria::IN);
			$objs = RankingLivePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseRankingLivePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/RankingLiveMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.RankingLiveMapBuilder');
}
