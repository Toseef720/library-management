const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", function(e) {
    e.preventDefault();

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const error = document.getElementById("error");

    if (username === "admin" && password === "admin123") {
        window.location.href = "pages/dashboard.php";
    } else {
        error.classList.remove("hidden");
    }
});