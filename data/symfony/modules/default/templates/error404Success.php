<?php decorate_with(sfLoader::getTemplatePath('default', 'defaultLayout.php')) ?>

<div class="sfTMessageContainer sfTAlert"> 
  <?php echo image_tag('/sf/sf_default/images/icons/cancel48.png', array('alt'=>'page not found', 'class'=>'sfTMessageIcon', 'size'=>'48x48')) ?>
  <div class="sfTMessageWrap">
    <h1>Oops! Página não encontrada</h1>
    <h4>O servidor retornou um erro 404.</h5>
  </div>
</div>
<dl class="sfTMessageInfo">
  <dt>Você digitou a URL?</dt>
  <dd>Você pode ter digitado o endereço (URL) incorretamente. Verifique-o para ter certeza de que você digitou corretamente a ortografia, acentuação, etc.</dd>

  <dt>Você chegou aqui por um link de algum lugar deste site?</dt>
  <dd>Se você encontrou esta página através de outra página deste sita, por favor envie um e-mail para nós pelo <?php echo link_to('formulário de contato', '/contact') ?> para que nos possamos corrigi-lo.</dd>

  <dt>Você chegou aqui por um link de outro site?</dt>
  <dd>Links de outros sites as vezes podem estar desatualizados ou incorretos. Envie-nos um e-mail para <?php echo link_to('formulário de contato', '/contact') ?> informando o site por onde você chegou aqui para que nós possamos entrar em contato para a correção do problema.</dd>

  <dt>O que fazer agora?</dt>
  <dd>
    <ul class="sfTIconList">
      <li class="sfTLinkMessage"><a href="javascript:history.go(-1)">Voltar para a página anterior</a></li>
      <li class="sfTLinkMessage"><?php echo link_to('Ir para a página principal', '@homepage') ?></li>
    </ul>
  </dd>
</dl>
