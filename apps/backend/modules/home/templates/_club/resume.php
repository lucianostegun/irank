	<!-- Tables inside tabs -->
    <div class="widget leftTabs">  
        <div class="title"><?php echo image_tag('backend/icons/dark/frames', array('class'=>'titleIcon')) ?></div>     
        <ul class="tabs">

            <li><a href="#tab1">Resultados pendentes</a></li>
            <li><a href="#tab2">Eventos agendados</a></li>
        </ul>
        
        <div class="tab_container">
            <div id="tab1" class="tab_content np">
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                    <thead>
                        <tr>
							<td widtd="16"></td> 
							<td>Nome</td> 
							<td>Ranking</td> 
							<td>Clube</td> 
							<td>Data/Hora</td> 
							<td>Buyin</td> 
							<td>Blind</td> 
							<td>Stack</td>
                        </tr>
                    </thead>
                    <tbody>
						<?php
							$criteria = new Criteria();
							$criteria->add( EventLivePeer::CLUB_ID, $clubId );
							$criteria->add( EventLivePeer::EVENT_DATE, date('Y-m-d'), Criteria::LESS_THAN );
							$criteria->add( EventLivePeer::SAVED_RESULT, false );
							
							$eventLiveIdList = array();
							foreach(EventLive::getList($criteria, $clubId) as $eventLiveObj):
								
								$eventLiveId       = $eventLiveObj->getId();
								$eventLiveIdList[] = $eventLiveId;
								
								$onclick = 'goToPage(\'eventLive\', \'edit\', \'eventLiveId\', '.$eventLiveId.')"';
								
								$eventDateTime = $eventLiveObj->getEventDateTime(null);
								
								$icon  = 'iconGreen';
								$title = 'Evento ainda não realizado';
								
								if( $eventDateTime < time()-(86400*2.5) ){
									
									$icon  = 'iconRed';
									$title = 'Evento já realizado - Resultado pendente há mais de 2 dias';
								}elseif( $eventDateTime < time()-86400 ){
									
									$icon  = 'iconYellow';
									$title = 'Evento já realizado - Resultado pendente';
								}
						?>
						<tr class="gradeA" onclick="<?php echo $onclick ?>" id="eventLiveIdRow-<?php echo $eventLiveId ?>">
							<td width="10"><?php echo image_tag('backend/icons/'.$icon, array('title'=>$title)) ?></td> 
							<td><?php echo $eventLiveObj->toString() ?></td> 
							<td><?php echo $eventLiveObj->getRankingLive()->toString() ?></td> 
							<td><?php echo $eventLiveObj->getClub()->toString() ?></td> 
							<td><?php echo $eventLiveObj->getEventDateTime('d/m/Y H:i') ?></td> 
							<td><?php echo Util::formatFloat($eventLiveObj->getBuyin(), true) ?></td> 
							<td><?php echo $eventLiveObj->getBlindTime('H:i') ?></td> 
							<td><?php echo number_format($eventLiveObj->getStackChips(), 0, '', '.') ?></td> 
						</tr> 
						<?php
							endforeach;
							
							$recordCount = count($eventLiveIdList);
						?>
						<tr class="<?php echo ($recordCount?'hidden':'') ?>">
							<td colspan="8">Nenhum evento pendente.<br/><?php echo link_to('Clique aqui', 'eventLive/new') ?> para cadastrar um novo evento.</td>
						</tr>
                    </tbody>
                </table>
            </div>
            <div id="tab2" class="tab_content np">
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                    <thead>
                        <tr>
							<td widtd="16"></td> 
							<td>Nome</td> 
							<td>Ranking</td> 
							<td>Clube</td> 
							<td>Data/Hora</td> 
							<td>Buyin</td> 
							<td>Blind</td> 
							<td>Stack</td>
                        </tr>
                    </thead>
                    <tbody>
						<?php
							$criteria = new Criteria();
							$criteria->add( EventLivePeer::CLUB_ID, $clubId );
							$criteria->add( EventLivePeer::EVENT_DATE, date('Y-m-d'), Criteria::GREATER_EQUAL );
							
							$eventLiveIdList = array();
							foreach(EventLive::getList($criteria, $clubId) as $eventLiveObj):
								
								$eventLiveId       = $eventLiveObj->getId();
								$eventLiveIdList[] = $eventLiveId;
								
								$onclick = 'goToPage(\'eventLive\', \'edit\', \'eventLiveId\', '.$eventLiveId.')"';
								
								$eventDateTime = $eventLiveObj->getEventDateTime(null);
						?>
						<tr class="gradeA" onclick="<?php echo $onclick ?>" id="eventLiveIdRow-<?php echo $eventLiveId ?>">
							<td width="10"><?php echo image_tag('backend/icons/'.$icon, array('title'=>$title)) ?></td> 
							<td><?php echo $eventLiveObj->toString() ?></td> 
							<td><?php echo $eventLiveObj->getRankingLive()->toString() ?></td> 
							<td><?php echo $eventLiveObj->getClub()->toString() ?></td> 
							<td><?php echo $eventLiveObj->getEventDateTime('d/m/Y H:i') ?></td> 
							<td><?php echo Util::formatFloat($eventLiveObj->getBuyin(), true) ?></td> 
							<td><?php echo $eventLiveObj->getBlindTime('H:i') ?></td> 
							<td><?php echo number_format($eventLiveObj->getStackChips(), 0, '', '.') ?></td> 
						</tr> 
						<?php
							endforeach;
							
							$recordCount = count($eventLiveIdList);
						?>
						<tr class="<?php echo ($recordCount?'hidden':'') ?>">
							<td colspan="8">Nenhum evento agendado.<br/><?php echo link_to('Clique aqui', 'eventLive/new') ?> para cadastrar um novo evento.</td>
						</tr>
                    </tbody>
                </table>
            </div>
            <div class="clear"></div>
        </div>	
    </div>