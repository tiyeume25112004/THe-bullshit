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
                    <th scope='col'>UserID</th>
                    <th scope='col'>Username</th>
                    <th scope='col'>password</th>
                    <th scope='col'>Email</th>
                    <th scope='col'>Fullname</th>
                    <th scope='col'>Role</th>
                    <th scope='col'>Score</th>
                </tr>
                </thead>
                <tbody id="table-body">
                </tbody>
            </table>
        </div>
        <script>
            try{
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange =function(){
                    if(xhr.status == 200 || xhr.readyState==4){
                        let data = JSON.parse(xhr.responseText);
                        document.getElementById("table-body").innerHTML=renderTable(data)
                        console.log(renderTable(data))
                    }
                }
                xhr.open('GET','api.php?choose=listAllUser&limit=8',false);
                xhr.send()
            }catch(err){
                alert("Some thing is wrong");
            }
            function renderTable(data){
                html = ""
                for(let key in data.users){
                            if(data.users.hasOwnProperty(key)){
                                row =data.users[key]
                                html += `
                                    <tr>
                                        <th scope='row'>${parseInt(key) + 1}</th>
                                        <td>${row.userID}</td>
                                        <td>${row.username}</td>
                                        <td>${row.password}</td>
                                        <td>${row.email}</td>
                                        <td>${row.fullname}</td>
                                        <td>${row.role}</td>
                                        <td>${row.total_score}</td>
                                        </tr>`;
                            }
                        }
                    return html
                }
        </script>
    </body>
</html>