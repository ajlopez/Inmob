<?php


/*
 *	Tests
 * for Entity Propiedad Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/PropiedadFunctions.inc.php');

class PropiedadFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = PropiedadInsert('Nombre', 'Domicilio', 0, 0, 0, 'Descripcion', 0, 0, 0, 0, 0, 'Notas', 0, 0);
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = PropiedadInsert('Nombre', 'Domicilio', 0, 0, 0, 'Descripcion', 0, 0, 0, 0, 0, 'Notas', 0, 0);
        PropiedadUpdate($id, 'New Nombre', 'New Domicilio', 0, 0, 0, 'New Descripcion', 0, 0, 0, 0, 0, 'New Notas', 0, 0);
        $result = PropiedadGetById($id);        
        $this->assertNotNull($result);
        $this->assertEqual('New Nombre', $result['Nombre']);
        $this->assertEqual('New Domicilio', $result['Domicilio']);
    }
    
    function testDelete() {
        $id = PropiedadInsert('Nombre', 'Domicilio', 0, 0, 0, 'Descripcion', 0, 0, 0, 0, 0, 'Notas', 0, 0);
        $result = PropiedadGetById($id);
        $this->assertTrue($result);
        PropiedadDelete($id);
        $result = PropiedadGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = PropiedadInsert('Nombre', 'Domicilio', 0, 0, 0, 'Descripcion', 0, 0, 0, 0, 0, 'Notas', 0, 0);
        $result = PropiedadGetById($id);
        $this->assertNotNull($result);
        $this->assertEqual('Nombre', $result['Nombre']);
        $this->assertEqual('Domicilio', $result['Domicilio']);
    }

    function testGetByNonexistentId() {
        $id = PropiedadInsert('Nombre', 'Domicilio', 0, 0, 0, 'Descripcion', 0, 0, 0, 0, 0, 'Notas', 0, 0);
        $result = PropiedadGetById(-1);
        $this->assertFalse($result);
    }
}

?>
