<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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


<?foreach($arResult["ITEMS"] as $arItem):?>
	<a href="/arenda/

<? $res = CIBlockElement::GetByID($arItem[ID]); 
                                while($obRes = $res->GetNextElement())
                                 {
                                 $ar_res = $obRes->GetProperty("HREF");
  	                             echo $ar_res['VALUE'];
                                  }?>
	/" class="maincatalog__coll">

	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

<div class="maincatalog__img">
				<img
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					/>

</div>
			<div class="maincatalog__items">
			<div class="maincatalog__caption"><?echo $arItem["NAME"]?>		</div>
		
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<div class="maincatalog__price"><?echo $arItem["PREVIEW_TEXT"];?></div>
		<?endif;?>
		</div>
<span class="maincatalog__link"></span>
			</a>
<?endforeach;?>


