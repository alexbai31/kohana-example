<div class="well">
	<ul style="float:left;">
		<?foreach($goods as $good):?>
		<li> <a href="<?=$url_base?>goods/profile/<?=$good["id"]?>"><?=$good["category_name"]?> - <?=$good["name"]?> - <?=$good["price"] . $good["currency"]?></a></li>
		<?endforeach?>
	</ul>
	<div style="float:right">
		<a href="#" class="btn btn-primary">
			Добавить товар в каталог
		</a>
	</div>

</div>
<?=$pagination?>