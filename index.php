<?php
    //declare(strict_types=1); 
    session_start();

    include 'applets/Menu.php';

    if (filter_input(INPUT_GET, 'content')) {
        $content = filter_input(INPUT_GET, 'content');
        $contentPage = $content . '.php';
    }
?>

<!DOCTYPE html>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="themes/stdtheme.css" rel="stylesheet" type="text/css"/>
    <link href="themes/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="themes/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="themes/icons/font/bootstrap-icons.min.css" rel="stylesheet" type="text/css"/>
    <title>Talent Hub</title>
</head>

<body>

    <?php
        $menu = new Menu;
        echo $menu->mainMenu();
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-9 pt-4">
    <?php
        if (isset($contentPage)) {
            include $contentPage;
        } else {

            include 'applets/Dashboard.php';

            $dashboard = new Dashboard();

            echo $dashboard->Dashboard();
        }
    ?>
            </div>
            <div class="col-sm-3 bg-light">
                <div class="sticky-top pt-4">
                    <div class='card mb-4 position-sticky '>
                        <div class="card-header text-muted">Latest Jobs</div>                        
                        <div class="card-body pt-3 lh-lg">
                            <ul style='list-style: none'>
                                <li><span class='bi-facebook pe-3'></span>ICT Administrator</li>
                                <li><span class='bi-google pe-3'></span>Human Resources Officer</li>
                                <li><span class='bi-book pe-3'></span>Accountant</li>
                                <li><span class='bi-bank pe-3'></span>Note Examiner</li>
                            </ul>
                        </div>                            
                    </div>                    
                    <div class='card mb-4 position-sticky sticky-top'>
                        <div class="card-header text-muted">Latest Jobs</div>                        
                        <div class="card-body pt-3 lh-lg">
                            <ul style='list-style: none'>
                                <li><span class='bi-facebook px-2'></span>ICT Administrator</li>
                                <li><span class='bi-google px-2'></span>Human Resources Officer</li>
                                <li><span class='bi-book px-2'></span>Accountant</li>
                                <li><span class='bi-bank px-2'></span>Note Examiner</li>
                            </ul>
                        </div>                            
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <?php
        echo $menu->footer();
    ?>
    <script src="scripts/bootstrap.min.js"></script>
</body>
