<?php

include_once './applets/Database.php';
include_once './applets/Form.php';

if(filter_input(INPUT_GET, 'content') == 'profile'){
    $profile = new profile;
    echo $profile->profile();
}

class profile {
    
    public function profile () {
        
        if(filter_input(INPUT_GET, 'profile') ) {
            echo $this->viewProfile(filter_input(INPUT_GET, 'profile'), false);
        }else{
            echo $this->fetchProfile();
        }

    }
    
    public function fetchProfile(){    
        echo "Fetch Profile";
        $db = new Database();
        $conn = $db->Database();
        
        $sql = "SELECT ID FROM JOB_SEEKERS WHERE USER = ".$_SESSION['id'].";";
        $result = $conn->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $profile = $this->viewProfile($row['ID'], true);
            }
        }else{
            $profile = "No Users found"
                . "<a href='add_job_seeker.html'>Create Your Profile</a>"
                . $this->createProfile();
        }
        
        return $profile;
    }
    
    public function createProfile () {
            
            $form = new Form;
   
            $createProfile = "<div class='container'>"
                . $form->formHeader('add_job_seeker', 'add_job_seeker.php')
                . $form->createFormField('text', 'name', 'Name', '')
                . $form->createFormField('text', 'email', 'E-Mail', '')
                . $form->createFormField('text', 'phone', 'Phone', '')
                . $form->createFormField('textarea', 'bio', 'Bio', '')
                . $form->createFormField('file', 'profile_picture', 'Profile Picture', '')
                . $form->createFormField('text', 'skills', 'Skills', '')
                . $form->createFormField('text', 'experience', 'Experience', '')
                . $form->createFormField('submit', 'submit', 'Submit', 'Add Profile')
                . $form->formFooter()
                . "</div>";
        
        return $createProfile;
    }
    
    public function viewProfile ($profileId, $editable) {   
        echo "View Profile";
        
        $db = new Database();
        $conn = $db->Database();

        $sql = "SELECT * FROM job_seekers WHERE id = ".$profileId.";";
        
        echo $sql;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $profile[] = "<div class='card border-0 rounded-2 mb-5'>"
                    . "<div class='card-img-top'>"
                        . "<img class='img-fluid w-100 p-0 border-0 rounded-top' src='" . $row["profile_picture"] . "' alt='Profile Picture'>"
                    . "</div>"
                    . "<div class='card-body bg-light'>"
                        . "<div class='card-title h2'>" . $row["name"] . "</div>"
                        . "<div class='card-subtitle pb-3 text-muted'>" . $row["skills"] . "</div>"
                        . "<div class='card-text'>" . $row["bio"] . "</div>"
                    ."</div>"
                    ."<div class='row m-0'>"
                        . $this->profileNavigation($profileId, $editable)
                    . "</div>"
                    . "</div>";
            }
        } else {
            $profile[] = "0 results" . "<a href='add_job_seeker.html'>Add Job Seeker</a>";
        }
        $conn->close();
        return  join($profile);
    }
    
    public function profileNavigation ($profileId, $editable) {
        $nav = "<ul class='nav nav-tabs px-2 bg-light' id='v-tabs' role='tablist'>"
                . "<li class='nav-link active mx-1' data-bs-toggle='tab' data-bs-target='#home' href='#home'>"
                    . "<span class='bi-house px-1'></span>Home</li>"
                . "<li class='nav-link mx-1' data-bs-toggle='tab' href='#education'>"
                    . "<span class='bi-book px-1'></span>Education</li>"
                . "<li class='nav-link mx-1' data-bs-toggle='tab' href='#occupation'>"
                    . "<span class='bi-sunglasses px-1'></span>Occupation</li>"
                . "<li class='nav-link mx-1' data-bs-toggle='tab' href='#references'>"
                    . "<span class='bi-pen px-1'></span>References</li>"
            . "</ul>";
        
        $tabContent = "<div class='tab-content' id='v-tab-content'>"
                . "<div id='home' class='tab-pane fade active show'>"
                    . $this->home($profileId, $editable)
                . "</div>"
                . "<div id='education' class='tab-pane fade'>"
                    . $this->education($profileId, $editable)
                . "</div>"
                . "<div id='occupation' class='tab-pane fade'>"
                    . $this->occupation($profileId, $editable)
                . "</div>"
                . "<div id='references' class='tab-pane fade'>"
                    . $this->reference($profileId, $editable)
                . "</div>"
            . "</div>";
        
        return $nav.$tabContent;
    }
    
    public function home($profileId, $editable) {
        $home = "<p class='h4 pt-4'>Education</p>"
            . $this->education($profileId, $editable)
            . "<p class='h4 pt-4'>Occupation Qualifications</p>"
            . $this->occupation($profileId, $editable)
            . "<p class='h4 pt-4'>References</p>"
            . $this->occupation($profileId, $editable);
        
        return $home;
    }
    
    public function education($profileId, $editable) {
        $db = new Database;
        $conn = $db->Database();
        
        $sql = "SELECT * FROM EDUCATION WHERE JOB_SEEKER = ".$profileId.";";
        $result = $conn->query($sql);
        
        $edu[] = '';
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $edu[] = $row['INSTITUTION'];
                $edu[] = $row['QUALIFICATION'];
                $edu[] = $row['START'];
                $edu[] = $row['END'];
            }
            $edu[] = "<a>Add Record</a>";
        }else{
            $edu[] = "<div class='bg-info bg-opacity-25 border border-info rounded text-center p-2'>"
                . "<span class='bi-exclamation-circle p-2'></span>"
                . "No Records Found"
            . "</div>";
            $editable ? $edu[] = "<button class='btn btn-primary'>Add Record</button>" : "";
        }
        
        return join("<br>", $edu);
        
    }
    public function occupation($profileId, $editable) {
        $db = new Database;
        $conn = $db->Database();
        
        $sql = "SELECT * FROM EDUCATION WHERE JOB_SEEKER = ".$profileId.";";
        $result = $conn->query($sql);
        
        $edu[] = '';
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $edu[] = $row['INSTITUTION'];
                $edu[] = $row['QUALIFICATION'];
                $edu[] = $row['START'];
                $edu[] = $row['END'];
            }
        }else{
            $edu[] = "<div class='bg-info bg-opacity-25 border border-info rounded text-center p-2'>"
                . "<span class='bi-exclamation-circle p-2'></span>"
                . "No Records Found"
            . "</div>";
        }
        
        return join("<br>", $edu);
        
    }
    public function reference($profileId, $editable) {
        $db = new Database;
        $conn = $db->Database();
        
        $sql = "SELECT * FROM EDUCATION WHERE JOB_SEEKER = ".$profileId.";";
        $result = $conn->query($sql);
        
        $edu[] = '';
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $edu[] = $row['INSTITUTION'];
                $edu[] = $row['QUALIFICATION'];
                $edu[] = $row['START'];
                $edu[] = $row['END'];
            }
        }else{
            $edu[] = "<div class=''>No Records Found</div>";
        }
        
        return join("<br>", $edu);
        
    }
    public function contacts($profileId, $editable) {
        $db = new Database;
        $conn = $db->Database();
        
        $sql = "SELECT * FROM EDUCATION WHERE JOB_SEEKER = ".$profileId.";";
        $result = $conn->query($sql);
        
        $edu[] = '';
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $edu[] = $row['INSTITUTION'];
                $edu[] = $row['QUALIFICATION'];
                $edu[] = $row['START'];
                $edu[] = $row['END'];
            }
        }else{
            $edu[] = "<div class=''>No Records Found</div>";
        }
        
        return join("<br>", $edu);
        
    }

}
