<?php

/*
 *	All Entity Functions Tests
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');

<#
for each Entity in Project.Model.Entities	
#>
include_once('./${Entity.Name}FunctionsTests.php');
<#
end for
#>

class AllFunctionsTests extends TestSuite {
    function __construct() {
        parent::__construct();
<#
for each Entity in Project.Model.Entities	
#>
        $this->add(new ${Entity.Name}FunctionsTests());
<#
end for
#>
    }
}
?>