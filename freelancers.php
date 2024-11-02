<?php

include_once 'applets/Database.php';

if(filter_input(INPUT_GET, 'content') == 'freelancers') {
    
    $jobSeeker = new job_seeker;
    
    $jobSeeker->job_seeker();
}

class job_seeker {

    public function job_seeker() {
        echo $this->viewJobSeekers();
    }

    public function viewJobSeekers() {
        $db = new Database;
        $conn = $db->Database();

        $sql = "SELECT id, name, email, phone, bio, profile_picture, skills, experience FROM job_seekers";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $userProfile[] = "<div class='row row-cols-1 row-cols-md-3 g-3 mb-3'>";
            while ($row = $result->fetch_assoc()) {
                $userProfile[] = "<div class='col'><div class='card hover p-0'>"
                    . "<div class='card-img h-50 overflow'>"
                        . "<img class='image-fluid img-thumbnail p-0 border-0 rounded mx-auto d-block' src='" . $row["profile_picture"] . "' alt='Profile Picture'>"
                    . "</div>"
                    . "<div class='card-body text-color'>"
                        . "<div class='card-title h4'><a class='link-underline link-underline-opacity-0 link-underline-opacity-50-hover text-primary' href='?content=profile&profile=".$row['id']."'>" . $row["name"] . "</a></div>"
                            . "<p class='p'>" . $row["skills"] . "</p>"
                        . "<div class='card-text text-start'>"
                            . "<p class='card-subtitle text-muted pb-3 ellipsis line-clamp'>" . $row["bio"] . "</p>"
                            . "<p class='text-end border rounded px-2 mx-1 float-end btn-outline-primary '><small>" . $row["experience"] . "</small></p>"
                            . "<p class='text-end border rounded px-2 float-end text-muted'><small>Rating: 5 Star</small></p>"
                            . "<p class='text-end border rounded px-2 float-end text-muted'><small>15 Reviews</small></p>"
                        . "</div>"
                    . "</div>"
                        . "<div class='card-footer'>"
                        . "<div class='row'>"
                            . "<div class='col-1' alt='E-Mail'><span class='bi-envelope-at  px-1'></span></div><div class='col-11'>" . $row["email"] . "</div>"
                            . "<div class='col-1' alt='E-Mail'><span class='bi-phone  px-1'></span></div><div class='col-11'>" . $row["phone"] . "</div>"
                            . "<div class='col-1' alt='E-Mail'><span class='bi-facebook  px-1'></span></div><div class='col-11'>" . $row["name"] . "</div>"
                            . "<div class='col-1' alt='E-Mail'><span class='bi-whatsapp  px-1'></span></div><div class='col-11'>" . $row["phone"] . "</div>"
                        . "</div>"
                        . "</div>"
                . "</div>"
                . "</div>";
            }
            $userProfile[] = "</div>";
        } else {
            $userProfile[] = "<div class='row p-3'>No Records Found</div>";
        }

        return join($userProfile);

        $conn->close();
    }
}
