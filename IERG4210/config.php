<?php
$db = new PDO('sqlite:../cart.db');
$db->query("PRAGMA foreign_keys = ON; ");   
?>