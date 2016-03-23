<?php

class Controller_Brand extends Controller_Core {

    public function action_get_like() {
        $query = $this->request->query("q");

        if (!$result = Cache::instance()->get($query)) {
            $result = DATA::select("brands")
                ->where("name", "ILIKE", "$query%")
                ->execute()
                ->as_array();
            Cache::instance()->set($query, $result);
        }
        $response = "";
        foreach ($result as $brand) {
            $response .= $brand['name'] . "|" . $brand['id'] .  ":";
        }

        $this->send_ajax_response($response);
    }


}
