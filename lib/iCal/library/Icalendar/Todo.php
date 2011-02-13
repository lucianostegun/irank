<?php
/**
 * Todo.php
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
class Icalendar_Todo extends Icalendar {
    
    /********************************************/
    /** Propriedades Gerais da Classe Todo.php **/
    /********************************************/
    
    /**
     * Array com os todo adicionados
     *
     * @var array
    */
    protected $_todo = array();
    
    /**
     * Array com as chaves que compoem o corpo do ICal
     *
     * @var array
    */
    protected $_todoKeys = array();
    
    /**
     * Array com as chaves do Todo-Alarm
    */
    protected $_alarmKeys = array();
    
    /**
     * Construtor da classe
    */
    public function __construct() {
        parent::__construct();
        $this->_todo = array();
        $this->_todoKeys = array("SEQUENCE", "UID", "DTSTAMP", "ORGANIZER",
                                 "ATTENDEE", "DUE", "STATUS", "SUMMARY",
                                 "VALARM");
        $this->_alarmKeys = array("ACTION", "TRIGGER", "ATTACH",
                                  "REPEAT", "DURATION");
    }
    
    /**********************************************************/
    /** SET    GET    SET    GET    SET    GET    SET    GET **/
    /**********************************************************/
    
    /**
     * Adiciona um novo todo ao array de todo
     *
     * @param array
    */
    public function setTodo($todo) {
        $oneMoreTodo = array();
        foreach ($todo as $key => $value) {
            if (in_array($key, $this->_todoKeys)) {
                $oneMoreTodo[$key] = $value;
            }
        }
        $this->_todo[] = $oneMoreTodo;
    }
    
    /**
     * Devolve o array de todo
     *
     * @return array
    */
    public function getTodo() {
        return $this->_todo;
    }
    
    /***************************************************/
    /** METODOS DA CLASSE     -     METODOS DA CLASSE **/
    /***************************************************/
    
    /**
     * Inicia um todo com a instrucao "BEGIN:VTODO".
    */
    protected function _startTodo() {
        $this->_ical .= "BEGIN:VTODO\r\n";
    }
    
    /**
     * Termina um todo com a instrucao "END:VTODO".
    */
    protected function _endTodo() {
        $this->_ical .= "END:VTODO\r\n";
    }
    
    /**
     * Inicia um todo-alarm com a instrucao "BEGIN:VALARM".
    */
    protected function _startAlarm() {
        $this->_ical .= "BEGIN:VALARM\r\n";
    }
    
    /**
     * Termina um todo-alarm com a instrucao "END:VALARM".
    */
    protected function _endAlarm() {
        $this->_ical .= "END:VALARM\r\n";
    }
    
    /**
     * Metodo que constroi o ical - todo
    */
    public function render() {
        $this->_start();
        foreach ($this->_todo as $todo) {
            $this->_startTodo();
            foreach ($todo as $key => $value) {
                if ((is_array($value)) && ($key == "VALARM")) {
                    $this->_startAlarm();
                    foreach ($value as $keyAlarm => $valueAlarm) {
                        if (in_array($keyAlarm, $this->_alarmKeys)) {
                            if (substr($valueAlarm, 0, 1) == ";") {
                                $this->_ical .= $keyAlarm . $valueAlarm . "\r\n";
                            } else {
                                $this->_ical .= $keyAlarm . ":" . $valueAlarm . "\r\n";
                            }
                        }
                    }
                    $this->_endAlarm();
                } else {
                    if (substr($value, 0, 1) == ";") {
                        $this->_ical .= $key . $value . "\r\n";
                    } else {
                        $this->_ical .= $key . ":" . $value . "\r\n";
                    }
                }
            }
            $this->_endTodo();
        }
        $this->_end();
    }
    
}

?>