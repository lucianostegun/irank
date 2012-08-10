<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Privacidade e segurança'=>null)));
?>
<div class="moduleIntro">
	<h1>Privacidade e segurança</h1>
	<br/>
	<p>A <b>iRank Store</b> compromete-se com a privacidade de seus consumidores.</p>
	<p>Dessa forma, não divulgamos seus dados cadastrais para terceiros em nenhuma situação, exceto quando esses sejam necessários para processo de entrega, cobrança ou por determinação judicial.</p>
	<p>Todas as mensagens enviadas pela loja virtual seguem com o e-mail <b>store<?php echo image_tag('emailAt', array('align'=>'absmiddle')) ?>irank.com.br</b> como endereço do destinatário.<br/>
	Pedimos que ignore todo e qualquer e-mail com assuntos relacionados à loja virtual que não forem enviados a partir deste endereço.</p>
	<br/>

	<h2>Certificados SSL</h2>
	<p>Certificado SSL é um componente que atesta a segurança da informação de um site.</p>
	<p>Chama-se Certificado SSL ou Certificado Digital por que uma empresa atesta que aquele site é confiável, e os dados que você trafegar entre o seu computador e o site que usar um Certificado SSL serão criptografados, impedindo qualquer agente de interceptar ou sniffar os dados da conexão entre você e o site.</p>
	<p>A empresa certificadora com que a <b>iRank Store</b> trabalha chama-se GeoTrust, hoje uma divisão da Symantec.</p>
	<p>A Symantec é a principal autoridade certificadora de certificados para servidores web - SSL, que tornam possivel o comércio eletrônico e as comunicações seguras. Escolha a marca de segurança da Internet que você pode confiar e ofereça a criptografia mais forte de SSL para os seus usuários disponível no mercado.</p>

</div>

<?php
	include_partial('store/include/paymethods');
?>