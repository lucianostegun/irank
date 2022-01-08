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
	
	public function getId($encode=false){
		
		$id = parent::getId();
		
		if( $encode )
			$id = Util::encodeId($id);
		
		return $id;
	}
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save($con);
	}
	
	public function quickSave($request){
		
		$rankingName             = $request->getParameter('rankingName');
		$rankingTypeId           = $request->getParameter('rankingTypeId');
		$gameTypeId              = $request->getParameter('gameTypeId');
		$gameStyleId             = $request->getParameter('gameStyleId');
		$startDate               = $request->getParameter('startDate');
		$finishDate              = $request->getParameter('finishDate');
		$noRanking               = $request->getParameter('noRanking');
		$scoreFormula            = $request->getParameter('scoreFormula');
		$scoreFormulaCustom      = $request->getParameter('scoreFormulaCustom');
		$scoreFormulaOption      = $request->getParameter('scoreFormulaOption');
		$description             = $request->getParameter('description');
		$clubIdList              = $request->getParameter('clubId');
		$startTime               = $request->getParameter('startTime');
		$isFreeroll              = $request->getParameter('isFreeroll');
		$isMultiday              = $request->getParameter('isMultiday');
		$buyin                   = $request->getParameter('buyin');
		$entranceFee             = $request->getParameter('entranceFee');
		$guaranteedPrize         = $request->getParameter('guaranteedPrize');
		$blindTime               = $request->getParameter('blindTime');
		$stackChips              = $request->getParameter('stackChips');
		$allowedRebuys           = $request->getParameter('allowedRebuys');
		$allowedAddons           = $request->getParameter('allowedAddons');
		$tablesNumber            = $request->getParameter('tablesNumber');
		$isIlimitedRebuys        = $request->getParameter('isIlimitedRebuys');
		$prizeSplit              = $request->getParameter('prizeSplit');
		$rakePercent             = $request->getParameter('rakePercent');
		$publishPrize            = $request->getParameter('publishPrize');
		$emailTemplateId         = $request->getParameter('emailTemplateId');

		$startTimeSatellite        = $request->getParameter('startTimeSatellite');
		$isFreerollSatellite       = $request->getParameter('isFreerollSatellite');
		$buyinSatellite            = $request->getParameter('buyinSatellite');
		$entranceFeeSatellite      = $request->getParameter('entranceFeeSatellite');
		$guaranteedPrizeSatellite  = $request->getParameter('guaranteedPrizeSatellite');
		$blindTimeSatellite        = $request->getParameter('blindTimeSatellite');
		$stackChipsSatellite       = $request->getParameter('stackChipsSatellite');
		$allowedRebuysSatellite    = $request->getParameter('allowedRebuysSatellite');
		$allowedAddonsSatellite    = $request->getParameter('allowedAddonsSatellite');
		$tablesNumberSatellite     = $request->getParameter('tablesNumberSatellite');
		$isIlimitedRebuysSatellite = $request->getParameter('isIlimitedRebuysSatellite');
		
		if( preg_match('/^[0-9]*[,\.]?[0-9]*[kK]$/', $stackChips) )
			$stackChips = Util::formatFloat($stackChips)*1000;
		
		if( preg_match('/^[0-9]*[,\.]?[0-9]*[kK]$/', $guaranteedPrize) )
			$guaranteedPrize = Util::formatFloat($guaranteedPrize)*1000;
		
		$blindTime = RankingLive::convertBlindTime($blindTime);

		if( $isFreeroll )
			$buyin = 0;
			
		if( $scoreFormulaOption=='multiple' )
			$scoreFormula = $scoreFormulaCustom;

		$this->setRankingName($rankingName);
		$this->setRankingTypeId($rankingTypeId);
		$this->setGameTypeId($gameTypeId);
		$this->setGameStyleId($gameStyleId);
		$this->setStartDate(Util::formatDate($startDate));
		$this->setFinishDate(($finishDate?Util::formatDate($finishDate):null));
		$this->setNoRanking(($noRanking?true:false));
		$this->setScoreFormula($scoreFormula);
		$this->setScoreFormulaOption($scoreFormulaOption);
		$this->setDescription($description);
		
		// Informações da aba Valores padrão
		$this->setStartTime(nvl($startTime));
		$this->setIsFreeroll(($isFreeroll?true:false));
		$this->setIsMultiday(($isMultiday?true:false));
		$this->setBuyin(Util::formatFloat($buyin));
		$this->setEntranceFee(Util::formatFloat($entranceFee));
		$this->setGuaranteedPrize(Util::formatFloat($guaranteedPrize));
		$this->setBlindTime(nvl($blindTime));
		$this->setStackChips($stackChips);
		$this->setAllowedRebuys($allowedRebuys);
		$this->setAllowedAddons($allowedAddons);
		$this->setTablesNumber($tablesNumber);
		$this->setIsIlimitedRebuys(($isIlimitedRebuys?true:false));
		$this->setPrizeSplit(nvl($prizeSplit));
		$this->setRakePercent(Util::formatFloat($rakePercent));
		$this->setPublishPrize(($publishPrize?true:false));
		$this->setEmailTemplateId($emailTemplateId);

		if( preg_match('/^[0-9]*[,\.]?[0-9]*[kK]$/', $stackChipsSatellite) )
			$stackChipsSatellite = Util::formatFloat($stackChipsSatellite)*1000;
		
		// Informações da aba Eventos/Satélites
		$this->setStartTimeSatellite(nvl($startTimeSatellite));
		$this->setIsFreerollSatellite(($isFreerollSatellite?true:false));
		$this->setBuyinSatellite(Util::formatFloat($buyinSatellite));
		$this->setEntranceFeeSatellite(Util::formatFloat($entranceFeeSatellite));
		$this->setGuaranteedPrizeSatellite(Util::formatFloat($guaranteedPrizeSatellite));
		$this->setBlindTimeSatellite(nvl($blindTimeSatellite));
		$this->setStackChipsSatellite($stackChipsSatellite);
		$this->setAllowedRebuysSatellite($allowedRebuysSatellite);
		$this->setAllowedAddonsSatellite($allowedAddonsSatellite);
		$this->setTablesNumberSatellite($tablesNumberSatellite);
		$this->setIsIlimitedRebuysSatellite(($isIlimitedRebuysSatellite?true:false));
		
		$this->setEnabled(true);
		$this->setVisible(true);
		$this->setDeleted(false);
		
		try{
			
			$con = Propel::getConnection();
			$con->begin();
			
			$this->save($con);
			
			$iRankAdmin = MyTools::hasCredential('iRankAdmin');
			
			if( $iRankAdmin )
				$this->saveClub($clubIdList, true);
			else
				$this->saveClub(array($clubIdList), false);
				
			$this->saveTemplate($request, $con);
			
			$con->commit();
		}catch(Exception $e){
			
			$con->rollback();
		}
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
	
	public function saveTemplate($request, $con){
		
		$this->deleteTemplate($con);
		
		$stepDayList     = $request->getParameter('stepDay');
		$daysAfterList   = $request->getParameter('daysAfter');
		$startTimeList   = $request->getParameter('templateStartTime');
		$isSatelliteList = $request->getParameter('isSatellite');
		
		$defaultStartTime = $this->getStartTime('H:i');
		
		if( !is_array($stepDayList) )
			return;
		
		foreach($stepDayList as $key=>$stepDay){
			
			$startTime   = nvl($startTimeList[$key], $this->getStartTime('H:i'));
			$isSatellite = (array_key_exists($key, $isSatelliteList)?$isSatelliteList[$key]:false);
			$stepDay = preg_replace('/dia ?/i', '', $stepDay);
			
			$eventLiveTemplateObj = new RankingLiveTemplate();
			$eventLiveTemplateObj->setRankingLiveId($this->getId());
			$eventLiveTemplateObj->setStepDay($stepDay);
			$eventLiveTemplateObj->setDaysAfter($daysAfterList[$key]);
			$eventLiveTemplateObj->setIsSatellite($isSatellite);
			$eventLiveTemplateObj->setStartTime($startTime);
			$eventLiveTemplateObj->save($con);
		}
	}
	
	public function deleteTemplate($con){
		
		Util::executeQuery('DELETE FROM ranking_live_template WHERE ranking_live_id = '.$this->getId(), $con);
	}
	
	public function saveQuickEvents($request){
		
		$quickEventEventDateList = $request->getParameter('quickEventEventDateList');
		
		if( empty($quickEventEventDateList) )
			return true;
		
		$quickEventEventDateList = explode(',', $quickEventEventDateList);
		
		$eventName = $request->getParameter('eventName');
		$clubId    = $request->getParameter('quickEventLiveClubId');
		$startTime = $this->getStartTime();
		
		if( !$eventName || !$startTime || !$clubId )
			return false;
		
		try{
			
			$con = Propel::getConnection();
			$con->begin();
			
			foreach($quickEventEventDateList as $eventDate){
				
				$stepNumber = $request->getParameter('stepNumber-'.$eventDate);
				
				$eventLiveObj = new EventLive();
				$eventLiveObj->setEventName($eventName);
				$eventLiveObj->setEventShortName($eventLiveObj->buildShortName());
				$eventLiveObj->setStepNumber(nvl($stepNumber));
				$eventLiveObj->setRankingLiveId($this->getId());
				$eventLiveObj->setClubId($clubId);
				$eventLiveObj->setEventDate(Util::formatDate($eventDate));
				$eventLiveObj->setStartTime($startTime);
				$eventLiveObj->setIsFreeroll($this->getIsFreeroll());
				$eventLiveObj->setIsMultiday($this->getIsMultiday());
				$eventLiveObj->setBuyin($this->getBuyin());
				$eventLiveObj->setEntranceFee($this->getEntranceFee());
				$eventLiveObj->setGuaranteedPrize($this->getGuaranteedPrize());
				$eventLiveObj->setRakePercent($this->getRakePercent());
				$eventLiveObj->setBlindTime($this->getBlindTime());
				$eventLiveObj->setStackChips($this->getStackChips());
				$eventLiveObj->setAllowedRebuys($this->getAllowedRebuys());
				$eventLiveObj->setAllowedAddons($this->getAllowedAddons());
				$eventLiveObj->setIsIlimitedRebuys($this->getIsIlimitedRebuys());
				$eventLiveObj->setPrizeSplit($this->getPrizeSplit());
				$eventLiveObj->setPublishPrize($this->getPublishPrize());
				$eventLiveObj->setRakePercent($this->getRakePercent());
				$eventLiveObj->setEmailTemplateId($this->getEmailTemplateId());
				$eventLiveObj->setTablesNumber($this->getTablesNumber());
				$eventLiveObj->setDescription('[descrição do ranking]');
				$eventLiveObj->setEnabled(true);
				$eventLiveObj->setVisible(true);
				$eventLiveObj->setDeleted(false);

				$eventLiveObj->save($con);
				
				if( $this->getIsMultiday() )
					$eventLiveObj->saveScheduleFromTemplate($con);
				
				$this->reloadEvents = true;
			}
			
			$con->commit();
		}catch(Exception $e){
				
			$con->rollback();
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

		return options_for_select($optionList, $defaultValue);
	}
	
	public function cleanRecord(){
		
		$this->setFileNameLogo(null);
	}
	
	public function getFileNameLogo($original=false, $size=null){
		
		$fileNameLogo = parent::getFileNameLogo();
		
		if( $original ){
			
			$rankingLiveId = $this->getId();
			$fileNameLogo  = preg_replace('/-[0-9]*(\.[^\.]*)$/', '\1', $fileNameLogo);
		}
		
		if( $size )
			$fileNameLogo = str_replace('/ranking/', '/ranking/'.$size.'/', $fileNameLogo);
		
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
		
		return Util::executeOne('SELECT COUNT(1) FROM event_live WHERE ranking_live_id = '.$this->getId().' AND visible AND enabled AND NOT deleted AND NOT is_satellite');
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

	public function getGuaranteedPrize($displayShort=false){
		
		$guaranteedPrize = parent::getGuaranteedPrize();
		
		if( $displayShort )
			$guaranteedPrize = ($guaranteedPrize/1000).'K';
			
		return $guaranteedPrize;
	}

	public function getStackChipsSatellite($displayShort=false){
		
		$stackChipsSatellite = parent::getStackChipsSatellite();
		
		if( $displayShort )
			$stackChipsSatellite = ($stackChipsSatellite/1000).'K';
			
		return $stackChipsSatellite;
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
		
		if( count($rankingLiveHistoryObjList)==0 )
			return array();
		else
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
	
	public static function convertBlindTime($blindTime){
		
		$blindTime = strtolower($blindTime);
		$blindTime = str_replace(' ', '', $blindTime);
		
		if( preg_match('/^([0-5]?[0-9]+)(m(in))$/', $blindTime, $matches) ){
			
			return sprintf('%02d:%02d', 0, $matches[1]);
		}

		if( preg_match('/^([0-5]?[0-9]+)h$/', $blindTime, $matches) ){
			
			return sprintf('%02d:%02d', $matches[1], 0);
		}
		
		return $blindTime;
	}
	
	public function getTemplateList(){
		
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn( RankingLiveTemplatePeer::DAYS_AFTER );
		
		return $this->getRankingLiveTemplateList($criteria);
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
		$infoList['tablesNumber']     = $this->getTablesNumber();
		$infoList['isIlimitedRebuys'] = $this->getIsIlimitedRebuys();
		$infoList['rakePercent']      = $this->getRakePercent();
		$infoList['prizeSplit']       = $this->getPrizeSplit();
		$infoList['publishPrize']     = $this->getPublishPrize();
		$infoList['reloadEvents']     = $this->reloadEvents;
		
		return $infoList;
	}
	
	public function getHistoryClassifyOptions( $defaultValue='' ){
		
		$eventLiveObjList = $this->getEventLiveList();
		$options          = array(''=>'Todos eventos');
		
		foreach($eventLiveObjList as $eventLiveObj)
			$options[$eventLiveObj->getEventDate('d/m/Y')] = $eventLiveObj->getEventDate('d/m/Y');
		
		return options_for_select($options, $defaultValue);
	}
}
