<?php sfContext::getInstance()->getResponse()->addStylesheet('/sf/sf_default/css/screen'); ?>
<div class="commonBar"><span>Página não encontrada</span></div>
<div class="sfTMessageContainer sfTAlert"> 
  <?php echo image_tag('/sf/sf_default/images/icons/cancel48.png', array('alt'=>'page not found', 'class'=>'sfTMessageIcon', 'size'=>'48x48')) ?>
  <div class="sfTMessageWrap">
    <h1>Ops! Página não encontrada</h1>
    <h4>O servidor retornou um erro 404.</h5>
  </div>
</div>
<br/><br/>
<dl class="sfTMessageInfo">
  <dt>Digitou a URL certa?</dt>
  <dd>Você pode ter digitado o endereço (URL) incorretamente. Verifique-o para ter certeza de que você digitou corretamente a ortografia, acentuação, etc.</dd><br/>

  <dt>Chegou aqui por um link de algum lugar do site?</dt>
  <dd>Se você encontrou esta página através de outra página deste site, por favor envie-nos um e-mail pelo <?php echo link_to('formulário de contato', '/contact') ?> para que nos possamos corrigir o problema.</dd><br/>

  <dt>Chegou aqui por um link de outro site?</dt>
  <dd>Links de outros sites podem estar desatualizados ou incorretos. Envie-nos um e-mail pelo <?php echo link_to('formulário de contato', '/contact') ?> informando o site por onde você chegou aqui para que possamos entrar em contato com eles.</dd><br/>

  <dt>O que fazer agora?</dt>
  <dd>
    <ul class="sfTIconList">
      <li class="sfTLinkMessage"><a href="javascript:history.go(-1)">Voltar para a página anterior</a></li>
      <li class="sfTLinkMessage"><?php echo link_to('Ir para a página principal', '@homepage') ?></li>
    </ul>
  </dd>
</dl>
