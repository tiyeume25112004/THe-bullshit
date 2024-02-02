<?php
require("../Chung/function/function.php");
checkauth();
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="wrapper">
            <table class='table'>
                <thead class='thead-light'>
                <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Fullname</th>
                    <th scope='col'>Email</th>
                    <th scope='col'>Role</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <script>
            try{
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange =function(){
                    if(xhr.status == 200 || xhr.readyState==4){
                        let x = xhr.responseText;
                        console.log(x)
                        users = JSON.parse(x)
                        const uniqueRoles = [...new Set(users.map(user => user.role))];
                        console.log(uniqueRoles)
                    }
                }
                xhr.open('GET','api.php?choose=listAll&limit=2',false);
                xhr.send()
            }catch(err){
                alert("Some thing is wrong");
            }
        </script>
    </body>
</html>