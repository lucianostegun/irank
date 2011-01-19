<?php

/**
 * Subclasse de construção do componente DhtmlxWindows.
 * Contém métodos de requisição de construção
 *
 * @package    TaskManager 2.0
 * @subpackage DhtmlxWindows30
 * @author     Luciano Stegun
 */
class DhtmlxWindows extends DhtmlxWindows30 {
	
    /**
	 * Método de criação de janelas
	 *
	 * @author     Luciano Stegun
	 * @param      String: Id da janela, deve ser único dentro da página
	 * @param      String: Título da janela
	 * @param      Integer: Largura da janela na página
	 * @param      Integer: Altura da janela na página
	 */
	public static function createWindow($id, $title, $width, $height, $content, $options=array()){

		$options = array_merge($options, array('windowHeight'=>$height));
		$ajax    = false;
		
		if( isset($options['ajax'])) $ajax = $options['ajax'];                        // Define se o conteúdo da janela será carregado apenas quando a janela for aberta
		$visible = (array_key_exists('visible', $options)?$options['visible']:false); // Define se a janela será carregada visível

		$scriptName = MyTools::getRequest()->getScriptName();

		if( $ajax )
			$content = $scriptName.'/home/getWindow?windowAddress='.$content.'&options='.serialize($options);
		else
			$content = get_partial($content, $options);
		
		if( Util::getBrowser('IE') )
			$height -= 5;
		
		parent::addElement('id', $id );
		parent::addElement('title', $title );
		parent::addElement('width', $width );
		parent::addElement('height', $height );
		parent::addElement('content', $content );
		parent::addElement('ajax', $ajax );
		parent::addElement('visible', $visible );
	}
}
?>