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

    public static function createRandom($length, $upper=true, $chars='abc2de3f3gh9j4kmn5pq8r6stu7vwx8yz'){
    
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