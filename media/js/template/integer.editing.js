$(document).ready(function() {
	$(".submit-integer").die();
    $(".submit-integer").live("click", function() {
        var integer = $(".integer").val();
        $(block_to_append).append('<p class="integer-str" title="' + integer + '">' + property_name + ': ' + integer +  ' <input type="hidden" name=properties['+property_id+'] value="' + integer + '">&nbsp;<button type="button" class="delete btn">X</button></p>');
        $(this).parent().empty();
    })
});
