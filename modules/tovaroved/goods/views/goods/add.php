<div class="well">
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
        <legend>
            Основные параметры
        </legend>

        <? OUT::_('<div class="control-group">
                <label class="control-label" for="category">Категория</label>
                <div class="controls">' .
                  FORM::select('category_id', $categories, NULL, array('id' => 'category'))
                  . '</div>
            </div>', 'add_goods_category') ?>

        <? OUT::_('<div class="control-group">
			<label class="control-label" for="chain">Торговая марка</label>
			<div class="controls">
				<input type="text" name="brand" placeholder="Торговая марка" id="brand" />
				<input type="hidden" id="brandid" name="brand_id" value="">
			</div>
		</div>', 'add_goods_brand') ?>

        <? OUT::_('<div class="control-group">
			<label class="control-label" for="name">Название</label>
			<div class="controls">
				<input type="text" name="name" placeholder="Название..." id="name" />
			</div>
		</div>', 'add_goods_name') ?>

        <? OUT::_('<div class="control-group">
			<label class="control-label" for="properties">Дополнительная информация</label>
			<div class="controls">
			<div class="propertieslist">' .
                  FORM::select('info_type_id', $info_types, NULL, array('class' => 'info_types'))

                  . '</div>

			    <div class="info-panel">

			    </div>
			    <div>
			    <br>
				<a href="#" role="button" class="btn add_info">Добавить</a>
				</div>

		</div>', 'add_goods_properties') ?>


        <? OUT::_('<div class="control-group">
			<label class="control-label" for="image">Добавить изображение</label>
			<div class="controls">

				<div>
					<input type="file" name="image[]" data-id="1" class="image">
					<label for=""><input type="radio" name="default_image" value="1" checked="checked"> Изображение по умолчанию </label>
				</div>
			    <p class="add_more_images">Добавить больше изображений</p>
			</div>
		</div>', 'add_images') ?>
		<label for="all_right"><input type="checkbox" name="all_right"> Все данные указаны верно </label> 
        <input class="btn btn-primary" id="send_form" type="submit" value="Добавить товар" disabled="disabled">

    </form>

</div>