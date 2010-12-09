<?php
/**
 * Shortcuts to all request and user attribute setting/getting/has functions
 * This class simply makes repetitive tasks a few characters (and in some cases, lines) shorter to accomplish
 */
class MyTools
{
    /** Get context singleton */
    public static function getContext()
    {
        return sfContext::getInstance();
    }
 
    /** Get request singleton */
    public static function getRequest()
    {
        return sfContext::getInstance()->getRequest();
    }
 
    /** Get request singleton */
    public static function getResponse()
    {
        return sfContext::getInstance()->getResponse();
    }
 
    /** Request parameter holder */
    public static function getRequestParameterHolder()
    {
        return sfContext::getInstance()->getRequest()->getParameterHolder();
    }
 
    /** Request attribute holder */
    public static function getRequestAttributeHolder()
    {
        return sfContext::getInstance()->getRequest()->getAttributeHolder();
    }
 
    /** Request parameters (read-only) */
    public static function getRequestParameter($name, $default = null)
    {
        return sfContext::getInstance()->getRequest()->getParameter($name, $default);
    }
 
    public static function hasRequestParameter($name)
    {
        return sfContext::getInstance()->getRequest()->hasParameter($name);
    }
 
    /** Request attributes (read/write - erased after every request) */
    public static function getRequestAttribute($name, $default = null)
    {
        return sfContext::getInstance()->getRequest()->getAttribute($name, $default);
    }
 
    public static function setRequestAttribute($name, $value)
    {
        sfContext::getInstance()->getRequest()->setAttribute($name, $value);
    }
 
    public static function hasRequestAttribute($name)
    {
        return sfContext::getInstance()->getRequest()->hasAttribute($name);
    }
 
    /** Get user singleton */
    public static function getUser()
    {
        return sfContext::getInstance()->getUser();
    }
 
    /** User attribute holder */
    public static function getAttributeHolder()
    {
        return sfContext::getInstance()->getUser()->getAttributeHolder();
    }
 
    /** User parameter holder */
    public static function getParameterHolder()
    {
        return sfContext::getInstance()->getUser()->getParameterHolder();
    }
 
    /** User flash parameters (stored in the session until the next request) */
    public static function setFlash($name, $value)
    {
        sfContext::getInstance()->getUser()->setAttribute($name, $value, 'symfony/flash');
    }
 
    public static function getFlash($name)
    {
    	
        $flash = sfContext::getInstance()->getUser()->getAttribute($name, null, 'symfony/flash');
        self::setFlash($name, null);
        return $flash;
    }
 
    public static function hasFlash($name)
    {
        return sfContext::getInstance()->getUser()->hasFlash($name);
    }
 
    /** User attribute parameters (stored in the session until removed) */
    public static function getAttribute($name, $default = null, $ns = 'iRank')
    {
        return sfContext::getInstance()->getUser()->getAttribute($name, $default, $ns);
    }
 
    public static function setAttribute($name, $value, $ns = 'iRank')
    {
        sfContext::getInstance()->getUser()->setAttribute($name, $value, $ns);
    }
 
    public static function removeAttribute($name, $ns = 'iRank')
    {
        sfContext::getInstance()->getUser()->removeAttribute($name, $ns);
    }
 
    public static function getAttributes($ns = 'iRank')
    {
        return sfContext::getInstance()->getUser()->getAttributes($ns);
    }
 
    public static function removeAttributes($ns = 'iRank')
    {
        sfContext::getInstance()->getUser()->removeAttributes($ns);
    }
 
    /** User parameter parameters (erased after every request) */
    public static function getParameter($name, $default = null, $ns = 'iRank')
    {
        return sfContext::getInstance()->getUser()->getParameter($name, $default, $ns);
    }
 
    public static function setParameter($name, $value, $ns = 'iRank')
    {
        sfContext::getInstance()->getUser()->setParameter($name, $value, $ns);
    }
 
    public static function removeParameter($name, $ns = 'iRank')
    {
        sfContext::getInstance()->getUser()->removeParameter($name, $ns);
    }
 
    public static function getParameters($ns = 'iRank')
    {
        return sfContext::getInstance()->getUser()->getParameters($ns);
    }
 
    public static function removeParameters($ns = 'iRank')
    {
        sfContext::getInstance()->getUser()->removeParameters($ns);
    }
 
    /** User credentials */
    public static function clearCredentials()
    {
        sfContext::getInstance()->getUser()->clearCredentials();
    }
 
    public static function listCredentials()
    {
        return sfContext::getInstance()->getUser()->listCredentials();
    }
 
    public static function removeCredential($credential)
    {
        sfContext::getInstance()->getUser()->removeCredential($credential);
    }
 
    public static function addCredential($credential)
    {
        sfContext::getInstance()->getUser()->addCredential($credential);
    }
 
    public static function addCredentials()
    {
        sfContext::getInstance()->getUser()->addCredentials(func_get_args());
    }
 
    public static function hasCredential($credential)
    {
        return sfContext::getInstance()->getUser()->hasCredential($credential);
    }
 
    /** User authentication */
    public static function isAuthenticated()
    {
        return sfContext::getInstance()->getUser()->isAuthenticated();
    }
 
    public static function setAuthenticated($authenticated)
    {
        sfContext::getInstance()->getUser()->setAuthenticated($authenticated);
    }
 
    /** User culture */
    public static function setCulture($culture)
    {
        sfContext::getInstance()->getUser()->setCulture($culture);
    }
 
    public static function setError( $errorName, $errorMessage )
    {
    	
    	$request = MyTools::getRequest();
        $request->setError( $errorName, $errorMessage );
    }
	
	public static function urlFor($internalUri, $absolute = false){
	  static $controller;
	
	  if (!isset($controller))
	  {
	    $controller = sfContext::getInstance()->getController();
	  }
	
	  return $controller->genUrl($internalUri, $absolute);
	}
 
    /** User attribute parameters (stored in the session until removed) */
    public static function getCookie($name, $default = null)
    {
        return MyTools::getRequest()->getCookie($name, $default);
    }
 
    public static function setCookie($name, $value, $expire=null, $path='/')
    {
        MyTools::getResponse()->setCookie($name, $value, $expire, $path);
    }

}
?>