<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>

<div class="f_feedback">

<?
if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}

if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?>
	<div class="f_feedback__result">
		<?=$arResult["OK_MESSAGE"]?>
	</div>
	<?
}
?>

<form action="<?=POST_FORM_ACTION_URI?>" method="POST">
	<?=bitrix_sessid_post()?>

	<?if(in_array("NAME", $arParams["SELECTED_FIELDS"])):?>
	<div class="f_feedback__group">
		<input
		type="text"
		class="f_feedback__input"
		name="user_name"
		value="<?=$arResult["AUTHOR_NAME"];?>"
		placeholder="<?=GetMessage("FT_NAME")?>"
		<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?>
			required=""
		<?endif;?>
		>
	</div>
	<?endif;?>

	<?if(in_array("EMAIL", $arParams["SELECTED_FIELDS"])):?>
	<div class="f_feedback__group">
		<input
		type="text"
		class="f_feedback__input"
		name="user_email"
		value="<?=$arResult["AUTHOR_EMAIL"];?>"
		placeholder="<?=GetMessage("FT_EMAIL")?>"
		<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?>
			required=""
		<?endif;?>
		>
	</div>
	<?endif;?>

	<?if(in_array("PHONE", $arParams["SELECTED_FIELDS"])):?>
	<div class="f_feedback__group">
		<input
		type="text"
		class="f_feedback__input"
		name="user_phone"
		value=""
		placeholder="<?=GetMessage("FT_PHONE")?>"
		<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?>
			required=""
		<?endif;?>
		>
	</div>
	<?endif;?>

	<?if(in_array("MESSAGE", $arParams["SELECTED_FIELDS"])):?>
	<div class="f_feedback__group">
		<textarea
		name="message"
		class="f_feedback__textarea"
		rows="5"
		<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?>
			required=""
		<?endif;?>
		></textarea>
	</div>
	<?endif;?>

	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<div class="f_feedback__captcha">
		<div class="mf-text"><?=GetMessage("FT_CAPTCHA")?></div>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<div class="mf-text"><?=GetMessage("FT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="">
	</div>
	<?endif;?>

	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input class="f_feedback__button" type="submit" name="submit" value="<?=GetMessage("FT_SUBMIT")?>">

</form>

</div>