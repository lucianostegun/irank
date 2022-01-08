<?php

/**
 * Subclasse de representação de objetos da tabela 'purchase_transaction_log'.
 *
 * 
 *
 * @package lib.model
 */ 
class PurchaseTransactionLog extends BasePurchaseTransactionLog
{
	
	const STATUS_1 = 'Aguardando pagamento';	// o comprador iniciou a transação, mas até o momento o PagSeguro não recebeu nenhuma informação sobre o pagamento.
	const STATUS_2 = 'Em análise';				// o comprador optou por pagar com um cartão de crédito e o PagSeguro está analisando o risco da transação.
	const STATUS_3 = 'Paga';					// a transação foi paga pelo comprador e o PagSeguro já recebeu uma confirmação da instituição financeira responsável pelo processamento.
	const STATUS_4 = 'Disponível';				// a transação foi paga e chegou ao final de seu prazo de liberação sem ter sido retornada e sem que haja nenhuma disputa aberta.
	const STATUS_5 = 'Em disputa';				// o comprador, dentro do prazo de liberação da transação, abriu uma disputa.
	const STATUS_6 = 'Devolvida';				// o valor da transação foi devolvido para o comprador.
	const STATUS_7 = 'Cancelada';				// a transação foi cancelada sem ter sido finalizada.
	
	const PAYMENT_TYPE_1 = 'Cartão de crédito';		// o comprador escolheu pagar a transação com cartão de crédito.
	const PAYMENT_TYPE_2 = 'Boleto';				// o comprador optou por pagar com um boleto bancário.
	const PAYMENT_TYPE_3 = 'Débito online (TEF)';	// o comprador optou por pagar a transação com débito online de algum dos bancos conveniados.
	const PAYMENT_TYPE_4 = 'Saldo PagSeguro';		// o comprador optou por pagar a transação utilizando o saldo de sua conta PagSeguro.
	const PAYMENT_TYPE_5 = 'Oi Paggo';				// o comprador escolheu pagar sua transação através de seu celular Oi.
	
	const PAYMENT_CODE_101 = 'Cartão de crédito Visa';
	const PAYMENT_CODE_102 = 'Cartão de crédito MasterCard';
	const PAYMENT_CODE_103 = 'Cartão de crédito American Express';
	const PAYMENT_CODE_104 = 'Cartão de crédito Diners';
	const PAYMENT_CODE_105 = 'Cartão de crédito Hipercard';
	const PAYMENT_CODE_106 = 'Cartão de crédito Aura';
	const PAYMENT_CODE_107 = 'Cartão de crédito Elo';
	const PAYMENT_CODE_108 = 'Cartão de crédito PLENOCard';
	const PAYMENT_CODE_109 = 'Cartão de crédito PersonalCard';
	const PAYMENT_CODE_110 = 'Cartão de crédito JCB';
	const PAYMENT_CODE_111 = 'Cartão de crédito Discover';
	const PAYMENT_CODE_112 = 'Cartão de crédito BrasilCard';
	const PAYMENT_CODE_113 = 'Cartão de crédito FORTBRASIL';
	const PAYMENT_CODE_201 = 'Boleto Bradesco';
	const PAYMENT_CODE_202 = 'Boleto Santander';
	const PAYMENT_CODE_301 = 'Débito online Bradesco';
	const PAYMENT_CODE_302 = 'Débito online Itaú';
	const PAYMENT_CODE_303 = 'Débito online Unibanco';
	const PAYMENT_CODE_304 = 'Débito online Banco do Brasil';
	const PAYMENT_CODE_305 = 'Débito online Banco Real';
	const PAYMENT_CODE_306 = 'Débito online Banrisul';
	const PAYMENT_CODE_307 = 'Débito online HSBC';
	const PAYMENT_CODE_401 = 'Saldo PagSeguro';
	const PAYMENT_CODE_501 = 'Oi Paggo';
	
	public static function getList(Criteria $criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->addDescendingOrderByColumn( PurchaseTransactionLogPeer::CREATED_AT );
		$criteria->addDescendingOrderByColumn( PurchaseTransactionLogPeer::ID );
		
		return PurchaseTransactionLogPeer::doSelect($criteria);
	}
}
