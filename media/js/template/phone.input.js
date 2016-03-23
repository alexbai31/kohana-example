$(document).ready(function() {
	$(".submit").die();
    $(".submit").live("click", function() {
        var phone = $(".prefix").val() + $(".postfix").val();
        $(".contactlist").append('<p class="phone" title="' + phone + '">Телефон' + '<input type="hidden" name=contacts[Телефон][] value="+' + phone + '">&nbsp;<button type="button" class="delete btn">X</button></p>');
        $(this).parent().empty();
    })
});
