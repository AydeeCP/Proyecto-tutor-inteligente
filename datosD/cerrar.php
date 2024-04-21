<?php
@session_start();
session_destroy();

header("Location: ../login/logDocente.php?sesion=1");

?>