<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU&onload=init"
        type="text/javascript"></script>


<script src="<?=URL::base(TRUE, TRUE) . $path_to_core?>" type="text/javascript"></script>
<? if (!empty($vars)): ?>
<script type="text/javascript">
        <? foreach ($vars as $name => $value) { ?>
    var <?=$name?> = <?= $value ?>;
        <? } ?>
</script>
<? endif; ?>
<? foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?=URL::base(TRUE, TRUE)?>media/js/map/<?=$script?>.js"></script>
<? } ?>
<div id="map" style="width: 450px; height: 350px; margin:10px;">

</div>