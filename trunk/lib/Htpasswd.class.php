<?php

/**
 * Classe responsável pela atualização do arquivo .htpasswd 
 *
 * @package    iRank
 * @author     Luciano Stegun
 */
class Htpasswd {
    
	public static function save_htpasswd( $pass_array ){
	  
	  $result = true;
	
	  ignore_user_abort(true);
	  $fp = fopen(HTPASSWDFILE, "w+");
	  if( flock($fp, LOCK_EX) ){
	    
	    while( list($u,$p) = each($pass_array) )
	      fputs($fp, "$u:$p\n");
	    
	    flock($fp, LOCK_UN); // release the lock
	  }else{
	    
	    trigger_error("Could not save (lock) .htpasswd", E_USER_WARNING);
	    $result = false;
	  }
	  
	  fclose($fp);
	  ignore_user_abort(false);
	  return $result;
	}
	
	// Generates a htpasswd compatible crypted password string.
	public function rand_salt_crypt( $pass ){
	  
	  $salt = "";
	  
	  mt_srand((double)microtime()*1000000);
	  
	  for ($i=0; $i<CRYPT_SALT_LENGTH; $i++)
	    $salt .= substr("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789./", mt_rand() & 63, 1);
	    
	  return crypt($pass, $salt);
	}
	
	// Generates a htpasswd compatible sha1 password hash
	public static function rand_salt_sha1( $pass ){
		
	  mt_srand((double)microtime()*1000000);
	  $salt = pack("CCCC", mt_rand(), mt_rand(), mt_rand(), mt_rand());
	  
	  return "{SSHA}" . base64_encode(pack("H*", sha1($pass . $salt)) . $salt);
	}
	
	// Generate a SHA1 password hash *without* salt
	public static function non_salted_sha1( $pass ){
		
	  return "{SHA}" . base64_encode(pack("H*", sha1($pass)));
	}
	
	// Returns true if the user exists and the password matches, false otherwise
	public static function test_htpasswd( $pass_array, $user, $pass ){
		
	  if ( !isset($pass_array[$user]))
	      return False;
	  $crypted = $pass_array[$user];
	
	  // Determine the password type
	  // TODO: Support for MD5 Passwords
	  if ( substr($crypted, 0, 6) == "{SSHA}" )
	  {
	    $ohash = base64_decode(substr($crypted, 6));
	    return substr($ohash, 0, 20) == pack("H*", sha1($pass . substr($ohash, 20)));
	  }
	  else if ( substr($crypted, 0, 5) == "{SHA}" )
	    return (non_salted_sha1($pass) == $crypted);
	  else
	    return crypt( $pass, substr($crypted,0,CRYPT_SALT_LENGTH) ) == $crypted;
	}
	
	// Internal test
	public static function internal_unit_test(){
	  
	  $pwds = Array( "Test" => rand_salt_crypt("testSecret!"),
	                 "fish" => rand_salt_crypt("sest Ticret"),
	                 "Generated" => "/uieo1ANOvsdA",
	                 "Generated2" => "Q3cbHUBgm7aYk");
	
	  assert( test_htpasswd( $pwds, "Test", "testSecret!" ));
	  assert( !test_htpasswd( $pwds, "Test", "wrong pass" ));
	  assert( test_htpasswd( $pwds, "fish", "sest Ticret" ));
	  assert( !test_htpasswd( $pwds, "fish", "wrong pass" ));
	  assert( test_htpasswd( $pwds, "Generated", "withHtppasswdCmd" ));
	  assert( !test_htpasswd( $pwds, "Generated", "" ));
	  assert( test_htpasswd( $pwds, "Generated2", "" ));
	  assert( !test_htpasswd( $pwds, "Generated2", "this is wrong too" ));
	}
}
?>