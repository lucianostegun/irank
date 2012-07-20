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
	
	public function notify(){
		
		$peopleObj = $this->getUserSite()->getPeople();
		
		$emailAddress = $peopleObj->getEmailAddress();
		$emailContent = EmailTemplate::getContentByTagName('storePurchaseConfirm');
		
		$addressComplement = $this->getAddressComplement();
		$addressComplement = ($addressComplement?" $addressComplement":'');
		
		$emailContent = str_replace('[peopleName]', $peopleObj->getFirstName(), $emailContent);
		$emailContent = str_replace('[orderNumber]', $this->getOrderNumber(), $emailContent);
		$emailContent = str_replace('[orderStatus]', $this->getOrderStatus(true), $emailContent);
		$emailContent = str_replace('[orderValue]', Util::formatFloat($this->getOrderValue(), true), $emailContent);
		$emailContent = str_replace('[shippingValue]', Util::formatFloat($this->getShippingValue(), true), $emailContent);
		$emailContent = str_replace('[totalValue]', Util::formatFloat($this->getTotalValue(), true), $emailContent);
		$emailContent = str_replace('[paymethod]', $this->getPaymethod(true), $emailContent);
		
		$emailContent = str_replace('[customerName]', $this->getCustomerName(), $emailContent);
		$emailContent = str_replace('[addressName]', $this->getAddressName(), $emailContent);
		$emailContent = str_replace('[addressNumber]', $this->getAddressNumber(), $emailContent);
		$emailContent = str_replace('[addressComplement]', $addressComplement, $emailContent);
		$emailContent = str_replace('[addressQuarter]', $this->getAddressQuarter(), $emailContent);
		$emailContent = str_replace('[addressCity]', $this->getAddressCity(), $emailContent);
		$emailContent = str_replace('[addressState]', $this->getAddressState(), $emailContent);
		$emailContent = str_replace('[addressZipcode]', $this->getAddressZipcode(), $emailContent);
		
		preg_match('/<productItemList>(.*)<\/productItemList>/msU', $emailContent, $matches);
		$productItemRow  = $matches[1];
		$productItemList = '';
		
		foreach($this->getPurchaseProductItemList() as $purchaseProductItemObj){
			
			$productItemObj    = $purchaseProductItemObj->getProductItem();
			$productObj        = $productItemObj->getProduct();
			$categoryShortName = $productObj->getProductCategory()->getShortName();
			
			$productName = $productObj->getProductName();
			$productOptionColor = $productItemObj->getProductOptionColor()->getOptionName();
			$productOptionSize  = $productItemObj->getProductOptionSize()->getDescription();
			
			$lineContent = $productItemRow;
			$lineContent = str_replace('[productName]', "$categoryShortName: $productName", $lineContent);
			$lineContent = str_replace('[productColor]', $productOptionColor, $lineContent);
			$lineContent = str_replace('[productSize]', $productOptionSize, $lineContent);
			$lineContent = str_replace('[price]', Util::formatFloat($purchaseProductItemObj->getPrice(), true), $lineContent);
			$lineContent = str_replace('[quantity]', $purchaseProductItemObj->getQuantity(), $lineContent);
			$lineContent = str_replace('[productItemTotalValue]', Util::formatFloat($purchaseProductItemObj->getTotalValue(), true), $lineContent);
			$productItemList .= $lineContent;
		}
		
		$emailContent = preg_replace('/<productItemList>(.*)<\/productItemList>/msU', $productItemList, $emailContent);
		
		$optionList = array('emailTemplate'=>'emailTemplateStore',
							'senderName'=>'iRank Store',
							'replyTo'=>'store@irank.com.br');
		
		Report::sendMail('Confirmação de pedido #'.$this->getOrderNumber(), $emailAddress, $emailContent, $optionList);
	}
	
	public function getOrderStatus($description=false){
		
		$orderStatus = parent::getOrderStatus();
		
		if( $description ){
			
			switch($orderStatus){
				case 'new':
					$orderStatus = 'Pedido confirmado';
					break;
			}
		}
		
		return $orderStatus;
	}
	
	public function getPaymethod($description=false){
		
		$paymethod = parent::getPaymethod();
		
		if( $description ){
			
			switch($paymethod){
				case 'billet':
					$paymethod = 'Boleto bancário';
					break;
				case 'pagseguro':
					$paymethod = 'PagSeguro';
					break;
			}
		}
		
		return $paymethod;
	}
}

class PurchaseException extends Exception 
{
    
}