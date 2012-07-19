<?php

/**
 * Subclasse de representação de objetos da tabela 'purchase'.
 *
 * 
 *
 * @package lib.model
 */ 
class Purchase extends BasePurchase
{
	
	public function buildOrderNumber(){
		
		$userSiteId  = $this->getUserSiteId();
		$orderNumber = Util::executeOne("SELECT COUNT(1)+1 FROM purchase WHERE user_site_id = $userSiteId");
		
		$orderNumber = sprintf('%04d%03d', ($userSiteId+date('Y')), $orderNumber);
		$this->setOrderNumber($orderNumber);
	}
	
	public function validateOrder(){
		
		if( !$this->getShippingValue() || $this->getShippingValue() <=0 )
			throw new PurchaseException('O valor do frete não pode ser menor ou igual a R$ 0,00');
		
		if( !$this->getTotalValue() || $this->getTotalValue() <=0 )
			throw new PurchaseException('O valor do pedido não pode ser menor ou igual a R$ 0,00');
		
		if( !$this->getAddressZipcode() || !$this->getAddressName() || !$this->getAddressNumber() || !$this->getAddressQuarter() || !$this->getAddressCity() || !$this->getAddressState() )
			throw new PurchaseException('O endereço para envio não está completo');
		
		if( !$this->getProducts() || !$this->getItens() )
			throw new PurchaseException('O pedido não possui nenhum item relacionado');

		if( !$this->getPaymethod() )
			throw new PurchaseException('A forma de pagamento não foi selecionada corretamente');

		if( !$this->getOrderNumber() )
			throw new PurchaseException('Ocorreu um erro ao gerar o número do pedido');
	}
}

class PurchaseException extends Exception 
{
    
}