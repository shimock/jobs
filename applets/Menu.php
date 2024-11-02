<?php

class Menu {
    
    function mainMenu () {

        if(isset($_SESSION['id'])){
            $profile = "<li class='nav-item'>"
                    . "<a href='./?content=profile' class='nav-link'>".$_SESSION['username']."</a>"
                . "</li>";
        }else{
            $profile = "<li class='nav-item'>"
                    . "<a href='./?content=login' class='nav-link'>Login</a>"
                . "</li>";    
        }
        
        
        $menu[] = "<nav class='navbar bg-white shadow text-dark'>"
            . "<div class='container'>"
                . "<a href='./' class='navbar-brand'>Talent Hub</a>"
                . "<ul class='navbar nav text-dark'>"                
                    . "<li class='nav-item'>"
                        . "<a href='./?content=jobs' class='nav-link'>Jobs</a>"
                    . "</li>"
                    . "<li class='nav-item'>"
                        . "<a href='./?content=companies' class='nav-link'>Companies</a>"
                    . "</li>"
                    . "<li class='nav-item'>"
                        . "<a href='./?content=freelancers' class='nav-link'>Job Seeker</a>"
                    . "</li>"
                    . $profile
                . "</ul>"                 
            . "</div>"
        . "</nav>";

        return join($menu);
    }
    
    public function footer() {
        $footer = "<footer class='container-fluid text-center border-top border-1 p-5 bg-white'>
            <p>Footer Text</p>
        </footer>";
        
        return $footer;
    }
}