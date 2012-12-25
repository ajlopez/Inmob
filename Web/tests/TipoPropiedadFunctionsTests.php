<?php


/*
 *	Tests
 * for Entity TipoPropiedad Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/TipoPropiedadFunctions.inc.php');

class TipoPropiedadFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = TipoPropiedadInsert('Nombre');
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = TipoPropiedadInsert('Nombre');
        TipoPropiedadUpdate($id, 'New Nombre');
        $result = TipoPropiedadGetById($id);        
        $this->assertNotNull($result);
        $this->assertEqual('New Nombre', $result['Nombre']);
    }
    
    function testDelete() {
        $id = TipoPropiedadInsert('Nombre');
        $result = TipoPropiedadGetById($id);
        $this->assertTrue($result);
        TipoPropiedadDelete($id);
        $result = TipoPropiedadGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = TipoPropiedadInsert('Nombre');
        $result = TipoPropiedadGetById($id);
        $this->assertNotNull($result);
        $this->assertEqual('Nombre', $result['Nombre']);
    }

    function testGetByNonexistentId() {
        $id = TipoPropiedadInsert('Nombre');
        $result = TipoPropiedadGetById(-1);
        $this->assertFalse($result);
    }
}

?>
