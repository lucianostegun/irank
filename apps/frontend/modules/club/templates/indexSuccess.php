<?php include_partial('home/component/commonBar', array('pathList'=>array('Onde jogar'=>$moduleName.'/index'))); ?>
<div class="moduleIntro">
	Confira abaixo os melhores lugares para participar de eventos presenciais em sua cidade.<br/><br/>
	Não encontrou a casa que procurava? <b><?php echo link_to('Clique aqui', 'contact/index') ?></b> e entre em contato conosco.
</div>

<div id="houseList">
	<?php
		$clubObjList = Club::getList();
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
			
			if( $mapsLink )
				$mapsLink = link_to(image_tag('mapsPin', array('align'=>'absmiddle')).'mapa', $mapsLink, array('target'=>'_blank'));
	?>
	<div class="house">
		<div class="logo"><?php echo link_to(image_tag('club/'.$fileNameLogo), '#goToPage("'.$tagName.'", "", "", "")') ?></div>
		<div class="info">
			<div class="profile">
				<h1><?php echo link_to($clubName, '#goToPage("'.$tagName.'", "", "", "")') ?></h1>
				<div class="address"><?php echo $addressName ?>, <?php echo $addressNumber ?><?php echo ($addressQuarter?', '.$addressQuarter:'') ?></div>
				<div class="address"><?php echo $city ?>, <?php echo $initial ?> <?php echo $mapsLink ?> <?php echo ($clubSiteLink?link_to($clubSite, $clubSiteLink, array('target'=>$clubSiteTarget)):'') ?></div>
				<div class="phoneList">
					<?php foreach($phoneNumberList as $phoneNumber): ?>
					<div class="phone"><?php echo $phoneNumber ?></div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="links">
				<div class="link" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" onclick="goToPage('club', 'details', 'id', <?php echo $clubId ?>)">Detalhes</div>
				<div class="link" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" onclick="goToPage('eventLive', 'index', 'clubId', <?php echo $clubId ?>)">Eventos</div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>