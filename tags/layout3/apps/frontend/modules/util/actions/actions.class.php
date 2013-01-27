<?php

/**
 * util actions.
 *
 * @package    iRank
 * @subpackage frontend
 * @author     Luciano Stegun
 */
class utilActions extends sfActions
{

  public function preExecute(){
    
  }
  
  public function executeIndex($request){
    
  }

  public function executeGetAddressByZipcode($request){
  	
  	$zipcode = $request->getParameter('zipcode');
  	
	echo Util::getAddressByZipcode($zipcode, false);
	exit;
  }
  
  public function executeObfuscate($request){
    
	$url = 'http://www.javascriptobfuscator.com/';
	$content = file_get_contents(Util::getFilePath('/js/form.js'));
	$content = str_replace(chr(10), ' ', $content);
	
	$content = '
var a="Hello World!";
function MsgBox(msg)
{
    alert(msg+"\n"+a);
}
MsgBox("OK");
                        ';
                        
	$params = array ('TextBox1'=>$content,
					 '__VIEWSTATE'=>'/wEPDwUKLTI0MDAwODAzNmQYAQUeX19Db250cm9sc1JlcXVpcmVQb3N0QmFja0tleV9fFgYFCGNiTGluZUJSBQhjYkluZGVudAULY2JFbmNvZGVTdHIFDmNiRW5jb2RlTnVtYmVyBQljYk1vdmVTdHIFDmNiUmVwbGFjZU5hbWVzWLIp5tAwfSlSb8/BzsrwTkYZR5udtjW4j8qra0WjWoA=',
					 '__EVENTVALIDATION'=>'/wEdAAvIDxFYarFOOv3KxLmnMoo9ESCFkFW/RuhzY1oLb/NUVB2nXP6dhZn6mKtmTGNHd3PN+DvxnwFeFeJ9MIBWR693/0+kJGcigziRf+JnyYP3ngWOnPKUhxuCfOKb0tlvVuly5juiFHJSf6q9cXRA/+LsCzkidEk0Y8qCyJLcOKXNoEywswNt0lfddYqrIj/HYv1fNaBSlQ4gCFEJtbofwBY37hv76BH8vu7iM4tkb8en1TRZcG/LhGcaihQKad6qZJWA4OxV8j/dbOIvemVtCa3p',
					 'TextBox3'=>'
^_get_
^_set_
^_mtd_',
					 'Button1'=>'Obfuscate',
					 'cbEncodeStr'=>'on',
					 'cbEncodeNumber'=>'on',
					 'cbReplaceNames'=>'on');

	$content = $this->post_request($url, $params);
	echo $content;
	exit;









	$url = 'http://www.phpblog.com.br/exemplos/encodejavascript/index.php';
	$content = file_get_contents(Util::getFilePath('/js/form.js'));
	$params = array ('src'=>$content,
					 '__VIEWSTATE'=>'/wEPDwUKLTI0MDAwODAzNmQYAQUeX19Db250cm9sc1JlcXVpcmVQb3N0QmFja0tleV9fFgYFCGNiTGluZUJSBQhjYkluZGVudAULY2JFbmNvZGVTdHIFDmNiRW5jb2RlTnVtYmVyBQljYk1vdmVTdHIFDmNiUmVwbGFjZU5hbWVzWLIp5tAwfSlSb8/BzsrwTkYZR5udtjW4j8qra0WjWoA=',
					 '__EVENTVALIDATION'=>'/wEdAAvIDxFYarFOOv3KxLmnMoo9ESCFkFW/RuhzY1oLb/NUVB2nXP6dhZn6mKtmTGNHd3PN+DvxnwFeFeJ9MIBWR693/0+kJGcigziRf+JnyYP3ngWOnPKUhxuCfOKb0tlvVuly5juiFHJSf6q9cXRA/+LsCzkidEk0Y8qCyJLcOKXNoEywswNt0lfddYqrIj/HYv1fNaBSlQ4gCFEJtbofwBY37hv76BH8vu7iM4tkb8en1TRZcG/LhGcaihQKad6qZJWA4OxV8j/dbOIvemVtCa3p',
					 'TextBox3'=>'^_get_
^_set_
^_mtd_',
					 'fast_decode'=>'on',
					 'ascii_encoding'=>'95',
					 'cbEncodeNumber'=>'on',
					 'cbMoveStr'=>'on',
					 'cbReplaceNames'=>'on');

	$content = $this->post_request($url, $params);
	preg_match('/<textarea id="packed" class="result" rows="10" cols="80" readonly="readonly">(.*)<\/textarea>/', $content, $matches);
	echo $matches[1];
	exit;
  }
  
  

public function post_request($url, $data, $referer='') {
 
    // Convert the data array into URL Parameters like a=b&foo=bar etc.
    $data = http_build_query($data);
 
    // parse the given URL
    $url = parse_url($url);
 
    if ($url['scheme'] != 'http') { 
        die('Error: Only HTTP request are supported !');
    }
 
    // extract host and path:
    $host = $url['host'];
    $path = $url['path'];
 
    // open a socket connection on port 80 - timeout: 30 sec
    $fp = fsockopen($host, 80, $errno, $errstr, 30);
 
    if ($fp){
 
        // send the request headers:
        fputs($fp, "POST $path HTTP/1.1\r\n");
        fputs($fp, "Host: $host\r\n");
 
        if ($referer != '')
            fputs($fp, "Referer: $referer\r\n");
 
        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: ". strlen($data) ."\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $data);
 
        $result = ''; 
        while(!feof($fp)) {
            // receive the results of the request
            $result .= fgets($fp, 128);
        }
    }
    else { 
        return array(
            'status' => 'err', 
            'error' => "$errstr ($errno)"
        );
    }
 
    // close the socket connection:
    fclose($fp);
 
    // split the result header from the content
    $result = explode("\r\n\r\n", $result, 2);
 
    $header = isset($result[0]) ? $result[0] : '';
    $content = isset($result[1]) ? $result[1] : '';
 
 return $content;
    // return as structured array:
    return array(
        'status' => 'ok',
        'header' => $header,
        'content' => $content
    );
}

  
}
