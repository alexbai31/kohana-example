$(document).ready(function() {
	$(".submit-bool").die();
    $(".submit-bool").live("click", function() {
		var bool_numeric = $(".bool:checked").val();
		bool             = bool_numeric == "true" ? "Да" : "Нет";
        $(block_to_append).append('<p class="bool-str" title="' + bool + '">' + property_name + ': '+ bool +' <input type="hidden" name=properties['+property_id+'] value="' + bool_numeric + '">&nbsp;<button type="button" class="delete btn">X</button></p>');
        $(this).parent().empty();
    })
});
