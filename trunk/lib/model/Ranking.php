<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking'.
 *
 * 
 *
 * @package lib.model
 */ 
class Ranking extends BaseRanking
{
	
	public function cleanRecord(){
		
		Util::executeQuery('DELETE FROM ranking_player WHERE ranking_id = '.$this->getId());
		Util::executeQuery('UPDATE event SET ranking_id = null WHERE ranking_id = '.$this->getId());
		Util::executeQuery('UPDATE ranking SET players=0, events=0 WHERE id = '.$this->getId());
	}
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

    		$this->postOnWall();
    		
			parent::save();
			
       		Log::quickLog('ranking', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('ranking', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setDeleted(true);
		$this->save();
		
		Log::quickLogDelete('ranking', $this->getPrimaryKey());
		
		$this->notifyDelete();
	}
	
	public function getCode(){
		
		return '#'.sprintf('%04d', $this->getId());
	}
	
	public static function getList($onlyMine=false){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		$peopleId   = MyTools::getAttribute('peopleId');
		
		$criteria = new Criteria();
		$criteria->add( RankingPeer::ENABLED, true );
		$criteria->add( RankingPeer::VISIBLE, true );
		$criteria->add( RankingPeer::DELETED, false );
		
		if( $onlyMine ){
		
			$criterion = $criteria->getNewCriterion( RankingPeer::USER_SITE_ID, $userSiteId );
			
			$criterion2 = $criteria->getNewCriterion( RankingPlayerPeer::PEOPLE_ID, $peopleId );
			$criterion2->addAnd( $criteria->getNewCriterion( RankingPlayerPeer::ALLOW_EDIT, true ) );
			
			$criterion->addOr($criterion2);
			
			$criteria->add($criterion);
		}
		
		$criteria->addAscendingOrderByColumn( RankingPeer::RANKING_NAME );
		
		return RankingPeer::doSelect( $criteria );
	}

	public static function getOptionsForSelect( $defaultValue=false, $returnArray=false, $onlyMine=false ){
		
		$rankingObjList = self::getList($onlyMine);

		$optionList = array();
		$optionList[''] = 'Selecione';
		foreach( $rankingObjList as $rankingObj )			
			$optionList[$rankingObj->getId()] = $rankingObj->getRankingName();
		
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
	
	public function getPeopleList($returnPeople=false, $orderByList=null){
		
		$criteria = new Criteria();
		$criteria->add( RankingPlayerPeer::ENABLED, true );
		$criteria->add( RankingPlayerPeer::RANKING_ID, $this->getId() );
		$criteria->addJoin( RankingPlayerPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		
		if( is_array($orderByList) ){

			foreach( $orderByList as $orderBy=>$order ){
				
				if( $order=='desc' )
					$criteria->addDescendingOrderByColumn( $orderBy );
				else
					$criteria->addAscendingOrderByColumn( $orderBy );
			}
		}
		
		$criteria->addAscendingOrderByColumn( PeoplePeer::FULL_NAME );
		
		if( $returnPeople )
			return PeoplePeer::doSelect($criteria);
		else
			return RankingPlayerPeer::doSelect($criteria);
	}
	
	public function getPlayerList($orderByList=null){
		
		return $this->getPeopleList(false, $orderByList);
	}
	
	public function addPlayer($peopleId){
		
		$rankingPlayerObj = RankingPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		
		if( !is_object($rankingPlayerObj) ){
			
			$rankingPlayerObj = new RankingPlayer();
			$rankingPlayerObj->setRankingId( $this->getId() );
			$rankingPlayerObj->setPeopleId( $peopleId );
			$rankingPlayerObj->setTotalPaid( 0.00 );
			$rankingPlayerObj->setTotalPrize( 0.00 );
			$rankingPlayerObj->setTotalBalance( 0.00 );
		}

		if( !$rankingPlayerObj->getEnabled() ){
			
			$rankingPlayerObj->getPeople()->sendPlayerNotify($this);
			
			$this->setPlayers( $this->getPlayers()+1 );
			$this->save();
		}
		
		$rankingPlayerObj->setEnabled( true );
		$rankingPlayerObj->save();
	}
	
	public function deletePlayer($peopleId){

		$rankingPlayerObj = RankingPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		
		if( is_object($rankingPlayerObj) ){
			
			$rankingPlayerObj->setEnabled( false );
			$rankingPlayerObj->save();
			
			$this->setPlayers( $this->getPlayers()-1 );
			$this->save();
		}else{
			
			throw new Exception('Membro não encontrado');
		}
	}
	
	public function getEventList($criteria=null, $con=null){
		
		$criteria = (is_object($criteria)?$criteria:new Criteria());
		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::VISIBLE, true );
		$criteria->add( EventPeer::DELETED, false );
		$criteria->add( EventPeer::RANKING_ID, $this->getId() );
		$criteria->addDescendingOrderByColumn( EventPeer::EVENT_DATE );
		$criteria->addDescendingOrderByColumn( EventPeer::START_TIME );
		
		return EventPeer::doSelect($criteria);
	}
	
	public function getRankingType($returnTagName=false){
		
		$virtualTableObj = $this->getVirtualTableRelatedByRankingTypeId();
		
		if( !is_object($virtualTableObj) )
			$virtualTableObj = new VirtualTable();
		
		if( $returnTagName )
			return $virtualTableObj->getTagName();
		else
			return $virtualTableObj;
	}
	
	public function getGameStyle($returnTagName=false){
		
		$virtualTableObj = $this->getVirtualTableRelatedByGameStyleId();
		
		if( !is_object($virtualTableObj) )
			$virtualTableObj = new VirtualTable();
		
		if( $returnTagName )
			return $virtualTableObj->getTagName();
		else
			return $virtualTableObj;
	}
	
	public function isRankingType($tagName){
		
		return $this->getRankingType()->isTagName($tagName);
	}
	
	public function updateInfo($peopleId, $dateStart=null, $dateFinish=null){

		/**
		 * Este método é utilizado para atualizar a tabela de ranking temporário
		 * utilizada para gerar histórico de rankings
		 */
		if( $dateStart || $dateFinish )
			$rankingPlayerObj = RankingPlayerTmpPeer::retrieveByPK($this->getId(), $peopleId);
		else
			$rankingPlayerObj = RankingPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		
		$rankingPlayerObj->updateInfo($dateStart, $dateFinish);
	}
	
	public function updateScores(){

	  	$rankingPlayerObjList = $this->getPlayerList(null);

	  	foreach( $rankingPlayerObjList as $rankingPlayerObj )
	  		$rankingPlayerObj->updateInfo();
	}
	
	public function getEventDateList($format='d/m/Y', $saved=true, $orderByList=array()){
		
		$criteria = new Criteria();
		$criteria->add( EventPeer::SAVED_RESULT, $saved );
		
		$criteria->addOrderBy($orderByList);
		
		$criteria->addAscendingOrderByColumn( EventPeer::EVENT_DATE );
		$eventObjList = $this->getEventList($criteria);
		
		$eventDateList = array();
		foreach($eventObjList as $eventObj)
			$eventDateList[] = $eventObj->getEventDate($format);
		
		return array_unique($eventDateList);
	}
	
	public function updateWholeHistory(){

		foreach($this->getEventDateList() as $eventDate)
			$this->getClassifyHistory($eventDate, true);
	}
	
	public function updateHistory($rankingDate){

		$rankingDate = Util::formatDate($rankingDate);
		Util::executeQuery('DELETE FROM ranking_history WHERE ranking_id = '.$this->getId().' AND ranking_date = \''.$rankingDate.'\'');
		
		foreach($this->getPlayerList() as $rankingPlayerObj){
			
			$rankingHistoryObjLast = $rankingPlayerObj->getLastHistory($rankingDate);
			
			$rankingHistoryObj = new RankingHistory();
			$rankingHistoryObj->setRankingId($rankingHistoryObjLast->getRankingId());
			$rankingHistoryObj->setPeopleId($rankingHistoryObjLast->getPeopleId());
			$rankingHistoryObj->setRankingDate($rankingDate);
			$rankingHistoryObj->setEnabled($rankingPlayerObj->getEnabled());
			$rankingHistoryObj->setTotalEvents($rankingHistoryObjLast->getTotalEvents()+0);
			$rankingHistoryObj->setTotalScore($rankingHistoryObjLast->getTotalScore()+0);
			$rankingHistoryObj->setTotalBalance($rankingHistoryObjLast->getTotalBalance()+0);
			$rankingHistoryObj->setTotalPrize($rankingHistoryObjLast->getTotalPrize()+0);
			$rankingHistoryObj->setTotalPaid($rankingHistoryObjLast->getTotalPaid()+0);
			
			$rankingHistoryObj->setEvents(0);
			$rankingHistoryObj->setScore(0);
			$rankingHistoryObj->setBalanceValue(0);
			$rankingHistoryObj->setPrizeValue(0);
			$rankingHistoryObj->setPaidValue(0);
			$rankingHistoryObj->updateInfo();
			$rankingHistoryObj->save();
		}
		
		$this->getClassifyHistory($rankingDate, true);
	}
	
	public function updatePlayerEvents(){
		
		$sql = 'UPDATE 
				    ranking_player
				SET 
				    total_events = (SELECT 
				                        COUNT(1) 
				                    FROM 
				                        event_player
				                        INNER JOIN event ON event_player.EVENT_ID=event.ID
				                    WHERE
				                        event.RANKING_ID='.$this->getId().'
				                        AND event_player.ENABLED = true
				                        AND event.RANKING_ID=ranking_player.RANKING_ID
				                        AND event_player.PEOPLE_ID=ranking_player.PEOPLE_ID
				                        AND event.DELETED = FALSE
				                        AND event.VISIBLE = TRUE
				                        AND event.ENABLED = TRUE
				                        AND event.SAVED_RESULT = TRUE)';
		Util::executeQuery($sql);
	}
	
	public function getClassifyHistory($rankingDate, $save=false){

	  	$defaultOrderByList = array();
	  	$defaultOrderByList[RankingHistoryPeer::TOTAL_PRIZE]   = 'desc';
	  	$defaultOrderByList[RankingHistoryPeer::TOTAL_BALANCE] = 'desc';
	  	$defaultOrderByList[RankingHistoryPeer::TOTAL_PAID]    = 'asc';
	  	$defaultOrderByList[RankingHistoryPeer::TOTAL_AVERAGE] = 'desc';
	  	$defaultOrderByList[RankingHistoryPeer::TOTAL_EVENTS]  = 'asc';
	  	$defaultOrderByList[RankingHistoryPeer::PEOPLE_ID]     = 'asc';
	  	
	  	$rankingType = $this->getRankingType(true);
	  	
		switch($rankingType){
			case 'value':
				$orderByList = array(RankingHistoryPeer::TOTAL_PRIZE=>'desc');
				break;
			case 'balance':
				$orderByList = array(RankingHistoryPeer::TOTAL_BALANCE=>'desc');
				break;
			case 'score':
				$orderByList = array(RankingHistoryPeer::TOTAL_SCORE=>'desc');
				break;
			case 'average':
				$orderByList = array(RankingHistoryPeer::TOTAL_AVERAGE=>'desc');
				break;
		}
	  	
	  	$orderByList = array_merge($orderByList, $defaultOrderByList);
	  	
	  	$criteria = new Criteria();
	  	$criteria->add( RankingHistoryPeer::RANKING_DATE, Util::formatDate($rankingDate) );
	  	$criteria->add( RankingHistoryPeer::RANKING_ID, $this->getId() );
	  	
	  	if( is_array($orderByList) ){

			foreach( $orderByList as $orderBy=>$order ){
				
				if( $order=='desc' )
					$criteria->addDescendingOrderByColumn( $orderBy );
				else
					$criteria->addAscendingOrderByColumn( $orderBy );
			}
		}
		
	  	$rankingHistoryObjList = RankingHistoryPeer::doSelect($criteria);

	  	$lastList = array();
	  	foreach($rankingHistoryObjList as $key=>$rankingHistoryObj){
	  		
	  		if( $rankingHistoryObj->getTotalPaid()==0 ){
	  			
	  			$lastList[] = $rankingHistoryObj;
	  			unset($rankingHistoryObjList[$key]);
	  		}
	  	}
	  	
	  	$rankingHistoryObjListReturn = array_merge($rankingHistoryObjList, $lastList);
	  	
	  	if( $save ){

			$players         = $this->getPlayers();
	  		$rankingPosition = 1;
	  		foreach($rankingHistoryObjList as $rankingHistoryObj){

	  			$rankingHistoryObj->setTotalRankingPosition($rankingPosition++);
	  			$rankingHistoryObj->save();
	  		}
	  		
	  		foreach($lastList as $rankingHistoryObj){

	  			$rankingHistoryObj->setTotalRankingPosition($players);
	  			$rankingHistoryObj->save();
	  		}

	
			// Salva a posição de cada jogador na data do evento
	
		  	$defaultOrderByList = array();
		  	$defaultOrderByList[RankingHistoryPeer::PRIZE_VALUE]   = 'desc';
		  	$defaultOrderByList[RankingHistoryPeer::BALANCE_VALUE] = 'desc';
		  	$defaultOrderByList[RankingHistoryPeer::PAID_VALUE]    = 'asc';
		  	$defaultOrderByList[RankingHistoryPeer::AVERAGE]       = 'desc';
		  	$defaultOrderByList[RankingHistoryPeer::EVENTS]        = 'asc';
		  	$defaultOrderByList[RankingHistoryPeer::TOTAL_PRIZE]   = 'desc';
		  	$defaultOrderByList[RankingHistoryPeer::TOTAL_BALANCE] = 'desc';
		  	$defaultOrderByList[RankingHistoryPeer::TOTAL_PAID]    = 'asc';
		  	$defaultOrderByList[RankingHistoryPeer::TOTAL_AVERAGE] = 'desc';
		  	$defaultOrderByList[RankingHistoryPeer::TOTAL_EVENTS]  = 'asc';
		  	$defaultOrderByList[RankingHistoryPeer::PEOPLE_ID]     = 'asc';
	
			switch($rankingType){
				case 'value':
					$orderByList = array(RankingHistoryPeer::PRIZE_VALUE=>'desc');
					break;
				case 'balance':
					$orderByList = array(RankingHistoryPeer::BALANCE_VALUE=>'desc');
					break;
				case 'score':
					$orderByList = array(RankingHistoryPeer::SCORE=>'desc');
					break;
				case 'average':
					$orderByList = array(RankingHistoryPeer::AVERAGE=>'desc');
					break;
			}
			
			$orderByList = array_merge($orderByList, $defaultOrderByList);
		  	
		  	$criteria = new Criteria();
		  	$criteria->add( RankingHistoryPeer::RANKING_DATE, Util::formatDate($rankingDate) );
		  	$criteria->add( RankingHistoryPeer::RANKING_ID, $this->getId() );
		  	
		  	if( is_array($orderByList) ){
	
				foreach( $orderByList as $orderBy=>$order ){
					
					if( $order=='desc' )
						$criteria->addDescendingOrderByColumn( $orderBy );
					else
						$criteria->addAscendingOrderByColumn( $orderBy );
				}
			}
			
		  	$rankingHistoryObjList = RankingHistoryPeer::doSelect($criteria);
	
		  	$lastList = array();
		  	foreach($rankingHistoryObjList as $key=>$rankingHistoryObj){
		  		
		  		if( $rankingHistoryObj->getPaidValue()==0 ){
		  			
		  			$lastList[] = $rankingHistoryObj;
		  			unset($rankingHistoryObjList[$key]);
		  		}
		  	} 	

	  		$rankingPosition = 1;
	  		foreach($rankingHistoryObjList as $rankingHistoryObj){

	  			$rankingHistoryObj->setRankingPosition($rankingPosition++);
	  			$rankingHistoryObj->save();
	  		}
	  		
	  		foreach($lastList as $rankingHistoryObj){

	  			$rankingHistoryObj->setRankingPosition($players);
	  			$rankingHistoryObj->save();
	  		}
	  	}	  	
	  	return $rankingHistoryObjListReturn;
	}
	
	public function getClassify($rankingDate=null){
		
		if( $rankingDate )
			return $this->getRankingHistoryByDate($rankingDate);
		
		switch($this->getRankingType(true)){
			case 'value':
				$orderByList = array(RankingPlayerPeer::TOTAL_PRIZE=>'desc');
				break;
			case 'balance':
				$orderByList = array(RankingPlayerPeer::TOTAL_BALANCE=>'desc');
				break;
			case 'score':
				$orderByList = array(RankingPlayerPeer::TOTAL_SCORE=>'desc');
				break;
			case 'average':
				$orderByList = array(RankingPlayerPeer::TOTAL_AVERAGE=>'desc');
				break;
		}
	  	
	  	$orderByList[RankingPlayerPeer::TOTAL_PRIZE]   = 'desc';
	  	$orderByList[RankingPlayerPeer::TOTAL_BALANCE] = 'desc';
	  	$orderByList[RankingPlayerPeer::TOTAL_PAID]    = 'asc';
	  	$orderByList[RankingPlayerPeer::TOTAL_PAID]    = 'asc';
	  	$orderByList[RankingPlayerPeer::TOTAL_AVERAGE] = 'desc';
	  	$orderByList[RankingPlayerPeer::PEOPLE_ID]     = 'asc';
	  	
	  	$rankingPlayerObjList = $this->getPlayerList($orderByList);
	  	$lastList = array();
	  	foreach($rankingPlayerObjList as $key=>$rankingPlayerObj){
	  		
	  		if( $rankingPlayerObj->getTotalPaid()==0 ){
	  			
	  			$lastList[] = $rankingPlayerObj;
	  			unset($rankingPlayerObjList[$key]);
	  		}
	  	}
	  	
	  	return array_merge($rankingPlayerObjList, $lastList);
	}
	
	public function getRankingHistoryByDate($rankingDate){
		
		$criteria = new Criteria();
		$criteria->add( RankingHistoryPeer::RANKING_ID, $this->getId() );
		$criteria->add( RankingHistoryPeer::RANKING_DATE, Util::formatDate($rankingDate) );
		$criteria->addAscendingOrderByColumn( RankingHistoryPeer::TOTAL_RANKING_POSITION );
		$rankingHistoryObjList = RankingHistoryPeer::doSelect($criteria);
		
		if( count($rankingHistoryObjList)==0 )
			throw new Exception('Não existe histórico para este ranking na data '.$rankingDate);
		else
			return $rankingHistoryObjList;
	}
	
	public function isMyRanking(){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		return ($this->getUserSiteId()==$userSiteId || $this->isAllowEdit());
	}
	
	public function isAllowEdit(){
		
		$peopleId = MyTools::getAttribute('peopleId');
		
		$rankingPlayerObj = RankingPlayerPeer::retrieveByPK( $this->getId(), $peopleId );
		
		return $rankingPlayerObj->getAllowEdit();
	}
	
	public function addToOpenEvents($peopleId){
		
		$criteria = new Criteria();
		$criteria->add( EventPeer::EVENT_DATE, date('Y-m-d'), Criteria::GREATER_EQUAL );
		$eventObjList = $this->getEventList($criteria);
		
		foreach($eventObjList as $eventObj)
			$eventObj->addPlayer($peopleId);
	}
	
	public function getByPlace($place){
		
		$rankingPosition = 1;
		foreach($this->getClassify() as $rankingPlayerObj)
			if( ($rankingPosition++)==$place )
				return $rankingPlayerObj;
		
		return null;
	}
	
	public function getEmailAddressList($tagName=null, $supressMe=false){
		
		$peopleId = MyTools::getAttribute('peopleId');
		
		$emailAddressList = array();
		
		if( $tagName )
			$userSiteOptionId = VirtualTable::getIdByTagName('userSiteOption', $tagName);
		
		foreach( $this->getPeopleList(true) as $peopleObj ){
			
			if( $supressMe && $peopleId==$peopleObj->getId() )
				continue;

			if( $tagName )
				if( !$peopleObj->getOptionValue($userSiteOptionId, true) )
					continue;
					
			$emailAddressList[] = $peopleObj->getEmailAddress();
		}
		
		return $emailAddressList;
	}
	
	public function notifyDelete(){

		$emailContent = AuxiliarText::getContentByTagName('rankingDeleteNotify');

		$peopleObj    = People::getCurrentPeople();
	  	$classifyList = $this->getEmailClassifyList();
	  	$rankingOwner = $this->getUserSite()->getPeople()->getFullName();
		
		$emailContent = str_replace('<classifyList>', $classifyList, $emailContent);
		$emailContent = str_replace('<peopleName>', $peopleObj->getName(), $emailContent);
		$emailContent = str_replace('<rankingName>', $this->getRankingName(), $emailContent);
		$emailContent = str_replace('<createdAt>', $this->getCreatedAt('d/m/Y'), $emailContent);
		$emailContent = str_replace('<startDate>', $this->getStartDate('d/m/Y'), $emailContent);
		$emailContent = str_replace('<rankingType>', $this->getRankingType()->getDescription(), $emailContent);
		$emailContent = str_replace('<players>', $this->getPlayers(), $emailContent);
		$emailContent = str_replace('<events>', $this->getEvents(), $emailContent);
		$emailContent = str_replace('<rankingOwner>', $rankingOwner, $emailContent);
		
		$emailAddressList = $this->getEmailAddressList();
		
		Report::sendMail('Exclusão do ranking @ '.$this->getRankingName(), $emailAddressList, $emailContent);
	}
	
	public function getEmailClassifyList(){
		
		$classifyList = '';
		$nl           = chr(10);
		$position     = 0;
		
		$rankingPlayerObjList = $this->getClassify();
	  	foreach($rankingPlayerObjList as $key=>$rankingPlayerObj){
		
			$peopleObj = $rankingPlayerObj->getPeople();
			
			$classifyList .= '  <tr class="boxcontent">'.$nl;
			$classifyList .= '    <td style="background: #1B4315">#'.(($position++)+1).'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315">'.$peopleObj->getFullName().'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.$rankingPlayerObj->getTotalEvents().'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($rankingPlayerObj->getTotalScore(), true).'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($rankingPlayerObj->getTotalPaid(), true).'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($rankingPlayerObj->getTotalPrize(), true).'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($rankingPlayerObj->getTotalBalance(), true).'</td>'.$nl;
			$classifyList .= '  </tr>'.$nl;
	  	}
	  	
	  	return $classifyList;
	}
	
	public function postOnWall(){
		
		if( $this->getDeleted() || !$this->getVisible() )
			return false;
			
		$isNew     = $this->isNew();
		$classify  = $this->isColumnModified( RankingPeer::RANKING_TYPE_ID );
		$gameStyle = $this->isColumnModified( RankingPeer::GAME_STYLE_ID );
		
		if( $isNew )
    		HomeWall::doLog('criado novo ranking <b>'.$this->getRankingName().'</b>', 'ranking');
		
		if( !$isNew && $classify )
    		HomeWall::doLog('classificação do ranking <b>'.$this->getRankingName().'</b> alterada para <b>'.$this->getRankingType()->getDescription().'</b>', 'ranking');
		
		if( !$isNew && $gameStyle )
    		HomeWall::doLog('estilo do ranking <b>'.$this->getRankingName().'</b> alterado para <b>'.$this->getGameStyle()->getDescription().'</b>', 'ranking');
	}
}
