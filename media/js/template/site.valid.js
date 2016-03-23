$(document).ready(function() {
	$(".submit-site").die();
    $(".submit-site").live("click", function() {
        var site = $(".site").val();
        $(".contactlist").append('<p class="site-str" title="' + site + '">Сайт' + '<input type="hidden" name=contacts[Сайт][] value="' + site + '">&nbsp;<button type="button" class="delete btn">X</button></p>');
        $(this).parent().empty();
    })
});

