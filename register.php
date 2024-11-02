<?php

include_once './applets/Database.php';
include_once './applets/Form.php';

if(filter_input(INPUT_POST, 'submit') == 'Register'){
    $regiser = new register;
    
    $regiser->register();
}else{
    
    $regiser = new register;
    
    echo $regiser->registerForm();
}


class register {
    
    public function register () {
        
        $db = new Database;
        $conn = $db->Database();

        //if ($serverRequestMethod == "POST") {
        if (filter_input(INPUT_POST, 'submit') == 'Register') {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            //echo $sql;
            if ($conn->query($sql) === TRUE) {
                echo "Registration successful!" . "<a href='login.html'>Sign In</a>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }/**/
        }

        $conn->close();
    }
    
    public function registerForm() {
        $form = new Form;
        
        $login[] = "<div class='container-fluid w-50'>";
        $login[] = $form->formHeader('register', './register.php')
            . $form->createFormField('text', 'username', 'Username', '')
            . $form->createFormField('password', 'password', 'Password', '')
            . $form->createFormField('submit', 'submit', '', 'Register')
            . $form->formFooter();
        $login[] = "</div>";
        
        return join('', $login);
    }
}