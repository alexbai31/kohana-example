<div class="well">
	<div class="page-header">
		<h1>
			Редактирование профиля
		</h1>
	</div>
	<legend>
		Выберите ваш регион
	</legend>
	<form action="" id="select_location" method="post">
		<div class="selects">
			<select name="location" id="location">
				<option value="-1"> Выберите регион... </option>
				<?foreach($countries as $country):?>
				<option value="<?=$country["id"]?>">
					<?=$country["name"]?>
				</option>
				<?endforeach;?>
			</select>
		</div>
		<input type="submit" name="submit" value="Сохранить изменения">
	</form>
</div>