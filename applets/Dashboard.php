<?php

include './freelancers.php';
include './jobs.php';
include './companies.php';

class Dashboard {

    public function Dashboard() {

        echo $this->landingPage();

        echo $this->recentJobs();

        echo $this->recentCompanies();

        echo $this->recentFreelancers();
    }

    public function landingPage() {

        $jumbotron = "<div class='container-fluid p-5 mb-5 bg-primary text-white rounded-3'"
                . "style='background-image: url=(../images/hero_bg.png); width: 100%'>"
                . "<h6 class='display-6'>Jumbotron Example</h6>"
                . "<p class='display-6'>Jumbotron Example</p>"
                . "</div>";

        return $jumbotron;
    }

    public function recentJobs() {
        
        echo "<div class='display-6 pb-3'>Job Listing</div>";

        $jobs = new jobs;
        $jobListings[] = $jobs->viewJobs();
        
        $jobListings[] = "<div class='container-fluid p-3 text-center'><button onclick=location='./?content=jobs' class='btn btn-primary'>See More</button></div>";

        return join($jobListings);
    }

    public function recentCompanies() {

        $companies = new companies;
        $companyListings[] = $companies->view_company();

        echo "<div class='display-6 pb-3'>Company Listing</div>";
        
        $companyListings[] = "<div class='container-fluid p-3 text-center'><button onclick=location='./?content=companies' class='btn btn-primary'>See More</button></div>";

        return join($companyListings);
    }

    public function recentFreelancers() {

        echo "<div class='display-6 pb-3'>Freelancers</div>";
        
        $jobSeeker = new job_seeker;
        
        $seeMore = "<div class='container-fluid p-3 text-center'><button onclick=location='./?content=freelancers' class='btn btn-primary'>See More</button></div>";
        
        return $jobSeeker->job_seeker().$seeMore;
        
    }

}
