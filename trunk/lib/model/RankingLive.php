<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking_live'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingLive extends BaseRankingLive
{
	
	const DEFAULT_SCORE_FORMULA = 'JOGADORES-(POSICAO-1)';
	private $reloadEvents = false;
	
	public function getIsNew(){
		
		return ($this->isNew() || (!$this->getVisible() && !$this->getEnabled() && !$this->getDeleted()));
	}
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

//    		$this->postOnWall();
    		
			parent::save();
			
       		Log::quickLog('ranking_live', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('ranking_live', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
	}
	
	public function quickSave($request){
		
		$rankingName             = $request->getParameter('rankingName');
		$rankingTypeId           = $request->getParameter('rankingTypeId');
		$gameTypeId              = $request->getParameter('gameTypeId');
		$gameStyleId             = $request->getParameter('gameStyleId');
		$startDate               = $request->getParameter('startDate');
		$finishDate              = $request->getParameter('finishDate');
		$isPrivate               = $request->getParameter('isPrivate');
		$scoreFormula            = $request->getParameter('scoreFormula');
		$description             = $request->getParameter('description');
		$clubIdList              = $request->getParameter('clubId');
		$startTime               = $request->getParameter('startTime');
		$isFreeroll              = $request->getParameter('isFreeroll');
		$buyin                   = $request->getParameter('buyin');
		$entranceFee             = $request->getParameter('entranceFee');
		$blindTime               = $request->getParameter('blindTime');
		$stackChips              = $request->getParameter('stackChips');
		$allowedRebuys           = $request->getParameter('allowedRebuys');
		$allowedAddons           = $request->getParameter('allowedAddons');
		$isIlimitedRebuys        = $request->getParameter('isIlimitedRebuys');
		$prizeSplit              = $request->getParameter('prizeSplit');
		$rakePercent             = $request->getParameter('rakePercent');
		$publishPrize            = $request->getParameter('publishPrize');
		
		if( preg_match('/^[0-9]*[,\.]?[0-9]*[kK]$/', $stackChips) )
			$stackChips = Util::formatFloat($stackChips)*1000;

		if( $isFreeroll )
			$buyin = 0;

		
		$this->setRankingName($rankingName);
		$this->setRankingTypeId($rankingTypeId);
		$this->setGameTypeId($gameTypeId);
		$this->setGameStyleId($gameStyleId);
		$this->setStartDate(Util::formatDate($startDate));
		$this->setFinishDate(($finishDate?Util::formatDate($finishDate):null));
		$this->setIsPrivate(($isPrivate?true:false));
		$this->setScoreFormula($scoreFormula);
		$this->setDescription($description);
		
		// Informações da aba Valores padrão
		$this->setStartTime(($startTime?$startTime:null));
		$this->setIsFreeroll(($isFreeroll?true:false));
		$this->setBuyin(Util::formatFloat($buyin));
		$this->setEntranceFee(Util::formatFloat($entranceFee));
		$this->setBlindTime(($blindTime?$blindTime:null));
		$this->setStackChips($stackChips);
		$this->setAllowedRebuys($allowedRebuys);
		$this->setAllowedAddons($allowedAddons);
		$this->setIsIlimitedRebuys(($isIlimitedRebuys?true:false));
		$this->setPrizeSplit(($prizeSplit?$prizeSplit:null));
		$this->setRakePercent(Util::formatFloat($rakePercent));
		$this->setPublishPrize(($publishPrize?true:false));
		
		$this->setEnabled(true);
		$this->setVisible(true);
		$this->setDeleted(false);
		$this->save();
		
		$iRankAdmin = MyTools::hasCredential('iRankAdmin');
		
		if( $iRankAdmin )
			$this->saveClub($clubIdList, true);
		else
			$this->saveClub(array($clubIdList), false);
	}
	
	public function saveClub($clubIdList, $delete){
		
		$rankingLiveId = $this->getId();
		
		foreach($clubIdList as $clubId){
			
			$clubRankingLiveObj = ClubRankingLivePeer::retrieveByPK($clubId, $rankingLiveId);
			$clubRankingLiveObj->setEnabled(true);
			$clubRankingLiveObj->save();
		}
		
		if( $delete ){
			
			$clubIdList[] = 0;
			Util::executeQuery('UPDATE club_ranking_live SET enabled=FALSE, updated_at = CURRENT_TIMESTAMP WHERE enabled AND ranking_live_id = '.$rankingLiveId.' AND club_id NOT IN ('.implode(',', $clubIdList).')');
		}
	}
	
	public function saveQuickEvents($request){
		
		for($i=1; $i <= 12; $i++ ){
			
			$eventName = $request->getParameter('eventName'.$i);
			$clubId    = $request->getParameter('clubId'.$i);
			$eventDate = $request->getParameter('eventDate'.$i);
			$startTime = $request->getParameter('startTime'.$i);

			if( !$eventName || !$clubId || !Validate::validateDate($eventDate) || !Validate::validateTime($startTime) )
				continue;
			
			$eventLiveObj = new EventLive();
			$eventLiveObj->setEventName($eventName);
			$eventLiveObj->setEventShortName($eventLiveObj->buildShortName());
			$eventLiveObj->setRankingLiveId($this->getId());
			$eventLiveObj->setClubId($clubId);
			$eventLiveObj->setEventDate(Util::formatDate($eventDate));
			$eventLiveObj->setStartTime($startTime);
			$eventLiveObj->setBuyin($this->getBuyin());
			$eventLiveObj->setEntranceFee($this->getEntranceFee());
			$eventLiveObj->setRakePercent($this->getRakePercent());
			$eventLiveObj->setBlindTime($this->getBlindTime());
			$eventLiveObj->setStackChips($this->getStackChips());
			$eventLiveObj->setAllowedRebuys($this->getAllowedRebuys());
			$eventLiveObj->setAllowedAddons($this->getAllowedAddons());
			$eventLiveObj->setIsIlimitedRebuys($this->getIsIlimitedRebuys());
			$eventLiveObj->setPrizeSplit($this->getPrizeSplit());
			$eventLiveObj->setPublishPrize($this->getPublishPrize());
			$eventLiveObj->setRakePercent($this->getRakePercent());
			$eventLiveObj->setDescription('<descrição do ranking>');
			$eventLiveObj->setEnabled(true);
			$eventLiveObj->setVisible(true);
			$eventLiveObj->setDeleted(false);
			$eventLiveObj->save();
			
			$this->reloadEvents = true;
		}
	}
	
	public static function getList($criteria=null, $clubId=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( RankingLivePeer::ENABLED, true );
		$criteria->add( RankingLivePeer::VISIBLE, true );
		$criteria->add( RankingLivePeer::DELETED, false );
		
		if( !is_null($clubId) ){
			
			$criteria->add( ClubRankingLivePeer::CLUB_ID, $clubId );
			$criteria->add( ClubRankingLivePeer::ENABLED, true );
			$criteria->addJoin( RankingLivePeer::ID, ClubRankingLivePeer::RANKING_LIVE_ID, Criteria::INNER_JOIN );
		}
		
		return RankingLivePeer::doSelect($criteria);
	}

	public static function getOptionsForSelect($clubId, $defaultValue=false, $returnArray=false){
		
		$rankingLiveObjList = self::getList(null, $clubId);

		$optionList = array();
		$optionList[''] = __('select');
		foreach( $rankingLiveObjList as $rankingLiveObj )			
			$optionList[$rankingLiveObj->getId()] = $rankingLiveObj->getRankingName();
			
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
	
	public function cleanRecord(){
		
		$this->setFileNameLogo(null);
	}
	
	public function getFileNameLogo($original=false){
		
		$fileNameLogo = parent::getFileNameLogo();
		
		if( $original ){
			
			$rankingLiveId = $this->getId();
			$fileNameLogo  = preg_replace('/-[0-9]*(\.[^\.]*)$/', '\1', $fileNameLogo);
		}
		
		if( !$fileNameLogo )
			return 'noImage.png';
		
		return $fileNameLogo;
	}
	
	public function getGameStyle(){
		
		return $this->getVirtualTableRelatedByGameStyleId();
	}
	
	public function getGameType(){
		
		return $this->getVirtualTableRelatedByGameTypeId();
	}
	
	public function getRankingType(){
		
		return $this->getVirtualTableRelatedByRankingTypeId();
	}
	
	public function getClubList($column=null){
		
		$criteria = new Criteria();
		$criteria->add( ClubRankingLivePeer::RANKING_LIVE_ID, $this->getId() );
		$criteria->add( ClubRankingLivePeer::ENABLED, true );
		$criteria->addJoin( ClubPeer::ID, ClubRankingLivePeer::CLUB_ID, Criteria::INNER_JOIN );
		$criteria->addJoin( ClubRankingLivePeer::RANKING_LIVE_ID, RankingLivePeer::ID, Criteria::INNER_JOIN );
		$clubObjList = ClubPeer::doSelect($criteria);
		
		if( is_null($column) )
			return $clubObjList;
		
		$function = 'get'.ucfirst($column);
		$clubList = array();
		
		foreach($clubObjList as $clubObj)
			$clubList[] = $clubObj->$function();
		
		
		return $clubList;
	}
	
	public function isMyRanking($userAdminId=null){
		
		if( !$this->getVisible() && !$this->getEnabled() && !$this->getDeleted() )
			return true;
		
		if( !$userAdminId )
			$userAdminId = MyTools::getAttribute('userAdminId');
		
		$iRankAdmin = MyTools::hasCredential('iRankAdmin');

		if( $iRankAdmin )
			return true;
		
		$criteria = new Criteria();
		$criteria->add( RankingLivePeer::ID, $this->getId() );
		$criteria->add( UserAdminPeer::ID, $userAdminId );
		$criteria->add( ClubRankingLivePeer::ENABLED, true );
		$criteria->addJoin( RankingLivePeer::ID, ClubRankingLivePeer::RANKING_LIVE_ID, Criteria::INNER_JOIN );
		$criteria->addJoin( ClubRankingLivePeer::CLUB_ID, UserAdminPeer::CLUB_ID, Criteria::INNER_JOIN );
		
		return (RankingLivePeer::doCount($criteria) > 0);
	}
	
	public function getEventCount(){
		
		return Util::executeOne('SELECT COUNT(1) FROM event_live WHERE visible AND enabled AND NOT deleted AND ranking_live_id = '.$this->getId());
	}
	
	public function getEventLiveList($criteria=null, $con=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
		
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );
		$criteria->addDescendingOrderByColumn( EventLivePeer::EVENT_DATE_TIME );
		
		return parent::getEventLiveList($criteria, $con);
	}
	
	public function toString(){
		
		return $this->getRankingName();
	}
	
	public function getStackChips($displayShort=false){
		
		$stackChips = parent::getStackChips();
		
		if( $displayShort )
			$stackChips = ($stackChips/1000).'K';
			
		return $stackChips;
	}
	
	public function getPlayerList($criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
		
		$criteria->add( RankingLivePlayerPeer::RANKING_LIVE_ID, $this->getId() );
		$criteria->add( RankingLivePlayerPeer::ENABLED, true );
		$criteria->addDescendingOrderByColumn( RankingLivePlayerPeer::TOTAL_SCORE );
		
		return RankingLivePlayerPeer::doSelect($criteria);
	}
	
	public function updateScores(){

	  	$rankingLivePlayerObjList = $this->getPlayerList();

	  	foreach( $rankingLivePlayerObjList as $rankingLivePlayerObj )
	  		$rankingLivePlayerObj->updateInfo();
	}
	
	public function updatePlayerEvents(){
		
		Util::executeQuery('SELECT update_ranking_live_player_events('.$this->getId().')');
	}
	
	public function updateHistory($rankingDate){

		$rankingDate = Util::formatDate($rankingDate);
		Util::executeQuery('DELETE FROM ranking_live_history WHERE ranking_live_id = '.$this->getId().' AND ranking_date = \''.$rankingDate.'\'');
		
		$criteria = new Criteria();
		$criteria->add( RankingLivePlayerPeer::TOTAL_EVENTS, 0, Criteria::GREATER_THAN );
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );
		$criteria->add( EventLivePeer::SAVED_RESULT, true );
		$criteria->add( EventLivePeer::EVENT_DATE, $rankingDate, Criteria::LESS_EQUAL );
		$criteria->add( EventLivePlayerPeer::ENABLED, true );
		$criteria->add( EventLivePlayerPeer::DELETED, false );
		$criteria->add( EventLivePlayerPeer::PEOPLE_ID, EventLivePlayerPeer::PEOPLE_ID.' = '.RankingLivePlayerPeer::PEOPLE_ID, Criteria::CUSTOM );
		$criteria->addJoin( RankingLivePlayerPeer::RANKING_LIVE_ID, EventLivePeer::RANKING_LIVE_ID, Criteria::INNER_JOIN );
		$criteria->addJoin( EventLivePeer::ID, EventLivePlayerPeer::EVENT_LIVE_ID, Criteria::INNER_JOIN );
		$criteria->setDistinct( EventLivePeer::ID );
		
		// Aqui atualiza as informações de valores, pontos e prêmios acumulados para a data
		foreach($this->getPlayerList($criteria) as $rankingLivePlayerObj){
			
			$rankingLiveHistoryObjLast = $rankingLivePlayerObj->getLastHistory($rankingDate);
			
			$rankingLiveHistoryObj = new RankingLiveHistory();
			$rankingLiveHistoryObj->setRankingLiveId($rankingLiveHistoryObjLast->getRankingLiveId());
			$rankingLiveHistoryObj->setPeopleId($rankingLiveHistoryObjLast->getPeopleId());
			$rankingLiveHistoryObj->setRankingDate($rankingDate);
			$rankingLiveHistoryObj->setEnabled($rankingLivePlayerObj->getEnabled());
			$rankingLiveHistoryObj->setTotalEvents($rankingLiveHistoryObjLast->getTotalEvents()+0);
			$rankingLiveHistoryObj->setTotalScore($rankingLiveHistoryObjLast->getTotalScore()+0);
			$rankingLiveHistoryObj->setTotalBalance($rankingLiveHistoryObjLast->getTotalBalance()+0);
			$rankingLiveHistoryObj->setTotalPrize($rankingLiveHistoryObjLast->getTotalPrize()+0);
			$rankingLiveHistoryObj->setTotalPaid($rankingLiveHistoryObjLast->getTotalPaid()+0);
			
			$rankingLiveHistoryObj->setEvents(0);
			$rankingLiveHistoryObj->setScore(0);
			$rankingLiveHistoryObj->setBalanceValue(0);
			$rankingLiveHistoryObj->setPrizeValue(0);
			$rankingLiveHistoryObj->setPaidValue(0);
			$rankingLiveHistoryObj->updateInfo($rankingDate);
			$rankingLiveHistoryObj->save();
		}

		$rankingLiveId   = $this->getId();
		$rankingPosition = 0;
		
		
		// A partir daqui atualiza as informações da classificação do dia e acumulada do jogador no ranking
		foreach($this->getClassify(null, $rankingDate) as $rankingLivePlayerObj){
			
			++$rankingPosition;
			$peopleId = $rankingLivePlayerObj->getPeopleId();
			
			$sql = "UPDATE ranking_live_history SET total_ranking_position = $rankingPosition WHERE ranking_live_id = $rankingLiveId AND ranking_date = '$rankingDate' AND people_id = $peopleId";
			Util::executeQuery($sql);
		}
		
		$criteria = new Criteria();
	  	$criteria->add( RankingLiveHistoryPeer::RANKING_DATE, Util::formatDate($rankingDate) );
	  	$criteria->add( RankingLiveHistoryPeer::RANKING_LIVE_ID, $this->getId() );
	  	$criteria->addDescendingOrderByColumn( RankingLiveHistoryPeer::SCORE );
	  	$rankingLiveHistoryObjList = RankingLiveHistoryPeer::doSelect($criteria);

  		$rankingPosition = 1;
  		foreach($rankingLiveHistoryObjList as $rankingLiveHistoryObj){

			if( $rankingLiveHistoryObj->getScore() )
	  			$rankingLiveHistoryObj->setRankingPosition($rankingPosition++);
	  		else
	  			$rankingLiveHistoryObj->setRankingPosition(0);
	  		
  			$rankingLiveHistoryObj->save();
  		}
	}
	
	public function getClassify($criteria=null, $rankingDate=null){
		
		if( $rankingDate )
			return $this->getRankingHistoryByDate($rankingDate);
		
		switch($this->getRankingType(true)){
			case 'value':
				$orderByList = array(RankingLivePlayerPeer::TOTAL_PRIZE=>'desc');
				break;
			case 'balance':
				$orderByList = array(RankingLivePlayerPeer::TOTAL_BALANCE=>'desc');
				break;
			case 'score':
				$orderByList = array(RankingLivePlayerPeer::TOTAL_SCORE=>'desc');
				break;
			case 'average':
				$orderByList = array(RankingLivePlayerPeer::TOTAL_AVERAGE=>'desc');
				break;
		}
	  	
	  	$orderByList[RankingLivePlayerPeer::TOTAL_PRIZE]   = 'desc';
	  	$orderByList[RankingLivePlayerPeer::TOTAL_BALANCE] = 'desc';
	  	$orderByList[RankingLivePlayerPeer::TOTAL_PAID]    = 'asc';
	  	$orderByList[RankingLivePlayerPeer::TOTAL_PAID]    = 'asc';
	  	$orderByList[RankingLivePlayerPeer::TOTAL_AVERAGE] = 'desc';
	  	$orderByList[RankingLivePlayerPeer::PEOPLE_ID]     = 'asc';
	  	
	  	$rankingLivePlayerObjList = $this->getPlayerList($criteria);
	  	$lastList = array();
	  	foreach($rankingLivePlayerObjList as $key=>$rankingLivePlayerObj){
	  		
	  		if( $rankingLivePlayerObj->getTotalPaid()==0 ){
	  			
	  			$lastList[] = $rankingLivePlayerObj;
	  			unset($rankingLivePlayerObjList[$key]);
	  		}
	  	}
	  	
	  	return array_merge($rankingLivePlayerObjList, $lastList);
	}
	
	public function getRankingHistoryByDate($rankingDate){
		
		$criteria = new Criteria();
		$criteria->add( RankingLiveHistoryPeer::RANKING_LIVE_ID, $this->getId() );
		$criteria->add( RankingLiveHistoryPeer::RANKING_DATE, Util::formatDate($rankingDate) );
		$criteria->addDescendingOrderByColumn( RankingLiveHistoryPeer::TOTAL_SCORE );
		$rankingLiveHistoryObjList = RankingLiveHistoryPeer::doSelect($criteria);
		
		if( count($rankingLiveHistoryObjList)==0 ){
		
			Util::getHelper('i18n');
			throw new Exception(__('ranking.noRankingLog', array('%date%'=>$rankingDate)));
		}else
			return $rankingLiveHistoryObjList;
	}
	
	/**
	 * Retorna o total em porcentagem da divisão de prêmios configurada na aba Resultados do módulo de eventos na administração
	 */
	public function getTotalPercentPrizeSplit(){
		
		$prizeSplit = split(EventLive::PRIZE_SPLIT_PATTERN, $this->getPrizeSplit());
		
		foreach($prizeSplit as &$prize)
			$prize = Util::formatFloat($prize);
		
		return array_sum($prizeSplit);
	}
	
	public function importPlayers(){
		
		$resultSet = Util::executeQuery('SELECT get_ranking_live_new_players('.$this->getId().')');

		while( $resultSet->next() ){
			
			$peopleId             = $resultSet->getInt(1);
			$rankingLivePlayerObj = RankingLivePlayerPeer::retrieveByPK($this->getId(), $peopleId);
			$rankingLivePlayerObj->save();
		}
	}

	public function updatePlayers(){
		
		Util::executeQuery('SELECT update_ranking_live_players('.$this->getId().')');
	}

	public function updateEvents(){
		
		Util::executeQuery('SELECT update_ranking_live_events('.$this->getId().')');
	}
	
	public function getTotalPrize(){
		
		return Util::executeOne('SELECT get_ranking_live_total_prize('.$this->getId().')', 'float');
	}
	
	public function getClub(){
		
		$clubObjList = $this->getClubList();
		
		if( count($clubObjList)==1 )
			return $clubObjList[0];
		else
			return 'Múltiplos clubes';
	}
	
	public function updateVisitCount(){
		
		$rankingLiveId = $this->getId();
		$className     = ucfirst(get_class($this));
		
		if( !MyTools::hasAttribute("visitCount$className-$rankingLiveId") ){
			
			Util::executeQuery("SELECT update_ranking_live_visit_count($rankingLiveId)");
			MyTools::setAttribute("visitCount$className-$rankingLiveId", true);
		}
	}
	
	public function getDateList($includeDeleted=false){
		
		$rankingLiveId = $this->getId();
		
		$includeDeleted = ($includeDeleted?'true':'false');
		$resultSet = Util::executeQuery("SELECT get_ranking_live_date_list($rankingLiveId, $includeDeleted)");
		
		$dateList = array();
		while( $resultSet->next() ){
			
			$timestamp = strtotime($resultSet->getString(1));
			$dateList[date('Y-m-d', $timestamp)] = date('d/m/Y', $timestamp);
		}
		
		return $dateList;
	}
	
	public function getEventDateList($format='d/m/Y', $saved=true, $orderByList=array()){
		
		$criteria = new Criteria();
		$criteria->add( EventLivePeer::SAVED_RESULT, $saved );
		
		$criteria->addOrderBy($orderByList);
		
		$criteria->addAscendingOrderByColumn( EventLivePeer::EVENT_DATE );
		$eventLiveObjList = $this->getEventLiveList($criteria);
		
		$eventDateList = array();
		foreach($eventLiveObjList as $eventObj)
			$eventDateList[] = $eventObj->getEventDate($format);
		
		return array_unique($eventDateList);
	}
	
	public function isPlayer($peopleId){
		
		$rankingLiveId = $this->getId();
		
		return Util::executeOne("SELECT is_ranking_live_player($rankingLiveId, $peopleId)", 'boolean');
	}
	
	public function getRankingPosition($peopleId, $rankingDate){
		
		$rankingLiveId = $this->getId();
		$rankingDate = Util::formatDate($rankingDate);
		$rankingPosition = Util::executeOne("SELECT ranking_position FROM ranking_live_history WHERE ranking_live_id = $rankingLiveId AND people_id = $peopleId AND ranking_date = '$rankingDate'");
		
		return (!$rankingPosition?null:$rankingPosition);
	}

	public function getTotalRankingPosition($peopleId, $rankingDate){
		
		$rankingLiveId = $this->getId();
		$rankingDate = Util::formatDate($rankingDate);
		$totalRankingPosition = Util::executeOne("SELECT total_ranking_position FROM ranking_live_history WHERE ranking_live_id = $rankingLiveId AND people_id = $peopleId AND ranking_date = '$rankingDate'");
		
		return (!$totalRankingPosition?null:$totalRankingPosition);
	}
	
	public function getByPlace($place){
		
		$rankingPosition = 1;
		foreach($this->getClassify() as $rankingLivePlayerObj)
			if( ($rankingPosition++)==$place )
				return $rankingLivePlayerObj;
		
		return null;
	}
	
	public function updateWholeHistory(){

		Util::executeQuery('DELETE FROM ranking_live_history WHERE ranking_live_id = '.$this->getId());
		
		foreach($this->getEventDateList() as $eventDate){
			
			echo $eventDate.'<br/>';
			$this->updateHistory($eventDate);
		}
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']               = $this->getId();
		$infoList['startTime']        = $this->getStartTime('H:i');
		$infoList['isFreeroll']       = $this->getIsFreeroll();
		$infoList['buyin']            = $this->getBuyin();
		$infoList['entranceFee']      = $this->getEntranceFee();
		$infoList['blindTime']        = $this->getBlindTime('H:i');
		$infoList['stackChips']       = $this->getStackChips(true);
		$infoList['allowedRebuys']    = $this->getAllowedRebuys();
		$infoList['allowedAddons']    = $this->getAllowedAddons();
		$infoList['isIlimitedRebuys'] = $this->getIsIlimitedRebuys();
		$infoList['rakePercent']      = $this->getRakePercent();
		$infoList['prizeSplit']       = $this->getPrizeSplit();
		$infoList['publishPrize']     = $this->getPublishPrize();
		$infoList['reloadEvents']     = $this->reloadEvents;
		
		return $infoList;
	}
}
