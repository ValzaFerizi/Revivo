document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault(); 

    const inputs = document.querySelectorAll("input[required]");
    const select = document.querySelector("select");
    let nukJaneNull = true;

   
    inputs.forEach(input => {
        if (input.value.trim() === "") {
            alert(`${input.placeholder} cannot be empty.`);
            nukJaneNull = false;
        }
    });

   
    if (select.value.trim() === "") {
        alert("Please select a city.");
        nukJaneNull = false;
    }

    
    if (nukJaneNull) {
        alert("User registered successfully!");
        window.location.href = "index.html";
    }
});
