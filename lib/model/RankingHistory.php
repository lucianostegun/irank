<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking_history'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingHistory extends BaseRankingHistory
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
       		Log::quickLog('ranking_history', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('ranking_history', $this->getPrimaryKey(), $e);
        }
    }
	
	public function updateScore(){
		
		$rankingDate = $this->getRankingDate('Y-m-d');
		
		$score = Util::executeOne('SELECT SUM(event_player.SCORE) FROM event_player, event WHERE event.EVENT_DATE = \''.$rankingDate.'\' AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_player.PEOPLE_ID='.$this->getPeopleId(), 'float');
		
		$this->setTotalScore($this->getTotalScore()+$score);
		$this->setScore($score);
	}
	
	public function updateBalance(){
			
		$rankingDate = $this->getRankingDate('Y-m-d');
		
		$paidValue  = Util::executeOne('SELECT SUM(event_player.ENTRANCE_FEE+event_player.BUYIN+event_player.REBUY+event_player.ADDON) FROM event_player, event WHERE event.EVENT_DATE = \''.$rankingDate.'\' AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_player.PEOPLE_ID='.$this->getPeopleId(), 'float');
		$prizeValue = Util::executeOne('SELECT SUM(event_player.PRIZE) FROM event_player, event WHERE event.EVENT_DATE = \''.$rankingDate.'\' AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_player.PEOPLE_ID='.$this->getPeopleId(), 'float');
		
		$balanceValue = $prizeValue-$paidValue;
		
		$this->setTotalPaid( $this->getTotalPaid()+$paidValue );
		$this->setTotalPrize( $this->getTotalPrize()+$prizeValue );
		$this->setTotalBalance( $this->getTotalBalance()+$balanceValue );
		
		$this->setTotalAverage( ($this->getTotalPaid()>0?($this->getTotalPrize()/$this->getTotalPaid()):0) );
		
		$this->setPaidValue( $paidValue );
		$this->setPrizeValue( $prizeValue );
		$this->setBalanceValue( $balanceValue );
		$this->setAverage( ($this->getPaidValue()>0?($this->getPrizeValue()/$this->getPaidValue()):0) );
	}
	
	public function updateEvents(){
		
		$rankingDate = $this->getRankingDate('Y-m-d');
		
		$events = Util::executeOne('SELECT COUNT(1) FROM event_player, event WHERE event.EVENT_DATE = \''.$rankingDate.'\' AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event_player.ENABLED=TRUE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_player.PEOPLE_ID='.$this->getPeopleId(), 'int');
		
		$this->setEvents($events);
		$this->setTotalEvents($this->getTotalEvents()+$events);
	}
	
	public function updateInfo(){

		$this->updateBalance();
		$this->updateEvents();
		$this->updateScore();
	}
	
	// Função que atualiza todos as datas do ranking
	// Não deve ser utilizada se a consistencia dos eventos do ranking estiverem certa
	public static function saveResults($rankingObj){
		
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn( EventPeer::EVENT_DATE );
		$criteria->addAscendingOrderByColumn( EventPeer::START_TIME );
		
		$eventObjList         = $rankingObj->getEventList($criteria);
		$rankingPlayerObjList = $rankingObj->getPlayerList();
		$rankingType          = $rankingObj->getRankingType(true);

		$eventDateList = array();
		foreach($eventObjList as $eventObj)
			$eventDateList[] = Util::formatDate($eventObj->getEventDate('d/m/Y'));
		
		$eventDateList = array_unique($eventDateList);
		$firstDate     = Util::formatDate($eventDateList[0]);

		foreach( $eventDateList as $eventDate){
			
			foreach($rankingPlayerObjList as $rankingPlayerObj){
				
				$rankingHistoryObj = new RankingHistory();
				$rankingHistoryObj->setPeopleId( $rankingPlayerObj->getPeopleId() );
				$rankingHistoryObj->setRankingId( $rankingPlayerObj->getRankingId() );
				$rankingHistoryObj->setRankingDate( $eventDate );
				$rankingHistoryObj->updateInfo($firstDate, $eventDate);
				$rankingHistoryObj->save();
			}
		}
	}
	
	// Sobrescreve os métodos para formatar os valores com duas casas decimais
	public function setAverage($average){
		
		parent::setAverage( Util::formatFloat($average, false, 3) );
	}
	
	public function setTotalAverage($totalAverage){
		
		parent::setTotalAverage( Util::formatFloat($totalAverage, false, 3) );
	}
}
