<?php


/*
 *	Tests
 * for Entity User Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/UserFunctions.inc.php');

class UserFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = UserInsert('UserName', 'Password', 'FirstName', 'LastName', 'Email', 'Genre', 0, 0, 0, 0, 0, 0, 'Notas', 0, 0);
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = UserInsert('UserName', 'Password', 'FirstName', 'LastName', 'Email', 'Genre', 0, 0, 0, 0, 0, 0, 'Notas', 0, 0);
        UserUpdate($id, 'New UserName', 'New Password', 'New FirstName', 'New LastName', 'New Email', 'New Genre', 0, 0, 0, 0, 0, 0, 'New Notas', 0, 0);
        $result = UserGetById($id);        
        $this->assertNotNull($result);
        $this->assertEqual('New UserName', $result['UserName']);
        $this->assertEqual('New Password', $result['Password']);
        $this->assertEqual('New FirstName', $result['FirstName']);
        $this->assertEqual('New LastName', $result['LastName']);
        $this->assertEqual('New Email', $result['Email']);
        $this->assertEqual('New Genre', $result['Genre']);
    }
    
    function testDelete() {
        $id = UserInsert('UserName', 'Password', 'FirstName', 'LastName', 'Email', 'Genre', 0, 0, 0, 0, 0, 0, 'Notas', 0, 0);
        $result = UserGetById($id);
        $this->assertTrue($result);
        UserDelete($id);
        $result = UserGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = UserInsert('UserName', 'Password', 'FirstName', 'LastName', 'Email', 'Genre', 0, 0, 0, 0, 0, 0, 'Notas', 0, 0);
        $result = UserGetById($id);
        $this->assertNotNull($result);
        $this->assertEqual('UserName', $result['UserName']);
        $this->assertEqual('Password', $result['Password']);
        $this->assertEqual('FirstName', $result['FirstName']);
        $this->assertEqual('LastName', $result['LastName']);
        $this->assertEqual('Email', $result['Email']);
        $this->assertEqual('Genre', $result['Genre']);
    }

    function testGetByNonexistentId() {
        $id = UserInsert('UserName', 'Password', 'FirstName', 'LastName', 'Email', 'Genre', 0, 0, 0, 0, 0, 0, 'Notas', 0, 0);
        $result = UserGetById(-1);
        $this->assertFalse($result);
    }
}

?>
