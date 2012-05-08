<?php

/**
 * Subclasse de representação de objetos da tabela 'sms_log'.
 *
 * 
 *
 * @package lib.model
 */ 
class SmsLog extends BaseSmsLog
{

	const MESSAGE_000  = 'Mensagem enviada com Sucesso.';
	const MESSAGE_001  = 'Credencial Inválida.';
	const MESSAGE_005  = 'Mobile fora do formato-Formato +999(9999)99999999.';
	const MESSAGE_007  = 'SEND_PROJECT tem que ser S, ou N.';
	const MESSAGE_008  = 'Mensagem ou FROM+MESSAGE maior que 142 posições.';
	const MESSAGE_009  = 'Sem crédito para envio de SMS. Favor repor.';
	const MESSAGE_109  = 'Sem crédito para envio de SMS'; // Verificado pela base, antes de tentar enviar
	const MESSAGE_010  = 'Gateway Bloqueado.';
	const MESSAGE_012  = 'Mobile no formato padrão, mas incorreto.';
	const MESSAGE_013  = 'Mensagem Vazia ou Corpo Inválido.';
	const MESSAGE_015  = 'Pais sem operação.';
	const MESSAGE_016  = 'Mobile com tamanho do código de área inválido.';
	const MESSAGE_017  = 'Operadora não autorizada para esta Credencial.';
	const MESSAGE_800  = 'Falha no gateway Mobile Pronto. Contate suporte Mobile Pronto.';
	const MESSAGE_900  = 'Erro de autenticação ou Limite de segurança excedido.';
	const MESSAGE_901  = 'Erro no acesso as operadoras.';
	const UNKNOW_ERROR = 'Erro desconhecido';

	public function getSendingSuccess(){
		
		return $this->getSendingStatus()=='000';
	}
	
	public function getErrorMessage(){
		
		if( $this->getSendingSuccess() )
			return null;
		
		if( $sendingStatus = $this->getSendingStatus() ){
			
			$varName = 'MESSAGE_'.$sendingStatus;
			
			if( !preg_match('/^MESSAGE_[0-9]{3}$/', $varName) )
				return SmsLog::UNKNOW_ERROR;
			
			$result  = null;
			@eval('$result = @SmsLog::'.$varName.';');
			
			if( !$result )
				return SmsLog::UNKNOW_ERROR;
			
			return $result;
		}
		
		return SmsLog::UNKNOW_ERROR;
	}
}
