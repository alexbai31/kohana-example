var Driver = ymaps;
$(document).ready(function () {
    Driver.ready(function () {
        function Map() {
            self = this;

            self.map = new Driver.Map("map", {
                center:[55.76, 37.64],
                zoom:10
            });
            self.click = function (callback) {
                self.map.events.add('click', callback);
            };
            self.setCenter = function (coords) {
                self.map.setCenter(coords);
            };
            self.getCenter = function () {
                return self.map.getCenter();
            };
            self.searchByAddress = function (address, callback) {
                var myGeocoder = Driver.geocode(address);
                myGeocoder.then(
                    function (res) {
                        var coords = res.geoObjects.get(0).geometry.getCoordinates();
                        callback(coords);
                    },
                    function (err) {
                        callback("error");
                    }
                );
            };
            self.searchByCoords = function (coords) {
                var myGeocoder = Driver.geocode(coords);
                func = this;
                myGeocoder.then(
                    function (res) {
                        var names = [];
                        res.geoObjects.each(function (obj) {
                            names.push(obj.properties.get('name'));
                        });
                        func.result = names[0];
                    },
                    function (err) {
                        alert('Ошибка');
                        func.result = false;
                    }
                );
                return func.result;
            };
            self.addControls = function (ids) {
                for (var i in ids) {
                    self.map.controls.add(ids[i]);
                }
            };
            self.setZoom = function(zoom, options) {
                options = options || {}
                return self.map.setZoom(zoom, options);
            };
            self.setBaloon = function(coords, content, options) {
                options = options || {}
                self.map.balloon.open(coords, content, options)
            };
            self.setPoint = function(coords){
                var point = new Driver.Placemark(coords);
                self.map.geoObjects.add(point);
            };
        }

        window.map = new Map();
        map.addControls(["typeSelector", "zoomControl"]);
    });
});

