<div class="well">
    <div class="item">
        <div class="page-header">
            <h3>Магазины </h3>
        </div>
        <?OUT::_('<a href="'.URL::base(TRUE, TRUE).'store" style="position:relative;display:block;float:left;margin:10px;"><img src="'.$img_path .'store-logo.png" alt="" class="img-polaroid"/><p style="position:absolute;top:0;left:10px;">Магазины</p></a>', 'stores');?>
        <?OUT::_('<a href="'.URL::base(TRUE, TRUE).'store/add" style="position:relative;display:block;float:left;margin:10px;"><img src="'.$img_path .'add-store.png" alt="" class="img-polaroid"/><p style="position:absolute;top:0;left:10px;">Добавить магазин</p></a>', 'add_store');?>
        <div style="clear:both"></div>
    </div>
    <div class="item">
        <div class="page-header">
            <h3>Товары </h3>
        </div>

        <?OUT::_('<a href="'.URL::base(TRUE, TRUE).'goods/add" style="position:relative;display:block;float:left;margin:10px;"><img src="'.$img_path .'goods-logo.png" alt="" class="img-polaroid"/><p style="position:absolute;top:0;left:10px;">Добавить товары</p></a>', 'add_goods');?>
        <?OUT::_('<a href="'.URL::base(TRUE, TRUE).'goods" style="position:relative;display:block;float:left;margin:10px;"><img src="'.$img_path .'goods-logo.png" alt="" class="img-polaroid"/><p style="position:absolute;top:0;left:10px;">Товары</p></a>', 'goods');?>

        <div style="clear:both"></div>
    </div>
    <div class="item">
        <div class="page-header">
            <h3>Цены </h3>
        </div>

        <?OUT::_('<a href="'.URL::base(TRUE, TRUE).'price/add" style="position:relative;display:block;float:left;margin:10px;"><img src="'.$img_path .'goods-logo.png" alt="" class="img-polaroid"/><p style="position:absolute;top:0;left:10px;">Добавить цены</p></a>', 'add_prices');?>

        <div style="clear:both"></div>
    </div>
</div>