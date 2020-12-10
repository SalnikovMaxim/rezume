<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>


<div class="credentials">

    <div class="hint date"><?= date("d.m.Y", strtotime($arResult["FIELDS"]["DATE_CREATE"])); ?></div>

</div>
<div class="text" itemprop="articleBody">
    <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
        <img
                class="detail_picture"
                border="0"
                src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
                height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>"
                alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
        />
    <? endif ?>

    <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arResult["FIELDS"]["PREVIEW_TEXT"]): ?>
        <p><?= $arResult["FIELDS"]["PREVIEW_TEXT"];
            unset($arResult["FIELDS"]["PREVIEW_TEXT"]); ?></p>
    <? endif; ?>
    <? if ($arResult["NAV_RESULT"]): ?>
        <? if ($arParams["DISPLAY_TOP_PAGER"]): ?><?= $arResult["NAV_STRING"] ?><br/><? endif; ?>
        <? echo $arResult["NAV_TEXT"]; ?>
        <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?><br/><?= $arResult["NAV_STRING"] ?><? endif; ?>
    <? elseif (strlen($arResult["DETAIL_TEXT"]) > 0): ?>
        <? echo $arResult["DETAIL_TEXT"]; ?>
    <? else: ?>
        <? echo $arResult["PREVIEW_TEXT"]; ?>
    <? endif ?>


    <? if (array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y") {
        ?>
        <div class="news-detail-share">
            <noindex>
                <?
                $APPLICATION->IncludeComponent("bitrix:main.share", "", array(
                    "HANDLERS" => $arParams["SHARE_HANDLERS"],
                    "PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
                    "PAGE_TITLE" => $arResult["~NAME"],
                    "SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                    "SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                    "HIDE" => $arParams["SHARE_HIDE"],
                ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );
                ?>
            </noindex>
        </div>
        <?
    }
    ?>
</div>
    
