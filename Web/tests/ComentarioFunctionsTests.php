<?php


/*
 *	Tests
 * for Entity Comentario Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/ComentarioFunctions.inc.php');

class ComentarioFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = ComentarioInsert('Texto', 0, 0);
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = ComentarioInsert('Texto', 0, 0);
        ComentarioUpdate($id, 'New Texto', 0, 0);
        $result = ComentarioGetById($id);        
        $this->assertNotNull($result);
    }
    
    function testDelete() {
        $id = ComentarioInsert('Texto', 0, 0);
        $result = ComentarioGetById($id);
        $this->assertTrue($result);
        ComentarioDelete($id);
        $result = ComentarioGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = ComentarioInsert('Texto', 0, 0);
        $result = ComentarioGetById($id);
        $this->assertNotNull($result);
    }

    function testGetByNonexistentId() {
        $id = ComentarioInsert('Texto', 0, 0);
        $result = ComentarioGetById(-1);
        $this->assertFalse($result);
    }
}

?>
