<?php

/**
 * Subclasse de representação de objetos da tabela 'event_live'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLive extends BaseEventLive
{
	
	const PRIZE_SPLIT_PATTERN = '((; ?)|(, ?))';
	private $eventLiveObjPrevious = null; // Variável que vai armazenar o evento imediatamente anterior a este
	
	public function getIsNew(){
		
		return ($this->isNew() || (!$this->getVisible() && !$this->getEnabled() && !$this->getDeleted()));
	}
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

//    		$this->postOnWall();
    		
    		$this->setEventDateTime($this->getEventDate('Y-m-d').' '.$this->getStartTime());
    		$this->setEnrollmentStartDate(nvl($this->getEnrollmentStartDate(), '2012-01-01'));

			parent::save($con);
			
        	Log::quickLog('event_live', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('event_live', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
		
		$rankingLiveObj = $this->getRankingLive();
		
		// Se estiver excluindo um evento de um ranking, atualiza todo o histórico de classificação
		if( is_object($rankingLiveObj) )
			$rankingLiveObj->updateWholeHistory();
	}
	
	public function quickSave($request){
		
		$clubId              = $request->getParameter('clubId');
		$rankingLiveId       = $request->getParameter('rankingLiveId');
		$eventName           = $request->getParameter('eventName');
		$eventShortName      = $request->getParameter('eventShortName');
		$isMultiday          = $request->getParameter('isMultiday');
		$eventDate           = $request->getParameter('eventDate');
		$startTime           = $request->getParameter('startTime');
		$stepNumber          = $request->getParameter('stepNumber');
		$isFreeroll          = $request->getParameter('isFreeroll');
		$entranceFee         = $request->getParameter('entranceFee');
		$guaranteedPrize     = $request->getParameter('guaranteedPrize');
		$buyin               = $request->getParameter('buyin');
		$rakePercent         = $request->getParameter('rakePercent');
		$blindTime           = $request->getParameter('blindTime');
		$stackChips          = $request->getParameter('stackChips');
		$allowedRebuys       = $request->getParameter('allowedRebuys');
		$allowedAddons       = $request->getParameter('allowedAddons');
		$tablesNumber        = $request->getParameter('tablesNumber');
		$isIlimitedRebuys    = $request->getParameter('isIlimitedRebuys');
		$description         = $request->getParameter('description');
		$comments            = $request->getParameter('comments');
		$suppressSchedule    = $request->getParameter('suppressSchedule');
		$scheduleStartDate   = $request->getParameter('scheduleStartDate');
		$enrollmentStartDate = $request->getParameter('enrollmentStartDate');
		
		if( preg_match('/^[0-9]*[,\.]?[0-9]*[kK]$/', $stackChips) )
			$stackChips = Util::formatFloat($stackChips)*1000;
			
		$blindTime = RankingLive::convertBlindTime($blindTime);

		if( $isFreeroll )
			$buyin = 0;
		
		// Se o evento já foi salvo, não deixa alterar a data
		if( $this->getSavedResult() )
			$eventDate = $this->getEventDate('d/m/Y');
		
		if( $this->getIsNew() ){
			
			$this->setClubid($clubId);
			$this->setRankingLiveId(nvl($rankingLiveId));
		}
		
		$this->setEventName($eventName);
		$this->setEventShortName(nvl($eventShortName));
		$this->setEventDate(Util::formatDate($eventDate));
		$this->setStartTime($startTime);
		$this->setIsFreeroll(($isFreeroll?true:false));
		$this->setEntranceFee(Util::formatFloat($entranceFee));
		$this->setGuaranteedPrize(Util::formatFloat($guaranteedPrize));
		$this->setBuyin(Util::formatFloat($buyin));
		$this->setBlindTime($blindTime);
		$this->setRakePercent(Util::formatFloat($rakePercent));
		$this->setStackChips($stackChips);
		$this->setAllowedRebuys($allowedRebuys);
		$this->setAllowedAddons($allowedAddons);
		$this->setTablesNumber($tablesNumber);
		$this->setIsIlimitedRebuys(($isIlimitedRebuys?true:false));
		$this->setIsMultiday(($isMultiday?true:false));
		$this->setStepNumber(nvl($stepNumber));
		
		$this->setDescription($description);
		$this->setComments(nvl($comments));
		
		// Informações da aba Options
		$this->setSuppressSchedule(($suppressSchedule?true:false));
		$this->setScheduleStartDate(Util::formatDate($scheduleStartDate));
		$this->setEnrollmentStartDate(Util::formatDate($enrollmentStartDate));
		
		$this->setEnabled(true);
		$this->setVisible(true);
		$this->setDeleted(false);
		
		try{
			
			$con = Propel::getConnection();
			$con->begin();
			
			$this->save($con);
			
			if( $isMultiday )
				$this->saveSchedule($request, $con);
			else
				$this->deleteSchedule($con);
			
			$con->commit();
		}catch(Exception $e){
			
			$con->rollback();
		}
		
	}
	
	public function saveSchedule($request, $con){
		
		$this->deleteSchedule($con);
		
		$stepEventDateList = $request->getParameter('stepEventDate');
		$stepStartTimeList = $request->getParameter('stepStartTime');
		$stepDayList       = $request->getParameter('stepDay');
		
		$eventDate        = null;
		$startTime        = null;
		$defaultStartTime = $this->getRankingLive()->getStartTime();
				
		foreach($stepEventDateList as $key=>$stepEventDate){
			
			$stepEventDate = Util::formatDate($stepEventDate);
			$stepStartTime = nvl($stepStartTimeList[$key], $defaultStartTime);
			
			if( $key==0 ){
				
				$eventDate = $stepEventDate;
				$startTime = $stepStartTime;
				$daysAfter = 0;
			}else{
				
				$daysAfter = Util::differenceDays($stepEventDate, $eventDate);
			}
			
			$stepDay = $stepDayList[$key];
			$stepDay = preg_replace('/dia ?/i', '', $stepDay);
			
			$eventLiveScheduleObj = new EventLiveSchedule();
			$eventLiveScheduleObj->setEventLiveId($this->getId());
			$eventLiveScheduleObj->setEventDate($stepEventDate);
			$eventLiveScheduleObj->setStartTime($stepStartTime);
			$eventLiveScheduleObj->setStepDay($stepDay);
			$eventLiveScheduleObj->setDaysAfter($daysAfter);
			$eventLiveScheduleObj->save($con);
		}
		
		$this->setEventDate($eventDate);
		$this->setStartTime($startTime);
		$this->save($con);
	}

	public function saveScheduleFromTemplate($con){
		
		$this->deleteSchedule($con);
		
		$startTime = null;
		
		$eventDate      = $this->getEventDate(null);
		$rankingLiveObj = $this->getRankingLive();
		
		foreach($this->getRankingLive()->getTemplateList() as $key=>$rankingLiveTemplateObj){
			
			$daysAfter     = $rankingLiveTemplateObj->getDaysAfter();
			$stepEventDate = $eventDate+(86400*$daysAfter);
			$isSatellite   = $rankingLiveTemplateObj->getIsSatellite();
			
			if( !$isSatellite ){
				
				if( $daysAfter==0 ){
					
					$eventDate = $stepEventDate;
					$startTime = $rankingLiveTemplateObj->getStartTime();
				}
				
				$eventLiveScheduleObj = new EventLiveSchedule();
				$eventLiveScheduleObj->setEventLiveId($this->getId());
				$eventLiveScheduleObj->setEventDate($stepEventDate);
				$eventLiveScheduleObj->setStartTime($rankingLiveTemplateObj->getStartTime());
				$eventLiveScheduleObj->setStepDay($rankingLiveTemplateObj->getStepDay());
				$eventLiveScheduleObj->setDaysAfter($rankingLiveTemplateObj->getDaysAfter());
				$eventLiveScheduleObj->setIsSatellite($isSatellite);
				$eventLiveScheduleObj->save($con);
			}else{
			
				$eventLiveObj = $this->getClone();
				
				$eventLiveObj->setEventName('Satélite '.$this->getEventName());
				$eventLiveObj->buildShortName();
				$eventLiveObj->setEventDate($stepEventDate);
				$eventLiveObj->setStartTime($rankingLiveObj->getStartTimeSatellite());
				$eventLiveObj->setIsFreeroll($rankingLiveObj->getIsFreerollSatellite());
				$eventLiveObj->setBuyin($rankingLiveObj->getBuyinSatellite());
				$eventLiveObj->setEntranceFee($rankingLiveObj->getEntranceFeeSatellite());
				$eventLiveObj->setGuaranteedPrize($rankingLiveObj->getGuaranteedPrizeSatellite());
				$eventLiveObj->setBlindTime($rankingLiveObj->getBlindTimeSatellite());
				$eventLiveObj->setStackChips($rankingLiveObj->getStackChipsSatellite());
				$eventLiveObj->setAllowedRebuys($rankingLiveObj->getAllowedRebuysSatellite());
				$eventLiveObj->setAllowedAddons($rankingLiveObj->getAllowedAddonsSatellite());
				$eventLiveObj->setTablesNumber($rankingLiveObj->getTablesNumberSatellite());
				$eventLiveObj->setIsIlimitedRebuys($rankingLiveObj->getIsIlimitedRebuysSatellite());
				$eventLiveObj->setIsSatellite(true);
				$eventLiveObj->setSuppressRanking(true);
				$eventLiveObj->setIsMultiday(false);
				$eventLiveObj->save($con);
			}
		}
		
		$this->setEventDate($eventDate);
		$this->setStartTime($startTime);
		$this->save($con);
	}
	
	public function getClone(){
		
		$eventLiveObj = new EventLive();
		
		foreach(EventLivePeer::getFieldNames() as $attribute){
			
			$getFunction = 'get'.$attribute;
			$setFunction = 'set'.$attribute;
			$eventLiveObj->$setFunction($this->$getFunction());
		}
		
		$eventLiveObj->setDescription($this->getDescription(false));
		
		return $eventLiveObj;
	}
	
	public function deleteSchedule($con){
		
		Util::executeQuery('DELETE FROM event_live_schedule WHERE event_live_id = '.$this->getId(), $con);
	}
	
	public static function getList(Criteria $criteria=null, $clubId=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );

		$criterion = $criteria->getNewCriterion( RankingLivePeer::ENABLED, true );
		$criterion->addAnd( $criteria->getNewCriterion( RankingLivePeer::VISIBLE, true ) );
		$criterion->addAnd( $criteria->getNewCriterion( RankingLivePeer::DELETED, false ) );
		
		$criterion2 = $criteria->getNewCriterion( EventLivePeer::RANKING_LIVE_ID, NULL );
		$criterion->addOr($criterion2);
		$criteria->add($criterion);
		
		if( $clubId )
			$criteria->add( EventLivePeer::CLUB_ID, $clubId );
			
		$criteria->addJoin( EventLivePeer::RANKING_LIVE_ID, RankingLivePeer::ID, Criteria::LEFT_JOIN );

		$criteria->addDescendingOrderByColumn( EventLivePeer::EVENT_DATE );
		$criteria->addAscendingOrderByColumn( EventLivePeer::START_TIME );
		
		return EventLivePeer::doSelect($criteria);
	}
	
	public function saveResult($request){
		
	    $publish      = $request->getParameter('publish');
		$totalRebuys  = $request->getParameter('totalRebuys');
		$prizeSplit   = $request->getParameter('prizeSplit');
		$publishPrize = $request->getParameter('publishPrize');
		
	    $this->setTotalRebuys(Util::formatFloat($totalRebuys));
	    $this->setPrizeSplit($prizeSplit);
	    $this->setPublishPrize(($publishPrize?true:false));
	    $this->save();
		
		$eventLiveId = $this->getId();
		
		$players      = $this->getPlayers();
		$peopleIdList = array(0);
		
		$lastValidEventPosition = 0;
		
		$isFreeroll  = $this->getIsFreeroll();
		$buyin       = $this->getBuyin();
		$entranceFee = $this->getEntranceFee();
		
		// Apenas salva o resultado sem publicar as informações
		for($eventPosition=1; $eventPosition <= $players; $eventPosition++){
			
			$peopleId = $request->getParameter('peopleIdPosition-'.$eventPosition);
			$prize    = $request->getParameter('prize-'.$eventPosition);
			$score    = $request->getParameter('score-'.$eventPosition);
			$rebuy    = 0;//$request->getParameter('rebuy-'.$eventPosition);
			$addon    = 0;//$request->getParameter('addon-'.$eventPosition);
			
			if( !$peopleId )
				continue;
			
			$lastValidEventPosition = $eventPosition;
			
			$prize = Util::formatFloat($prize);
			$score = Util::formatFloat($score);
				
			$peopleIdList[] = $peopleId;

			$eventLivePlayerObj = EventLivePlayerPeer::retrieveByPK($eventLiveId, $peopleId);
			
			$eventLivePlayerObj->setEventPosition($eventPosition);
			$eventLivePlayerObj->setPrize( Util::formatFloat($prize) );
			$eventLivePlayerObj->setEntranceFee( Util::formatFloat($entranceFee) );
			$eventLivePlayerObj->setRebuy( Util::formatFloat($rebuy) );
			$eventLivePlayerObj->setAddon( Util::formatFloat($addon) );
			$eventLivePlayerObj->setBuyin( Util::formatFloat(($isFreeroll?0:$buyin)) );
			$eventLivePlayerObj->setScore( $score );
			$eventLivePlayerObj->save();
		}
		
		Util::executeQuery('UPDATE event_live_player SET event_position = null, prize=0 WHERE event_live_id = '.$eventLiveId.' AND people_id NOT IN ('.implode(',', $peopleIdList).')');
	
		$savedResult = $this->getSavedResult();
	
		// Publica as informações no site
		if( $publish || $savedResult ){
			
			// Coloca por últimos os jogadores que não marcaram em que posição sairam
			$criteria = new Criteria();
			$criteria->add( EventLivePlayerPeer::PEOPLE_ID, $peopleIdList, Criteria::NOT_IN );
			
			$eventPosition = $lastValidEventPosition;
			foreach($this->getEventLivePlayerList($criteria) as $eventLivePlayerObj){
				
				$eventPosition++;
				$prize = $request->getParameter('prize-'.$eventPosition);
				$score = $request->getParameter('score-'.$eventPosition);
			
				$prize = Util::formatFloat($prize);
				$score = Util::formatFloat($score);
				
				$eventLivePlayerObj->setEventPosition($eventPosition);
				$eventLivePlayerObj->setPrize($prize);
				$eventLivePlayerObj->setScore($score);
				$eventLivePlayerObj->save();
				
				$peopleId = $eventLivePlayerObj->getPeopleId();
			}
			
			$this->setSavedResult(true);
			$this->save();
			
			$rankingLiveObj = $this->getRankingLive();
				
			if( $this->getRankingLiveId() && is_object($rankingLiveObj) ){
				
				/**
				 * Reimporta todos os jogadores que ainda não fazem parte do ranking,
				 * ou seja, os jogadores que estão jogando pela primeira vez.
				 */
				$rankingLiveObj->importPlayers();
				
				$rankingLiveObj->updateScores();
				$rankingLiveObj->updatePlayerEvents();
				$rankingLiveObj->updatePlayers();
				$rankingLiveObj->updateEvents();
				$rankingLiveObj->updateHistory($this->getEventDate('d/m/Y'));
				
				if( $rankingLiveObj->getScoreFormulaOption()=='multiple' )
					$this->getParsedScore(true);
			}
		}
	}
	
	public function getRankingLive($con=null){
		
		$rankingLiveObj = parent::getRankingLive($con);
		
		if( !is_object($rankingLiveObj) )
			$rankingLiveObj = new RankingLive();
			
		return $rankingLiveObj;
	}
	
	public function isMyEvent($userAdminId=null){
		
		if( !$this->getVisible()  && !$this->getEnabled() && !$this->getDeleted() )
			return true;
		
		if( !$userAdminId )
			$userAdminId = MyTools::getAttribute('userAdminId');
		
		$iRankAdmin = MyTools::hasCredential('iRankAdmin');

		if( $iRankAdmin )
			return true;
		
		$criteria = new Criteria();
		$criteria->add( EventLivePeer::ID, $this->getId() );
		$criteria->add( UserAdminPeer::ID, $userAdminId );
		$criteria->addJoin( EventLivePeer::CLUB_ID, UserAdminPeer::CLUB_ID, Criteria::INNER_JOIN );
		
		return (EventLivePeer::doCount($criteria) > 0);
	}
	
	public function getEventPlace(){
		
		return $this->getClub()->getLocation();
	}
	
	public function isPastDate(){
		
		$eventDateTime   = $this->getEventDate('Y-m-d').' '.$this->getStartTime('H:i:s');
		$currentDateTime = time();
		
		return $currentDateTime > strtotime($eventDateTime);
	}
	
	public function isEditable(){

		$rankingLiveObj = $this->getRankingLive();
		
		// Se o evento não possui ranking então pode editar sempre
		if( !is_object($rankingLiveObj) )
		
		// Se hoje for maior que a data final do ranking
		if( $this->getSavedResult() && $rankingLiveObj->getFinishDate()!==null && $rankingLiveObj->getFinishDate(null) < time() )
			return false;

		$eventDate = $this->getEventDate();
		if( $eventDate==null )
			return true;
		
		$criteria = new Criteria();
		$criteria->add( EventLivePeer::RANKING_LIVE_ID, $this->getRankingLiveId() );
		$criteria->add( EventLivePeer::EVENT_DATE, $eventDate, Criteria::GREATER_THAN );
		$criteria->add( EventLivePeer::SAVED_RESULT, true );
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );
		$eventCount = EventLivePeer::doCount($criteria);

		return ($eventCount==0);
	}
	
	public function getPlayerStatus($peopleId, $boolean=false){
		
		if( !$peopleId )
			return 'no';
		
		$enrollmentStatus = Util::executeOne('SELECT enrollment_status FROM event_live_player WHERE event_live_id = '.$this->getId().' AND people_id = '.$peopleId, 'string');
		
		$enrolled = in_array($enrollmentStatus, array('enrolled', 'confirmed'));
		
		if( $boolean )
			return $enrolled;
		else
			return ($enrolled?'yes':'no');
	}
	
	public function getPlayers($updated=false, $countAll=false){
		
		if( $countAll )
			// Considera todos os jogadores que se inscreveram
			return Util::executeOne('SELECT COALESCE(COUNT(1), 0) FROM event_live_player WHERE event_live_id = '.$this->getId());
		elseif( $updated )
			return Util::executeOne('SELECT get_event_live_players('.$this->getId().', true)');
		else
			return parent::getPlayers();
	}
	
	public function getPlayerList(){
		
		$criteria = new Criteria();
		$criteria->add( EventLivePlayerPeer::EVENT_LIVE_ID, $this->getId() );
		$criteria->add( EventLivePlayerPeer::ENABLED, true );
		$criteria->addJoin( PeoplePeer::ID, EventLivePlayerPeer::PEOPLE_ID, Criteria::INNER_JOIN );
		$criteria->addAscendingOrderByColumn( PeoplePeer::FULL_NAME );
		
		return PeoplePeer::doSelect($criteria);
	}
	
	public function getParsedScore($save=false){
		
		$savedResult   = $this->getSavedResult();
		$totalRebuys   = $this->getTotalRebuys();
		$prizeSplit    = $this->getPrizeSplit();
		$prizeConfig   = split(EventLive::PRIZE_SPLIT_PATTERN, $prizeSplit);
		$paidPlaces    = count($prizeConfig);
		$players       = $this->getPlayers();
		$rankingLiveId = $this->getRankingLiveId();
		
		$buyin        = $this->getBuyin();
		$rakePercent  = $this->getRakePercent();
		$totalPrize   = $this->getTotalBuyin()+Util::formatFloat($totalRebuys);
		$totalPrize  -= ($totalPrize*$rakePercent/100);
		
		$totalBuyins = $totalPrize/$buyin;
		
		$prizeConfigList = array();
		$prizeConfigList['players'] = $players;
		
		$eventPosition = 0;
		foreach($this->getEventLivePlayerList() as $eventLivePlayerObj){
			
			$eventPosition++;
			
			$peopleId = $eventLivePlayerObj->getPeopleId();
			$prize    = ($eventPosition <= $paidPlaces?$totalPrize*$prizeConfig[$eventPosition-1]/100:0);
			$events   = 1;
			
			if( $rankingLiveId ){
				
				$events  = Util::executeOne("SELECT get_ranking_live_player_events($rankingLiveId, $peopleId)");
				$events += (!$savedResult?1:0); // Se o resultado do evento ainda não foi salvo, considera o evento atual na contagem de eventos
			}
			
			// Se não for pra salvar, limpa a variável $peopleId que é o que define se vai salvar a pontuação no método parseScore
			if( !$save )
				$peopleId = null;
			
			$score = $this->parseScore($eventPosition, $events, $prize, $players, $totalBuyins, $buyin, $prize, $peopleId);
			
			$prizeConfigList[$eventPosition] = array('score'=>$score, 'prize'=>$prize);
		}
		
		return $prizeConfigList;
	}
	
	public function parseScore($position, $events, $prize, $players, $totalBuyins, $buyin, $itm, $peopleId=null){
		
		$eventLiveId   = $this->getId();
		$formula       = $this->getRankingLive()->getScoreFormula();
		$formulaOption = $this->getRankingLive()->getScoreFormulaOption();
		
		if( !$formula )
			$formula = RankingLive::DEFAULT_SCORE_FORMULA;
			
		$formula = strtolower($formula);
		$formula = preg_replace('/\t\r\n /', '', $formula);
		$formula = preg_replace('/posi[cç][aã]o|position/', '$position', $formula);
		$formula = preg_replace('/eventos|events/', '$events', $formula);
		$formula = preg_replace('/pr[eê]mio|prize/', '$prize', $formula);
		$formula = preg_replace('/jogadores|players/', '$players', $formula);
		$formula = preg_replace('/buyins/', '$totalBuyins', $formula);
		$formula = preg_replace('/buyin/', '$buyin', $formula);
		$formula = preg_replace('/itm/', '$itm', $formula);
		$formula = preg_replace('/arred_cima/', 'ceil', $formula);
		$formula = preg_replace('/arred_baixo/', 'floor', $formula);
		$formula = preg_replace('/%/', '/100', $formula);
		
		$formulaList = explode('|', $formula);
		
		if( $peopleId )
			Util::executeQuery("DELETE from event_live_player_score WHERE event_live_id = $eventLiveId AND people_id = $peopleId");
		
		$scoreList = array();
		foreach($formulaList as &$formula){
			
			preg_match('/^(.*): ?/', $formula, $matches);
			
			$label   = ($formulaOption=='multiple'?$matches[1]:'');
			$formula = preg_replace('/^'.$label.': */', '', $formula);
			$score   = 0;
			
			@eval('$score = '.$formula.';');
			$scoreList[$label] = $score;
		}
		
		$score = array_sum($scoreList);
		
		if( $score===null )
			throw new Exception('Erro ao processar a fórmula de pontuação:\n'.'$score = '.$formula.';');
			
		if( $peopleId ){
			
			$orderSeq = 0;
			foreach($scoreList as $label=>$score)
				EventLivePlayerScore::quickSave($eventLiveId, $peopleId, $score, $label, ++$orderSeq);
			
			return $scoreList;
		}
		
		$score = number_format($score, 3);
		
		return $score;		
	}
	
	public function getGameStyle($returnTagName=false){
		
		$rankingLiveId = $this->getRankingLiveId();
		
		if( !$rankingLiveId )
			return new VirtualTable();
		
		return $this->getRankingLive()->getGameStyle($returnTagName);
	}
	
	public function getGameType($returnTagName=false){
		
		$rankingLiveId = $this->getRankingLiveId();
		
		if( !$rankingLiveId )
			return new VirtualTable();
		
		return $this->getRankingLive()->getGameType($returnTagName);
	}
	
	public function getEventLivePlayerList($criteria=null, $con=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( EventLivePlayerPeer::ENROLLMENT_STATUS, array('enrolled', 'confirmed'), Criteria::IN );
		$criteria->addJoin( EventLivePlayerPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$criteria->addAscendingOrderByColumn( EventLivePlayerPeer::EVENT_POSITION );
		
		return parent::getEventLivePlayerList($criteria, $con);
	}
	
	public function getEventLivePlayerResultList($criteria=null, $forceEventResult=false){
		
		// Se o evento tiver um ranking, retorna a classificação do ranking e não do evento
		if( $this->getRankingLiveId() && !$forceEventResult )
			return $this->getRankingLive()->getClassify($criteria);
			
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( EventLivePlayerPeer::ENABLED, true );
		$criteria->addAnd( EventLivePlayerPeer::EVENT_POSITION, 0, Criteria::GREATER_THAN );
		$criteria->addAnd( EventLivePlayerPeer::EVENT_POSITION, null, Criteria::NOT_EQUAL );
		$criteria->addAscendingOrderByColumn( EventLivePlayerPeer::EVENT_POSITION );
		
		return $this->getEventLivePlayerList($criteria);
	}
	
	public function getDescription($convertTags=true){
		
		$description = parent::getDescription();
		
		if( $convertTags ){
			
			$rankingDescription = $this->getRankingLive()->getDescription();
			if( empty($rankingDescription) )
				$rankingDescription = 'Sem descrição';
			
			$description = preg_replace('/[descri[çc]+[ã]+o ?do ?ranking]/i', $rankingDescription, $description);
			$description = preg_replace('/[\n]/i', '<br/>', $description);
		}
		
		return $description;
	}

	public function getComments($convertTags=true){
		
		$comments = parent::getComments();
		
		if( $convertTags ){
			
			$rankingDescription = $this->getRankingLive()->getDescription();
			
			if( $rankingDescription )
				$comments = preg_replace('/[descri[çc]+[ã]+o ?do ?ranking]/i', $rankingDescription, $comments);

			$comments = preg_replace('/[\n]/i', '<br/>', $comments);
		}
		
		return $comments;
	}
	
	public function getBuyinInfo(){
		
		if( $this->getIsFreeroll() )
			return 'Freeroll';
			
		$buyin       = $this->getBuyin();
		$entranceFee = $this->getEntranceFee();
		
		$entranceFee = Util::formatFloat($entranceFee, true);
		$entranceFee = str_replace(',00', '', $entranceFee);

		$buyin = Util::formatFloat($buyin, true);
//		$buyin = str_replace(',00', '', $buyin);
		
		$buyinInfo = '';
		$buyinInfo = ($buyin?$buyin.($entranceFee?'+':''):'');
		$buyinInfo = $buyinInfo.($entranceFee?$entranceFee:'');
		
		return $buyinInfo;
	}
	
	public function getStackChips($displayShort=false){
		
		$stackChips = parent::getStackChips();
		
		if( $displayShort )
			$stackChips = ($stackChips/1000).'K';
			
		return $stackChips;
	}
	
	public static function uploadPhoto($request, $eventLiveId){
		
		$eventLiveId          = $request->getParameter('eventLiveId', $eventLiveId);
		$allowedExtensionList = array('jpg', 'jpeg', 'png');
		$maxFileSize          = (1024*1024*4);
		
		$options = array('allowedExtensionList'=>$allowedExtensionList,
						 'maxFileSize'=>$maxFileSize);
	
		try {
			
			$fileObj = File::upload( $request, 'file', 'eventLivePhoto/eventLive-'.$eventLiveId, $options );
		}catch( Exception $e ){
		
			Util::forceError($e);	
		}
		
		$thumbPath = '/uploads/eventLivePhoto/eventLive-'.$eventLiveId.'/thumb';
		$fileObj->createThumbnail($thumbPath, 80, 60);
		$fileObj->resizeMax(800,600);
		
		$eventLivePhotoObj = new EventLivePhoto();
		$eventLivePhotoObj->setEventLiveId($eventLiveId);
		$eventLivePhotoObj->setFileId($fileObj->getId());
		$eventLivePhotoObj->save();
		
		return $eventLivePhotoObj;
	}
	
	public function getTotalBuyin($includeRebuys=false){
		
		$players = $this->getPlayers(true, false);
		
		$totalBuyin   = $players * $this->getBuyin();
		$totalBuyin  += $players * $this->getEntranceFee();
		
		if( $includeRebuys )
			$totalBuyin  += $this->getTotalRebuys();
		
		return $totalBuyin;
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
	
	public function updateVisitCount(){
		
		$eventLiveId = $this->getId();
		$className   = ucfirst(get_class($this));
		
		if( !MyTools::hasAttribute("visitCount$className-$eventLiveId") ){
			
			Util::executeQuery("SELECT update_event_live_visit_count($eventLiveId)");
			MyTools::setAttribute("visitCount$className-$eventLiveId", true);
		}
	}
	
	public function buildShortName(){
		
		$eventName = $this->getEventName();
		$eventName = preg_replace('/ ?-.*Garantidos?/i', '', $eventName);
		$eventName = preg_replace('/ ?Garantidos?/i', '', $eventName);
		$eventName = preg_replace('/ ?-.*/', '', $eventName);
		$eventName = substr($eventName, 0, 35);
		
		return $eventName;	
	}
	
	public function getPreviousEventLive(){
		
		if( is_object($this->eventLiveObjPrevious) )
			return $this->eventLiveObjPrevious;
		
		$criteria = new Criteria();
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );
		$criteria->add( EventLivePeer::RANKING_LIVE_ID, $this->getRankingLiveId() );
		$criteria->add( EventLivePeer::EVENT_DATE_TIME, $this->getEventDateTime(), Criteria::LESS_THAN );
		$criteria->addDescendingOrderByColumn( EventLivePeer::EVENT_DATE_TIME );
		$eventLiveObj = EventLivePeer::doSelectOne($criteria);
		
		if( !is_object($eventLiveObj) ){
			
			$eventLiveObj = new EventLive();
			$eventLiveObj->setId(0);
		}
		
		$this->eventLiveObjPrevious = $eventLiveObj;
		
		return $eventLiveObj;
	}
	
	public function getBalanceDifference(){
		
		$eventLiveObj       = $this->getPreviousEventLive();
		$totalBuyin         = $this->getTotalBuyin(true);
		$totalBuyinPrevious = $eventLiveObj->getTotalBuyin(true);
		
		if( $eventLiveObj->isNew() || $this->getIsNew() )
			return 0;
		
		$difference = $totalBuyin-$totalBuyinPrevious;
		$percent    = ($difference*100/($totalBuyinPrevious?$totalBuyinPrevious:1));
		
		if( !$totalBuyinPrevious )
			return 0;
		
		return $percent;
	}
	
	public function getBalanceStats(){
		
	    $balanceValue         = $this->getTotalBuyin(true);
	    $balanceChanges       = $this->getBalanceDifference();
		$previousBalanceValue = $this->getPreviousEventLive()->getTotalBuyin(true);
	    
	    return array('value'=>$balanceValue,
	    			 'changes'=>$balanceChanges,
	    			 'previous'=>$previousBalanceValue);
	}
	
	public function getStats($jsKeys=false){
		
		$visitCount     = $this->getVisitCount();
		$players        = $this->getPlayers(false, true);
		$playersConfirm = $this->getPlayers(true, false);
		
		$eventLiveObj = $this->getPreviousEventLive();
		
		if( $eventLiveObj->isNew() ){
			
			$visitCountPrevious     = 0;
			$playersPrevious        = 0;
			$playersConfirmPrevious = 0;
			
			$changesVisitCount    = 0;
			$changePlayers        = 0;
			$changePlayersConfirm = 0;
		}else{
			
			$visitCountPrevious     = $eventLiveObj->getVisitCount();
			$playersPrevious        = $eventLiveObj->getPlayers(false, true);
			$playersConfirmPrevious = $eventLiveObj->getPlayers();
			
			if( $this->getIsNew() ){
				
				$changesVisitCount = $changePlayers = $changePlayersConfirm = 0;
			}else{
			
				$changesVisitCount    = (($visitCount-$visitCountPrevious)*100/($visitCountPrevious?$visitCountPrevious:1));
				$changePlayers        = (($players-$playersPrevious)*100/($playersPrevious?$playersPrevious:1));
				$changePlayersConfirm = (($playersConfirm-$playersConfirmPrevious)*100/($playersConfirmPrevious?$playersConfirmPrevious:1));
			}
		}
		
		
		$numStatList = array();
		$numStatList[($jsKeys?'visitCount':'Visitas')]      = array('tagName'=>'visitCount',     'value'=>$visitCount, 'changes'=>$changesVisitCount, 'previous'=>$visitCountPrevious);
    	$numStatList[($jsKeys?'players':'Inscrições')]      = array('tagName'=>'players',        'value'=>$players, 'changes'=>$changePlayers, 'previous'=>$playersPrevious);
    	$numStatList[($jsKeys?'playersConfirm':'Confirm.')] = array('tagName'=>'playersConfirm', 'value'=>$playersConfirm, 'changes'=>$changePlayersConfirm, 'previous'=>$playersConfirmPrevious);
    	
    	return $numStatList;
	}
	
	public function getLastEventDateTime($format='Y-m-d H:i:s'){
		
		$isMultiday = $this->getIsMultiday();
		if( $isMultiday )
			return Util::executeOne('SELECT MAX(event_date_time) FROM event_live_schedule WHERE event_live_id = '.$this->getId(), 'timestamp');
		else
			return $this->getEventDateTime($format);
	}
	
	public function hasPreviousPendingResult(){
		
		// Se não possui ranking não tem evento para comparar resultados pendentes
		if( !$this->getRankingLiveId() )
			return false;

		return Util::executeOne('SELECT has_previous_pending_results('.$this->getId().')', 'boolean');
	}

	public function isPendingResult(){
		
		$hoursToPending    = Settings::getValue('hoursToPending');
		$lastEventDateTime = $this->getLastEventDateTime();
		$lastEventDateTime = strtotime($lastEventDateTime);
		
		return (!$this->getSavedResult() && ($lastEventDateTime < (time()-(3600*$hoursToPending))));
	}
	
	public function notifyPlayer($peopleId){
		
	  	$peopleObj = PeoplePeer::retrieveByPK( $peopleId );
	  	
	  	if( !is_object($peopleObj) )
	  		throw new Exception ('Não foi possível concluir o envio do email');
	  	
	  	$emailAddress = $peopleObj->getEmailAddress();
	  	
	  	if(!$emailAddress)
	  		throw new Exception('Email não cadastrado');
	  		
	  	$eventLivePlayerDisclosureEmailObj = EventLivePlayerDisclosureEmailPeer::retrieveByPK($this->getId(), $peopleId);
  		$emailLogObj = $eventLivePlayerDisclosureEmailObj->getEmailLog();
  		
  		if( $emailLogObj->getSendingSuccess() )
  			die($emailLogObj->getCreatedAt('d/m/Y H:i'));
  		
  		$emailLogObj->setEmailAddress($emailAddress);
  		$emailLogObj->save();
  		
  		$emailLogId = $emailLogObj->getId();
  		
  		$eventLivePlayerDisclosureEmailObj->setEmailLogId($emailLogId);
  		$eventLivePlayerDisclosureEmailObj->save();
  		
  		$emailContent = $this->getDisclosureEmailTemplate($peopleObj);
  		$emailSubject = $this->getDisclosureEmailSubject();
  		
  		$options = array('emailLogId'=>$emailLogId);
	  	Report::sendMail($emailSubject, $emailAddress, $emailContent, $options);
	  	
	  	echo $emailLogObj->getCreatedAt('d/m/Y H:i');
	}

	public function notifyPlayerSms($peopleId, $smsId){
		
		$clubId = MyTools::getAttribute('clubId');
		
	  	$peopleObj = PeoplePeer::retrieveByPK( $peopleId );
	  	
	  	if( !is_object($peopleObj) )
	  		throw new Exception ('Não foi possível concluir o envio do ss');
	  	
	  	$phoneNumber = $peopleObj->getPhoneNumber();
	  	$phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
	  	
	  	if(!$phoneNumber)
	  		throw new Exception('Telefone não cadastrado');
	  		
	  	$eventLivePlayerDisclosureSmsObj = EventLivePlayerDisclosureSmsPeer::retrieveByPK($this->getId(), $peopleId);
  		$smsLogObj = $eventLivePlayerDisclosureSmsObj->getSmsLog();
  		
  		if( $smsLogObj->getSendingSuccess() )
  			die($smsLogObj->getCreatedAt('d/m/Y H:i'));
  		
  		$smsLogObj->setPhoneNumber('55'.$phoneNumber);
  		$smsLogObj->setSmsId($smsId);
  		$smsLogObj->save();
  		
  		$smsLogId = $smsLogObj->getId();
  		
  		$eventLivePlayerDisclosureSmsObj->setSmsLogId($smsLogId);
  		$eventLivePlayerDisclosureSmsObj->setSmsId($smsId);
  		$eventLivePlayerDisclosureSmsObj->save();
  		
  		$smsObj = SmsPeer::retrieveByPK($smsId);
	  	$result = $smsObj->sendSms($phoneNumber, $smsLogObj, $clubId);
	  	
	  	if( $result=='000' )
	  		echo $smsLogObj->getCreatedAt('d/m/Y H:i');
	  	else
	  		Util::forceError($smsLogObj->getErrorMessage());
	}
	
	public function getDisclosureEmailTemplate($peopleObj){
		
	  	$emailContent = $this->getEmailTemplate()->getContent();
		
		return Report::replace($emailContent, $this->getReplaceTags($peopleObj));	
	}
	
	public function getReplaceTags($peopleObj){
		
		$entranceFee = $this->getEntranceFee();
		$buyin       = $this->getBuyin();
		
		$comments = $this->getComments();
		
		$infoList = $this->getInfo();
		$infoList['eventName']       = $this->getEventName();
		$infoList['eventShortName']  = $this->getEventShortName();
		$infoList['stepNumber']      = $this->getStepNumber();
		$infoList['rankingName']     = $this->getRankingLive()->getRankingName();
		$infoList['gameStyle']       = $this->getGameStyle()->getDescription();
		$infoList['gameType']        = $this->getGameType()->getDescription();
		$infoList['eventPlace']      = $this->getEventPlace();
		$infoList['mapsLink']        = $this->getClub()->getMapsLink();
		$infoList['eventDate']       = $this->getEventDate('d/m/Y');
		$infoList['startTime']       = $this->getStartTime('H:i');
		$infoList['entranceFee']     = Util::formatFloat($entranceFee, true);
		$infoList['buyin']           = Util::formatFloat($buyin, true).($entranceFee?'+'.$infoList['entranceFee']:'');
		$infoList['guaranteedPrize'] = Util::formatFloat($this->getGuaranteedPrize(), true);
		$infoList['eventDateWrite']  = $this->getEventDateWrite();
		$infoList['fileNameLogo']    = $this->getFileNameLogo();
		$infoList['description']     = $this->getDescription(true);
		$infoList['comments']        = ($comments?'<separator>'.$comments:'');
		$infoList['eventWeekDay']    = $weekDay = $this->getWeekDay();
		$infoList['clubLink']        = $this->getClub()->getLink();
		$infoList['eventLink']       = $this->getLink();
		
		if( is_object($peopleObj) )
			$infoList['peopleName'] = $peopleObj->getFirstName();
		
		return $infoList;
	}
	
	public function getLink(){
		
		$host        = MyTools::getRequest()->getHost();
		$eventLiveId = $this->getId();
		
		$code = base64_encode($eventLiveId);
		
		return 'http://'.$host.'/eventLive/'.$code;
	}

	public function getDisclosureEmailSubject(){
		
	  	return 'Notificação de evento / '.$this->getClub()->toString();		
	}
	
	public function getFileNameLogo(){
		
		$fileNameLogo = $this->getRankingLive()->getFileNameLogo();
	
		if( $fileNameLogo=='noImage.png' )
			$fileNameLogo = 'club/original/'.$this->getClub()->getFileNameLogo();
		else
			$fileNameLogo = 'ranking/'.$fileNameLogo;
		
		return $fileNameLogo;
	}
	
	public function getTwitterStatus(){
		
  		$twitterTemplate = Settings::getValue('twitterTemplate');
		$twitterTemplate = $this->replaceTemplate($twitterTemplate);
		
		return $twitterTemplate;
	}
	
	public function getFacebookDescription(){
		
		$facebookDescription = "[eventName]\n@[clubName] [eventDateTime]";
		$facebookDescription = $this->replaceTemplate($facebookDescription);
		
		return $facebookDescription;
	}

	public function replaceTemplate($template){
		
		$shareId = base64_encode($this->getId());
		
		$template = str_replace('[eventName]',     $this->toString(), 						$template);
		$template = str_replace('[eventDateTime]', $this->getEventDateTime('d/m/Y H:i'), 	$template);
		$template = str_replace('[weekDay]',       $this->getWeekDay(), 					$template);
		$template = str_replace('[clubName]',      $this->getClub()->toString(), 			$template);
		$template = str_replace('[clubLocation]',  $this->getClub()->getLocation(), 		$template);
		$template = str_replace('[allowedRebuys]', $this->getAllowedRebuys(), 				$template);
		$template = str_replace('[allowedAddons]', $this->getAllowedAddons(), 				$template);
		$template = str_replace('[isFreeroll]',    $this->getIsFreeroll(), 					$template);
		$template = str_replace('[rakePercent]',   $this->getRakePercent(), 				$template);
		$template = str_replace('[entranceFee]',   $this->getEntranceFee(), 				$template);
		$template = str_replace('[buyin]',         $this->getBuyin(), 						$template);
		$template = str_replace('[blindTime]',     $this->getBlindTime('H:i'), 				$template);
		$template = str_replace('[stackChips]',    $this->getStackChips(), 					$template);
		$template = str_replace('[players]',       $this->getPlayers(), 					$template);
		$template = str_replace('[savedResult]',   $this->getSavedResult(), 				$template);
		$template = str_replace('[eventUrl]',      'http://'.MyTools::getRequest()->getHost().'/index.php/eventLive/details/shareId/'.$shareId, $template);
		
		return $template;
	}
	
	public function getEventDateWrite(){
		
		return $this->getEventDateTime('d/m/Y H:i');
	}
	
	public function isEnrollmentOpen(){
		
		$enrollmentStartDate = $this->getEnrollmentStartDate(null);
		
		return (is_null($enrollmentStartDate) || $enrollmentStartDate <= time());
	}
	
	public function getWeekDay(){
		
		return Util::getWeekDay($this->getEventDateTime('d/m/Y'));
	}
	
	public function getPhotoList(){
		
		$criteria = new Criteria();
		$criteria->add( EventLivePhotoPeer::EVENT_LIVE_ID, $this->getId() );
		$criteria->add( EventLivePhotoPeer::DELETED, false );
		$criteria->addDescendingOrderByColumn( EventLivePhotoPeer::CREATED_AT );
		return EventLivePhotoPeer::doSelect($criteria);
	}
	
	public function updatePlayers(){
		
		Util::executeQuery('SELECT update_event_live_players('.$this->getId().')');
	}
	
	public function cutUnconfirmedPlayers(){
		
		Util::executeQuery('UPDATE event_live_player SET enrollment_status = \'\' WHERE event_live_id = '.$this->getId().' AND NOT enabled');
		$this->updatePlayers();
	}
	
	public function getScheduleList($criteria=null){
		
		if( !$this->getIsMultiday() ){
			
			$eventLiveScheduleObj = new EventLiveSchedule();
			$eventLiveScheduleObj->setEventDate($this->getEventDate());
			$eventLiveScheduleObj->setStartTime($this->getStartTime());
			$eventLiveScheduleObj->setEventDateTime($this->getEventDateTime());
			$eventLiveScheduleObj->setDaysAfter(0);
			
			return array($eventLiveScheduleObj);
		}
		
		if( is_null($criteria) )
			$criteria = new Criteria();
		
		$criteria->addAscendingOrderByColumn( EventLiveSchedulePeer::EVENT_DATE_TIME );
		return $this->getEventLiveScheduleList($criteria);
	}
	
	public static function getXml($eventList){
		
		return Util::buildXml($eventList, 'eventLives', 'eventLive');
	}
	
	public function toString(){
	
		$stepNumber      = $this->getStepNumber();
		$guaranteedPrize = $this->getGuaranteedPrize();
		$isSatellite     = $this->getIsSatellite();
		
		if( $stepNumber )
			$stepNumber = $stepNumber.'ª Etapa ';
		
		if( $guaranteedPrize ){
			
			if( $guaranteedPrize >=1000 && !$isSatellite )
				$guaranteedPrize = ($guaranteedPrize/1000).'K';
			
			$guaranteedPrize = " - $guaranteedPrize ".($isSatellite?'VGS ':'')."GTD";
		}else
			$guaranteedPrize = '';
		
		return $stepNumber.$this->getEventName().$guaranteedPrize;
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['eventName']      = $this->getEventName();
		$infoList['eventDateTime']  = $this->getEventDateTime('d/m/Y H:i');
		$infoList['weekDay']        = $this->getWeekDay();
		$infoList['clubName']       = $this->getClub()->toString();
		$infoList['clubLocation']   = $this->getClub()->getLocation();
		$infoList['allowedRebuys']  = $this->getAllowedRebuys();
		$infoList['allowedAddons']  = $this->getAllowedAddons();
		$infoList['isFreeroll']     = $this->getIsFreeroll();
		$infoList['rakePercent']    = $this->getRakePercent();
		$infoList['entranceFee']    = $this->getEntranceFee();
		$infoList['buyin']          = $this->getBuyin();
		$infoList['blindTime']      = $this->getBlindTime('H:i');
		$infoList['stackChips']     = $this->getStackChips();
		$infoList['players']        = $this->getPlayers();
		$infoList['savedResult']    = $this->getSavedResult();
		
		return $infoList;
	}
}
