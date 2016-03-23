$(document).ready(function() {
    Driver.ready(function() {
        function parse_coords(coords) {
            var pattern = /\(([0-9]+?\.[0-9]+?),\s([0-9]+?\.[0-9]+?)\)/
            var result;
            result = pattern.exec(coords);
            return [result[1], result[2]];
        }

        if (typeof coordinates != "undefined") {
            map.setZoom(17);
            map.setBaloon(parse_coords(coordinates), "<h3>" + name + "</h3><p>" + body + "</p>");
        }
    });

    $(".add_to_places_link").click(function(){
        alert("gui");
    });
})
