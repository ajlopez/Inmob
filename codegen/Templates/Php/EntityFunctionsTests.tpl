<?php

<#
function GetTestValues(Entity)
    values = ""
    
    for each Property in Entity.Properties where Property.SqlColumn and Property.Type <> "Id"
        if values <> "" then
            values = values + ", "
        end if
        values = values + GetTestValue(Property)
    end for
    
    return values
end function

function GetTestValue(Property)
    if Property.Type = "Text" or Property.Type = "Memo" then
        return "'" + Property.Name + "'"
    end if
    
    return "0"
end function

function GetTestNewValues(Entity)
    values = ""
    
    for each Property in Entity.Properties where Property.SqlColumn and Property.Type <> "Id"
        if values <> "" then
            values = values + ", "
        end if
        values = values + GetTestNewValue(Property)
    end for
    
    return values
end function

function GetTestNewValue(Property)
    if Property.Type = "Text" or Property.Type = "Memo" then
        return "'New " + Property.Name + "'"
    end if
    
    return "0"
end function
#>

/*
 *	Tests
 * for Entity ${Entity.Name} Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/${Entity.Name}Functions.inc.php');

class ${Entity.Name}FunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = ${Entity.Name}Insert(${GetTestValues(Entity)});
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = ${Entity.Name}Insert(${GetTestValues(Entity)});
        ${Entity.Name}Update($id, ${GetTestNewValues(Entity)});
        $result = ${Entity.Name}GetById($id);        
        $this->assertNotNull($result);
<#
    for each Property in Entity.Properties where Property.SqlColumn and Property.Type = "Text"
#>
        $this->assertEqual(${GetTestNewValue(Property)}, $result['${Property.Name}']);
<#
    end for
#>
    }
    
    function testDelete() {
        $id = ${Entity.Name}Insert(${GetTestValues(Entity)});
        $result = ${Entity.Name}GetById($id);
        $this->assertTrue($result);
        ${Entity.Name}Delete($id);
        $result = ${Entity.Name}GetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = ${Entity.Name}Insert(${GetTestValues(Entity)});
        $result = ${Entity.Name}GetById($id);
        $this->assertNotNull($result);
<#
    for each Property in Entity.Properties where Property.SqlColumn and Property.Type = "Text"
#>
        $this->assertEqual(${GetTestValue(Property)}, $result['${Property.Name}']);
<#
    end for
#>
    }

    function testGetByNonexistentId() {
        $id = ${Entity.Name}Insert(${GetTestValues(Entity)});
        $result = ${Entity.Name}GetById(-1);
        $this->assertFalse($result);
    }
}

?>