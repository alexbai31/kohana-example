$(document).ready(function() {
    $("#brand").autocomplete(url_base + "brand/get_like", {
        delay:5,
        minChars:2,
        matchSubset:1,
        autoFill:true,
        matchContains:1,
        formatItem:function (row, i, num) {
            return "<a href='#'>" + row[0] + "</a>";
        },
        selectFirst:true,
        maxItemsToShow:10,
        resultsClass:"dropdown-menu",
        lineSeparator:":",
        onItemSelect:function (li) {
            $("#brandid").val(li.extra[0]);
            var category = $("#category option:selected").html();
            var brand = $("#brand").val();
            var name = $("#name");
            name.val(category + " " + '"' + brand + '"');
        }
    });

    var category = $("#category option:selected").html();
    var brand = typeof $("#brand").val() == "undefined" ? "" : $("#brand").val();
    var name = $("#name");
    name.val(category + " " + '"' + brand + '"');

    var info_type_select = $(".info_types");
    $(".info_types").remove();

    $(".add_info").click(function () {
        $(".info-panel").append(info_type_select.clone());
        return false;
    });

    $("#brand").keyup(function () {
        brand = $("#brand").val();
        name.val(category + " " + '"' + brand + '"');
    });
    $("#category").change(function () {
        category = $("#category option:selected").html();
        name.val(category + " " + '"' + brand + '"');
    });
    $('.info_types').live("change", function() {
        $.post(url_base + "goods/get_form", {id:$(this).val()}, function(response) {
            $(".info-panel").empty().append(response);
        });
    });
    $(".delete").live("click", function() {
        $(this).parent().remove();
    });

    $("input[name=all_right]").click(function(){
        if($(this).is(":checked")){
            $("#send_form").removeAttr("disabled");
        } else {
            $("#send_form").attr("disabled", "disabled");
        }
    }); 
    var counter = 1;
    $(".add_more_images").live('click', function() {
        var code = $(this).prev().clone();

        counter += 1;

        console.log(counter);

        code.find("input[type=radio]").attr("value", counter)

        $(this).parent().append(code);
    });
});
