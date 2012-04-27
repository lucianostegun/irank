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
	
	public function getIsNew(){
		
		return ($this->isNew() || (!$this->getVisible() && !$this->getEnabled() && !$this->getDeleted()));
	}
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

//    		$this->postOnWall();
    		
    		$this->setEventDateTime($this->getEventDate('Y-m-d').' '.$this->getStartTime());

			parent::save();
			
        	Log::quickLog('event_live', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('event_live', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
	}
	
	public function quickSave($request){
		
		$clubId           = $request->getParameter('clubId');
		$rankingLiveId    = $request->getParameter('rankingLiveId');
		$eventName        = $request->getParameter('eventName');
		$eventShortName   = $request->getParameter('eventShortName');
		$eventDate        = $request->getParameter('eventDate');
		$startTime        = $request->getParameter('startTime');
		$isFreeroll       = $request->getParameter('isFreeroll');
		$entranceFee      = $request->getParameter('entranceFee');
		$buyin            = $request->getParameter('buyin');
		$rakePercent      = $request->getParameter('rakePercent');
		$blindTime        = $request->getParameter('blindTime');
		$stackChips       = $request->getParameter('stackChips');
		$allowedRebuys    = $request->getParameter('allowedRebuys');
		$allowedAddons    = $request->getParameter('allowedAddons');
		$isIlimitedRebuys = $request->getParameter('isIlimitedRebuys');
		$description      = $request->getParameter('description');
		$comments         = $request->getParameter('comments');
		$suppressSchedule = $request->getParameter('suppressSchedule');
		
		if( preg_match('/^[0-9]*[,\.]?[0-9]*[kK]$/', $stackChips) )
			$stackChips = Util::formatFloat($stackChips)*1000;

		if( $isFreeroll )
			$buyin = 0;
		
		$this->setClubid($clubId);
		$this->setRankingLiveId(($rankingLiveId?$rankingLiveId:null));
		$this->setEventName($eventName);
		$this->setEventShortName(($eventShortName?$eventShortName:null));
		$this->setEventDate(Util::formatDate($eventDate));
		$this->setStartTime($startTime);
		$this->setIsFreeroll(($isFreeroll?true:false));
		$this->setEntranceFee(Util::formatFloat($entranceFee));
		$this->setBuyin(Util::formatFloat($buyin));
		$this->setBlindTime($blindTime);
		$this->setRakePercent(Util::formatFloat($rakePercent));
		$this->setStackChips($stackChips);
		$this->setAllowedRebuys($allowedRebuys);
		$this->setAllowedAddons($allowedAddons);
		$this->setIsIlimitedRebuys(($isIlimitedRebuys?true:false));
		$this->setDescription($description);
		$this->setComments(($comments?$comments:null));
		
		// Informações da aba Options
		$this->setSuppressSchedule(($suppressSchedule?true:false));
		
		$this->setEnabled(true);
		$this->setVisible(true);
		$this->setDeleted(false);
		$this->save();
	}
	
	public static function getList(Criteria $criteria=null, $clubId=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );
		
		if( $clubId )
			$criteria->add( EventLivePeer::CLUB_ID, $clubId );

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
			foreach($this->getEventLivePlayerList($criteria) as $eventLivePlayerObj){
				
				$eventLivePlayerObj->setEventPosition(++$lastValidEventPosition);
				$eventLivePlayerObj->save();
				
				$peopleId = $eventLivePlayerObj->getPeopleId();
			}
			
			$this->setSavedResult(true);
			$this->save();
			
			$rankingLiveObj = $this->getRankingLive();
				
			if( is_object($rankingLiveObj) ){
				
				$rankingLiveObj->updateScores();
				$rankingLiveObj->updatePlayerEvents();
				$rankingLiveObj->updateHistory($this->getEventDate('d/m/Y'));
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
	
	public function getPlayerStatus($peopleId, $boolean=false){
		
		if( !$peopleId )
			return 'no';
		
		$enabled = Util::executeOne('SELECT enabled FROM event_live_player WHERE event_live_id = '.$this->getId().' AND people_id = '.$peopleId, 'boolean');
		
		if( $boolean )
			return $enabled;
		else
			return ($enabled?'yes':'no');
	}
	
	public function getPlayers($updated=false, $countAll=false){
		
		if( $countAll )
			// Considera todos os jogadores que se inscreveram
			return Util::executeOne('SELECT COUNT(1) FROM event_live_player WHERE event_live_id = '.$this->getId());
		elseif( $updated )
			return Util::executeOne('SELECT get_event_live_players('.$this->getId().')');
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
	
	public function parseScore($position, $events, $prize, $players, $totalBuyins, $buyin, $itm){
		
		$formula = $this->getRankingLive()->getScoreFormula();
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
		
		$score = null;
		
		@eval('$score = '.$formula.';');
		
		if( $score===null )
			throw new Exception('Erro ao processar a fórmula de pontuação:\n'.'$score = '.$formula.';');
		
		return number_format($score, 3);		
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
			
		$criteria->add( EventLivePlayerPeer::ENABLED, true );
		$criteria->addAscendingOrderByColumn( EventLivePlayerPeer::EVENT_POSITION );
		
		return parent::getEventLivePlayerList($criteria, $con);
	}
	
	public function getEventLivePlayerResultList($criteria=null, $forceEventResult=false){
		
		// Se o evento tiver um ranking, retorna a classificação do ranking e não do evento
		if( $this->getRankingLiveId() && !$forceEventResult )
			return $this->getRankingLive()->getClassify();
			
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( EventLivePlayerPeer::ENABLED, true );
		$criteria->addAnd( EventLivePlayerPeer::EVENT_POSITION, 0, Criteria::GREATER_THAN );
		$criteria->add( EventLivePlayerPeer::EVENT_POSITION, null, Criteria::NOT_EQUAL );
		$criteria->addAscendingOrderByColumn( EventLivePlayerPeer::EVENT_POSITION );
		
		return $this->getEventLivePlayerList($criteria);
	}
	
	public function getDescription($convertTags=true){
		
		$description = parent::getDescription();
		
		if( $convertTags )
			$description = preg_replace('/<descri[çc]+[ã]+o ?do ?ranking>/i', $this->getRankingLive()->getDescription(), $description);
		
		return $description;
	}
	
	public function toString(){
	
		return ($this->getEventShortName()?$this->getEventShortName():$this->getEventName());	
	}
	
	public function getBuyinInfo(){
		
		if( $this->getIsFreeroll() )
			return 'Freeroll';
			
		$buyin       = $this->getBuyin();
		$entranceFee = $this->getEntranceFee();
		
		$entranceFee = Util::formatFloat($entranceFee, true);
		$entranceFee = str_replace(',00', '', $entranceFee);

		$buyin = Util::formatFloat($buyin, true);
		$buyin = str_replace(',00', '', $buyin);
		
		$buyinInfo = '';
		$buyinInfo = ($buyin?$buyin.($entranceFee?'+':''):'');
		$buyinInfo = $buyinInfo.($entranceFee?Util::formatFloat($entranceFee, true):'');
		
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
		
		$players = $this->getPlayers();
		
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
		
		$prizeSplit = split('((; ?)|(, +))', $this->getPrizeSplit());
		
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
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['eventName']      = $this->getEventName();
		$infoList['eventDateTime']  = $this->getEventDateTime('d/m/Y H:i');
		$infoList['weekDay']        = Util::getWeekDay($this->getEventDateTime('d/m/Y'));
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
		
		return $infoList;
	}
}
