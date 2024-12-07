document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault(); 
    
  
    const usernameEmail = document.getElementById("username_email");
    const password = document.getElementById("password");

   
    if (usernameEmail.value.trim() === "" || password.value.trim() === "") {
        alert("Both fields are required!");
        return; 
    }

    window.location.href = "index.html"; 
});
