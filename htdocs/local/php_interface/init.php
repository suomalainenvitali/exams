<?
require_once( $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/autoload.php');

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", array(Handlers\Products\ProductHandler::class, "OnBeforeIBlockElementUpdateHandler"));

