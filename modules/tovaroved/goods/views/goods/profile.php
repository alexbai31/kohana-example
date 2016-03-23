<div class="well">
    <?=$category->name?>
    <div class="page-header">
        <h1>
            <?=$profile->name;?>
        </h1>
    </div>

    <?if (isset($images) && !empty($images)) { ?>
    <legend>Фото</legend>
    <div class="gallery">
        <? foreach ($images as $index => $image) { ?>
        <a href="<?=$img_path?>goods/<?=$profile->id?>/<?=$image?>" rel="lightbox"><img src="<?=$img_path?>goods/<?=$profile->id?>/<?=$image?>" <?= ($index+1) == $profile->default_image ? 'style="display: block; width:100px;"' : 'style="display:none"'?> ></a>
        <? } ?>
    </div>
    <? } else { ?>
    <legend>Фото</legend>
    <img src="http://dummyimage.com/120/99cccc.gif&text=Изображение+отсутсвует" />
    <? } ?>

    <legend>
        Цены
    </legend>
    <?if(!empty($max_price)):?>
    <p>
       Максимальная - <?=$max_price[0]["value"] . " " . $max_price[0]["code"]?> 
   </p>
   <?endif;?>
   <?if(!empty($min_price)):?>
   <p>
       Минимальная - <?=$min_price[0]["value"] . " " . $min_price[0]["code"]?> 
   </p>
   <?endif;?>
   <legend>Дополнительная информация</legend>
   <?foreach ($goods_properties as $property) { ?>
   <p><?=$property['name']?> : <?= !empty($property['value']) ? $property["value"] : $property["value_numeric"]?></p>
   <? }?>
</div>

<?OUT::_(
'<a href="'.$url_base.'goods/edit/'. $profile->id .'">Редактировать товар</a>', "edit_good");?>
<div class="clearfix"></div>
<br>
</div>