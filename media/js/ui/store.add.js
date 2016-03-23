function fill_properties(category_id) {
    $(".available_properties, .propertieslist").empty();
    $.post(url_base + "property/get_by_category", {category_id:category_id}, function (data) {
        console.log(data);
        for (var i in data) {
            $(".available_properties").append('<label class="checkbox"><input id="' + data[i].id + '" class="properties" name="properties[]" type="checkbox" value="' + data[i].id + '"><p>' + data[i].name + '</p> </label>');
        }
        $(".properties").click(function () {
            var list = $(".propertieslist");
            list.append("<p class='" + $(this).next().html() + "' title='" + $(this).next().html() + "'>" + $(this).next().html() + " <button type=\"button\"  class='delete_property' data-id='" + $(this).val() + "'>×</button></p>");
            list.find('.delete_property').click(function () {
                $(this).parent().remove();
                $("#" + $(this).data("id")).attr("checked", false);

            });
        });
    }, "json");
}


function get_day(el) {
    var day = el.parent().parent().attr("class");

    return day.substr(0, 3);

}

$(document).ready(function () {
    var schedule_forms = {
        all:$($(".schedule_variants .all").html()),
        every:$($(".schedule_variants .every").html()),
        individual:$($(".schedule_variants .individual").html())
    }
    var contact_type_select = $(".contact_types");
    var info_type_select = $(".info_types");
    $(".info_types").remove();
    $(".contact_types").remove();


    $(".schedule_variants").empty();
    $("#chain").autocomplete(url_base + "chain/get_like", {
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
            $("#chainid").val(li.extra[0]);
            var category = $("#category option:selected").html();
            var chain = $("#chain").val();
            var name = $("#name");
            name.val(category + " " + '"' + chain + '"');
        }
    });
    var category = $("#category option:selected").html();
    var chain = $("#chain").val();
    var name = $("#name");
    name.val(category + " " + '"' + chain + '"');

    var category_id = $("#category option:selected").val();

    fill_properties(category_id);


    $("#chain").keyup(function () {
        chain = $("#chain").val();
        name.val(category + " " + '"' + chain + '"');
    });
    $("#category").change(function () {
        category = $("#category option:selected").html();
        name.val(category + " " + '"' + chain + '"');
        fill_properties($("#category option:selected").val())
    });

    $(".delete").live("click", function() {
        $(this).parent().remove();
    });

    $('.contact_types').live("change", function() {
        $.post(url_base + "store/get_form", {id:$(this).val()}, function(response) {
            $(".panel").html(response);
        });
    });
    $('.info_types').live("change", function() {
        $.post(url_base + "store/get_form", {id:$(this).val()}, function(response) {
            $(".info-panel").html(response);
        });
    });

    $(".add_contact").click(function () {
        $(".panel").html(contact_type_select.clone());
        return false;
    });
    $(".add_info").click(function () {
        $(".info-panel").html(info_type_select.clone());
        return false;
    });

    $(".add_property").click(function () {
        var list = $(".propertieslist");
        list.append("<p class='" + $('#property').val() + "' title='" + $('#property').val() + "'>" + $("#property").val() + " <button type=\"button\"  class='delete'>×</button><input type='hidden' name='properties[]' value='" + $('#property').val() + "'></p>");
        $("#add_more_info").modal("hide");
        $("#add_more_info input").val("");
        list.find('.delete').click(function () {
            $(this).parent().remove();
        });
    });
    $("#schedule_options").change(function () {
        $(".schedule_variants").empty().append(schedule_forms[$(this).val()]);
    });
    $(".breaktime").live("click", function () {
        $(this).parent().append('<label> С: <input type="text" class="input-small" name="schedule[break][' + get_day($(this)) + '][from]" id="break_' + get_day($(this)) + '_from"></label><label> По: <input class="input-small" type="text" name="schedule[break][' + get_day($(this)) + '][to]" id="break_' + get_day($(this)) + '_to"></label>');
    });
    $(".add_more_images").live('click', function() {
        var code = $(this).prev().clone();
        $(this).parent().append(code);
    });
});