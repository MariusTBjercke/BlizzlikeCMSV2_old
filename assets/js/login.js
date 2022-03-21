const loginForm = document.querySelector(".login-form");

if (loginForm) {
    const usernameField = document.querySelector(".login-form #username");
    const passwordField = document.querySelector(".login-form #password");
    const loginBtn = document.querySelector(".login-form #submit");

    loginBtn.addEventListener('click', (e) => {
        e.preventDefault();

        let data = {
            username: usernameField.value,
            password: passwordField.value
        };

        $.post('../includes/ajax/login.php', data, (response) => {
            if (response === "1") {
                alert("You are now logged in!");
                window.location = "index.php";
            } else {
                alert("Wrong username or password, please try again.");
                usernameField.value = "";
                passwordField.value = "";
            }
        });
    });
}