<?php
    $name = $_GET['MonsterID'];

    require_once '../../includes/dbhinc.php';
    require_once '../../includes/functionsinc.php';

    delete_mon($conn, $name);