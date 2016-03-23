<?php
defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');

/**
 * Tests search
 *
 * @group tovaroved.search
 * @group tovaroved.search.sphinx
 * */

class SearchTest extends Kohana_Unittest_TestCase
{
    public function testResult()
    {
        $search = Search::factory("sphinx");

        $queries = Kohana::$config->load("expectation.queries");
        foreach ($queries as $query) {
            $result = $search->query($query["text"]);
            $result = isset($result["matches"]) ? array_keys($result["matches"]) : NULL;
            if (!is_null($result)) {
                $this->_check_count($query, $result);
                if ($query["output"]["order_matters"]) {
                    $this->_check_order($query, $result);
                } else {
                    $this->_check_contents($query, $result);
                }
            }
        }
        $fails = array();
        foreach ($queries as $query) {
            if ($query["accepted_minimum"] > array_sum(Arr::flatten($this->_mark[$query["text"]]))) {
                $fails[$query["text"]]["percent"] = (100 / $query["accepted_minimum"]) * array_sum(Arr::flatten($this->_mark[$query["text"]]));
                $fails[$query["text"]]["max"] = $query["accepted_maximum"];
                $fails[$query["text"]]["min"] = $query["accepted_minimum"];
                $fails[$query["text"]]["mark"] = array_sum(Arr::flatten($this->_mark[$query["text"]]));
            }
        }
        $fail_message = "";
        if (!empty($fails)) {
            foreach ($fails as $query => $percent) {
                $fail_message .= "Запрос '$query' не прошел тестирование с результатом " . $percent['percent'] . "% (" . $percent['mark'] . " баллов) (Минимальный проходной бал - " . $percent["min"] . " Максимальный - " . $percent["max"] . ") Минимальный проходной балл в процентах - " . round((100 / $percent["max"]) * $percent["min"], 2) . "% |||||||||";
            }
            $this->fail($fail_message);
        }

        echo "<pre>";
        print_r($this->_mark);
        echo "</pre>";


    }

    private function _check_count($query, $result)
    {
        $expecting_count = count($query["output"]["items"]);
        $real_count = count($result);

        if (abs($real_count - $expecting_count) >= $query["output"]["max_to_min_overflow"]) {
            $this->_mark[$query["text"]]["count"] = $query["output"]["min_points"];
        } else {
            $this->_mark[$query["text"]]["count"] = $query["output"]["max_points"];
        }

    }

    private function _check_contents($query, $result)
    {
        $items = $query["output"]["items"];
        foreach ($items as $item) {
            if ($this->_in_result($result, $item["id"])) {
                $this->_mark[$query["text"]]["contents"][$item["id"]] = $query["output"]["items_weight"]["max_points"];
            }
        }
    }

    private function _check_order($query, $result)
    {
        foreach ($query["output"]["items"] as $index => $item) {
            if ($this->_in_result($result, $item["id"])) {
                $difference = (array_search($item["id"], $result) + 1) - ($index + 1);
                if ($difference >= 0) {
                    $this->_mark[$query["text"]]["order"][$item["id"]] = $item["max_points"];
                } else if (abs($difference) < $item["max_to_min_displacement"]) {
                    $this->_mark[$query["text"]]["order"][$item["id"]] = $item["max_points"];
                } else if (abs($difference) >= $item["max_to_min_displacement"]) {
                    $this->_mark[$query["text"]]["order"][$item["id"]] = $item["min_points"];
                }
            }
        }
    }

    private function _in_result($result = array(), $id)
    {
        foreach ($result as $item) {
            if ($item == $id) {
                return true;
            }
        }
        return false;
    }
}
