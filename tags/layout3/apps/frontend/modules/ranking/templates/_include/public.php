<div id="publicRankings">
	<h1>Home Rankings</h1>
	<?php
		$criteria = new Criteria();
		$criteria->addJoin( RankingPeer::ID, EventPeer::RANKING_ID, Criteria::INNER_JOIN );
		$criteria->add( RankingPeer::VISIBLE, true );
		$criteria->add( RankingPeer::ENABLED, true );
		$criteria->add( RankingPeer::DELETED, false );
		$criteria->add( EventPeer::VISIBLE, true );
		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::DELETED, false );
		$criteria->add( RankingPeer::EVENTS, 1, Criteria::GREATER_EQUAL );
		$criteria->add( RankingPeer::PLAYERS, 1, Criteria::GREATER_THAN );
		
		$criterion = $criteria->getNewCriterion( RankingPeer::FINISH_DATE, time(), Criteria::GREATER_THAN );
		$criterion->addOr( $criteria->getNewCriterion( RankingPeer::FINISH_DATE, NULL ) );
		$criteria->add($criterion);
		
	//	$criteria->addDescendingOrderByColumn( RankingPeer::EVENTS );
		$criteria->addAscendingOrderByColumn( 'RANDOM()' );
		$criteria->addGroupByColumn( RankingPeer::ID );
		$criteria->addGroupByColumn( 'ranking.RANKING_NAME, ranking.RANKING_TAG, ranking.USER_SITE_ID, ranking.RANKING_TYPE_ID, ranking.GAME_STYLE_ID, ranking.START_DATE, ranking.START_TIME, ranking.FINISH_DATE, ranking.IS_PRIVATE, ranking.BUYIN, ranking.ENTRANCE_FEE, ranking.PLAYERS, ranking.EVENTS, ranking.SCORE_SCHEMA, ranking.SCORE_FORMULA, ranking.ENABLED, ranking.VISIBLE, ranking.DELETED, ranking.LOCKED, ranking.CREATED_AT, ranking.UPDATED_AT' );
		$criteria->setLimit( 10 );
		$rankingObjList = RankingPeer::doSelect($criteria);
		
		$count = 0;
		foreach($rankingObjList as $rankingObj):
			
			if( $count == 3 )
				break;
			
			$eventObj = $rankingObj->getNextEvent();
			if( is_object($eventObj) ){
				
				$eventDate = $eventObj->getEventDate('d/m/Y');
				$eventLabel = 'próx evt';
				$eventTitle = 'Data do próximo evento';
			}else{
				
				$eventObj = $rankingObj->getLastEvent();
				if( !is_object($eventObj) )
					continue;
				
				$eventDate = $rankingObj->getLastEvent()->getEventDate('d/m/Y');
				$eventLabel = 'últ evt';
				$eventTitle = 'Data do último evento';
			}
			
			$count++;
	?>
	<div class="ranking" onclick="goToPage('ranking', 'share', 'share', '<?php echo Util::encodeId($rankingObj->getId()) ?>')">
		<h1>
		<?php echo $rankingObj->getRankingName() ?>
		</h1>
		<div class="clear mt5"></div>
		<label style="width: 50px" title="Valor padrão dos buy-ins dos eventos">buyin</label>
		<label style="width: 35px" title="Jogadores inscritos no ranking">jog</label>
		<label style="width: 35px" title="Eventos já realizados">evts</label>
		<label style="width: 70px" title="<?php echo $eventTitle ?>"><?php echo $eventLabel ?></label>
		<div class="clear mt2"></div>
		<span style="width: 50px" title="Valor padrão dos buy-ins dos eventos"><?php echo Util::formatFloat($rankingObj->getBuyin(), true) ?></span>
		<span style="width: 35px" title="Jogadores inscritos no ranking"><?php echo $rankingObj->getPlayers() ?></span>
		<span style="width: 35px" title="Eventos já realizados"><?php echo $rankingObj->getEvents() ?></span>
		<span style="width: 70px" title="<?php echo $eventTitle ?>"><?php echo $eventDate ?></span>
		<div class="disclosure"></div>
	</div>
	<?php endforeach; ?>
</div>