<?php
/**
 * Created by JetBrains PhpStorm.
 * User: roman
 * Date: 03.10.12
 * Time: 14:08
 * To change this template use File | Settings | File Templates.
 */


class Controller_Searchdemo extends Controller_Core
{
    public function action_index()
    {
        if ($this->request->post()) {
            $post = $this->request->post();
            $key = array_keys($post);
            $key = $key[0];

            $this->$key($post[$key]);
        }
    }

    public function query_yandex_comma($query)
    {
        $query_string = $query;
        $query = explode(",", $query);
        $name = $query[0];
        array_shift($query);
        $address = implode(" ", $query);
        $search = Search::factory();
        $search->SetFieldWeights(array(
            'name' => 50,
            'latitude' => 40,
            'longitude' => 40,
            'address_name' => 10,
        ));
        $search->SetSortMode(SPH_SORT_RELEVANCE);
        if (!empty($address)) {
            $yandex_result = json_decode(file_get_contents("http://geocode-maps.yandex.ru/1.x/?geocode=" . str_replace(" ", "+", $address) . "&format=json&results=1"));
        }
        try {
            $tmp = $yandex_result->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos;

            $coords = $tmp;
        } catch (Exception $e) {
            $coords = 0.000000;
        }

        $search = $search->query("@name " . $this->GetSphinxKeyword($name) . "  " . $this->GetSphinxKeyword($coords));
        $matches = array_key_exists("matches", $search) ? $search["matches"] : array();
        $matches = array_keys($matches);
        if (!empty($matches))
            $this->data["results"] = DATA::select("demo")->where("id", "IN", $matches)->execute()->as_array();
        else
            $this->data["results"] = array();

        $this->data["query"] = $query_string . " ";

    }

    public function query_yandex_twofields($query)
    {
        $query_string = implode(" ", $query);
        $name = $query[0];

        $address = $query[1];
        $search = Search::factory();
        $search->SetFieldWeights(array(
            'name' => 50,
            'latitude' => 40,
            'longitude' => 40,
            'address_name' => 10,
        ));
        $search->SetSortMode(SPH_SORT_RELEVANCE);
        if (!empty($address)) {
            $yandex_result = json_decode(file_get_contents("http://geocode-maps.yandex.ru/1.x/?geocode=" . str_replace(" ", "+", $address) . "&format=json&results=1"));
        }
        try {
            $tmp = $yandex_result->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos;

            $coords = $tmp;
        } catch (Exception $e) {
            $coords = 0.000000;
        }

        $search = $search->query("@name " . $this->GetSphinxKeyword($name) . "  " . $this->GetSphinxKeyword($coords));
        $matches = array_key_exists("matches", $search) ? $search["matches"] : array();
        $matches = array_keys($matches);
        if (!empty($matches))
            $this->data["results"] = DATA::select("demo")->where("id", "IN", $matches)->execute()->as_array();
        else
            $this->data["results"] = array();

        $this->data["query"] = $query_string;
    }

    public function query_implode_comma($query)
    {
        $query_string = $query;
        $search = Search::factory();
        $search->SetFieldWeights(array(
            'name' => 30,
            'address' => 30,
            'address_name' => 50,
        ));
        $search->SetSortMode(SPH_SORT_RELEVANCE);
        $search = $search->query("@address_name " . $this->GetSphinxKeyword($query));
        $matches = array_key_exists("matches", $search) ? $search["matches"] : array();
        $matches = array_keys($matches);
        if (!empty($matches))
            $this->data["results"] = DATA::select("demo")->where("id", "IN", $matches)->execute()->as_array();
        else
            $this->data["results"] = array();

        $this->data["query"] = $query_string;
    }

    public function query_implode_twofields($query)
    {
        $query_string = implode(" ", $query);
        $search = Search::factory();
        $search->SetFieldWeights(array(
            'name' => 30,
            'address' => 30,
            'address_name' => 50,
        ));
        $search->SetSortMode(SPH_SORT_RELEVANCE);

        $search = $search->query("@address_name " . $this->GetSphinxKeyword($query_string));
        $matches = array_key_exists("matches", $search) ? $search["matches"] : array();
        $matches = array_keys($matches);
        if (!empty($matches))
            $this->data["results"] = DATA::select("demo")->where("id", "IN", $matches)->execute()->as_array();
        else
            $this->data["results"] = array();

        $this->data["query"] = $query_string;
    }

    private function GetSphinxKeyword($sQuery)
    {
        $aKeyword = array();
        $aRequestString = preg_split('/[\s,-]+/', $sQuery, 5);
        if ($aRequestString) {
            foreach ($aRequestString as $sValue) {
                if (strlen($sValue) > 3) {
                    $aKeyword[] .= "(" . $sValue . " | *" . $sValue . "*)";
                }
            }
            $sSphinxKeyword = implode(" & ", $aKeyword);

//            $sSphinxKeyword .= " | " . implode(" | ", $aKeyword);
        }
        return $sSphinxKeyword;
    }
}
