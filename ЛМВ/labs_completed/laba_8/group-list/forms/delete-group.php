<?php
    include(__DIR__ . "/../auth/check-auth.php");
    if (!CheckRight('group', 'delete')) {
        die('Ви не маєте права на виконання цієї операції');
    }
    $dirName = "../data/" . $_GET['group'];
    $conts = scandir($dirName);
    $i=0;
    foreach ($conts as $node) {
        @unlink($dirName . "/" . $node);
    }
    @rmdir($dirName);
    header('Location: ../index.php');