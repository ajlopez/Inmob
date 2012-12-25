<?php


/*
 *	Tests
 * for Entity Zona Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/ZonaFunctions.inc.php');

class ZonaFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = ZonaInsert('Nombre', 0);
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = ZonaInsert('Nombre', 0);
        ZonaUpdate($id, 'New Nombre', 0);
        $result = ZonaGetById($id);        
        $this->assertNotNull($result);
        $this->assertEqual('New Nombre', $result['Nombre']);
    }
    
    function testDelete() {
        $id = ZonaInsert('Nombre', 0);
        $result = ZonaGetById($id);
        $this->assertTrue($result);
        ZonaDelete($id);
        $result = ZonaGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = ZonaInsert('Nombre', 0);
        $result = ZonaGetById($id);
        $this->assertNotNull($result);
        $this->assertEqual('Nombre', $result['Nombre']);
    }

    function testGetByNonexistentId() {
        $id = ZonaInsert('Nombre', 0);
        $result = ZonaGetById(-1);
        $this->assertFalse($result);
    }
}

?>
