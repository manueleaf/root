<?php
    $name = $_GET['MonsterAreaID'];

    require_once '../../includes/dbhinc.php';
    require_once '../../includes/functionsinc.php';

    delete_monarea($conn, $name);