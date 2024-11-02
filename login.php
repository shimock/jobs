<?php

include 'applets/Database.php';
include 'applets/Form.php';

$login = new login;

if(isset($_SESSION['id'])){
    header('Location: ./');
}

if (filter_input(INPUT_POST, 'submit')) {
    
    $login->createSession();
    
}else{
    
    echo $login->loginForm();
}

class login {

    public function createSession() {
        
        $db = new Database;
        $conn = $db->Database();
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }   
        
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        
        $sql = "SELECT * FROM users WHERE username='$username' -- and password = '".$password."';";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify(password: $password, hash: $row['password'])) {
                //echo "Login successful!";
                // Start session and set session variables here

                session_start();

                $_SESSION['username'] = $row['username'];
                $_SESSION['id'] = $row['id'];                
                
                header('Location: ./');
                
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that username." . "<a href='register.html'>Register</a>";
        }
    }
    
    public function loginForm() {
        
        $form = new Form;
        
        $login[] = "<div class='container-fluid w-50'>";
        $login[] = $form->formHeader('login', './login.php')
            . $form->createFormField('text', 'username', 'Username', '')
            . $form->createFormField('password', 'password', 'Password', '')
            . $form->createFormField('submit', 'submit', '', 'Login')
            . $form->formFooter();
        $login[] = "<div class='p-3 text-center'><a href='?content=register'>Register</a></div>";
        $login[] = "</div>";
        
        return join('', $login);
    }
}
