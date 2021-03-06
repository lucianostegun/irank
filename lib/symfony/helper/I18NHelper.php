<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * I18NHelper.
 *
 * @package    symfony
 * @subpackage helper
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: I18NHelper.php 5141 2007-09-16 14:37:58Z fabien $
 */

function __($text, $args = array(), $catalogue = 'messages', $culture=null)
{
  static $i18n;

  	$cultureTmp = MyTools::getCulture();

  	if( $culture )
  		MyTools::setCulture($culture);

  if (sfConfig::get('sf_i18n'))
  {
    if (!isset($i18n))
    {
      $i18n = sfContext::getInstance()->getI18N();
    }
    
	$returnValue = $i18n->__($text, $args, $catalogue);
	
	MyTools::setCulture($cultureTmp);

    return $returnValue;
  }
  else
  {
    if (empty($args))
    {
      $args = array();
    }

    // replace object with strings
    foreach ($args as $key => $value)
    {
      if (is_object($value) && method_exists($value, '__toString'))
      {
        $args[$key] = $value->__toString();
      }
    }
    
	MyTools::setCulture($cultureTmp);
	
    return strtr($text, $args);
  }
}

function format_number_choice($text, $args = array(), $number, $catalogue = 'messages')
{
  $translated = __($text, $args, $catalogue);

  $choice = new sfChoiceFormat();

  $retval = $choice->format($translated, $number);

  if ($retval === false)
  {
    $error = sprintf('Unable to parse your choice "%s"', $translated);
    throw new sfException($error);
  }

  return $retval;
}

function format_country($country_iso, $culture = null)
{
  $c = new sfCultureInfo($culture === null ? sfContext::getInstance()->getUser()->getCulture() : $culture);
  $countries = $c->getCountries();

  return isset($countries[$country_iso]) ? $countries[$country_iso] : '';
}

function format_language($language_iso, $culture = null)
{
  $c = new sfCultureInfo($culture === null ? sfContext::getInstance()->getUser()->getCulture() : $culture);
  $languages = $c->getLanguages();

  return isset($languages[$language_iso]) ? $languages[$language_iso] : '';
}
