<div class="item" style="font-weight: bold"><?php echo link_to('Novo ranking', 'ranking/new') ?></div>
<div class="item"><?php echo link_to('Meus rankings', 'ranking/index') ?></div>
<div class="item" style="font-weight: bold"><?php echo link_to('Novo evento', 'event/new') ?></div>
<div class="item"><?php echo link_to('Eventos', 'event/index') ?></div>
<div class="item" style="padding-top: 20px; background: url('/images/icon/stats.png') 10px 22px no-repeat"><?php echo link_to('Estatísticas', 'statistic/index', array('style'=>'background: none')) ?></div>
<div class="item" style="background: url('/images/icon/options.png') 10px 6px no-repeat"><?php echo link_to('Configurações', 'myAccount/index?tab=options', array('style'=>'background: none')) ?></div>
<div class="item" style="background: url('/images/icon/logout.png') 10px 6px no-repeat"><?php echo link_to('Desconectar', 'login/logout', array('style'=>'background: none')) ?></div>