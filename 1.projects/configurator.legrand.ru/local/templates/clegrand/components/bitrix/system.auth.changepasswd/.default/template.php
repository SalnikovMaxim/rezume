<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["PHONE_REGISTRATION"])
{
	CJSCore::Init('phone_auth');
}
?>
<div class="container section-style">
    <div class="page-title"><?=GetMessage("AUTH_CHANGE_PASSWORD")?></div><br>

<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>

<?if($arResult["SHOW_FORM"]):?>

<form class="decor-form" method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
	<?if (strlen($arResult["BACKURL"]) > 0): ?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<? endif ?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="CHANGE_PWD">
    <div class="decor-form__fields">
<?if($arResult["PHONE_REGISTRATION"]):?>
    <div class="decor-form__field">
        <label class="label-style">
            <span class="label-style__head"><span class="label-style__hint"><?echo GetMessage("sys_auth_chpass_phone_number")?></span></span>
            <input class="input input-style"  type="text" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" disabled="disabled" />
            <input type="hidden" name="USER_PHONE_NUMBER" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" />
        </label>
    </div>
    <div class="decor-form__field">
        <label class="label-style">
            <span class="label-style__head"><span class="label-style__hint"><?echo GetMessage("sys_auth_chpass_code")?></span></span>
            <input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" class="input input-style" autocomplete="off" />
        </label>
    </div>

<?else:?>
    <div class="decor-form__field">
        <label class="label-style">
            <span class="label-style__head"><span class="label-style__hint"><?=GetMessage("AUTH_LOGIN")?></span></span>
            <input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" class="input input-style" />
        </label>
    </div>
    <div class="decor-form__field">
        <label class="label-style">
            <span class="label-style__head"><span class="label-style__hint"><?=GetMessage("AUTH_CHECKWORD")?></span></span>
            <input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" class="input input-style" autocomplete="off" />
        </label>
    </div>

<?endif?>
        <div class="decor-form__field">
            <label class="label-style">
                <span class="label-style__head"><span class="label-style__hint"><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?></span></span>
                <input type="password" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" class="input input-style" autocomplete="off" />
            </label>
            <?if($arResult["SECURE_AUTH"]):?>
                <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
                <noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
                </noscript>
                <script type="text/javascript">
                    document.getElementById('bx_auth_secure').style.display = 'inline-block';
                </script>
            <?endif?>
        </div>
        <div class="decor-form__field">
            <label class="label-style">
                <span class="label-style__head"><span class="label-style__hint"><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?></span></span>
                <input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="input input-style" autocomplete="off" />
            </label>
        </div>

		<?if($arResult["USE_CAPTCHA"]):?>
            <div class="decor-form__field">
                <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                <label class="label-style">
                    <span class="label-style__head"><span class="label-style__hint"><?echo GetMessage("system_auth_captcha")?></span></span>
                    <input type="text" name="captcha_word" maxlength="50" value="" class="input input-style" />
                </label>
            </div>
		<?endif?>
        <div class="decor-form__row">
            <div class="decor-form__field">
                <input class="my-btn" type="submit" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" />
            </div>
        </div>
    </div>
</form>

<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>

<?if($arResult["PHONE_REGISTRATION"]):?>

<script type="text/javascript">
new BX.PhoneAuth({
	containerId: 'bx_chpass_resend',
	errorContainerId: 'bx_chpass_error',
	interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
	data:
		<?=CUtil::PhpToJSObject([
			'signedData' => $arResult["SIGNED_DATA"]
		])?>,
	onError:
		function(response)
		{
			var errorDiv = BX('bx_chpass_error');
			var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
			errorNode.innerHTML = '';
			for(var i = 0; i < response.errors.length; i++)
			{
				errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
			}
			errorDiv.style.display = '';
		}
});
</script>

<div id="bx_chpass_error" style="display:none"><?ShowError("error")?></div>

<div id="bx_chpass_resend"></div>

<?endif?>

<?endif?>

<p><a href="<?=$arResult["AUTH_AUTH_URL"]?>"><b><?=GetMessage("AUTH_AUTH")?></b></a></p>

</div>