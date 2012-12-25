<?php

/*
 *	All Entity Functions Tests
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');

include_once('./PropiedadFunctionsTests.php');
include_once('./ImagenPropiedadFunctionsTests.php');
include_once('./ZonaFunctionsTests.php');
include_once('./InmobiliariaFunctionsTests.php');
include_once('./MonedaFunctionsTests.php');
include_once('./ComentarioFunctionsTests.php');
include_once('./UserFunctionsTests.php');
include_once('./TipoPropiedadFunctionsTests.php');
include_once('./EventoFunctionsTests.php');

class AllFunctionsTests extends TestSuite {
    function __construct() {
        parent::__construct();
        $this->add(new PropiedadFunctionsTests());
        $this->add(new ImagenPropiedadFunctionsTests());
        $this->add(new ZonaFunctionsTests());
        $this->add(new InmobiliariaFunctionsTests());
        $this->add(new MonedaFunctionsTests());
        $this->add(new ComentarioFunctionsTests());
        $this->add(new UserFunctionsTests());
        $this->add(new TipoPropiedadFunctionsTests());
        $this->add(new EventoFunctionsTests());
    }
}
?>
