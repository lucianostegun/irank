<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Versão Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo está disponível sob a Licença GPL disponível pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Você deve ter recebido uma cópia da GNU Public License junto com     |
// | esse pacote; se não, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colaborações de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de João Prado Maia e Pablo Martins F. Costa				        |
// | 														                                   			  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto Itaú: Glauber Portella                        |
// +----------------------------------------------------------------------+


// ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formulário c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 0;
$data_venc = date('d/m/Y', $purchaseObj->getCreatedAt(null) + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = Util::formatFloat($purchaseObj->getTotalValue(), true); // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(',', '.',$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$orderNumber = $purchaseObj->getOrderNumber();

$dadosboleto['nosso_numero'] = sprintf('%08d', $orderNumber);  // Nosso numero - REGRA: Máximo de 8 caracteres!
$dadosboleto['numero_documento'] = $orderNumber;	// Num do pedido ou nosso numero
$dadosboleto['data_vencimento'] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto['data_documento'] = date('d/m/Y'); // Data de emissão do Boleto
$dadosboleto['data_processamento'] = date('d/m/Y'); // Data de processamento do boleto (opcional)
$dadosboleto['valor_boleto'] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

$addressName       = $purchaseObj->getAddressName();
$addressNumber     = $purchaseObj->getAddressNumber();
$addressComplement = $purchaseObj->getAddressComplement();
$addressComplement = ($addressComplement?" $addressComplement":'');
$addressQuarter    = $purchaseObj->getAddressQuarter();
$addressCity       = $purchaseObj->getAddressCity();
$addressState      = $purchaseObj->getAddressState();
$addressZipcode    = $purchaseObj->getAddressZipcode();

// DADOS DO SEU CLIENTE
$dadosboleto['sacado'] = $purchaseObj->getCustomerName();
$dadosboleto['endereco1'] = "$addressName, $addressNumber{$addressComplement}, $addressQuarter";
$dadosboleto['endereco2'] = "$addressCity-$addressState  CEP: $addressZipcode";

// INFORMACOES PARA O CLIENTE
$dadosboleto['demonstrativo1'] = 'Pagamento de compra na loja virtual iRank';
$dadosboleto['demonstrativo2'] = '';
$dadosboleto['demonstrativo3'] = '';
$dadosboleto['instrucoes1'] = '- Não receber após vencimento';
$dadosboleto['instrucoes2'] = '- Em caso de dúvidas entre em contato conosco: contato@irank.com.br';
$dadosboleto['instrucoes3'] = '&nbsp; Emitido pelo site http://www.irank.com.br/store/billet/'.$orderNumber;
$dadosboleto['instrucoes4'] = '';

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto['quantidade'] = $purchaseObj->getItens();
$dadosboleto['valor_unitario'] = $valor_boleto;
$dadosboleto['aceite'] = 'N';
$dadosboleto['especie'] = 'R$';
$dadosboleto['especie_doc'] = 'DM';


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - ITAÚ
$dadosboleto['agencia'] = '3130'; // Num da agencia, sem digito
$dadosboleto['conta'] = '25552';	// Num da conta, sem digito
$dadosboleto['conta_dv'] = '8'; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - ITAÚ
$dadosboleto['carteira'] = '109';  // Código da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

// SEUS DADOS
$dadosboleto['identificacao'] = 'Newai Software';
$dadosboleto['cpf_cnpj'] = '09.636.816/0001-80';
$dadosboleto['endereco'] = 'Coloque o endereço da sua empresa aqui';
$dadosboleto['cidade_uf'] = 'Cidade / Estado';
$dadosboleto['cedente'] = 'iRank - Poker Ranking';

$libDir = sfConfig::get('sf_lib_dir');

// NÃO ALTERAR!
include("$libDir/boletophp/include/funcoes_itau.php"); 
include("$libDir/boletophp/include/layout_itau.php");
?>