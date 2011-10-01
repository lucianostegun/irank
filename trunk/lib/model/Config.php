<?php

/**
 * Subclasse de representação de objetos da tabela 'config'.
 *
 * 
 *
 * @package lib.model
 */ 
class Config extends BaseConfig
{

	const DOMAIN_ID = '200080';
	
	/**
	 * Método que retorna um objeto da class Config referente a um registro
	 * encontrado a partir do parâmetro passado.
	 * Também pode retornar apenas o valor da configuração se o segundo parâmetro
	 * for definido como TRUE
	 *
	 * @author     Luciano Stegun
	 * @param      String: TagName do registro de configuração
	 * @param      Boolean: Define se o retorno será apenas o valor atual da configuração
	 * @return     String/Object Config
	 */
	public static function getConfigByName( $configName, $returnValue=false ){

		$configObj = ConfigPeer::retrieveByPK( $configName );
		
		if( !is_object($configObj) )
			throw new Exception('Não foi possível localizar a configuração "'.$configName.'"');

		if( $returnValue )
			return $configObj->getConfigValue();
			
		return $configObj;
	}
	
	/**
	 * Método genérico para salvar as configurações no banco de dados
	 *
	 * @author     Luciano Stegun
	 * @param      String: TagName do registro de configuração
	 * @param      Object: Objeto da classe sfRequest nativa do framework
	 */
	public static function saveConfig( $configName, $request, $defaultValue=null ){
		
		$configObj   = self::getConfigByName( $configName );
		$configValue = $request->getParameter( $configName );

		$configObj->setConfigValue( ($configValue?$configValue:$defaultValue) );
		$configObj->save();
	}
}
