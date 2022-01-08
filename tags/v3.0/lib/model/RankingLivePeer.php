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
	
	public static function validateScoreFormula($scoreFormula){
		
		$position     = 1;
		$events       = 1;
		$prize        = 1;
		$players      = 1;
		$totalBuyins  = 1;
		$buyin        = 1;
		$itm          = 1;
		
		$scoreFormulaOption = MyTools::getRequestParameter('scoreFormulaOption');
		$scoreFormulaCustom = MyTools::getRequestParameter('scoreFormulaCustom');
		
		if( $scoreFormulaOption=='multiple' )
			$scoreFormulaList = explode('|', $scoreFormulaCustom);
		else
			$scoreFormulaList = array($scoreFormula);
		
		$validate = true;
		
		foreach($scoreFormulaList as $scoreFormula){
			
			$scoreFormula = preg_replace('/^.*: ?/', '', $scoreFormula);
			$validate &= self::validateFormulaPart($scoreFormula);
		}

		if( !$validate ){
			
			MyTools::setError('scoreFormula', 'Fórmula de pontuação inválida');
			return false;
		}

		return true;
	}

	public static function validateFormulaPart($formula){
		
		$position     = 1;
		$events       = 1;
		$prize        = 1;
		$players      = 1;
		$totalBuyins  = 1;
		$buyin        = 1;
		$itm          = 1;
		
		$scoreFormulaOption = MyTools::getRequestParameter('scoreFormulaOption');
		
		$formula = strtolower($formula);
		
		$patternList = array('/posi[cç][aã]o|position/'=>'$position',
							 '/eventos|events/'=>'$events',
							 '/pr[eê]mio|prize/'=>'$prize',
							 '/jogadores|players/'=>'$players',
							 '/buyins/'=>'$totalBuyins',
							 '/buyin/'=>'$buyin',
							 '/itm/'=>'$itm',
							 '/arred_cima/'=>'ceil',
							 '/arred_baixo/'=>'floor',
							 '/%/'=>'/100');

		// Valida se tem alguma variável ou função não permitida
		$formulaCheck = $formula;
		foreach($patternList as $pattern=>$replace)
			$formulaCheck = preg_replace($pattern, '1', $formulaCheck);
		
		$formulaCheck  = !preg_match('/[^0-9 \.)\(%\-\+\*\/]/', $formulaCheck);
		$formulaResult = null;
		
		// A partir daqui, com a fórmula já validada, verifica se a expressão matemática é valida
		if( $formulaCheck ){
			
			foreach($patternList as $pattern=>$replace)
				$formula = preg_replace($pattern, $replace, $formula);
			
			@eval('$formulaResult = ('.$formula.');');
		}

		if( $formulaResult===null || !is_numeric($formulaResult) )
			return false;

		return true;
	}
	
	public static function validateBlindTime($blindTime){
		
		$blindTime = strtolower($blindTime);
		$blindTime = str_replace(' ', '', $blindTime);
		
		if( preg_match('/^[0-5]?[0-9]+(m(in)?|h)$/', $blindTime) )
			return true;
		else
			return Validate::validateTime($blindTime);
	}
	
	public static function validatePrizeSplit($prizeSplit){
		
		$prizeConfig = split(EventLive::PRIZE_SPLIT_PATTERN, $prizeSplit);
		
		return array_sum($prizeConfig)==100;
	}
	
	public static function validateTemplate($isMultiday){
		
		$request       = MyTools::getRequest();
		$stepDayList   = $request->getParameter('stepDay');
		$daysAfterList = $request->getParameter('daysAfter');
		$startTimeList = $request->getParameter('templateStartTime');
		
		$defaultStartTime = $request->getParameter('startTime');
		
		foreach($startTimeList as $startTime){
			
			if( $startTime && !Validate::validateTime($startTime) ){
				
				MyTools::setError('templateStartTimeError', 'Informe corretamente todos os horários das etapas');
				break;
			}

			if( !$defaultStartTime && empty($stepEventDate) ){
				
				MyTools::setError('templateStartTimeError', 'Informe todos os horários das etapas');
				break;
			}
		}

		foreach($stepDayList as $stepDay){
			
			if( !$stepDay ){
				
				MyTools::setError('stepDayError', 'Informe a indicação do dia de cada etapa');
				break;
			}
		}

		foreach($daysAfterList as $daysAfter){
			
			if( $daysAfter==='' ){
				
				MyTools::setError('daysAfterError', 'Informe o intervalo de todos os dias');
				break;
			}

			if( !is_numeric($daysAfter) ){
				
				MyTools::setError('daysAfterError', 'Informe um número inteiro no intervalo de todos os dias');
				break;
			}
		}
		
		// INICIO - Verifica se não possui duas linhas iguais
		$checkList = array();
		foreach($startTimeList as $key=>$startTime)
			$checkList[] = $startTime.'-'.$daysAfterList[$key];
		
		$checkList = array_unique($checkList);
		if( count($checkList) < count($startTimeList) )
			MyTools::setError('templateStartTimeError', 'Não é possível cadastrar dois dias com o mesmo horário');
		// FIM

		return !$request->hasErrors();
	}
}
