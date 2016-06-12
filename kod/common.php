<!-- dio koda (ideja multilinguae implementacije) preuzeta s http://www.bitrepository.com/php-how-to-add-multi-language-support-to-a-website.html -->
<?php
session_start();
 
if(isSet($_GET['lang']))
{
$lang = $_GET['lang'];
 
// register the session and set the cookie
$_SESSION['lang'] = $lang;
 
setcookie('lang', $lang, time() + (3600 * 24 * 30));
}
else if(isSet($_SESSION['lang']))
{
$lang = $_SESSION['lang'];
}
else if(isSet($_COOKIE['lang']))
{
$lang = $_COOKIE['lang'];
}
else
{
$lang = 'hr';
}

include_once 'lang.'.$lang.'.php';
?>