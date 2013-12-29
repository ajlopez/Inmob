<?php
    // http://php.net/manual/en/errorfunc.constants.php
    // error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE & ~E_WARNING);
    error_reporting(32767 & ~16384 & ~2048 & ~8 & ~2);
?>
