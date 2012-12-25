<?php


/*
 *	Tests
 * for Entity Moneda Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/MonedaFunctions.inc.php');

class MonedaFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = MonedaInsert('Nombre');
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = MonedaInsert('Nombre');
        MonedaUpdate($id, 'New Nombre');
        $result = MonedaGetById($id);        
        $this->assertNotNull($result);
        $this->assertEqual('New Nombre', $result['Nombre']);
    }
    
    function testDelete() {
        $id = MonedaInsert('Nombre');
        $result = MonedaGetById($id);
        $this->assertTrue($result);
        MonedaDelete($id);
        $result = MonedaGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = MonedaInsert('Nombre');
        $result = MonedaGetById($id);
        $this->assertNotNull($result);
        $this->assertEqual('Nombre', $result['Nombre']);
    }

    function testGetByNonexistentId() {
        $id = MonedaInsert('Nombre');
        $result = MonedaGetById(-1);
        $this->assertFalse($result);
    }
}

?>
