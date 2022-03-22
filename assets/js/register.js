const registerForm = document.querySelector(".register-form");

if (registerForm) {
    const usernameField = document.querySelector(".register-form #username");
    const passwordField = document.querySelector(".register-form #password");
    const emailField = document.querySelector(".register-form #email");
    const registerBtn = document.querySelector(".register-form #submit");

    registerBtn.addEventListener('click', (e) => {
        e.preventDefault();

        let data = {
            username: usernameField.value,
            password: passwordField.value,
            email: emailField.value
        };

        $.post('../includes/ajax/register.php', data, (response) => {
            if (response === "1") {
                alert("The account has been registered.");
                window.location = "index.php";
            } else if (response === "2") {
                alert("All fields need to be filled out, please try again.");
            } else {
                alert("Something went wrong, please try again.");
                usernameField.value = "";
                passwordField.value = "";
                emailField.value = "";
            }
        });
    });
}