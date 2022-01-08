<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR">
<head>
<link rel="icon" href="/favicon.ico" type="image/x-icon"/>
<?php
include_http_metas();
include_metas();

include_title();
?>

<style>
a {
	
	color: 				#E82314;
	text-decoration: 	none;
}

img {
	
	border: 	0px;
}
</style>

<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/sf/sf_default/css/screen.css" />
<!--[if lt IE 7.]>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/sf/sf_default/css/ie.css" />
<![endif]-->

</head>
<body>
<div class="sfTContainer">
  <a title="iRank - Poker Ranking" href="http://www.irank.com.br/"><img alt="Erro interno de processamento" class="sfTLogo" src="<?php echo $path ?>/images/maintenanceLogo.png" /></a>
  <div class="sfTMessageContainer sfTAlert">
    <img alt="Erro interno de processamento" class="sfTMessageIcon" src="<?php echo $path ?>/images/error500.png" />
    <div class="sfTMessageWrap">
      <h1>Oooops! Ocorreu um erro :(</h1>
      <h4>O servidor se comportou de forma inesperada.</h4>
    </div>
  </div>

  <dl class="sfTMessageInfo">
    <dd>Por favor, envie-nos uma mensagem pelo <a href="/contact">formulário de contato</a><br/>
    ou diretamente pelo e-mail <a href="mailto:contato@irank.com.br">contato<span>@</span>irank.com.br</a>
    e conte-nos exatamente o que aconteceu para que esse erro ocorresse.<br/><br/>
    Iremos corrigi-lo o mais rápido possível.<br/>
    Pedimos desculpas pelo inconveniente.</dd>

	<br/>
  <dt>O que fazer agora?</dt>
  <dd>
    <ul class="sfTIconList">
      <li class="sfTLinkMessage"><a href="javascript:void(0)" onclick="history.go(-1)">Voltar para a página anterior</a></li>
    </ul>
  </dd>
  </dl>
  <div class="clear"></div>
</div>
</body>
</html>
