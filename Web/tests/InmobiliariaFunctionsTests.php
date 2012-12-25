<?php


/*
 *	Tests
 * for Entity Inmobiliaria Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/InmobiliariaFunctions.inc.php');

class InmobiliariaFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = InmobiliariaInsert('Nombre', 'Domicilio', 'Descripcion', 'Contacto', 'Notas', 0, 0);
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = InmobiliariaInsert('Nombre', 'Domicilio', 'Descripcion', 'Contacto', 'Notas', 0, 0);
        InmobiliariaUpdate($id, 'New Nombre', 'New Domicilio', 'New Descripcion', 'New Contacto', 'New Notas', 0, 0);
        $result = InmobiliariaGetById($id);        
        $this->assertNotNull($result);
        $this->assertEqual('New Nombre', $result['Nombre']);
        $this->assertEqual('New Domicilio', $result['Domicilio']);
    }
    
    function testDelete() {
        $id = InmobiliariaInsert('Nombre', 'Domicilio', 'Descripcion', 'Contacto', 'Notas', 0, 0);
        $result = InmobiliariaGetById($id);
        $this->assertTrue($result);
        InmobiliariaDelete($id);
        $result = InmobiliariaGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = InmobiliariaInsert('Nombre', 'Domicilio', 'Descripcion', 'Contacto', 'Notas', 0, 0);
        $result = InmobiliariaGetById($id);
        $this->assertNotNull($result);
        $this->assertEqual('Nombre', $result['Nombre']);
        $this->assertEqual('Domicilio', $result['Domicilio']);
    }

    function testGetByNonexistentId() {
        $id = InmobiliariaInsert('Nombre', 'Domicilio', 'Descripcion', 'Contacto', 'Notas', 0, 0);
        $result = InmobiliariaGetById(-1);
        $this->assertFalse($result);
    }
}

?>
