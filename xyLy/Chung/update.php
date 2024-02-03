<?php 
@error_reporting(1);
require("./function/function.php");
if(!checkauth()){
    die("Only admin");
}
if(checkRole()!=="admin"){
    die("Only admin, the suck user");
}
?>

<!DOCTYPE html>
<html>
    <head><title>Upload</title></head>
    <body>
        <?= $ma = "65bd606140a8c"; getOneChallenge($ma);?>
        <form method="post" enctype="multipart/form-data" id="usrform">
            <div>
                <input type="file" name="file">
            </div>
            <div>
                <input type="text" name="name" placeholder="name" id="name">
            </div>
            <div>
                <textarea rows="4" cols="50" name="description" form="usrform" placeholder="Description" id="description"></textarea>
            </div>
            <div>
                <input type="text" name="point" placeholder="point" id="point">
            </div>
            <button type="button" onclick="postData()">Enter</button>
        </form>
        <script>
            function postData() {
            // Get values from form elements
                var nameValue = document.getElementById('name').value;
                var descriptionValue = document.getElementById('description').value;
                var pointValue = document.getElementById('point').value;

                // Create a FormData object to store the form data
                var formData = new FormData();
                formData.append('name', nameValue);
                formData.append('description', descriptionValue);
                formData.append('point', pointValue);

                // Create a new XMLHttpRequest object
                var xhr = new XMLHttpRequest();

                // Configure it to send a POST request to api.php
                xhr.open("POST", "api.php?choose=updateChallenge&ma=65bd606140a8c", true);

                // Set up a callback function to handle the response
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response from the server (if needed)
                    console.log(xhr.responseText);
                    }
                };
                // Send the form data
                xhr.send(formData);
            }
        </script>
    </body>
</html>