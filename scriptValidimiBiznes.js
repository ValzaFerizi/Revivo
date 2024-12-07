document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault(); 

    const inputs = document.querySelectorAll("input[required]");
    let isNotNull = true;

    
    inputs.forEach(input => {
        if (input.value.trim() === "") {
            alert(`${input.placeholder} cannot be empty.`);
            isNotNull = false;
        }
    });

    
    if (isNotNull) {
        alert("User registered successfully!");
        window.location.href = "index.html"; 
    }
});
