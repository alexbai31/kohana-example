<?php



class Controller_Demo extends Controller
{
    private $_dictionary = array(
        "streets" => array(
            "Абрикосовая ",
            "Абрикосовый ",
            "Авангардная ",
            "Авдеева-Черноморского ",
            "Авиаторов /Авиаторский  ",
            "Авиационная ",
            "Авчинниковский ",
            "Аграрная ",
            "Агрономическая ",
            "Агрономический ",
            "Адмирала Лазарева, ",
            "Адмиральский проспект",
            "Азовский ",
            "Академика Вавилова, ",
            "Академика Векслера ",
            "Академика Вильямса ",
            "Академика Вильямса ",
            "Академика Воробьёва ",
            "Академика Гаркавого ",
            "Академика Гамалеи ",
            "Академика Глушко проспект",
            "Академика Заболотного, ",
            "Академика Королёва, ",
            "Академика Курчатова ",
            "Академика Курчатова ",
            "Академика Павлова  ",
            "Академика Павлова ",
            "Академика Павлова спуск - ",
            "Академика Панкратовой ",
            "Академика Филатова ",
            "Академика Ясиновского ",
            "Академическая площадь",
            "Академическая ",
            "Академический ",
            "Акварельный ",
            "Аккордная ",
            "Албанская ",
            "Александра Матросова ",
            "Александра Невского ",
            "Александра Невского  ",
            "Александра Тимошенко ",
            "Александрийский ",
            "Александровская площадь ",
            "Александровский проспект",
            "Александровская ",
            "Александровский ",
            "Алексеевская площадь",
            "Алексеевский сквер",
            "Алмазная ",
            "Алмазный ",
            "Альпинистов ",
            "Амбулаторная  ",
            "Амбулаторный ",
            "Амвросия Бучмы ",
            "Амундсена ",
            "Амундсена  ",
            "Амурская ",
            "Амурский  ",
            "Ананьевская ",
            "Ананьевский ",
            "Ангарская ",
            "Андре Марти ",
            "Андреевская ",
            "Андриевского ",
            "Андросовская ",
            "Андросовский ",
            "Анны Ахматовой ",
            "Антонова ",
            "Антонова ",
            "Апельсиновая ",
            "Апрельская ",
            "Аптекарский ",
            "Арбузная ",
            "Аркадийская ",
            "Аркадийский  ",
            "Армейская ",
            "Армейский ",
            "Арсенальная ",
            "Артезианская ",
            "Артёма  ",
            "Артиллерийская ",
            "Артиллерийский ",
            "Архитекторская ",
            "Архитектурная ",
            "Архитектурный ",
            "Асташкина "
        ),
        "cats" => array(
            "улица", "переулок", "бульвар", "проспект"
        ),
        "buildings" => array(
            "дом", "строение", "завод", "павильон", "гараж", "квартира"
        ),
        "names" => array(
            "Амстор", "Сильпо", "Малютка", "Одежда", "Краска", "Павильон", "Магазинчик"
        )
    );

    public function action_generate()
    {
        for ($i = 0; $i < 20; $i++) {
            $address = $this->_dictionary["cats"][array_rand($this->_dictionary["cats"])] . " " . $this->_dictionary["streets"][array_rand($this->_dictionary["streets"])] . $this->_dictionary["buildings"][array_rand($this->_dictionary["buildings"])] . " " . rand(1, 100);
            $name = "Магазин " . $this->_dictionary["names"][array_rand($this->_dictionary["names"])];
            $yandex_result = json_decode(file_get_contents("http://geocode-maps.yandex.ru/1.x/?geocode=" . str_replace(" ", "+", $address) . "&format=json&results=1"));
            try {
                $tmp = explode(" ", $yandex_result->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos);

                $coords[0] = (float) $tmp[0];
                $coords[1] = (float) $tmp[1];
            } catch (Exception $e) {
                $coords[0] = 0.000000;
                $coords[1] = 0.000000;
            }
            DATA::factory("demo")->set(array(
                "name" => $name,
                "address" => $address,
                "latitude" => $coords[0],
                "longitude" => $coords[1],
                "address_name" => $address . " " . $name
            ))->save();
            echo  $address . " " . $name . "\n";
        }

        for ($i = 0; $i < 20; $i++) {
            $address = $this->_dictionary["cats"][array_rand($this->_dictionary["cats"])] . " " . $this->_dictionary["streets"][array_rand($this->_dictionary["streets"])] . $this->_dictionary["buildings"][array_rand($this->_dictionary["buildings"])] . " " . rand(1, 100) . " " .  $this->_dictionary["buildings"][array_rand($this->_dictionary["buildings"])] . " " . rand(1, 100);
            $name = "Магазин " . $this->_dictionary["names"][array_rand($this->_dictionary["names"])];
            $yandex_result = json_decode(file_get_contents("http://geocode-maps.yandex.ru/1.x/?geocode=" . str_replace(" ", "+", $address) . "&format=json&results=1"));
            try {
                $tmp = explode(" ", $yandex_result->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos);
                $coords[0] = $tmp[0];
                $coords[1] = $tmp[1];
            } catch (Exception $e) {
                $coords[0] = 0.000000;
                $coords[1] = 0.000000;
            }
            DATA::factory("demo")->set(array(
                "name" => $name,
                "address" => $address,
                "latitude" => $coords[0],
                "longitude" => $coords[1],
                "address_name" => $address . " " . $name
            ))->save();
            echo  $address . " " . $name . "\n";
            flush();
        }
    }
}
