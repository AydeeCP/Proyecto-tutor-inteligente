<?php
@session_start();
session_destroy();

header("Location: ../login/logPad.php?sesion=1");

?>