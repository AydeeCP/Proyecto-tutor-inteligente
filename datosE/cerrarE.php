<?php
@session_start();
session_destroy();

header("Location: ../login/logEst.php?sesion=1");

?>