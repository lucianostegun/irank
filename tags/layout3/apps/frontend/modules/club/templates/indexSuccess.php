<?php
	$stateId = null;
	$state   = $sf_params->get('state');
	
	$pathList = array('Onde jogar'=>$moduleName.'/index');
	if( $state )
		$pathList[$state] = null;
	
	include_partial('home/component/commonBar', array('pathList'=>$pathList));
?>
<?php echo image_tag('club', array('class'=>'logo')) ?>
<div class="moduleIntro image">
	Confira abaixo os melhores lugares para participar de eventos presenciais em sua cidade.<br/><br/>
	Você também pode ajudar a manter o cadastro de clubes sempre atualizado.<br>
	<b><?php echo link_to('Entre em contato', 'contact/index') ?></b> para informar sobre novos clubes ou notificar informações de clubes já cadastrados.
</div>
<hr class="separator"/>
<div class="clubStateFilter">
<?php
	$initialList = array();
	foreach(State::getList() as $stateObj)
		$initialList[] = $stateObj->getInitial();
	
	sort($initialList);
	
	foreach($initialList as $initial)
		echo link_to($initial, 'club?state='.$initial, array('class'=>($state==$initial?'selected':'')));
		
	$stateObj = StatePeer::retrieveByInitial($state);
	
	if( is_object($stateObj) )
		$stateId = $stateObj->getId();
?>
</div>
<hr class="separator"/>
<?php if( $stateId ): ?>
	<div class="ml20 mt10">Filtrando clubes do estado de <b><?php echo $stateObj->getStateName() ?></b></div>
<?php endif; ?>
<div id="houseList">
	<?php
		$criteria = new Criteria();
		$criteria->addJoin( ClubPeer::CITY_ID, CityPeer::ID, Criteria::INNER_JOIN );
		if( $stateId )
			$criteria->add( CityPeer::STATE_ID, $stateId );
		
		$clubObjList = Club::getList($criteria);
		foreach($clubObjList as $clubObj):
		
			$clubId          = $clubObj->getId();
			$fileNameLogo    = $clubObj->getFileNameLogo();
			$clubName        = $clubObj->getClubName();
			$tagName         = $clubObj->getTagName();
			$clubSite        = $clubObj->getClubSite();
			$mapsLink        = $clubObj->getMapsLink();
			$addressName     = $clubObj->getAddressName();
			$addressNumber   = $clubObj->getAddressNumber();
			$addressQuarter  = $clubObj->getAddressQuarter();
			$city            = $clubObj->getCity()->getCityName();
			$initial         = $clubObj->getCity()->getState()->getInitial();
			$clubSiteLink    = ($clubSite?(preg_match('/^[a-zA-Z0-9\-_\.]*@/', $clubSite)?'mailto:'.$clubSite:'http://'.$clubSite):null);
			$clubSiteTarget  = ($clubSite?(preg_match('/^[a-zA-Z0-9\-_\.]*@/', $clubSite)?'_top':'_blank'):null);
			$clubSite        = str_ireplace('http://', '', $clubSite);
			$clubSiteLink    = str_ireplace('http://http://', 'http://', $clubSiteLink);
			$phoneNumberList = $clubObj->getPhoneNumberList();
			
//			if( $mapsLink )
//				$mapsLink = link_to(image_tag('mapsPin', array('align'=>'absmiddle')).'mapa', $mapsLink, array('target'=>'_blank'));
			
			$clubSite = str_replace('www.', '', $clubSite);
	?>
	<div class="house">
		<div class="logo"><?php echo link_to(image_tag('club/'.$fileNameLogo), '#goToPage("'.$tagName.'", "", "", "")') ?></div>
		<div class="info">
			<div class="profile">
				<h1><?php echo link_to($clubName, '#goToPage("'.$tagName.'", "", "", "")') ?></h1>
				<div class="address"><?php echo $addressName ?>, <?php echo $addressNumber ?><?php echo ($addressQuarter?', <span title="Bairro">'.$addressQuarter.'</span>':'') ?></div>
				<div class="address"><span title="Cidade"><?php echo $city ?></span>, <span title="Estado"><?php echo $initial ?></span> <?php echo ($clubSiteLink?link_to($clubSite, $clubSiteLink, array('class'=>'clubSite', 'target'=>$clubSiteTarget)):'') ?></div>
				<div class="phoneList">
					<?php foreach($phoneNumberList as $phoneNumber): ?>
					<div class="phone"><?php echo $phoneNumber ?></div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="links">
				<?php echo button_tag('details', 'DETALHES', array('style'=>'position: relative; top: 60px; left: 20px', 'image'=>'details.png', 'onclick'=>'goToPage("club", "details", "id", '.$clubId.')')) ?>
				<div class="clear"></div>
				<?php echo button_tag('location', 'LOCALIZAÇÃO', array('style'=>'position: relative; top: 70px; left: -1px;', 'image'=>'mapsPin.png', 'onclick'=>'goModule("club", "details", "id", '.$clubId.', false, false, "tab", "location")')) ?>
			</div>
		</div>
	</div>
	<?php
		endforeach;
		
		if( empty($clubObjList) ):
	?>
	<div class="clubNotFound">
	Infelizmente não foi encontrado nenhum clube para o estado selecionado!<br/><br/>
	Conhece algum clube da região que não esteja cadatrado no <b>iRank</b>?<br/>
	<b><?php echo link_to('Entre em contato', 'contact/index') ?></b> informando o nome, site e endereço do clube para que possamos cadastrá-lo.
	</div>	
	<?php endif; ?>
</div>