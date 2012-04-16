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
		$defaultStartTime        = $request->getParameter('defaultStartTime');
		$defaultIsFreeroll       = $request->getParameter('defaultIsFreeroll');
		$defaultBuyin            = $request->getParameter('defaultBuyin');
		$defaultEntranceFee      = $request->getParameter('defaultEntranceFee');
		$defaultBlindTime        = $request->getParameter('defaultBlindTime');
		$defaultStackChips       = $request->getParameter('defaultStackChips');
		$defaultAllowedRebuys    = $request->getParameter('defaultAllowedRebuys');
		$defaultAllowedAddons    = $request->getParameter('defaultAllowedAddons');
		$defaultIsIlimitedRebuys = $request->getParameter('defaultIsIlimitedRebuys');
		
		if( preg_match('/^[0-9]*[,\.]?[0-9]*[kK]$/', $defaultStackChips) )
			$defaultStackChips = Util::formatFloat($defaultStackChips)*1000;

		if( $defaultIsFreeroll )
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
		$this->setDefaultStartTime($defaultStartTime);
		$this->setDefaultIsFreeroll(($defaultIsFreeroll?true:false));
		$this->setDefaultBuyin(Util::formatFloat($defaultBuyin));
		$this->setDefaultEntranceFee(Util::formatFloat($defaultEntranceFee));
		$this->setDefaultBlindTime($defaultBlindTime);
		$this->setDefaultStackChips($defaultStackChips);
		$this->setDefaultAllowedRebuys($defaultAllowedRebuys);
		$this->setDefaultAllowedAddons($defaultAllowedAddons);
		$this->setDefaultIsIlimitedRebuys(($defaultIsIlimitedRebuys?true:false));
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
	
	public function getDefaultStackChips($displayShort=false){
		
		$defaultStackChips = parent::getDefaultStackChips();
		
		if( $displayShort )
			$defaultStackChips = ($defaultStackChips/1000).'K';
			
		return $defaultStackChips;
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']                      = $this->getId();
		$infoList['defaultStartTime']        = $this->getDefaultStartTime('H:i');
		$infoList['defaultIsFreeroll']       = $this->getDefaultIsFreeroll();
		$infoList['defaultBuyin']            = $this->getDefaultBuyin();
		$infoList['defaultEntranceFee']      = $this->getDefaultEntranceFee();
		$infoList['defaultBlindTime']        = $this->getDefaultBlindTime('H:i');
		$infoList['defaultStackChips']       = $this->getDefaultStackChips(true);
		$infoList['defaultAllowedRebuys']    = $this->getDefaultAllowedRebuys();
		$infoList['defaultAllowedAddons']    = $this->getDefaultAllowedAddons();
		$infoList['defaultIsIlimitedRebuys'] = $this->getDefaultIsIlimitedRebuys();
		
		return $infoList;
	}
}
