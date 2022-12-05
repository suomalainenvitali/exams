<?
namespace Handlers\Products;

IncludeModuleLangFile(__FILE__);

define("IBLOCK_CATALOG", 2);
define("MAX_SHOWS", 2);

class ProductHandler 
{
    function OnBeforeIBlockElementUpdateHandler($arFields) 
    {
        global $APPLICATION;

        if ($arFields["IBLOCK_ID"] == IBLOCK_CATALOG) 
        {
            if ($arFields["ACTIVE"] == "N")
            {
                $arSelect = array(
                    "ID", 
                    "IBLOCK_ID", 
                    "NAME", 
                    "SHOW_COUNTER",
                ); 
            
                $arFilter = array(
                    "IBLOCK_ID" => IBLOCK_CATALOG, 
                    "ID" => $arFields["ID"],
                );
            
                $res = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

                $arItems = $res->Fetch();

                if ($arItems["SHOW_COUNTER"] > MAX_SHOWS)
                {
                    $exText = GetMessage("MAX_SHOWS", array("#COUNT#" => $arItems["SHOW_COUNTER"]));
                    $APPLICATION->throwException($exText);
                    return false;
                }
            }
        }
    }
}