<?php


/*
 *	Tests
 * for Entity Evento Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/EventoFunctions.inc.php');

class EventoFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = EventoInsert('Tipo', 0, 0, 0);
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = EventoInsert('Tipo', 0, 0, 0);
        EventoUpdate($id, 'New Tipo', 0, 0, 0);
        $result = EventoGetById($id);        
        $this->assertNotNull($result);
        $this->assertEqual('New Tipo', $result['Tipo']);
    }
    
    function testDelete() {
        $id = EventoInsert('Tipo', 0, 0, 0);
        $result = EventoGetById($id);
        $this->assertTrue($result);
        EventoDelete($id);
        $result = EventoGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = EventoInsert('Tipo', 0, 0, 0);
        $result = EventoGetById($id);
        $this->assertNotNull($result);
        $this->assertEqual('Tipo', $result['Tipo']);
    }

    function testGetByNonexistentId() {
        $id = EventoInsert('Tipo', 0, 0, 0);
        $result = EventoGetById(-1);
        $this->assertFalse($result);
    }
}

?>
