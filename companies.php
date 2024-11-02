<?php

//declare(strict_types=1);
include_once 'applets/Form.php';
include_once 'applets/Database.php';


if (filter_input(INPUT_GET, 'content') == 'companies'){
    $content = new companies;
    echo $content->companies();
}

class companies {
    
    public function companies () {
        return $this->view_company();
    }

    // Add a new company to the database
    public function add_company() {
        
        include 'applets/Database.php';

        // Check connection
        if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

        $company_name = filter_input(INPUT_POST, 'company_name');
        $company_desc = filter_input(INPUT_POST, 'company_desc');

        $sql = "INSERT INTO companies (company_name, company_desc) VALUES ('$company_name', '$company_desc')";

        if ($conn->query($sql) === TRUE) {
            echo "<div>Company profile added successfully!</div>" . "<a href='dashboard.php'>Dashboard</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    // Display the form for adding a new company to the database
    public function add_company_form () {    

            $Form = new Form;

            $form[] = $Form->formHeader('add_company', 'company.php');
            $form[] = $Form->createFormField('', 'company_name', 'Company Name', '');
            $form[] = $Form->createFormField('textarea', 'company_desc', 'Company Description', '');
            $form[] = $Form->createFormField('text', 'company_address', 'Company Address', '');
            $form[] = $Form->createFormField('submit', 'add_company', '', 'Add Company');
            $form[] = $Form->formFooter();

            echo join($form);
    }

    // Retrieve company information from database
    public function view_company (){
        
        $db = new Database;
        $conn = $db->Database();

        $sql = "SELECT * FROM companies";
        $result = $conn->query($sql);
       
        $companyData[] = "<div class='row row-cols-1 row-cols-md-4 g-2'>";

        while ($row = mysqli_fetch_assoc($result)) {
            $companyData[] = "<div class='col'><div class='card p-0 m-2 rounded-3 hover'>"
                    . "<div class='card-img'>"
                        . "<img src='images/hero_bg.png' style='width: 100%' class='rounded-top' />"
                    . "</div>"                    
                    . "<div class='card-body p-2 m-0'>"
                        . "<div class='card-title h6'>"
                            . $row['company_name']
                        . "</div>"
                        . "<div>"
                            .$row['company_desc']
                        . "</div>"
                    . "</div>"
                . "</div>"
                . "</div>";
        }
        
        $companyData[] = "</div>";

        return join($companyData);
    }

    public function search () {

        $form = new Form;

        $search[] = $form->formHeader('search', './')
                . $form->createFormField('text', 'search', 'Search Companies', '')
                .$form->formFooter();

        $actions[] = $form->formHeader('actions', '?action=add_company')
                . $form->createFormField('submit', 'new_company', '', 'Add Company')
                . $form->formFooter();

        return join($search) . join($actions);
    }

}

?>


<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="themes/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <title>Add Company Profile</title>
</head>
<body>
    
    <?php /*
        echo search();
        
        echo "<div class='container'>";
        if (filter_input(INPUT_GET, 'action') == "add_company") {
           echo add_company_form();
        }

        if (filter_input(INPUT_POST, 'add_company')) {
            add_company();
            
            echo view_company();
        }
    
        if (filter_input(INPUT_GET, 'action') == "view_companies") {
            echo view_company();
        }
        if (!filter_input(INPUT_GET, 'action')) {
            echo view_company();
        }
        echo "</div>"
     */
    
    ?>
    
</body>
</html> -->
