<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registeration Page</title>
</head>
<body>
    registeration Page
    <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <span class="error-text"></span>
        <input type="text" name="fname" placeholder="First name" required>
        <input type="text" name="lname" placeholder="Last name" required>
        <input type="text" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter new password" required>
        <input class="continue" id="upload" type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required="*">
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
           xhr.open("POST", "core/signup.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
               if(xhr.status === 200){
                    let data = xhr.response;
                    if(data === "success"){
                          location.href="dashboard";
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