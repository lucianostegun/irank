<div style="padding: 10 5 10 5">
Olá,<br/>seja bem vindo ao modo <i>mobile</i> do site <b>iRank</b>.
</div>
<div class="homeLink" onclick="goModule('ranking', 'index')"><div class="image"><?php echo image_tag('mobile/home/ranking') ?></div><div class="title">Meus rankings</div></div>
<div class="homeLink" onclick="goModule('event', 'index')"><div class="image"><?php echo image_tag('mobile/home/event') ?></div><div class="title">Meus eventos</div></div>
<?php if( MyTools::isAuthenticated() ): ?>
<div class="homeLink" onclick="goModule('login', 'logout')"><div class="image"><?php echo image_tag('mobile/home/close') ?></div><div class="title">Sair</div></div>
<?php else: ?>
<div class="homeLink" onclick="goModule('login', 'index')"><div class="image"><?php echo image_tag('mobile/home/login') ?></div><div class="title">Login</div></div>
<?php endif; ?>