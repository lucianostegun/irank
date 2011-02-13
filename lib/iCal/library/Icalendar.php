<?php
/**
 * Icalendar.php
 * 
 * @version   1.0.0
 * @category  ITSoft
 * @package   Icalendar
 * @author    Thiago Brito <tbrito78@hotmail.com>
 * @copyright 2006 (c) ITSoft
*/
class Icalendar {
    
    /*********************************************/
    /** Propriedades Gerais da Classe ICalendar **/
    /*********************************************/
    
    /**
     * Texto com as informacoes (eventos) que serao exportados para o
     * formato ICalendar
     *
     * @var string
    */
    protected $_ical = null;
    
    /**
     * Nome do ficheiro .ics
     *
     * @var string
    */
    protected $_fileName = null;
    
    /********************************************/
    /** Propriedades do cabecalho do ICalendar **/
    /********************************************/
    
    /**
     * PRODID
     *
     * @var string
    */
    protected $_prodid = null;
    
    /**
     * Versao do ICalendar
     *
     * @var string
    */
    protected $_version  = null;
    
    /**
     * Tipo de Calendario - Gregorian
     *
     * @var string
    */
    protected $_calscale = null;
    
    /**
     * Metodo
     *
     * @var string
    */
    protected $_method   = null;
    
    /**
     * Nome do Calendario
     *
     * @var string
    */
    protected $_calname = null;
    
    /**
     * Descricao do Calendario
     *
     * @var string
    */
    protected $_caldesc = null;
    
    /**
     * Time Zone
     *
     * @var string
    */
    protected $_timezone = null;
    
    /**
     * Time Zone - Off Set From
     *
     * @var string
    */
    protected $_tzoffsetfrom = null;
    
    /**
     * Time Zone - Off Set To
     *
     * @var string
    */
    protected $_tzoffsetto = null;
    
    /**
     * Time Zone Name
     *
     * @var string
    */
    protected $_tzname = null;
    
    /**
     * Data de Inicio
     *
     * @var string
    */
    protected $_dtstart = null;
    
    /**
     * Construtor da classe
    */
    public function __construct() {
        $this->_ical = "";
        $this->_fileName = 'ical_itsoft';
        
        $this->_prodid       = "ITSoft - Thiago Brito";
        $this->_version      = "2.0";
        $this->_calscale     = "GREGORIAN";
        $this->_method       = "PUBLISH";
        $this->_calname      = "ITSoft - Thiago Brito";
        $this->_caldesc      = "ITSoft - Thiago Brito";
        $this->_timezone     = date_default_timezone_get();
        $this->_tzoffsetfrom = "-0700";
        $this->_tzoffsetto   = "-0800";
        $this->_tzname       = date("T");
        $this->_dtstart      = date("Ymd") . "T" . date("H") . "0000";
        
    }
    
    /**********************************************************/
    /** SET    GET    SET    GET    SET    GET    SET    GET **/
    /**********************************************************/
    
    /**
     * Atribui um valor ao filename
     *
     * @param string
    */
    public function setFilename($filename) {
        $this->_fileName = $filename;
    }
    
    /**
     * Devolve o valor da propriedade _fileName
     *
     * @return string
    */
    public function getFilename() {
        return $this->_fileName;
    }
    
    /**
     * PRODID
     *
     * @param string
    */
    public function setProdid($prodid) {
        $this->_prodid = $prodid;
    }
    
    /**
     * PRODID
     *
     * @return string
    */
    public function getProdid() {
        return $this->_prodid;
    }
    
    /**
     * Versao do ICalendar
     *
     * @param string
    */
    public function setVersion($version) {
        $this->_version = $version;
    }
    
    /**
     * Versao do ICalendar
     *
     * @return string
    */
    public function getVersion() {
        return $this->_version;
    }
    
    /**
     * Tipo de Calendario - Gregorian
     *
     * @param string
    */
    public function setCalscale($calscale) {
        $this->_calscale = $calscale;
    }
    
    /**
     * Tipo de Calendario - Gregorian
     *
     * @return string
    */
    public function getCalscale() {
        return $this->_calscale;
    }
    
    /**
     * Metodo
     *
     * @param string
    */
    public function setMethod($method) {
        $this->_method = $method;
    }
    
    /**
     * Metodo
     *
     * @return string
    */
    public function getMethod() {
        return $this->_method;
    }
    
    /**
     * Nome do Calendario
     *
     * @param string
    */
    public function setCalname($calname) {
        $this->_calname = $calname;
    }
    
    /**
     * Nome do Calendario
     *
     * @return string
    */
    public function getCalname() {
        return $this->_calname;
    }
    
    /**
     * Descricao do Calendario
     *
     * @param string
    */
    public function setCaldesc($caldesc) {
        $this->_caldesc = $caldesc;
    }
    
    /**
     * Descricao do Calendario
     *
     * @return string
    */
    public function getCaldesc() {
        return $this->_caldesc;
    }
    
    /**
     * Time Zone
     *
     * @param string
    */
    public function setTimezone($timezone) {
        $this->_timezone = $timezone;
    }
    
    /**
     * Time Zone
     *
     * @return string
    */
    public function getTimezone() {
        return $this->_timezone;
    }
    
    /**
     * Time Zone - Off Set From
     *
     * @param string
    */
    public function setTzoffsetfrom($tzoffsetfrom) {
        $this->_tzoffsetfrom = $tzoffsetfrom;
    }
    
    /**
     * Time Zone - Off Set From
     *
     * @return string
    */
    public function getTzoffsetfrom() {
        return $this->_tzoffsetfrom;
    }
    
