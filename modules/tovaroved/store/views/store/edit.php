<div class="page-header">
    <h2>Добавление магазина</h2>
</div>
<div class="well">
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
        <legend>
            Информация
        </legend>

        <?=$map?>

        <? OUT::_('<div class="control-group">
			<label class="control-label" for="category">Категория</label>
			<div class="controls">' .
                  FORM::select('category_id', $categories, NULL, array('id' => 'category'))
                  . '</div>
		</div>', 'add_category') ?>


        <? OUT::_('<div class="control-group">
			<label class="control-label" for="chain">Сеть</label>
			<div class="controls">
				<input type="text" name="chain" placeholder="Торговая сеть" id="chain" />
				<input type="hidden" id="chainid" name="chain_id" value="">
			</div>
		</div>', 'add_chain') ?>


        <? OUT::_('<div class="control-group">
			<label class="control-label" for="name">Название</label>
			<div class="controls">
				<input type="text" name="name" placeholder="Название..." id="name" />
			</div>
		</div>', 'add_name') ?>


        <? OUT::_('	<div class="control-group">
			<label class="control-label" for="address">Адрес</label>
			<div class="controls">
				<input type="text" name="address" placeholder="Адрес.." id="address" />
			</div>
		</div>', 'add_address') ?>


        <? OUT::_('<div class="control-group">
    <label class="control-label" for="address">Режим работы</label>

    <div class="controls">
        <a href="#schedule" role="button" class="btn" data-toggle="modal">Выбрать</a>

        <div class="modal hide fade" id="schedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Режим работы</h3>
            </div>
            <div class="modal-body">
                <select name="schedule_type" id="schedule_options">
                    <option value="all">Круглосуточно</option>
                    <option value="every">Каждый день</option>
                    <option value="individual">Индивидуальный</option>
                </select>
                <br><br>

                <div class="schedule_variants">
                    <div class="all"></div>
                    <div class="every">
                        <label for="from"> С: <input type="text" class="input-small" name="schedule[from]" id="from"></label>
                        <label for="to"> По: <input class="input-small" type="text" name="schedule[to]" id="to"></label>
                        <label for="breaktime"> <a href="#" class="breaktime">добавить перерыв</a></label>

                    </div>
                    <div class="individual">
                        <div class="monday">
                            <p>Понедельник</p>
                            <label for="from"> С: <input type="text" class="input-small" name="schedule[from][mon]" id="from_mon"></label>
                            <label for="to"> По: <input class="input-small" type="text" name="schedule[to][mon]" id="to_mon"></label>
                            <label for="breaktime"> <a href="#" class="breaktime">добавить перерыв</a></label>
                        </div>
                        <div class="tuesday">
                            <p>Вторник</p>
                            <label for="from"> С: <input type="text" class="input-small" name="schedule[from][tue]" id="from_tue"></label>
                            <label for="to"> По: <input class="input-small" type="text" name="schedule[to][tue]" id="to_tue"></label>
                            <label for="breaktime"> <a href="#" class="breaktime">добавить перерыв</a></label>
                        </div>
                        <div class="wednesday">
                            <p>Среда</p>
                            <label for="from"> С: <input type="text" class="input-small" name="schedule[from][wed]" id="from_wed"></label>
                            <label for="to"> По: <input class="input-small" type="text" name="schedule[to][wed]" id="to_wed"></label>
                            <label for="breaktime"> <a href="#" class="breaktime">добавить перерыв</a></label>
                        </div>
                        <div class="thursday">
                            <p>Четверг</p>
                            <label for="from"> С: <input type="text" class="input-small" name="schedule[from][thu]" id="from_thu"></label>
                            <label for="to"> По: <input class="input-small" type="text" name="schedule[to][thu]" id="to_thu"></label>
                            <label for="breaktime"> <a href="#" class="breaktime">добавить перерыв</a></label>
                        </div>
                        <div class="friday">
                            <p>Пятница</p>
                            <label for="from"> С: <input type="text" class="input-small" name="schedule[from][fri]" id="from_fri"></label>
                            <label for="to"> По: <input class="input-small" type="text" name="schedule[to][fri]" id="to_fri"></label>
                            <label for="breaktime"> <a href="#" class="breaktime">добавить перерыв</a></label>
                        </div>
                        <div class="saturday">
                            <p>Суббота</p>
                            <label for="from"> С: <input type="text" class="input-small" name="schedule[from][sat]" id="from_sat"></label>
                            <label for="to"> По: <input class="input-small" type="text" name="schedule[to][sat]" id="to_sat"></label>
                            <label for="breaktime"> <a href="#" class="breaktime">добавить перерыв</a></label>
                        </div>
                        <div class="sunday">
                            <p>Воскресенье</p>
                            <label for="from"> С: <input type="text" class="input-small" name="schedule[from][sun]" id="from_sun"></label>
                            <label for="to"> По: <input class="input-small" type="text" name="schedule[to][sun]" id="to_sun"></label>
                            <label for="breaktime"> <a href="#" class="breaktime">добавить перерыв</a></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Save</button>
            </div>
        </div>
    </div>
</div>
		', 'add_schedule') ?>


        <? OUT::_('<div class="control-group">
			<label class="control-label" for="contacts">Контактная информация</label>
			<div class="controls">
			    <div class="contactlist">'.
                    FORM::select('contact_type_id', $contact_types, NULL, array('class' => 'contact_types'))
			   .' </div>
			    <div class="panel">

			    </div>
			    <div>
			    <br>
				    <a href="#" role="button" class="btn add_contact" >Добавить</a>
                </div>
		     </div>', 'add_contacts') ?>
        <hr>
        <? OUT::_('<div class="control-group">
			<label class="control-label" for="properties">Дополнительная информация</label>
			<div class="controls">
			<div class="propertieslist">'.
                 FORM::select('info_type_id', $info_types, NULL, array('class' => 'info_types'))

			    .'</div>

			    <div class="info-panel">

			    </div>
			    <div>
			    <br>
				<a href="#" role="button" class="btn add_info">Добавить</a>
				</div>

		</div>', 'add_properties') ?>


        <hr>
        <? OUT::_('<div class="control-group">
			<label class="control-label" for="image">Добавить изображение</label>
			<div class="controls">
				<input type="file" name="image[]" class="image">
			    <p class="add_more_images">Добавить больше изображений</p>
			</div>
		</div>', 'add_properties') ?>

        <input class="btn btn-primary" type="submit" value="Добавить магазин">


    </form>
</div>