<?php


/*
 *	Tests
 * for Entity ImagenPropiedad Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/ImagenPropiedadFunctions.inc.php');

class ImagenPropiedadFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = ImagenPropiedadInsert('Nombre', 'Descripcion', 'NombreArchivo', 0, 'Notas', 0);
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = ImagenPropiedadInsert('Nombre', 'Descripcion', 'NombreArchivo', 0, 'Notas', 0);
        ImagenPropiedadUpdate($id, 'New Nombre', 'New Descripcion', 'New NombreArchivo', 0, 'New Notas', 0);
        $result = ImagenPropiedadGetById($id);        
        $this->assertNotNull($result);
        $this->assertEqual('New Nombre', $result['Nombre']);
        $this->assertEqual('New NombreArchivo', $result['NombreArchivo']);
    }
    
    function testDelete() {
        $id = ImagenPropiedadInsert('Nombre', 'Descripcion', 'NombreArchivo', 0, 'Notas', 0);
        $result = ImagenPropiedadGetById($id);
        $this->assertTrue($result);
        ImagenPropiedadDelete($id);
        $result = ImagenPropiedadGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = ImagenPropiedadInsert('Nombre', 'Descripcion', 'NombreArchivo', 0, 'Notas', 0);
        $result = ImagenPropiedadGetById($id);
        $this->assertNotNull($result);
        $this->assertEqual('Nombre', $result['Nombre']);
        $this->assertEqual('NombreArchivo', $result['NombreArchivo']);
    }

    function testGetByNonexistentId() {
        $id = ImagenPropiedadInsert('Nombre', 'Descripcion', 'NombreArchivo', 0, 'Notas', 0);
        $result = ImagenPropiedadGetById(-1);
        $this->assertFalse($result);
    }
}

?>
