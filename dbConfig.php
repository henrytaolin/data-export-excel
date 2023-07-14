<?php
    // Database Config
    $dbHost     = "localhost";
    $dbPort     = "3306";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "fansclub";

    // Create Database Connection
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName, $dbPort);

    //Check Connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }