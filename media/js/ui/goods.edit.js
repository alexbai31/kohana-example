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
    var brand = $("#brand").val();
    var name = $("#name");
    


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
    // $("#category").change(function () {
    //     category = $("#category option:selected").html();
    //     name.val(category + " " + '"' + brand + '"');
    // });
    $('.info_types').live("change", function() {
        $.post(url_base + "goods/get_form", {id:$(this).val()}, function(response) {
            $(".info-panel").empty().append(response);
        });
    });
    $(".delete").live("click", function() {
        var id = $(this).data("id");

        $(this).parent().remove();

        $(".edit_form").append(Html.input.hidden(id, "deleting_properties[]"))
    });

    
    $(".add_more_images").live('click', function() {
        var code = $(this).prev().clone();

        counter += 1;

        code.find("input[type=radio]").attr("value", counter)
        code.find("input[type=file]").attr("name", "image[" + counter + "]")

        $(this).parent().append(code);
    });

    $(".gallery a[rel=lightbox]").lightBox({
        imageLoading: url_base + "media/js/libraries/lightbox/images/lightbox-ico-loading.gif",
        imageBtnPrev:url_base + "media/js/libraries/lightbox/images/lightbox-btn-prev.gif",
        imageBtnNext:url_base + "media/js/libraries/lightbox/images/lightbox-btn-next.gif",
        imageBtnClose:url_base + "media/js/libraries/lightbox/images/lightbox-btn-close.gif",
        imageBlank:url_base + "media/js/libraries/lightbox/images/lightbox-blank.gif"
    });
});
