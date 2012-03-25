<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'ranking_live'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingLivePeer extends BaseRankingLivePeer
{
	
	public static function validateScoreFormula($formula){
		
		$position     = 1;
		$events       = 1;
		$prize        = 1;
		$players      = 1;
		$totalBuyins  = 1;
		$defaultBuyin = 1;
		$itm          = 1;
		
		$formula = strtolower($formula);
		
		$formula = preg_replace('/posi[cç][aã]o|position/', '$position', $formula);
		$formula = preg_replace('/eventos|events/', '$events', $formula);
		$formula = preg_replace('/pr[eê]mio|prize/', '$prize', $formula);
		$formula = preg_replace('/jogadores|players/', '$players', $formula);
		$formula = preg_replace('/buyins/', '$totalBuyins', $formula);
		$formula = preg_replace('/buyin/', '$defaultBuyin', $formula);
		$formula = preg_replace('/itm/', '$itm', $formula);
		
		$formulaResult = null;
		
		@eval('$formulaResult = '.$formula.';');

		if( $formulaResult===null || !is_numeric($formulaResult) ){
			
			MyTools::setError('scoreFormula', 'Fórmula de pontuação inválida');
			return false;
		}
		
		return true;
	}
}
