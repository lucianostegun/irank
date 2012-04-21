<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include_http_metas();
include_metas();
include_title();

$iRankAdmin = $sf_user->hasCredential('iRankAdmin');
$iRankClub  = $sf_user->hasCredential('iRankClub');
$messages   = 0;
$peopleName = $sf_user->getAttribute(($messages?'firstName':'fullName'));
$moduleName = $sf_context->getModuleName();
$actionName = $sf_context->getActionName();

$mainBalanceValue   = isset($mainBalanceValue)?$mainBalanceValue:0;
$mainBalancePercent = isset($mainBalancePercent)?$mainBalancePercent:null;
$visitCountValue   = isset($visitCountValue)?$visitCountValue:null;
?>
<script>
	var _mainBalanceValue   = <?php echo ($mainBalanceValue?$mainBalanceValue:'0') ?>;
	var _mainBalancePercent = <?php echo ($mainBalancePercent?$mainBalancePercent:'0') ?>;
	var _ModuleName         = '<?php echo $moduleName ?>';
	var _ActionName         = '<?php echo $actionName ?>';
</script>
</head>

<body>
<div id="debugDiv"></div>
<!-- Left side content -->
<div id="leftSide">
    <div class="logo"><?php echo link_to(image_tag('backend/logo'), 'home/index', array('title'=>'Voltar para a página inicial')) ?></div>
    
    <div class="sidebarSep mt0"></div>
    
    <!-- Search widget -->
    <form action="" class="sidebarSearch">

        <input type="text" name="search" placeholder="pesquisa rápida..." id="ac" />
        <input type="submit" value="" />
    </form>
    
    <div class="sidebarSep"></div>

	<?php
		if( isset($mainBalanceLabel) && isset($mainBalanceValue) || $visitCountValue ):
		
			$mainBalancePercent = isset($mainBalancePercent)?$mainBalancePercent:null;
	?>
    <!-- General balance widget -->
    <div class="genBalance <?php echo (isset($mainBalanceLabel)?'balance':'') ?> <?php echo ($visitCountValue?'visitCount':'') ?>">
    	<?php if( isset($mainBalanceLabel) ): ?>
        <a href="javascript:void(0)" title="" class="amount">
            <span><?php echo $mainBalanceLabel ?>:</span>
            <span class="balanceAmount" id="mainBalanceAmount">R$ <?php echo Util::formatFloat($mainBalanceValue, true) ?></span>
        </a>
        <?php endif; ?>
        <?php if( !is_null($mainBalancePercent) ): ?>
        <a href="javascript:void(0)" title="" class="amChanges">
            <strong class="<?php echo ($mainBalancePercent<0?'sNegative':'sPositive') ?>" id="mainBalancePercent"><?php echo Util::formatFloat($mainBalancePercent, true, 1) ?>%</strong>
        </a>
	    <?php endif; ?>
    	<?php if( !is_null($visitCountValue) ): ?>
        <a href="javascript:void(0)" title="" class="amountWide">
            <span>Visitas na página:</span>
            <span class="visitCount" id="mainVisitCount"><?php echo $visitCountValue ?></span>
        </a>
	    <?php endif; ?>
    </div>
    <div class="sidebarSep"></div>
    <?php endif; ?>
    
    
    <!-- Left navigation -->
	
    <ul id="menu" class="nav">
        <li class="dash"><?php echo link_to('<span>Resumo geral</span>', 'home/index', array('class'=>($moduleName=='home'?'active':''))) ?></li>
        
        <?php if( $iRankAdmin ): ?>
        <li class="club"><a href="javascript:void(0)" title="" class="<?php echo ($moduleName=='club'?'active':'exp') ?>"><span>Clubes</span><strong>2</strong></a>
            <ul class="sub">
                <li><?php echo link_to('Novo clube', 'club/new') ?></li>
                <li><?php echo link_to('Listar clubes', 'club/index', array('class'=>'last')) ?></li>
            </ul>
        </li>
        <?php endif; ?>
        <?php if( !$iRankAdmin && $iRankClub ): ?>
        <li class="club"><a href="<?php echo url_for('club/edit') ?>"><span>Informações do clube</span></a></li>
        <?php endif; ?>
        
        <li class="ranking"><a href="javascript:void(0)" title="" class="<?php echo (strstr($moduleName, 'ranking')?'active':'exp') ?>"><span>Rankings</span><strong>2</strong></a>
            <ul class="sub">
                <li><?php echo link_to('Rankings live', 'rankingLive/index') ?><?php echo link_to('<strong></strong>', 'rankingLive/new', array('title'=>'Novo ranking LIVE')) ?></li>
                <li class="last"><?php echo link_to('Rankings home', 'ranking/index') ?></li>
            </ul>
        </li>
        
        <li class="event"><a href="javascript:void(0)" title="" class="<?php echo (strstr($moduleName, 'event')?'active':'exp') ?>"><span>Eventos</span><strong>2</strong></a>
            <ul class="sub">
                <li><?php echo link_to('Eventos live', 'eventLive/index') ?><?php echo link_to('<strong></strong>', 'eventLive/new', array('title'=>'Novo evento LIVE')) ?></li>
                <li class="last"><?php echo link_to('Eventos home', 'event/index') ?></li>
            </ul>
        </li>

		<?php if( $iRankAdmin ): ?>
        <li class="admin"><a href="javascript:void(0)" title="" class="<?php echo (in_array($moduleName, array('userAdmin', 'controlPanel'))?'active':'exp') ?>"><span>Administração</span><strong>2</strong></a>
            <ul class="sub">
                <li><?php echo link_to('Painel de controle', 'controlPanel/index') ?></li>
                <li class="last"><?php echo link_to('Usuários', 'userAdmin/index') ?></li>
            </ul>
        </li>
        <?php endif; ?>
    </ul>
