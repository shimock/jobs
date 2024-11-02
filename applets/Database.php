<?php

class Database {
    
    public function Database () {
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "job_portal";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        return $conn;
    }
}
