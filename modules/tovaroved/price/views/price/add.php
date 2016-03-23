<div class="well">
  <form action="" method="POST" class="prices_form">
    <select name="prices[][good]" class="goods input-block-level">
      <?foreach ($goods as $good) {?>
      <option value="<?=$good["id"]?>"><?=$good["name"]?></option>
      <?}?>
    </select>

    <select class="currencies">
      <?foreach ($currencies as $currency) {?>
      <option value="<?=$currency["id"]?>"><?=$currency["code"]?></option>
      <?}?>
    </select>

    <!-- Button to trigger modal -->
    <a href="#add_store" role="button" class="btn" data-toggle="modal">Добавить магазин</a>
    <input type="submit" value="Добавить цены" class="btn btn-primary">
  </form>
</div>

<!-- Modal -->
<div id="add_store" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Добавить магазин</h3>
  </div>
  <div class="modal-body">
    <select name="stores" id="stores">
     <?foreach ($stores as $store) {?>
     <option value="<?=$store['id']?>"><?=$store["name"]?></option>
     <?}?>      
   </select>  
 </div>
 <div class="modal-footer">
  <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
  <button class="btn btn-primary" id="choose" data-dismiss="modal">Выбрать</button>
</div>
</div>