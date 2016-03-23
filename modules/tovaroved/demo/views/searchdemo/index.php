<div>
    <form method="POST"><input placeholder="Через запятую, yandex" name="query_yandex_comma" type="text"><input
            value="искать" type="submit"></form>
    <form method="POST"><input placeholder="Два поля, yandex (магазин)" name="query_yandex_twofields[]" type="text"><input
            placeholder="Два поля, yandex (адрес)" name="query_yandex_twofields[]" type="text"><input value="искать"
                                                                                              type="submit"></form>
    <form method="POST"><input placeholder="Через запятую, склейка" name="query_implode_comma" type="text"><input
            value="искать" type="submit"></form>
    <form method="POST"><input placeholder="Два поля, склейка (магазин)" name="query_implode_twofields[]" type="text"><input
            placeholder="Два поля, склейка (адрес)" name="query_implode_twofields[]" type="text"><input value="искать"
                                                                                                type="submit"></form>
</div>
<? if (isset($query)) { ?>
<div class="well">
    <h1><?=$query?></h1>
    <ul>
        <?foreach ($results as $result) { ?>
        <li>
            <?=$result["name"]?> <?=$result["address"]?>
        </li>
        <? }?>


    </ul>
</div>
<? } ?>