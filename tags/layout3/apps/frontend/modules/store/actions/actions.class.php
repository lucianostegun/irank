<?php

/**
 * store actions.
 *
 * @package    iRank
 * @subpackage frontend
 * @author     Luciano Stegun
 */
class storeActions extends sfActions
{

  public function preExecute(){
    
    $this->cartSession = $this->getUser()->getAttribute('iRankStoreCartSession');
    
    if( !$this->cartSession )
    	$this->cartSession = $this->getNewSession();
  }
  
  public function executeIndex($request){
  	
  }
  
  public function executeDetails($request){
  	
  	$productCode      = $request->getParameter('productCode');
  	$this->productObj = ProductPeer::retrieveByCode($productCode);
  }

  public function executeCart($request){
  	
  	$cartSessionObj = base64_decode($this->cartSession);
  	$cartSessionObj = unserialize($cartSessionObj);
  	
  	$this->cartSessionObj = $cartSessionObj;
  }

  public function executeAddItem($request){
  	
  	$productCode          = $request->getParameter('productCode');
  	$quantity             = $request->getParameter('quantity', 1);
  	$productOptionIdColor = $request->getParameter('productOptionIdColor');
  	$productOptionIdSize  = $request->getParameter('productOptionIdSize');
  	
	$this->addItemToCart($productCode, $quantity, $productOptionIdColor, $productOptionIdSize);
  	
  	return $this->redirect('store/cart');
  }

  public function executeRemoveItem($request){
  	
  	$productItemId  = $request->getParameter('productItemId');
  	$cartSessionObj = $this->removeItemFromCart($productItemId);
  	
  	echo Util::parseInfo($cartSessionObj);
  	exit;
  }

  public function executeUpdateItemQuantity($request){
  	
  	$cartSessionObj = $this->getCartSession();
  	$productItemId  = $request->getParameter('productItemId');
  	$quantity       = (int)$request->getParameter('quantity');
  	
  	if( $quantity > 0 && $quantity <= 99 ){
  		
	  	$cartSessionObj->productItemList[$productItemId]->quantity = $quantity;
	  	$this->getUpdateSession($cartSessionObj);
  	}
  	
  	if( $cartSessionObj->zipcode )
  		return $this->forward('store', 'calculateShipping');
  	
  	echo Util::parseInfo($cartSessionObj);
  	exit;
  }

  public function executeUpdateCartQuantity($request){
  	
  	$cartSessionObj = $this->getCartSession();
  	
  	foreach($cartSessionObj->productItemList as $productItemId=>$productItem){
  		
	  	$quantity = (int)$request->getParameter('quantity-'.$productItemId);
	  	
	  	if( $quantity <= 0 || $quantity > 99 )
	  		continue;
	  	
  		$productItem->quantity = $quantity;
  	}
  	
  	if( $cartSessionObj->zipcode )
  		return $this->forward('store', 'calculateShipping');
  		
  	$this->updateShippingValue($request);
  	$this->getUpdateSession($cartSessionObj);
  	
  	echo Util::parseInfo($cartSessionObj);
  	exit;
  }

  public function executeCalculateShipping($request){
  	
  	$cartSessionObj = $this->updateShippingValue($request);
  	echo Util::parseInfo($cartSessionObj);
  	exit;
  }

  public function executePayment($request){
  	
  	$this->userSiteId = $this->getUser()->getAttribute('userSiteId');
  	
  	$cartSessionObj = $this->getCartSession();
  	
  	if( $cartSessionObj->products==0 )
  		return $this->redirect('store/cart');
  	
	$result = Util::getAddressByZipcode($cartSessionObj->zipcode);
	
	$this->zipcode           = $cartSessionObj->zipcode;
	$this->state             = null;
    $this->city              = null;
    $this->quarter           = null;
    $this->addressName       = null;
    $this->addressNumber     = null;
    $this->addressComplement = null;
    
    $peopleObj = People::getCurrentPeople();
    if( is_object($peopleObj) ){
    	
		$this->state             = $peopleObj->getAddressState();
	    $this->city              = $peopleObj->getAddressCity();
	    $this->quarter           = $peopleObj->getAddressQuarter();
	    $this->addressName       = $peopleObj->getAddressName();
	    $this->addressNumber     = $peopleObj->getAddressNumber();
	    $this->addressComplement = $peopleObj->getAddressComplement();
	    
	    if( !$this->zipcode )
	    	$this->zipcode = $peopleObj->getAddressZipcode();
    }

	if( is_object($result) ){
		
		switch($result->resultado){  
		    case '1':
		    	$addressType = $result->tipo_logradouro;
		    	
		        $this->state       = $result->uf;
		        $this->city        = $result->cidade;
		        $this->quarter     = $result->bairro;
		        $this->addressName = ($addressType?$addressType.' ':'').$result->logradouro;
		    	break;  
		    case '2':  
		        $this->state = $result->uf;
		        $this->city  = $result->cidade;
		    	break;  
		    break;  
		}
	}
	
	$this->cartSessionObj = $cartSessionObj;
  }

