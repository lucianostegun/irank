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
		$this->setStartTime($startTime);
		$this->setIsFreeroll(($isFreeroll?true:false));
		$this->setBuyin(Util::formatFloat($buyin));
		$this->setEntranceFee(Util::formatFloat($entranceFee));
		$this->setBlindTime($blindTime);
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
			$this->saveRankingLive($clubIdList, true);
		else
			$this->saveRankingLive(array($clubIdList), false);
	}
	
	public function saveRankingLive($clubIdList, $delete){
		
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
	
	public static function getList($clubId=null){
		
		$criteria = new Criteria();
		$criteria->add( RankingLivePeer::ENABLED, true );
		$criteria->add( RankingLivePeer::VISIBLE, true );
		$criteria->add( RankingLivePeer::DELETED, false );
		
		if( $clubId ){
			
			$criteria->add( ClubRankingLivePeer::CLUB_ID, $clubId );
			$criteria->add( ClubRankingLivePeer::ENABLED, true );
			$criteria->addJoin( RankingLivePeer::ID, ClubRankingLivePeer::RANKING_LIVE_ID, Criteria::INNER_JOIN );
		}
		
		return RankingLivePeer::doSelect($criteria);
	}

	public static function getOptionsForSelect($clubId, $defaultValue=false, $returnArray=false){
		
		$rankingLiveObjList = self::getList($clubId);

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
		$criteria->add( ClubRankingLivePeer::ENABLED, true );
		$criteria->add( UserAdminPeer::ID, $userAdminId );
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
	
	public function getPlayerList(){
		
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
		
		foreach($this->getPlayerList() as $rankingLivePlayerObj){
			
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
			$rankingLiveHistoryObj->updateInfo();
			$rankingLiveHistoryObj->save();
		}
	}
	
	public function getClassify($rankingDate=null){
		
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
	  	
	  	$rankingLivePlayerObjList = $this->getPlayerList($orderByList);
	  	$lastList = array();
	  	foreach($rankingLivePlayerObjList as $key=>$rankingLivePlayerObj){
	  		
	  		if( $rankingLivePlayerObj->getTotalPaid()==0 ){
	  			
	  			$lastList[] = $rankingLivePlayerObj;
	  			unset($rankingLivePlayerObjList[$key]);
	  		}
	  	}
	  	
	  	return array_merge($rankingLivePlayerObjList, $lastList);
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
		
		return $infoList;
	}
}
