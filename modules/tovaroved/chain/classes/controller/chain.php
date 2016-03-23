<?php

class Controller_Chain extends Controller_Core {

    public function action_get_like() {
        $query = $this->request->query("q");

        if (!$result = Cache::instance()->get($query)) {
            $result = DATA::select("chain")
                ->where("name", "ILIKE", "$query%")
                ->execute()
                ->as_array();
            Cache::instance()->set($query, $result);
        }
        $response = "";
        foreach ($result as $chain) {
            $response .= $chain['name'] . "|" . $chain['id'] .  ":";
        }

        $this->send_ajax_response($response);
    }


}
