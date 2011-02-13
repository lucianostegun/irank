<?php
/**
 * Journal.php
 * 
 * @version   1.0.0
 * @category  ITSoft
 * @package   Icalendar
 * @author    Thiago Brito <tbrito78@hotmail.com>
 * @copyright 2006 (c) ITSoft
*/

include_once('./library/Icalendar.php');

/**
 * @version   1.0.0
 * @category  ITSoft
 * @package   Icalendar
 * @author    Thiago Brito <tbrito78@hotmail.com>
 * @copyright 2006 (c) ITSoft
*/
class Icalendar_Journal extends Icalendar {
    
    /***********************************************/
    /** Propriedades Gerais da Classe Journal.php **/
    /***********************************************/
    
    /**
     * Array com os journal adicionados
     *
     * @var array
    */
    protected $_journal = array();
    
    /**
     * Array com as chaves que compoem o corpo do ICal
     *
     * @var array
    */
    protected $_journalKeys = array();
    
    /**
     * Construtor da classe
    */
    public function __construct() {
        parent::__construct();
        $this->_journal = array();
        $this->_journalKeys = array("DTSTAMP", "UID", "ORGANIZER", "STATUS",
                                    "CLASS", "CATEGORY", "DESCRIPTION");
        
    }
    
    /**********************************************************/
    /** SET    GET    SET    GET    SET    GET    SET    GET **/
    /**********************************************************/
    
    /**
     * Adiciona um novo journal ao array de journal
     *
     * @param array
    */
    public function setJournal($journal) {
        $oneMoreJournal = array();
        foreach ($journal as $key => $value) {
            if (in_array($key, $this->_journalKeys)) {
                $oneMoreJournal[$key] = $value;
            }
        }
        $this->_journal[] = $oneMoreJournal;
    }
    
    /**
     * Devolve o array de journal
     *
     * @return array
    */
    public function getJournal() {
        return $this->_journal;
    }
    
    /***************************************************/
    /** METODOS DA CLASSE     -     METODOS DA CLASSE **/
    /***************************************************/
    
    /**
     * Inicia um journal com a instrucao "BEGIN:VJOURNAL".
    */
    protected function _startJournal() {
        $this->_ical .= "BEGIN:VJOURNAL\r\n";
    }
    
    /**
     * Termina um journal com a instrucao "END:VJOURNAL".
    */
    protected function _endJournal() {
        $this->_ical .= "END:VJOURNAL\r\n";
    }
    
    /**
     * Metodo que constroi o ical - journal
    */
    public function render() {
        $this->_start();
        foreach ($this->_journal as $journal) {
            $this->_startJournal();
            foreach ($journal as $key => $value) {
                $this->_ical .= $key . ":" . $value . "\r\n";
            }
            $this->_endJournal();
        }
        $this->_end();
    }
    
}

?>