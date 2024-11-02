<?php

include_once 'applets/Database.php';

if (filter_input(INPUT_GET, 'content') == 'jobs'){
    $content = new jobs;
    $content->jobs();
}

class jobs {
    
    public function jobs () {
        return $this->viewJobs();
    }
    
    public function viewJobs() {
        
        $db = new Database();
        $conn = $db->Database();        

        // Check connection
        //if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}

        $sql = "SELECT * FROM jobs JOIN companies ON jobs.company_id = companies.company_id ORDER BY job_date DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $jobLising[] = "";
            while($row = $result->fetch_assoc()) {
                $jobLising[] = "<div class='container-fluid mb-3 p-2 border shadow-sm rounded bg-white'>"
                    . "<div class='row'>"
                        . "<div class='col-2'><div class='rounded border'>Company Logo</div></div>"
                        . "<div class='col-10'>"
                            . "<div class='fw-bold'>".$row['job_title']."</div>"
                            . "<div class='text-muted'>".$row['company_name']."</div>"
                            . "<div class='text-muted'>".$row['job_desc']."</div>"
                            . "<div class='fs-6 text-sm-end'>".date("l, jS F Y", strtotime($row['job_date']))."</div>"
                        . "</div>"
                    . "</div>"
                . "</div>";
            }
            echo join($jobLising);
        } else { echo "0 results" . "<a href='add_job.html'>Add a Job</a>"; }

        $conn->close();
    }
}