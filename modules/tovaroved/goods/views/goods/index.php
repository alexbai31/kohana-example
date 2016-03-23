<div class="well">
	
  <form action="<?=$url_base?>goods/search" method="POST" class="form-search">
     <input type="text" name="query" class="input-xxlarge">
     <input type="submit" class="btn" value="Искать">
     <label for=""> | Показывать на странице: 
        <select name="items_per_page" id="select" class="input-small">
             <option value="10">10</option>
             <option value="25">25</option>
             <option value="75">75</option>
             <option value="100">100</option>
         </select>
     </label>
     <br><br>
     <label class="control-label" id="open_filters">Фильтры</label>
     <div class="control-group filters" style="display: none;">
        <div class="controls">
          <select name="category" id="category">
            <?=$categories?>
          </select>   

        <hr>
        <?foreach ($properties["form"] as $value) {?>
        <p><?=$value?></p>              
        <?}?>  
    </div>
</div>

</form>


<ul>
    <?foreach ($goods as $good): ?>
    <li>
        <a href="<?=URL::base(TRUE, TRUE)?>goods/profile/<?=$good["id"]?>"><?=$good["name"]?></a>
    </li>
<? endforeach;?>
</ul>
<?=$pagination?>
<div class="clearfix"></div>
</div>
