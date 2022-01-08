<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Sobre a loja'=>null)));
?>
<div class="moduleIntro">
	<h1>Sobre a loja</h1>
	<br/>
	
	<p>O site <b>iRank - Poker Ranking</b> foi lançado no final de 2010 com a proposta de ser<br/>
	o primeiro site de gerenciamento de torneios pessoais de Poker.</p> 
	
	<p>Após ficar durante um ano em <?php echo link_to('beta', 'http://pt.wikipedia.org/wiki/Vers%C3%A3o_beta', array('target'=>'_blank')) ?> o site ganhou uma nova versão,<br/>
	muito mais moderna, estável e com muitas novas opções ao usuários, abrindo caminho para a versão atual<br/>
	que foi liberada no segundo semestre de 2012.</p> 
	
	<p>Além de todas as novidades da 3ª versão foi criada também a <b>iRank Store</b><br/>
	trazendo aos amantes do Poker uma nova linha de produtos originais, de alta qualidade<br/>
	e com preços acessíveis através de uma interface te compra simples, rápida e acima de tudo <b>segura</b>,<br/>
	oferecendo opções de pagamento reconhecidas no meio de transações online.</p>
	
	<p>Seguindo o padrão <b>1-Click</b>, suas compras na loja virtual podem ser feitas sem complicações em uma<br/>
	interface intuitiva e simples de usar.<p>
	<br/>
	
	<h2>Os produtos</h2>
	<p>Criados por jogadores para jogadores. Assim os produtos foram criados com a única proposta de ser<br/>
	uma nova linha de artigos voltados ao mundo do Poker assumindo um visual moderno e descontraído, podendo ser usados<br/>
	por todos os jogadores.</p>
	
	<p>Todos os itens disponíveis na loja são produtos originais e não podem ser encontrados em qualquer outra loja,<br/>
	seja ela física ou virtual.</p>
	
	<p>Desde as camisetas até os acessórios, os produtos são todos produzidos utilizando materials de alta qualidade<br/>
	garantindo grande durabilidade e conforto em sua utilização.</p>
	
	<br/>
	<h2>Seus pedidos</h2>
	<p>Todos os pedidos já realizados ficam ho histórico de sua conta, podendo ser consultados a qualquer hora<br/>
	e contém todas as informações necessárias para acompanhamento de sua compra, desde valores, itens e quantidades<br/>
	até os prazos de envios e códigos de rastreamento após o envio.</p>
	
	<p>Sempre que seu pedido mudar de status, seja em uma aprovação de pagamento ou após o envio dos produtos,<br/>
	uma mensagem é enviada ao endereço de e-mail cadastrado contendo todas as informações atualizadas de seu pedido.<br/><br/>
	<i><b>IMPORTANTE:</b> Todas as mensagens contendo assuntos relacionados à loja virtual, pedidos ou contatos<br/>
	são enviados a partir do remetente <b>store<?php echo image_tag('emailAt', array('align'=>'absmiddle')) ?>irank.com.br</b></i>.</p>
	
	<p>Em breve também será possível acompanhar seus pedidos a partir do <?php echo link_to('iRank App para iOS', 'http://itunes.apple.com/us/app/irank/id481129223', array('target'=>'_blank')) ?>, além de ser informado por mensagens de texto
	sobre as atualizações de seus pedidos/</p>
	<br/>
	<h2>Uma só conta</h2>
	<p>Para realizar suas compras você pode utilizar a mesma conta de usuário que utiliza para gerenciar seus torneios,<br/>
	sendo necessário apenas complementar seu cadastro com o endereço de entrega ao final do processo de compra.</p>
	<p>Caso ainda não seja um usuário, seu cadastro poderá ser feito durante a compra, sendo necessários apenas dados primários<br/>
	como Nome completo, E-mail e Senha de acesso.</p>
</div>

<?php
	include_partial('store/include/paymethods');
?>