  public function handleErrorFinishOrder(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeFinishOrder($request){
  	
    $addressName       = $request->getParameter('addressName');
    $addressNumber     = $request->getParameter('addressNumber');
    $addressQuarter    = $request->getParameter('addressQuarter');
    $addressComplement = $request->getParameter('addressComplement');
    $addressCity       = $request->getParameter('addressCity');
	$addressState      = $request->getParameter('addressState');
	$addressZipcode    = $request->getParameter('addressZipcode');
	$paymethod         = $request->getParameter('paymethod');
    
  	$peopleObj = People::getCurrentPeople();
  	
  	if( !$peopleObj->getAddressName() && !$peopleObj->getAddressZipcode() ){
  		
	    $peopleObj->setAddressName($addressName);
	    $peopleObj->setAddressNumber($addressNumber);
	    $peopleObj->setAddressQuarter($addressQuarter);
	    $peopleObj->setAddressComplement($addressComplement);
	    $peopleObj->setAddressCity($addressCity);
		$peopleObj->setAddressState($addressState);
		$peopleObj->setAddressZipcode($addressZipcode);
		$peopleObj->save();
  	}
	
	$cartSessionObj = $this->getCartSession();
	
	if( $addressZipcode!=$cartSessionObj->zipcode ){
		
		if( $addressZipcode ){
			
			$cartSessionObj->zipcode = $addressZipcode;
		  	$this->getUpdateSession($cartSessionObj);
		}
		
		$cartSessionObj = $this->updateShippingValue($request);
	}
	
    $cartSessionObj->addressName       = $addressName;
    $cartSessionObj->addressNumber     = $addressNumber;
    $cartSessionObj->addressQuarter    = $addressQuarter;
    $cartSessionObj->addressComplement = $addressComplement;
    $cartSessionObj->addressCity       = $addressCity;
	$cartSessionObj->addressState      = $addressState;
	$cartSessionObj->status            = 'ready';
  	
  	$cartSessionObj->paymethod = $paymethod;
  	
  	$this->getUpdateSession($cartSessionObj);
  	
  	echo 'success';
  	exit;
  }

  public function executeConfirmOrder($request){
  	
  	$this->cartSessionObj = $this->getCartSession();
  	
  	if( $this->cartSessionObj->status!='ready' )
  		return $this->redirect('store/cart');
  }

  public function executeSaveOrder($request){
  	
  	$cartSessionObj = $this->getCartSession();
  	$userSiteId     = $this->getUser()->getAttribute('userSiteId');
  	
  	$shippingValue = $cartSessionObj->shippingValue;
  	$orderValue    = $cartSessionObj->totalValue-$shippingValue;
  	$totalValue    = $orderValue+$shippingValue;
  	$ipAddress     = $_SERVER['REMOTE_ADDR'];
  	$duration      = time()-$cartSessionObj->createdAt;
  	
  	$peopleObj = People::getCurrentPeople();
  	
  	$purchaseObj = new Purchase();
	$purchaseObj->setUserSiteId($userSiteId);
	$purchaseObj->buildOrderNumber();
	$purchaseObj->setOrderStatus('new');
	$purchaseObj->setOrderValue($orderValue);
	$purchaseObj->setProducts($cartSessionObj->products);
	$purchaseObj->setItens($cartSessionObj->itens);
	$purchaseObj->setShippingValue($shippingValue);
	$purchaseObj->setTotalValue($totalValue);
	$purchaseObj->setPaymethod($cartSessionObj->paymethod);
	$purchaseObj->setIpAddress($ipAddress);
	$purchaseObj->setDuration($duration);
  	
    $purchaseObj->setCustomerName($peopleObj->getName());
    $purchaseObj->setAddressName($cartSessionObj->addressName);
    $purchaseObj->setAddressNumber($cartSessionObj->addressNumber);
    $purchaseObj->setAddressQuarter($cartSessionObj->addressQuarter);
    $purchaseObj->setAddressComplement($cartSessionObj->addressComplement);
    $purchaseObj->setAddressCity($cartSessionObj->addressCity);
	$purchaseObj->setAddressState($cartSessionObj->addressState);
	$purchaseObj->setAddressZipcode($cartSessionObj->zipcode);
	$purchaseObj->setCreatedAt($cartSessionObj->createdAt);
  	
  	foreach($cartSessionObj->productItemList as $productItemId=>$productItem){
  		
  		$price    = $productItem->price;
  		$quantity = $productItem->quantity;
  		$weight   = ProductItem::getWeightById($productItemId);
  		
  		$purchaseProductItemObj = new PurchaseProductItem();
  		$purchaseProductItemObj->setProductItemId($productItemId);
  		$purchaseProductItemObj->setPrice($price);
  		$purchaseProductItemObj->setQuantity($quantity);
  		$purchaseProductItemObj->setWeight($weight);
  		$purchaseProductItemObj->setTotalValue($price*$quantity);
  		$purchaseObj->addPurchaseProductItem($purchaseProductItemObj);
  	}
  	
  	try{
  		$purchaseObj->validateOrder();
  		
//		$con = Propel::getConnection();
//		$con->begin();
  		
  		$purchaseObj->save();
  		$purchaseObj->notify();
  		
//		$con->rollback();
  		
  		$this->getNewSession();
  		echo $purchaseObj->getOrderNumber();
  	}catch(PurchaseException $e){
  		
  		Util::forceError($e->getMessage());
  	}catch(Exception $e){
  		
  		Util::forceError('error');
  	}
  	
  	exit;
  }

  public function executeOrderConfirm($request){
  	
  	$userSiteId  = $this->getUser()->getAttribute('userSiteId');
  	$orderNumber = $request->getParameter('orderNumber');
  	$this->purchaseObj = PurchasePeer::retrieveByOrderNumber($orderNumber, $userSiteId);
  	
  	if( !is_object($this->purchaseObj) )
  		return $this->redirect('store/index');
  }

  public function executeBillet($request){
  	
  	$userSiteId  = $this->getUser()->getAttribute('userSiteId');
  	$orderNumber = $request->getParameter('orderNumber');
  	
  	$this->purchaseObj = PurchasePeer::retrieveByOrderNumber($orderNumber, $userSiteId);
  	
  	if( !is_object($this->purchaseObj) )
  		return $this->redirect('store/index');
  		
	sfConfig::set('sf_web_debug', false);
  }

  public function executeGetSignForm($request){

	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag');
	return $this->renderText(get_partial('store/include/sign', array()));
  }

  public function executeMyOrders($request){

  }

  public function executeOrderDetails($request){
  	
  	$userSiteId  = $this->getUser()->getAttribute('userSiteId');
  	$orderNumber = $request->getParameter('orderNumber');
  	
  	$this->purchaseObj = PurchasePeer::retrieveByOrderNumber($orderNumber, $userSiteId);
  	
  	if( !is_object($this->purchaseObj) )
  		return $this->redirect('store/index');
  }

  public function executeUploadFile($request){
  	
  	$userSiteId  = $this->getUser()->getAttribute('userSiteId');
	$purchaseId  = $request->getParameter('purchaseId');
	$maxFileSize = (1024*1024*2);
	
	$purchaseObj = PurchasePeer::retrieveByPK($purchaseId);
	
	if( !is_object($purchaseObj) || $purchaseObj->getUserSiteId()!=$userSiteId )
		throw new Exception('Pedido não encontrado');
	
	try {
		
		$options = array('fileId'=>$purchaseObj->getFileId(),
						 'fileName'=>'payticket-'.date('YmdHis'),
						 'maxFileSize'=>$maxFileSize,
						 'forceNewFile'=>true);
		
		$fileObj = File::upload($request, 'filePath', 'store/purchase/'.$purchaseObj->getOrderNumber(), $options);
	}catch( FileException $e ){
	
		echo '<script>';
		echo 'window.parent.handleUploadFileFailure("'.$e->getMessage().'");';
		echo '</script>';
		exit;
	}catch( Exception $e ){
	
		exit;
	}
	
	$purchaseObj->setFileId($fileObj->getId());
	$purchaseObj->save();
	
	$fileId   = $fileObj->getId();
	$fileName = $fileObj->getFileName();
	
	echo '<script>';
	echo 'window.parent.handleUploadFileSuccess('.$fileId.', "'.$fileName.'");';
	echo '</script>';
	
	exit;
  }

  public function executeDownloadFile($request){
  	
	$orderNumber = $request->getParameter('orderNumber');
	$purchaseObj = PurchasePeer::retrieveByOrderNumber($orderNumber);
	
	$purchaseObj->getFile()->download();

	exit;
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  private function getNewSession(){
  	
  	$ipAddress = $_SERVER['REMOTE_ADDR'];
  	$sessionId = $ipAddress.'-'.microtime();
  	
  	$cartSessionObj = new stdClass();
  	$cartSessionObj->id              = $sessionId;
  	$cartSessionObj->status          = 'new';
  	$cartSessionObj->products        = 0;
  	$cartSessionObj->itens           = 0;
  	$cartSessionObj->totalValue      = 0;
  	$cartSessionObj->zipcode         = null;
  	$cartSessionObj->shippingValue   = 0;
  	$cartSessionObj->paymethod       = null;
  	$cartSessionObj->productItemList = array();
  	$cartSessionObj->createdAt       = time();
  	
  	$peopleObj = People::getCurrentPeople();
    
    if( is_object($peopleObj) )
  		$cartSessionObj->zipcode = $peopleObj->getAddressZipcode();
  	
  	return $this->getUpdateSession($cartSessionObj);
  }

  private function getCartSession(){
  	
	$cartSessionObj = $this->getUser()->getAttribute('iRankStoreCartSession');
	$cartSessionObj = base64_decode($cartSessionObj);
	$cartSessionObj = unserialize($cartSessionObj);
	
	return $cartSessionObj;
  }
  
  private function getUpdateSession($cartSessionObj){
  	
  	$products        = 0;
  	$productItens    = 0;
  	$totalOrderValue = 0;
  	
  	foreach($cartSessionObj->productItemList as $productItem){
		  	
  		$price    = $productItem->price;
  		$quantity = $productItem->quantity;
  		
  		$products     += 1;
  		$productItens += $quantity;
		
		$totalValue       = $price*$quantity;
		$totalOrderValue += $totalValue;
		
		$productItem->totalValue = $totalValue;
  	}
  	
  	$cartSessionObj->products   = $products; // Produtos únicos
 	$cartSessionObj->itens      = $productItens;
 	$cartSessionObj->totalValue = $totalOrderValue+$cartSessionObj->shippingValue;
	 	
  	$cartSessionObj = serialize($cartSessionObj);
  	$cartSessionObj = base64_encode($cartSessionObj);
  	
  	$this->getUser()->setAttribute('iRankStoreCartSession', $cartSessionObj);
  	
  	$this->cartSession = $cartSessionObj;
  	return $this->cartSession;
  }
  
  private function addItemToCart($productCode, $quantity, $productOptionIdColor, $productOptionIdSize){

	$request = $this->getRequest();

	$cartSessionObj = $this->getCartSession();
  	$productId      = Product::getIdByCode($productCode);
  	
  	$productItemObj = ProductItemPeer::retrieveByOptions($productId, $productOptionIdColor, $productOptionIdSize);
  	
  	$quantity = (int)$quantity;
  	
  	if( !is_object($productItemObj) || $quantity <= 0 || $quantity > 99 )
  		return;
  	
  	$productItemId = $productItemObj->getId();
	$price         = $productItemObj->getPrice();
  	
  	if( !isset($cartSessionObj->productItemList[$productItemId]) ){
  		
	 	$productItem = new stdClass();
	 	$productItem->code       = $productCode;
	 	$productItem->price      = $price;
	 	$productItem->quantity   = 0;
	 	$productItem->totalValue = $totalValue = ($price*$quantity);
	 	$productItem->color      = ProductOptionPeer::retrieveByPK($productOptionIdColor)->getOptionName();
	 	$productItem->size       = ProductOptionPeer::retrieveByPK($productOptionIdSize)->getDescription();
  	}else{
  		
  		$productItem = $cartSessionObj->productItemList[$productItemId];
  	}

 	$productItem->quantity += $quantity;
 	
  	
  	$cartSessionObj->productItemList[$productItemId] = $productItem;
  	$this->getUpdateSession($cartSessionObj);
 	
 	$this->updateShippingValue($request);
  }

  private function removeItemFromCart($productItemId){

	$request = $this->getRequest();
	$cartSessionObj = base64_decode($this->cartSession);
  	$cartSessionObj = unserialize($cartSessionObj);
  	
  	$productItemList = $cartSessionObj->productItemList;
  	
  	if( isset($productItemList[$productItemId]) ){
		
		$productItem = $productItemList[$productItemId];
		
		$price       = $productItem->price;
		$quantity    = $productItem->quantity;
		
		$cartSessionObj->products   -= 1; // Produtos únicos
		$cartSessionObj->itens      -= $quantity;
	 	$cartSessionObj->totalValue -= ($price*$quantity);
	 	
	 	if( $cartSessionObj->products < 0 || $cartSessionObj->itens < 0 || $cartSessionObj->totalValue < 0 ){
	 		
			$cartSessionObj->products   = 0; // Produtos únicos
			$cartSessionObj->itens      = 0;
		 	$cartSessionObj->totalValue = 0;
	 	}
	 	
	 	unset($productItemList[$productItemId]);
	}
	
  	
  	$cartSessionObj->productItemList = $productItemList;
  	$this->getUpdateSession($cartSessionObj);
  	
	$cartSessionObj = $this->updateShippingValue($request);
  	
  	return $cartSessionObj;
  }
  
  private function updateShippingValue($request){
  	
  	$cartSessionObj = $this->getCartSession();
  	
	$totalWeight = 0;
  	$zipcode     = $request->getParameter('zipcode', $cartSessionObj->zipcode);
  	
  	if( !$zipcode )
  		return $cartSessionObj;
  	
  	if( $cartSessionObj->itens > 0 ){
  		
	  	$productWeightList = array();
	  	$index = 0;
	  	foreach($cartSessionObj->productItemList as $productItemId=>$productItem){
	  		
	  		$quantity      = $productItem->quantity;
	  		$productWeight = ProductItem::getWeightById($productItemId);
	  		
	  		if( !isset($productWeightList[$index]) )
	  			$productWeightList[$index] = 0;
	  			
	  		for($i=0; $i < $quantity; $i++){
		  		
		  		if( $productWeightList[$index]+$productWeight > 30000 )
		  			$productWeightList[++$index] = 0;
	  			
	  			$productWeightList[$index] += $productWeight;
	  		}
	  	}
	  	
		$webserviceUrl = 'http://webservice.uni5.net/web_frete.php';
		$shippingValue = 0;
	  	foreach($productWeightList as $productWeight){
	  		
			$webserviceQuery = array(
			    'auth'=>'d2444763f5fd6f8f616b4b4dce37752e',		//Chave de autenticação do WebService - Consultar seu painel de controle
			    'formato'=>'query_string',						//Valores possíveis: xml, query_string ou javascript
			    'tipo'=>'sedex',								//Tipo de pesquisa: sedex, carta, pac,
			    'cep_origem'=>'04547-003',						//CEP de Origem - CEP que irá postar a encomenda
			    'cep_destino'=>$zipcode,						//CEP de Destino - CEP que irá receber a encomenda
			    'mao_propria'=>'0',								//Serviço adicional - Mão própria (MP), para utilizar valor "S" ou "1"
			    'aviso_de_recebimento'=>'0',					//Serviço adicional - Mão própria (MP), para utilizar valor "S" ou "1"
			    'peso'=> $productWeight,						//em gr
			    'cep'=>$zipcode,								//CEP que será pesquisado
			);
			
			//Forma URL
			$webserviceUrl .= '?';
			foreach($webserviceQuery as $key=>$value)
			    $webserviceUrl .= $key.'='.urlencode($value).'&';
			
			$result = null;
			parse_str(file_get_contents($webserviceUrl), $result);
			
			if( !isset($result['resultado']) || $result['resultado']!='1' )
				Util::forceError('Erro ao calcular o valor do frete!'.chr(10).$result['resultado_txt']);
				
			$shippingValue += $result['valor'];
	  	}
  	}else{
  		
  		
	  	$shippingValue = 0;
  	}
  	
  	$cartSessionObj->shippingValue = $shippingValue;
  	$cartSessionObj->zipcode       = $zipcode;
  	
  	$this->getUpdateSession($cartSessionObj);
  	
  	return $cartSessionObj;
  }
}
