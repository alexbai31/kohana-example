<div class="well">
    <?=$category->name?>
    <div class="page-header">
        <h1>
            <?=$name;?>
        </h1>
        <a href="<?=$url_base?>store/catalog/<?=$id?>">Каталог товаров</a>
    </div>
    <div class="span-4">
        <?if (isset($images) && !empty($images)) { ?>
        <legend>Фото</legend>
        <img src="<?=$img_path?>stores/<?=$id?>/<?=array_pop($images)?>" alt="" style="width:100px">
        <? }?>
        <p><?=$current_rating?></p>
        <legend>Адрес</legend>
        <p><?=$address?></p>
        <legend>Режим работы -</legend>
    <p>
        <?$schedule = json_decode($schedule, true)?>
        <?if (!isset($schedule[0])): ?>
        <? if (!is_array($schedule["from"])): ?>
            <p>C <?=$schedule["from"]?>-00 По <?=$schedule["to"]?>-00</p>
            <? if (isset($schedule["break"])): ?>
                <p>Перерыв с <?=$schedule["break"]["sch"]["from"];?>-00
                    по <?=$schedule["break"]["sch"]["to"];?>-00</p>
                <? endif; ?>
            <? else: ?>
            <? foreach (Days::get_days_of_week() as $day) { ?>
                <ul>
                    <li>
                        <?=Days::translate_to("ru", $day)?>:
                        C: <?=$schedule["from"][$day]?>
                        По: <?=$schedule["to"][$day]?>
                        <?if (isset($schedule["break"][$day])): ?>
                        <p>Перерыв с <?=$schedule["break"][$day]["from"];?>-00
                            по <?=$schedule["break"][$day]["to"];?>-00</p>
                        <? endif;?>
                    </li>
                </ul>
                <? } ?>
            <? endif; ?>
        <? else: ?>
        <p>Круглосуточно</p>
        <?endif;?>
        </p>
        <legend>Контакты</legend>
    <p>
        <?if (!is_null($contacts)): ?>
        <? foreach (json_decode($contacts, true) as $type => $value) { ?>
            <p><strong><?=$type?></strong>:
            <? foreach ($value as $node): ?>
                <?= $node ?>
                <? endforeach; ?>
            <? } ?>
        <? endif;?>
    </p>
        <legend>Дополнительная информация</legend>
        <?foreach ($store_properties as $property) { ?>
        <p><?=$property['name']?> : <?=$property['value']?></p>
        <? }?>
    </div>
    <div style="float:right;">
        <?=$map?>
    </div>
    <div class="clearfix"></div>
    <br>

    <?OUT::_('<a href="#" class="add_to_places_link">
                Добавить в мои места
            </a>
            <div class="add_form">
            </div>
            ', "add_to_my_places")?>



</div>
