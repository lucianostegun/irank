<?php
$orderNumber = Util::executeOne('SELECT MAX(order_number) FROM purchase');

echo form_tag('store/updateOrderStatusPagSeguro');
echo '<table border="0">';
echo '<tr><th>VendedorEmail</th><td>'.input_tag('VendedorEmail', 'lucianostegun@gmail.com').'</td></tr>';
echo '<tr><th>TransacaoID</th><td>'.input_tag('TransacaoID', 'D20B40163CA54811B5414DED6CA6CA6B').'</td></tr>';
echo '<tr><th>Referencia</th><td>'.input_tag('Referencia', $orderNumber).'</td></tr>';
echo '<tr><th>Extras</th><td>'.input_tag('Extras', '0,00').'</td></tr>';
echo '<tr><th>TipoFrete</th><td>'.input_tag('TipoFrete', 'SD').'</td></tr>';
echo '<tr><th>ValorFrete</th><td>'.input_tag('ValorFrete', '0,00').'</td></tr>';
echo '<tr><th>Anotacao</th><td>'.input_tag('Anotacao', '').'</td></tr>';
echo '<tr><th>DataTransacao</th><td>'.input_tag('DataTransacao', '24/07/2012 09:22:31').'</td></tr>';
echo '<tr><th>TipoPagamento</th><td>'.input_tag('TipoPagamento', 'Pagamento Online').'</td></tr>';
echo '<tr><th>StatusTransacao</th><td>'.input_tag('StatusTransacao', 'Aguardando Pagto').'</td></tr>';
echo '<tr><th>CliNome</th><td>'.input_tag('CliNome', 'Luciano Stegun').'</td></tr>';
echo '<tr><th>CliEmail</th><td>'.input_tag('CliEmail', 'lucianostegun@gmail.com').'</td></tr>';
echo '<tr><th>CliEndereco</th><td>'.input_tag('CliEndereco', 'Avenida José Maria Whitaker').'</td></tr>';
echo '<tr><th>CliNumero</th><td>'.input_tag('CliNumero', '714').'</td></tr>';
echo '<tr><th>CliComplemento</th><td>'.input_tag('CliComplemento', 'apto 2B').'</td></tr>';
echo '<tr><th>CliBairro</th><td>'.input_tag('CliBairro', 'Planalto Paulista').'</td></tr>';
echo '<tr><th>CliCidade</th><td>'.input_tag('CliCidade', 'São Paulo').'</td></tr>';
echo '<tr><th>CliEstado</th><td>'.input_tag('CliEstado', 'SP').'</td></tr>';
echo '<tr><th>CliCEP</th><td>'.input_tag('CliCEP', '04057000').'</td></tr>';
echo '<tr><th>CliTelefone</th><td>'.input_tag('CliTelefone', '11 80302030').'</td></tr>';
echo '<tr><th>NumItens</th><td>'.input_tag('NumItens', '1').'</td></tr>';
echo '<tr><th>Parcelas</th><td>'.input_tag('Parcelas', '1').'</td></tr>';
echo '<tr><th>ProdID_1</th><td>'.input_tag('ProdID_1', 'IRKDL-002').'</td></tr>';
echo '<tr><th>ProdDescricao_1</th><td>'.input_tag('ProdDescricao_1', 'Dealer: Dealer iRank 3D').'</td></tr>';
echo '<tr><th>ProdValor_1</th><td>'.input_tag('ProdValor_1', '0,50').'</td></tr>';
echo '<tr><th>ProdQuantidade_1</th><td>'.input_tag('ProdQuantidade_1', '1').'</td></tr>';
echo '<tr><th>ProdFrete_1</th><td>'.input_tag('ProdFrete_1', '0,00').'</td></tr>';
echo '<tr><th>ProdExtras_1</th><td>'.input_tag('ProdExtras_1', '0,00').'</td></tr>';
echo '</table>';
echo submit_tag('Enviar');
?>