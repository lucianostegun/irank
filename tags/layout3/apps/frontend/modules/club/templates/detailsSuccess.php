<?php
	$clubName       = $clubObj->toString();
	$addressName    = $clubObj->getAddressName();
	$addressNumber  = $clubObj->getAddressNumber();
	$addressQuarter = $clubObj->getAddressQuarter();
	$city           = $clubObj->getCity()->getCityName();
	$state          = $clubObj->getCity()->getState()->getInitial();
	$description    = $clubObj->getDescription();
	$description    = str_replace(chr(10), '<br/>', $description);
	
	$clubSite        = $clubObj->getClubSite();
	$clubSiteLink    = ($clubSite?(preg_match('/^[a-zA-Z0-9\-_\.]*@/', $clubSite)?'mailto:'.$clubSite:'http://'.$clubSite):null);
	$clubSiteTarget  = ($clubSite?(preg_match('/^[a-zA-Z0-9\-_\.]*@/', $clubSite)?'_top':'_blank'):null);
	$clubSite        = str_ireplace('http://', '', $clubSite);
	
	$pathList = array('Onde jogar'=>$moduleName.'/index', 
					  $clubName=>null);
?>
<?php include_partial('home/component/commonBar', array('pathList'=>$pathList)); ?>

<div class="clubDetailsArea" align="center">
	<table cellspacing="0" cellpadding="0" width="99%" class="clubDetails">
		<tr>
			<td class="logo" style="width: 150px"><?php echo image_tag('club/'.$clubObj->getFileNameLogo()) ?><br/><?php echo image_tag('blank.gif', array('style'=>'width: 130px; height: 1px;')) ?></td>
			<td valign="top"><table cellspacing="0" cellpadding="0" class="clubDetails">
					<tr>
						<td valign="top" class="info" colspan="2">
							<h1><?php echo $clubName ?></h1>
						</td>
					</tr>
					<tr>
						<td valign="top" class="info" rowspan="2">
							<div class="location">
								<?php echo $addressName.', '.$addressNumber.($addressQuarter?', '.$addressQuarter:'') ?><br/>
								<?php echo $city ?>-<?php echo $state ?>
							</div>
						</td>
					</tr>
					
					<?php if( $clubSiteLink ): ?>
					<tr>
						<td class="link"><?php echo ($clubSiteLink?link_to($clubSite, $clubSiteLink, array('target'=>$clubSiteTarget)):'') ?></td>
					</tr>
					<?php endif; ?>
					<tr>
						<th class="phones" colspan="3">
							<div class="separator"></div><label>Telefones:</label>
							<?php foreach($clubObj->getPhoneNumberList() as $phoneNumber): ?>
							<div class="phone"><?php echo $phoneNumber ?></div>
							<?php endforeach; ?>
						</th>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<div class="separator"></div>
	<table cellspacing="0" cellpadding="0" class="channel">
		<tr>
			<td id="clubInfo" class="clubTab first active" onclick="showClubTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Informações</td>
			<td id="clubEvents" class="clubTab" onclick="loadClubTab(this, <?php echo $clubId ?>); showClubTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Agenda</td>
			<td id="clubComments" class="clubTab" onclick="showClubTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Comentários</td>
			<td id="clubPhotos" class="clubTab" onclick="loadClubTab(this, <?php echo $clubId ?>); showClubTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Fotos</td>
			<td id="clubLocation" class="clubTab location" onclick="loadClubTab(this, <?php echo $clubId ?>); showClubTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Localização</td>
		</tr>
	</table>
	<div class="separator"></div>
	
	<div id="clubInfoContent" class="clubTabContent active">
		<?php echo $description ?>
	</div>
	<div id="clubCommentsContent" class="clubTabContent loaded">
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=173327886080667";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="fb-comments ml20 mt10" data-href="http://www.irank.com.br/<?php echo $clubObj->getTagName() ?>" data-num-posts="50" data-width="750"></div>
	</div>			
	<div id="clubEventsContent" class="clubTabContent">
		<?php include_partial('home/include/tabLoading', array()) ?>
	</div>
	<div id="clubPhotosContent" class="clubTabContent">
		<?php include_partial('home/include/tabLoading', array()) ?>
	</div>
	<div id="clubLocationContent" class="clubTabContent">
		<?php include_partial('home/include/tabLoading', array()) ?>
	</div>
	<br/><br/>
</div>

