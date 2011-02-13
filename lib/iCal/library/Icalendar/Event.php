<?php
/**
 * Event.php
 * 
 * @version   1.0.0
 * @category  ITSoft
 * @package   Icalendar
 * @author    Thiago Brito <tbrito78@hotmail.com>
 * @copyright 2006 (c) ITSoft
*/

/**
 * @version   1.0.0
 * @category  ITSoft
 * @package   Icalendar
 * @author    Thiago Brito <tbrito78@hotmail.com>
 * @copyright 2006 (c) ITSoft
*/
class Icalendar_Event extends Icalendar {
    
    /*********************************************/
    /** Propriedades Gerais da Classe Event.php **/
    /*********************************************/
    
    /**
     * Array com os eventos adicionados
     *
     * @var array
    */
    protected $_events = array();
    
    /**
     * Array com as chaves que compoem o corpo do ICal
     *
     * @var array
    */
    protected $_eventKeys = array();
    
    /**
     * Construtor da classe
    */
    public function __construct() {
        parent::__construct();
        $this->_events = array();
        $this->_eventKeys = array("DTSTAMP", "ORGANIZER",
                                  "DATESTART", "HOURSTART", "DATEEND", "HOUREND",
                                  "UID", "CLASS", "CREATED", "DESCRIPTION",
                                  "LAST-MODIFIED", "LOCATION", "SEQUENCE",
                                  "STATUS", "SUMMARY", "TRANSP");
        
    }
    
    /**********************************************************/
    /** SET    GET    SET    GET    SET    GET    SET    GET **/
    /**********************************************************/
    
    /**
     * Adiciona um novo evento ao array de eventos
     *
     * @param array
    */
    public function setEvent($event) {
        $oneMoreEvent = array();
        foreach ($event as $key => $value) {
            if (in_array($key, $this->_eventKeys)) {
                if (($key == "DATESTART") || ($key == "HOURSTART") || ($key == "DATEEND") || ($key == "HOUREND")) {
                    if ($key == "DATESTART") {
                        $oneMoreEvent["DTSTART"] = ";" . $this->_dateReconizer($event, 1);
                    } elseif ($key == "DATEEND") {
                        $oneMoreEvent["DTEND"] = ";" . $this->_dateReconizer($event, 2);
                    }
                } elseif ($key == "ORGANIZER") {
                    $oneMoreEvent[$key] = ";CN=" . $value;
                } else {
                    $oneMoreEvent[$key] = $value;
                }
            }
        }
        $this->_events[] = $oneMoreEvent;
    }
    
    /**
     * Devolve o array de eventos
     *
     * @return array
    */
    public function getEvents() {
        return $this->_events;
    }
    
    /***************************************************/
    /** METODOS DA CLASSE     -     METODOS DA CLASSE **/
    /***************************************************/
    
    /**
     * Inicia um evento com a instrucao "BEGIN:VEVENT".
    */
    protected function _startEvent() {
        $this->_ical .= "BEGIN:VEVENT\r\n";
    }
    
    /**
     * Termina um evento com a instrucao "END:VEVENT".
    */
    protected function _endEvent() {
        $this->_ical .= "END:VEVENT\r\n";
    }
    
    public function render() {
        $this->_start();
        foreach ($this->_events as $event) {
            $this->_startEvent();
            foreach ($event as $key => $value) {
                if (substr($value, 0, 1) == ";") {
                    $this->_ical .= $key . $value . "\r\n";
                } else {
                    $this->_ical .= $key . ":" . $value . "\r\n";
                }
            }
            $this->_endEvent();
        }
        $this->_end();
    }
    
    /**
     * Funcao auxiliar que trata as chaves DATESTART, HOURSTART
     * DATEEND, HOUREND
     *
     * @return string
    */
    protected function _dateReconizer($event, $type) {
        switch ($type) {
            case 1:
                // START
                return "TZID=" . $this->_timezone . ":" . $this->dateBuilder($event["DATESTART"], $event["HOURSTART"]);
                break;
            case 2:
                // END
                return "TZID=" . $this->_timezone . ":" . $this->dateBuilder($event["DATEEND"], $event["HOUREND"]);
                break;
        }
    }
    
}

?>