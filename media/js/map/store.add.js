$(document).ready(function () {
    Driver.ready(function () {
        $("#address").keypress(function (e) {
            if ($(this).val() != "" && e.which == 13) {
                e.preventDefault();
                map.searchByAddress($(this).val(), function(coords){
                    map.setZoom(17);
                    map.setCenter(coords);
                    map.setPoint(coords);
                });
            }
        });
        map.click(function (e) {
            var coords = e.get("coordPosition");
            $("#address").val(map.searchByCoords(coords));
        });

    });
});
