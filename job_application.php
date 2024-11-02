<h2>Job Application Form</h2>
    <form action="submit_application.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>
        
        <label for="resume">Resume:</label>
        <input type="file" id="resume" name="resume" required><br><br>
        
        <input type="submit" value="Submit">
    </form>    
    <span><a href="login.html">Login</a></span>
    <span> | </span>
    <span><a href="register.html">Register</a></span>