</div>


<!-- Right side -->
<div id="rightSide">

    <!-- Top fixed navigation -->
    <div class="topNav">
        <div class="wrapper">
            
            <div class="welcome"><a href="#" title=""><img src="/images/backend/userPic.png" alt="" /></a><span>Olá, <?php echo $peopleName ?>!</span></div>
            <div class="userNav">
                <ul>
                    <li><?php echo link_to(image_tag('backend/icons/topnav/profile').'<span>Perfil</span>', 'userTools/edit') ?></li>
					<!--
                    <li><a href="#" title=""><img src="/images/backend/icons/topnav/tasks.png" alt="" /><span>Tasks</span></a></li>
                    <li class="dd"><a title=""><img src="/images/backend/icons/topnav/messages.png" alt="" /><span>Messages</span><span class="numberTop"><?php echo $messages ?></span></a>
                        <ul class="userDropdown">
                            <li><a href="#" title="" class="sAdd">new message</a></li>
                            <li><a href="#" title="" class="sInbox">inbox</a></li>
                            <li><a href="#" title="" class="sOutbox">outbox</a></li>

                            <li><a href="#" title="" class="sTrash">trash</a></li>
                        </ul>
                    </li>
                    -->
                    <?php if( $iRankAdmin ): ?>
                    <li><?php echo link_to(image_tag('backend/icons/topnav/settings').'<span>Configurações</span>', 'settings/index') ?></li>
                    <?php endif; ?>
                    <li><?php echo link_to(image_tag('backend/icons/topnav/logout').'<span>Logout</span>', 'login/logout') ?></li>
                </ul>
            </div>
            
            <div class="clear"></div>
        </div>
    </div>
	<?php include_partial('home/include/breadscrumbs', array('pathList'=>$pathList)); ?>
    
    <!-- Responsive header -->
    <div class="resp">
        <div class="respHead">
            <a href="index.html" title=""><img src="/images/backend/loginLogo.png" alt="" /></a>
        </div>
        
        <div class="cLine"></div>

        <div class="smalldd">
            <span class="goTo"><img src="/images/backend/icons/light/home.png" alt="" />Dashboard</span>
            <ul class="smallDropdown">
                <li><a href="index.html" title=""><img src="/images/backend/icons/light/home.png" alt="" />Dashboard</a></li>
                <li><a href="charts.html" title=""><img src="/images/backend/icons/light/stats.png" alt="" />Statistics and charts</a></li>
                <li><a href="#" title="" class="exp"><img src="/images/backend/icons/light/pencil.png" alt="" />Forms stuff<strong>4</strong></a>

                    <ul>
                        <li><a href="forms.html" title="">Form elements</a></li>
                        <li><a href="form_validation.html" title="">Validation</a></li>
                        <li><a href="form_editor.html" title="">WYSIWYG and file uploader</a></li>
                        <li class="last"><a href="form_wizards.html" title="">Wizards</a></li>
                    </ul>
                </li>

                <li><a href="ui_elements.html" title=""><img src="/images/backend/icons/light/users.png" alt="" />Interface elements</a></li>
                <li><a href="tables.html" title="" class="exp"><img src="/images/backend/icons/light/frames.png" alt="" />Tables<strong>3</strong></a>
                    <ul>
                        <li><a href="table_static.html" title="">Static tables</a></li>
                        <li><a href="table_dynamic.html" title="">Dynamic table</a></li>
                        <li class="last"><a href="table_sortable_resizable.html" title="">Sortable &amp; resizable tables</a></li>

                    </ul>
                </li>
                <li><a href="#" title="" class="exp"><img src="/images/backend/icons/light/fullscreen.png" alt="" />Widgets and grid<strong>2</strong></a>
                    <ul>
                        <li><a href="widgets.html" title="">Widgets</a></li>
                        <li class="last"><a href="grid.html" title="">Grid</a></li>
                    </ul>

                </li>
                <li><a href="#" title="" class="exp"><img src="/images/backend/icons/light/alert.png" alt="" />Error pages<strong>6</strong></a>
                    <ul class="sub">
                        <li><a href="403.html" title="">403 page</a></li>
                        <li><a href="404.html" title="">404 page</a></li>
                        <li><a href="405.html" title="">405 page</a></li>

                        <li><a href="500.html" title="">500 page</a></li>
                        <li><a href="503.html" title="">503 page</a></li>
                        <li class="last"><a href="offline.html" title="">Website is offline</a></li>
                    </ul>
                </li>
                <li><a href="file_manager.html" title=""><img src="/images/backend/icons/light/files.png" alt="" />File manager</a></li>
                <li><a href="#" title="" class="exp"><img src="/images/backend/icons/light/create.png" alt="" />Other pages<strong>3</strong></a>

                    <ul>
                        <li><a href="typography.html" title="">Typography</a></li>
                        <li><a href="calendar.html" title="">Calendar</a></li>
                        <li class="last"><a href="gallery.html" title="">Gallery</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <div class="cLine"></div>
    </div>
    
    <div class="<?php echo (in_array($actionName, array('error404', 'accessDenied'))?'errorWrapper':'wrapper') ?>">
    	<!-- Title area -->
	    <div class="titleArea">
	       <?php echo $sf_data->getRaw('sf_content') ?> 
	    </div>
    </div>
    
    <!-- Footer line -->
    <div id="footer">
        <div class="wrapper">As usually all rights reserved. And as usually brought to you by <a href="http://themeforest.net/user/Kopyov?ref=kopyov" title="">Eugene Kopyov</a></div>

    </div>

</div>

<div class="clear"></div>

</body>
</html>