    /**
     * Time Zone - Off Set To
     *
     * @param string
    */
    public function setTzoffsetto($tzoffsetto) {
        $this->_tzoffsetto = $tzoffsetto;
    }
    
    /**
     * Time Zone - Off Set To
     *
     * @return string
    */
    public function getTzoffsetto() {
        return $this->_tzoffsetto;
    }
    
    /**
     * Time Zone Name
     *
     * @param string
    */
    public function setTzname($tzname) {
        $this->_tzname = $tzname;
    }
    
    /**
     * Time Zone Name
     *
     * @return string
    */
    public function getTzname() {
        return $this->_tzname;
    }
    
    /**
     * Data de Inicio
     *
     * @param string
    */
    public function setDtstart($dtstart) {
        $this->_dtstart = $dtstart;
    }
    
    /**
     * Data de Inicio
     *
     * @return string
    */
    public function getDtstart() {
        return $this->_dtstart;
    }
    
    /***************************************************/
    /** METODOS DA CLASSE     -     METODOS DA CLASSE **/
    /***************************************************/
    
    /**
     * Esta funcao inicia o ICal com a instrucao "BEGIN:VCALENDAR".
    */
    protected function _start() {
        $this->_ical = "";
        $this->_ical .= "BEGIN:VCALENDAR\r\n";
        $this->_ical .= "PRODID:" . $this->_prodid . "\r\n";
        $this->_ical .= "VERSION:" . $this->_version . "\r\n";
        $this->_ical .= "CALSCALE:" . $this->_calscale . "\r\n";
        $this->_ical .= "METHOD:" . $this->_method . "\r\n";
        $this->_ical .= "X-WR-CALNAME:" . $this->_calname . "\r\n";
        $this->_ical .= "X-WR-TIMEZONE:" . $this->_timezone . "\r\n";
        $this->_ical .= "X-WR-CALDESC:" . $this->_caldesc . "\r\n";
        $this->_ical .= "BEGIN:VTIMEZONE\r\n";
        $this->_ical .= "TZID:" . $this->_timezone . "\r\n";
        $this->_ical .= "X-LIC-LOCATION:" . $this->_timezone . "\r\n";
        $this->_ical .= "BEGIN:STANDARD\r\n";
        $this->_ical .= "TZOFFSETFROM:" . $this->_tzoffsetfrom . "\r\n";
        $this->_ical .= "TZOFFSETTO:" . $this->_tzoffsetto . "\r\n";
        $this->_ical .= "TZNAME:" . $this->_tzname . "\r\n";
        $this->_ical .= "DTSTART:" . $this->_dtstart . "\r\n";
        $this->_ical .= "RRULE:FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU\r\n";
        $this->_ical .= "END:STANDARD\r\n";
        $this->_ical .= "BEGIN:DAYLIGHT\r\n";
        $this->_ical .= "TZOFFSETFROM:" . $this->_tzoffsetfrom . "\r\n";
        $this->_ical .= "TZOFFSETTO:" . $this->_tzoffsetto . "\r\n";
        $this->_ical .= "TZNAME:" . $this->_tzname . "\r\n";
        $this->_ical .= "DTSTART:" . $this->_dtstart . "\r\n";
        $this->_ical .= "RRULE:FREQ=YEARLY;BYMONTH=4;BYDAY=1SU\r\n";
        $this->_ical .= "END:DAYLIGHT\r\n";
        $this->_ical .= "END:VTIMEZONE\r\n";
    }
    
    /**
     * Esta funcao termina o ICal com a instrucao "END:VCALENDAR".
    */
    protected function _end() {
        $this->_ical .= "END:VCALENDAR\r\n";
    }
    
    /**
     * Mostra o resultado ICal na tela do computador.
     *
     * @return string
    */
    public function display() {
        echo $this->_ical;
    }
    
    /**
     * Salva o resultado ICal em disco com a extensao ".ics"
    */
    public function download() {
        header("Pragma: no-cache");
        header("Content-Disposition: attachment; filename=" . $this->_fileName . ".ics");
        header("Content-type: text/calendar");
        echo $this->_ical;
    }
    
    /**
     * Salva o resultado ICal em disco com a extensao ".ics"
    */
    public function save() {
        
        $filePath = $this->getFilename();
        $file = fopen($filePath, 'w');
        fwrite($file, $this->_ical);
        fclose($file);
    }
    
    /**
     * Funcao auxiliar que devolve uma data no formato RFC 2445
     *
     * @param string $date
     * @param string $time
     *
     * @return string [yyyymmddThhmmss]
    */
    public function dateBuilder($date, $time) {
        $newDate = "";
        $newTime = "";
        $newDate = $this->_date($date);
        $newTime = $this->_time($time);
        
        return $newDate . "T" . $newTime;
    }
    
    /**
     * Funcao auxiliar que trata da formatacao da data
     *
     * @param string
     *
     * @return string
    */
    protected function _date($date) {
        $date = str_replace("-", "", $date);
        $date = str_replace("/", "", $date);
        if (strlen($date) < 8) {
            $date = str_pad($date, 8, "0", STR_PAD_RIGHT);
        }
        return $date;
    }
    
    /**
     * Funcao auxiliar que trata da formatacao da hora
     *
     * @param string
     *
     * @return string
    */
    protected function _time($time) {
        $time = str_replace(":", "", $time);
        $time = str_replace("-", "", $time);
        if (strlen($time) < 6) {
            $time = str_pad($time, 6, "0", STR_PAD_RIGHT);
        }
        return $time;
    }
    
}

?>