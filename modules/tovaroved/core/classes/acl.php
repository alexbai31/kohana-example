<?

defined('SYSPATH') or die('No direct script access.');

class ACL {

    public static function get_rules($page, $id = array()) {
        $rules = DATA::select("acl_rules")
        ->where("page", "=", $page)
        ->and_where(key($id), "=", current($id))
        ->limit(1)
        ->execute();

        if ($rules->loaded())
            if ($rules->estimation > time() || is_null($rules->estimation)) {
                return json_decode($rules->rules, true);
            } else {
                $rules->delete();
                return NULL;
            }
            else
                return NULL;
        }

        public static function check_access($mask, $redirect = NULL) {
            $usergroup = Buyer::instance()->get_access_level();

            $mask = strrev(base_convert($mask, 10, 2));
            $usergroup = strrev(base_convert($usergroup, 10, 2));

            if (strlen($mask) < strlen($usergroup)) {
                if(is_null($redirect))
                    return false;
                else 
                    Request::factory()->redirect($redirect);
            } else {
                $usergroup = STR::fill($usergroup, "0", strlen($mask));
                for ($i = 0; $i < strlen($mask); $i++) {
                    if((($mask{$i} == $usergroup{$i}) && ($mask{$i} == 1 &&  $usergroup{$i} == 1))){
                        return true;
                    }
                }
            }
            if(is_null($redirect))
                return false;
            else 
                Request::factory()->redirect($redirect);
        }

        public static function get_group($id = "unlogged") {
            return DATA::select("acl_groups")
            ->where("description", "=", $id)
            ->limit(1)
            ->execute()
            ->mask;
        }

    }
