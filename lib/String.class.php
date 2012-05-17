<?php

/**
 * Classe com métodos de manipulação e geração de strings 
 *
 * @package    TaskManager 2.0
 * @author     Luciano Stegun
 */
class String
{

	public static $translateTable = array(	'from' => 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåªæçèéêëìíîïðñòóôõöøùúûüýÿ',
											'to'   => 'AAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaaceeeeiiiionoooooouuuuyy' );

    public static function createRandom($length, $upper=true, $chars='2a3b4c5d6e7f8g9h2i3j4k5l6m7n8p9q2r3s4t5u6v7w8x9y3'){
    
        srand((double)microtime()*1000000);
        $i = 0;
        $string = '' ;

        while ($i < $length){
        	
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $string = $string . $tmp;
            
            if($tmp)
            	$i++;
        }
    
    	if( $upper )
    		$string = strtoupper($string);
    
        return $string;
    }
    
	public static function removeAccents( $string ){
		
		return strtr( iconv( 'UTF-8', 'ISO-8859-1', $string ), iconv( 'UTF-8', 'ISO-8859-1', self::$translateTable['from'] ), self::$translateTable['to'] );
	}
}
?>