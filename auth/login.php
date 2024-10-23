<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    login Page
    <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <span class="error-text"></span>
        <input type="text" name="email" placeholder="email@gmail.com" required>
        <input class="login" type="submit" name="submit" value="Continue to Chat">
        <input type="password" class="continue" name="password" placeholder="......." required>
    </form>
    
    <script>
        const form = document.querySelector("form"),
        continueBtn = form.querySelector(".continue"),
        errorText = form.querySelector(".error-text");

        form.onsubmit = (e)=>{
            e.preventDefault();
        }

        continueBtn.onclick = ()=>{
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "core/login.php", true);
        xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                location.href = "dashboard";
              }else{
                errorText.style.display = "block";
                errorText.textContent = data;
              }
          }
          }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    }
    </script>

</body>
</html>