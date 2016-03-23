$(document).ready(function(){
	var stores_index = 0;
	var goods = $(".goods").clone();
	$(".goods").remove();
	var currencies = $(".currencies").clone();
	$(".currencies").remove();

	$("#choose").click(function(){
		var store_name = $("#stores option:checked").html();
		var date = new Date();
		$(".prices_form").prepend(Html.table({
			Attrs:{Class:"prices table"},
			Titles:[store_name, Html.div({}, Html.input({Id:"datepicker", Placeholder:"Выберите дату", name:"prices["+stores_index+"][date]"}, "", "text")), 'Discount', Html.link({Class:"add add_price_to_store", "data-store-index": stores_index}, "#","Добавить цену")]
		}));
		$(".prices_form").prepend(
				Html.input.hidden({Name: "prices["+stores_index+"][store_id]"}, $("#stores").val())
			);

		stores_index++;

		$("#datepicker").datepicker();
	});

	$(".add_price_to_store").live("click", function(){

		$(this).parents("table").find("tbody").append(Html.table.row(
				{Class:"price_row"},
				[
				{Attrs:{Class:"price", Colspan:2}, Value: goods.clone().attr("name", "prices["+$(this).data("store-index")+"][good][]")},
				{Attrs:{Class:"price_input" }, Value: Html.input({Placeholder:"Введите цену", Name: "prices["+$(this).data("store-index")+"][price][]"}, "", "text").after(currencies.attr({Class: "input-small", Name: "prices["+$(this).data("store-index")+"][currency][]"}).clone()) },
				]
			));
	});



})