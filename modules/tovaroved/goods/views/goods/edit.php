<div class="well">
	<form class="form-horizontal edit_form" method="POST" enctype="multipart/form-data">
		<legend>
			Основные параметры
		</legend>

		<? OUT::_('<div class="control-group">
			<label class="control-label" for="category">Категория</label>
			<div class="controls">' .
			FORM::select('category_id', $categories, $current_category, array('id' => 'category'))
			. '</div>
		</div>', 'add_goods_category') ?>

		<? OUT::_('<div class="control-group">
			<label class="control-label" for="chain">Торговая марка</label>
			<div class="controls">
			<input type="text" name="brand" value="'.$current_brand.'" placeholder="Торговая марка" id="brand" />
			<input type="hidden" id="brandid" name="brand_id" value="">
			</div>
		</div>', 'add_goods_brand') ?>

		<? OUT::_('<div class="control-group">
			<label class="control-label" for="name">Название</label>
			<div class="controls">
			<input type="text" name="name" placeholder="Название..." id="name" value="'.$current_name.'"/>
			</div>
		</div>', 'add_goods_name') ?>

		<?$properties = "";?>

		<?foreach ($goods_properties as $value) {
			$properties .= '<p class="mark-str" title="'. (!empty($value["value"]) ?$value["value"]: $value["value_numeric"]) .'">'.$value["name"].'<input type="hidden" name="properties['.$value["id"].']" value="4">&nbsp;:&nbsp;'.(!empty($value["value"]) ?$value["value"]: $value["value_numeric"]).'&nbsp;<button type="button" data-id="'.$value["id"].'" class="delete btn">X</button></p>';
		} ?>

		

		<? OUT::_('<div class="control-group">
			<label class="control-label" for="properties">Дополнительная информация</label>
			<div class="controls">
			<div class="propertieslist">' .

			$properties .

			FORM::select('info_type_id', $info_types, NULL, array('class' => 'info_types'))

			. '</div>

			<div class="info-panel">

			</div>
			<div>
			<br>
			<a href="#" role="button" class="btn add_info">Добавить</a>
			</div>

		</div>', 'add_goods_properties') ?>


<?if (isset($images) && !empty($images)) { ?>
		<legend>Фото</legend>
		<div class="gallery">
			<? foreach ($images as $index => $image) { 
				$checked = str_replace(".jpg", "", $image) == $default_image ? 'checked="checked"' : "";
				?>
			<table>
				<tr>
					<td>
						<a href="<?=$img_path?>goods/<?=$current_id?>/<?=$image?>" rel="lightbox"><img src="<?=$img_path?>goods/<?=$current_id?>/<?=$image?>" style="width:200px;"></a>
					</td>
				</tr>
				<tr>
					<td>
						<label for=""> <input type="checkbox" name="deleting_images[]" value="<?=$image?>"> Удалить изображение</label>
						<label for=""> <input type="radio" name="default_image" value="<?=$image?>"  <?=$checked?>> Изображение по умолчанию</label>
					</td>
				</tr>
			</table>
			<? } ?>
		</div>
		<? } else { $images = []; } ?>

		<? end($images); $last = current($images) ? str_replace(".jpg", "", end($images)) + 1 : 1; ?>
		<script type="text/javascript">
			var counter = <?=$last?>
		</script>

		<? OUT::_('<div class="control-group">
			<label class="control-label" for="image">Добавить изображение</label>
			<div class="controls">

			<div>
			<input type="file" name="image['. $last .']" data-id="' . $last . '" class="image">
			<label for=""><input type="radio" name="default_image" value="' .$last. '"> Изображение по умолчанию </label>
			</div>
			<p class="add_more_images">Добавить больше изображений</p>
			</div>
		</div>', 'add_images') ?>
		
		<br>
		<input class="btn btn-primary" id="send_form" type="submit" value="Сохранить изменения">
	</form>
</div>