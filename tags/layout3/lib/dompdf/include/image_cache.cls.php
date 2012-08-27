<?php
/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @author  Helmut Tischer <htischer@weihenstephan.org>
 * @author  Fabien Ménager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @version $Id: image_cache.cls.php 455 2012-01-19 19:25:18Z eclecticgeek@gmail.com $
 */

/**
 * Static class that resolves image urls and downloads and caches
 * remote images if required.
 *
 * @access private
 * @package dompdf
 */
class Image_Cache {

  /**
   * Array of downloaded images.  Cached so that identical images are
   * not needlessly downloaded.
   *
   * @var array
   */
  static protected $_cache = array();
  
  /**
   * The url to the "broken image" used when images can't be loade
   * 
   * @var string
   */
  public static $broken_image;


static function resolve_url($url, $proto, $host, $base_path) {
  global $_dompdf_warnings;
 
 
  $resolved_url = null;
 
  // Remove dynamic part of url to determine the file extension
  $tmp = preg_replace('/\?.*/','',$url);
 
  // We need to preserve the file extenstion
  $i = mb_strrpos($tmp, ".");
  if ( $i === false )
    throw new DOMPDF_Exception("Unknown image type: $url.");
 
  $ext = mb_strtolower(mb_substr($tmp, $i+1));
 
  // NEW CODE
  if (DOMPDF_DYNAMIC_IMAGES_LINKS && $ext == "php")
  {
    $tmp = preg_replace('/.*\?/','',$url);
 
    if (preg_match("~\.(jpg|gif|png|tiff|bmp)(\&|$)~i", $tmp, $matches))
    {
      $ext = $matches[1];
    }
  }
  // END OF NEW CODE
 
  $parsed_url = explode_url($url);
 
  $remote = ($proto != "" && $proto != "file://");
  $remote = $remote || ($parsed_url['protocol'] != "");
 
  if ( !DOMPDF_ENABLE_REMOTE && $remote ) {
 
    $resolved_url = DOMPDF_LIB_DIR . "/res/broken_image.png";
    $ext = "png";
 
  } else if ( DOMPDF_ENABLE_REMOTE && $remote ) {
    // Download remote files to a temporary directory
    $url = build_url($proto, $host, $base_path, $url);
 
    if ( isset(self::$_cache[$url]) ) {
 
      list($resolved_url,$ext) = self::$_cache[$url];
      //echo "Using cached image $url (" . $resolved_url . ")\n";
 
    } else {
 
      //echo "Downloading file $url to temporary location: ";
      $resolved_url = tempnam(DOMPDF_TEMP_DIR, "dompdf_img_");
      //echo $resolved_url . "\n";
 
      $old_err = set_error_handler("record_warnings");
 
      $image = file_get_contents($url);
 
      restore_error_handler();
 
      if ( strlen($image) == 0 ) {
        $image = file_get_contents(DOMPDF_LIB_DIR . "/res/broken_image.png");
        $ext = "png";
      }
 
      file_put_contents($resolved_url, $image);
 
      self::$_cache[$url] = array($resolved_url, $ext);
 
    }
 
  } else {
 
    $resolved_url = build_url($proto, $host, $base_path, $url);
 
  }
 
  if ( !is_readable($resolved_url) || !filesize($resolved_url) ) {
    $_dompdf_warnings[] = "File " .$resolved_url . " is not readable or is an empty file.\n";
    $resolved_url = DOMPDF_LIB_DIR . "/res/broken_image.png";
    $ext = "png";
  }
 
  // Assume for now that all dynamic images are pngs
  if ( $ext == "php" ) $ext = "png";
 
  return array($resolved_url, $ext);
 
}

  /**
   * Unlink all cached images (i.e. temporary images either downloaded
   * or converted)
   */
  static function clear() {
    if ( empty(self::$_cache) || DEBUGKEEPTEMP ) return;
    
    foreach ( self::$_cache as $file ) {
      if (DEBUGPNG) print "[clear unlink $file]";
      unlink($file);
    }
  }
  
  static function detect_type($file) {
    list($width, $height, $type) = dompdf_getimagesize($file);
    return $type;
  }
  
  static function type_to_ext($type) {
    $image_types = array(
      IMAGETYPE_GIF  => "gif",
      IMAGETYPE_PNG  => "png",
      IMAGETYPE_JPEG => "jpeg",
      IMAGETYPE_BMP  => "bmp",
    );
    
    return (isset($image_types[$type]) ? $image_types[$type] : null);
  }
  
  static function is_broken($url) {
    return $url === self::$broken_image;
  }
}

Image_Cache::$broken_image = DOMPDF_LIB_DIR . "/res/broken_image.png";
