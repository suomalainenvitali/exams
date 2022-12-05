<?
if (isset($arParams["ID_IBLOCK_CANONICAL"]))
{
    $arSelect = array(
        "ID", 
        "IBLOCK_ID", 
        "NAME", 
        "PROPERTY_NEW"
    ); 

    $arFilter = array(
        "IBLOCK_ID" => $arParams["ID_IBLOCK_CANONICAL"], 
        "PROPERTY_NEW" => $arResult["ID"],
    );

    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

    if ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arResult["CANONICAL_LINK"] = $arFields["NAME"];
        $this->__component->SetResultCacheKeys(array("CANONICAL_LINK"));
    }
}