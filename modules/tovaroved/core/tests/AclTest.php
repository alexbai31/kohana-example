<?php

/**
 * Tests access control library
 * 
 * @group tovaroved.core
 * @group tovaroved.core.acl
 *
 * */
class AclTests extends Kohana_Unittest_TestCase {

    function testCheckAcess() {

        $tmp = Session::instance()->get("access_level", 2);
        Session::instance()->set("access_level", 2);

        $this->assertTrue(ACL::check_access("2"));
        $this->assertTrue(!ACL::check_access("4"));
        Session::instance()->set("access_level", $tmp);
    }

    function testGetGroup() {
        $this->assertEquals(Session::instance()->get("access_level", 2), ACL::get_group());
    }
    
}

?>
