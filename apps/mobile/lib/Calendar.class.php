<?php

/**
 * Classe de construção de calendários para campos de texto normal. 
 *
 * @package    Research beta
 * @author     Luciano Stegun
 */
class Calendar {

	/**
	 * Método construtor da classe
	 *
	 * @package    Research beta
	 * @subpackage area
	 * @author     Luciano Stegun
	 * @param      String: Deve ser o id do campo que receberá o calendário
	 */
    function __construct( $fieldName ) {
    	
		echo '<script type="text/javascript">
		    Calendar.setup({
		      inputField : "'.$fieldName.'",
		      ifFormat : "%d/%m/%Y",
		      isRelated : false,
		      daFormat : "%d/%m/%Y",
		      button : "'.$fieldName.'"
		    });
		</script>';
		
		sfContext::getInstance()->getResponse()->addJavascript( '/sf/calendar/calendar' );
		sfContext::getInstance()->getResponse()->addJavascript( '/sf/calendar/lang/calendar-en' );
		sfContext::getInstance()->getResponse()->addJavascript( '/sf/calendar/calendar-setup' );
		sfContext::getInstance()->getResponse()->addStylesheet( '/sf/calendar/skins/aqua/theme' );
    }
}
?>