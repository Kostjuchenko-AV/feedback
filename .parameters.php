<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
$arFilter = Array("TYPE_ID" => "FEEDBACK_FORM", "ACTIVE" => "Y");
if($site !== false)
	$arFilter["LID"] = $site;

$arEvent = Array();
$dbType = CEventMessage::GetList($by="ID", $order="DESC", $arFilter);
while($arType = $dbType->GetNext())
	$arEvent[$arType["ID"]] = "[".$arType["ID"]."] ".$arType["SUBJECT"];

$selectedFieldsValues = $arCurrentValues["SELECTED_FIELDS"];

$arComponentParameters = array(
	"PARAMETERS" => array(
		"AJAX_MODE" => array(),
		"USER_CONSENT" => array(),
		"USE_CAPTCHA" => Array(
			"NAME" => GetMessage("FP_CAPTCHA"), 
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y", 
			"PARENT" => "BASE",
		),
		"OK_TEXT" => Array(
			"NAME" => GetMessage("FP_OK_MESSAGE"), 
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("FP_OK_TEXT"), 
			"PARENT" => "BASE",
		),
		"EMAIL_TO" => Array(
			"NAME" => GetMessage("FP_EMAIL_TO"), 
			"TYPE" => "STRING",
			"DEFAULT" => htmlspecialcharsbx(COption::GetOptionString("main", "email_from")), 
			"PARENT" => "BASE",
		),
		"SELECTED_FIELDS" => Array(
			"NAME" => GetMessage("FP_SELECTED_FIELDS"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"REFRESH" => "Y", 
			"VALUES" => Array(
				"NAME" => GetMessage("FP_NAME"),
				"EMAIL" => GetMessage("FP_EMAIL"),
				"PHONE" => GetMessage("FP_PHONE"),
				"MESSAGE" => GetMessage("FP_MESSAGE")
			),
			"DEFAULT" => "",
			"COLS" => 25, 
			"PARENT" => "BASE",
		),
		"EVENT_MESSAGE_ID" => Array(
			"NAME" => GetMessage("FP_EMAIL_TEMPLATES"), 
			"TYPE"=>"LIST", 
			"VALUES" => $arEvent,
			"DEFAULT" => "", 
			"MULTIPLE"=>"Y", 
			"COLS" => 25, 
			"PARENT" => "BASE",
		),

	)
);

if(count($selectedFieldsValues) > 0) {
	foreach($selectedFieldsValues as $value) {
		$fields[$value] = GetMessage("FP_".$value);
	}
	$fields = array("NONE" => GetMessage("FP_ALL_REQ")) + $fields;
	$arComponentParameters["PARAMETERS"]["REQUIRED_FIELDS"] = Array(
		"NAME" => GetMessage("FP_REQUIRED_FIELDS"), 
		"TYPE" => "LIST", 
		"MULTIPLE" => "Y", 
		"VALUES" => $fields,
		"DEFAULT" => "", 
		"COLS" => 25, 
		"PARENT" => "BASE",
	);
}


?>