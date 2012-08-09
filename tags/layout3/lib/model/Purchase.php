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
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
       		Log::quickLog('purchase', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('purchase', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
		
		Log::quickLogDelete('purchase', $this->getPrimaryKey());
	}
	
	public function quickSave($request){
		
		$orderStatus  = $request->getParameter('orderStatus');
		$shippingDate = $request->getParameter('shippingDate');
		$tracingCode  = $request->getParameter('tracingCode');
		
		$this->setShippingDate( Util::formatDate($shippingDate) );
		$this->setTracingCode( strtoupper($tracingCode) );
		$this->save();
		
		if( $this->getOrderStatus()!=$orderStatus )
			$this->addStatusLog(date('d/m/Y H:i:s'), strtoupper(md5($this->getId().$orderStatus.microtime())), $this->getOrderStatusList($orderStatus), 'Não informado', 0, 1, 'iRank Admin');
	}
	
	public static function getList(Criteria $criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->addDescendingOrderByColumn( PurchasePeer::UPDATED_AT );
		$criteria->addDescendingOrderByColumn( PurchasePeer::CREATED_AT );
		
		return PurchasePeer::doSelect($criteria);
	}
	
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
		
		if( !$this->getDiscountCoupon()->validateCoupon() )
			throw new PurchaseException('O cupom de desconto não é mais válido');
	}
	
	public function notify($purchaseStatusLogId=null){
		
		$peopleObj = $this->getUserSite()->getPeople();
		
		$orderStatus  = $this->getOrderStatus();
		$emailAddress = $peopleObj->getEmailAddress();
		
		$emailContent = EmailTemplate::getContentByTagName('storePurchase'.ucfirst($orderStatus));
		
		$addressComplement = $this->getAddressComplement();
		$addressComplement = ($addressComplement?" $addressComplement":'');
		
		$orderNumber = $this->getOrderNumber();
		
		$emailContent = str_replace('[peopleName]', $peopleObj->getFirstName(), $emailContent);
		$emailContent = str_replace('[orderNumber]', $orderNumber, $emailContent);
		$emailContent = str_replace('[orderStatus]', $this->getOrderStatus(true), $emailContent);
		$emailContent = str_replace('[orderValue]', Util::formatFloat($this->getOrderValue(), true), $emailContent);
		$emailContent = str_replace('[shippingValue]', Util::formatFloat($this->getShippingValue(), true), $emailContent);
		$emailContent = str_replace('[totalValue]', Util::formatFloat($this->getTotalValue(), true), $emailContent);
		$emailContent = str_replace('[paymethod]', $this->getPaymethod(true), $emailContent);
		$emailContent = str_replace('[shippingDueDate]', $this->getShippingDueDate(), $emailContent);
		$emailContent = str_replace('[shippingDate]', $this->getShippingDate('d/m/y'), $emailContent);
		$emailContent = str_replace('[approvalDate]', $this->getApprovalDate('d/m/Y H:i'), $emailContent);
		$emailContent = str_replace('[tracingCode]', $this->getTracingCode(), $emailContent);
		
		$emailContent = str_replace('[customerName]', $this->getCustomerName(), $emailContent);
		$emailContent = str_replace('[addressName]', $this->getAddressName(), $emailContent);
		$emailContent = str_replace('[addressNumber]', $this->getAddressNumber(), $emailContent);
		$emailContent = str_replace('[addressComplement]', $addressComplement, $emailContent);
		$emailContent = str_replace('[addressQuarter]', $this->getAddressQuarter(), $emailContent);
		$emailContent = str_replace('[addressCity]', $this->getAddressCity(), $emailContent);
		$emailContent = str_replace('[addressState]', $this->getAddressState(), $emailContent);
		$emailContent = str_replace('[addressZipcode]', $this->getAddressZipcode(), $emailContent);
		
		$paymethod = $this->getPaymethod();
		switch($paymethod){
			case 'billet':
				$paymentLabel = 'Imprimir boleto';
				$paymentUrl   = 'http://[host]/store/billet/'.$orderNumber;
				break;
			case 'pagseguro':
				$paymentLabel = 'URL para pagamento';
				$paymentUrl    = $this->getPagseguroUrl();
				break;
		}

		$emailContent = str_replace('[paymentUrl]', $paymentUrl, $emailContent);
		$emailContent = str_replace('[paymentLabel]', $paymentLabel, $emailContent);
		
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
		
		switch($orderStatus){
			case 'new':
				$emailSubject = "Confirmação de pedido #$orderNumber";
				break;
			case 'approved':
				$emailSubject = "Pagamento aprovado #$orderNumber";
				break;
			case 'shipped':
				$emailSubject = "Pedido enviado #$orderNumber";
				break;
			case 'refused':
				$emailSubject = "Pagamento recusado #$orderNumber";
				break;
			case 'canceled':
				$emailSubject = "Pedido cancelado #$orderNumber";
				break;
		}
		
		$emailLogObj = new EmailLog();
		$emailLogObj->setEmailSubject($emailSubject);
		$emailLogObj->setEmailAddress($emailAddress);
		
		if( $purchaseStatusLogId ){
			
			$emailLogObj->setClassName('PurchaseStatusLog');
			$emailLogObj->setObjectId($purchaseStatusLogId);
		}else{
			
			$emailLogObj->setClassName('Purchase');
			$emailLogObj->setObjectId($this->getId());
		}
		
		$emailLogObj->save();
		
		$emailLogId = $emailLogObj->getId();
		
		$optionList = array('emailTemplate'=>'emailTemplateStore',
							'senderName'=>'iRank Store',
							'replyTo'=>'store@irank.com.br',
							'emailLogId'=>$emailLogId);
		
//		echo $emailSubject;
//		echo '<hr/>';
//		echo $emailContent;exit;
		Report::sendMail($emailSubject, $emailAddress, $emailContent, $optionList);
	}
	
	public function getOrderStatus($description=false){
		
		$orderStatus = parent::getOrderStatus();
		
		if( $description ){
			
			$orderStatusList = Purchase::getOrderStatusList();
			
			if( !isset($orderStatusList[$orderStatus]) )
				$orderStatus = 'Pedido pendente';
			else
				$orderStatus = $orderStatusList[$orderStatus];
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
	
	public function markAsRead(){
		
		$this->setHasNewStatus(false);
		$this->save();
	}
	
	public function getShippingDueDate(){
		
		$approvalDate = $this->getApprovalDate(null);
		
		if( !$approvalDate )
			return null;
		
		return date('d/m/Y', ($approvalDate+(3*86400)));
	}
	
	public static function getOrderStatusList($key=null){
		
		$orderStatusList = array('PRÉ VENDA'=>array(),
								 'new'=>'Pedido confirmado',
								 'pending'=>'Aguardando pagamento',
								 'checking'=>'Verificação financeira',
								 'PÓS VENDA'=>array(),
								 'approved'=>'Pagamento aprovado',
								 'shipped'=>'Produto enviado',
								 'complete'=>'Produto entregue',
								 'ERRO'=>array(),
								 'refused'=>'Pedido recusado',
								 'canceled'=>'Pedido cancelado');
		
		if( $key )
			return $orderStatusList[$key];
		else
			return $orderStatusList;
	}
	
	public function updateProductStock($updateType, $con){
		
		foreach($this->getPurchaseProductItemList() as $purchaseProductItemObj){
			
			$productItemObj = $purchaseProductItemObj->getProductItem();
			
			if( $updateType=='decrase' )
				$productItemObj->decraseStock($purchaseProductItemObj->getQuantity(), $con);
			else
				$productItemObj->incraseStock($purchaseProductItemObj->getQuantity(), $con);
		}
	}
	
	public function getPurchaseStatusLogList(){
		
		$criteria = new Criteria();
		$criteria->add( PurchaseStatusLogPeer::PURCHASE_ID, $this->getId() );
		$criteria->addDescendingOrderByColumn( PurchaseStatusLogPeer::ID );
		return PurchaseStatusLogPeer::doSelect($criteria);
	}
	
	public function addTransactionLog($xmlObj){
		
//		echo '<pre>';
//		print_r($xmlObj);
//		exit;
		
	    $transactionCode   = (string)$xmlObj->code;
	    $transactionType   = (int)$xmlObj->type;
	    $transactionStatus = (int)$xmlObj->status;
	    $paymethodType     = (int)$xmlObj->paymentMethod->type;
	    $paymethodCode     = (int)$xmlObj->paymentMethod->code;
	    $grossAmount       = (float)$xmlObj->grossAmount;
	    $feeAmount         = (float)$xmlObj->feeAmount;
	    $netAmount         = (float)$xmlObj->netAmount;
	    $escrowEndDate     = (string)$xmlObj->escrowEndDate;
	    $extraAmount       = (float)$xmlObj->extraAmount;
	    $installmentCount  = (int)$xmlObj->installmentCount;
	    $createdAt         = (string)$xmlObj->date;
	    $updatedAt         = (string)$xmlObj->lastEventDate;

		$purchaseTransactionLogObj = PurchaseTransactionLogPeer::retrieveByCode($transactionCode);
		
		if( !is_object($purchaseTransactionLogObj) )
			$purchaseTransactionLogObj = new PurchaseTransactionLog();
		
		$purchaseTransactionLogObj->setPurchaseId($this->getId());
		$purchaseTransactionLogObj->setTransactionCode($transactionCode);   
		$purchaseTransactionLogObj->setTransactionType($transactionType);
		$purchaseTransactionLogObj->setTransactionStatus($transactionStatus);
		$purchaseTransactionLogObj->setPaymethodType($paymethodType);
		$purchaseTransactionLogObj->setPaymethodCode($paymethodCode);
		$purchaseTransactionLogObj->setGrossAmount($grossAmount);
		$purchaseTransactionLogObj->setFeeAmount($feeAmount);
		$purchaseTransactionLogObj->setNetAmount($netAmount);
		$purchaseTransactionLogObj->setEscrowEndDate(nvl($escrowEndDate));
		$purchaseTransactionLogObj->setExtraAmount($extraAmount);
		$purchaseTransactionLogObj->setInstallmentCount($installmentCount);
		$purchaseTransactionLogObj->setCreatedAt($createdAt);
		$purchaseTransactionLogObj->setUpdatedAt($updatedAt);
		
		$purchaseTransactionLogObj->save();
		
		$this->updateOrderStatusFromPagSeguro($purchaseTransactionLogObj);
	}
	
	public function addStatusLog($transactionDate, $transactionCode, $transactionStatus, $paymethodType, $extraAmount, $installmentCount, $changeSource){

		$orderStatus = strtolower($transactionStatus);
		$orderStatus = String::removeAccents($orderStatus);
		
		switch($orderStatus){
			case 'new':
			case 'pedido confirmado':
			default:
				$orderStatus = 'new';
				break;
			case 'completo':
			case 'aprovado':
			case 'pagamento aprovado':
			case 'paga':
			case 'approved':
				$orderStatus = 'approved';
				break;
			case 'complete':
			case 'produto entregue':
				$orderStatus = 'complete';
				break;
			case 'aguardando pagto':
			case 'pending':
				$orderStatus = 'pending';
				break;
			case 'em analise':
			case 'checking':
				$orderStatus = 'checking';
				break;
			case 'produto enviado':
			case 'shipped':
				$orderStatus = 'shipped';
				break;
			case 'cancelado':
			case 'canceled':
				$orderStatus = 'canceled';
				break;
		}
		
		$transactionStatus = Purchase::getOrderStatusList($orderStatus);
		
		$purchaseStatusLogObj = PurchaseStatusLogPeer::retrieveByCode($transactionCode);
		
		if( !is_object($purchaseStatusLogObj) )
			$purchaseStatusLogObj = new PurchaseStatusLog();
		
		$purchaseStatusLogObj->setPurchaseId($this->getId());
		$purchaseStatusLogObj->setTransactionCode(nvl($transactionCode));   
		$purchaseStatusLogObj->setTransactionDate(Util::formatDateTime($transactionDate));
		$purchaseStatusLogObj->setTransactionStatus($transactionStatus);
		$purchaseStatusLogObj->setOrderStatus($orderStatus);
		$purchaseStatusLogObj->setPaymethodType($paymethodType);
		$purchaseStatusLogObj->setExtraAmount($extraAmount);
		$purchaseStatusLogObj->setInstallmentCount($installmentCount);
		$purchaseStatusLogObj->setChangeSource($changeSource);
		$purchaseStatusLogObj->save();
		
		$this->updateOrderStatus($orderStatus, $purchaseStatusLogObj->getId());
	}
	
	private function updateOrderStatusFromPagSeguro($purchaseTransactionLogObj){
		
		$transactionStatus = $purchaseTransactionLogObj->getTransactionStatus();
		
		$paymethodType = $purchaseTransactionLogObj->getPaymethodType();
		$paymethodType = constant("PurchaseTransactionLog::PAYMENT_TYPE_$paymethodType");
		
		$transactionStatus = constant("PurchaseTransactionLog::STATUS_$transactionStatus");
		
		$this->addStatusLog($purchaseTransactionLogObj->getUpdatedAt('d/m/Y H:i:s'), $purchaseTransactionLogObj->getTransactionCode(), $transactionStatus, $paymethodType, $purchaseTransactionLogObj->getExtraAmount(), $purchaseTransactionLogObj->getInstallmentCount(), 'PagSeguro');
	}
	
	public function updateOrderStatus($orderStatus, $purchaseStatusLogId){
		
		$currentOrderStatus = $this->getOrderStatus();
		
		if( $currentOrderStatus==$orderStatus )
			return null;
		
		if( $orderStatus=='approved' )
			$this->setApprovalDate(time());
		
		if( $orderStatus=='canceled' ){
			
			$this->setRefusalDate(time());
			$this->setRefusalReason('Compra cancelada');
		}
		
		$con = Propel::getConnection();
		$con->begin();
		
		try{
			
			$this->setOrderStatus($orderStatus);
			$this->setHasNewStatus(($orderStatus!='new'));
			$this->save($con);
			
			if( in_array($orderStatus, array('new', 'approved', 'shipped', 'refused', 'canceled')) )
				$this->notify($purchaseStatusLogId);
				
			// Se o status atual não for ENTREGUE ou ENVIADO, decrementa o estoque atual
			if( $orderStatus=='shipped' && !in_array($currentOrderStatus, array('complete')) ||
				$orderStatus=='complete' && !in_array($currentOrderStatus, array('shipped')) )
				$this->updateProductStock('decrase', $con);
			
			// Se por acaso o status voltar de ENTREGUE ou ENVIADO para qualquer outro status, incrementa o estoque atual
			if( !in_array($orderStatus, array('shipped', 'complete')) && in_array($currentOrderStatus, array('shipped', 'complete')) )
				$this->updateProductStock('incrase', $con);
			
			$con->commit();
		}catch(Exception $e){
			
			$con->rollback();
		}
	}
}

class PurchaseException extends Exception 
{
    
}