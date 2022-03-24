const registerForm = document.querySelector(".register-form");
const usernameField = document.querySelector(".register-form #username");
const passwordField = document.querySelector(".register-form #password");
const emailField = document.querySelector(".register-form #email");
const registerBtn = document.querySelector(".register-form #submit");

if (registerForm) {

    // Add listener for "enter" key.
    registerForm.addEventListener("keydown", (e) => {
        if (e.keyCode === 13) {
            registerBtn.click();
        }
    });

    let fieldsError = "All fields needs to be filled out, please try again.";

    registerBtn.addEventListener('click', (e) => {
        let error = 0;

        // Form validation
        for (let item of [
            [usernameField, "Please fill inn a username."],
            [passwordField, "Please fill inn a password."],
            [emailField, "Please fill in a email address."]
        ]) {
            if (!item[0].value) {
                item[0].classList.add('register-form__input-error');
                console.log(item[1]);
                error++;
            } else {
                if (item[0].classList.contains("register-form__input-error")) {
                    item[0].classList.remove("register-form__input-error");
                }
            }
        }

        if (error > 0) {
            return;
        }

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
                alert(fieldsError);
            } else {
                alert("Something went wrong, please try again.");
                usernameField.value = "";
                passwordField.value = "";
                emailField.value = "";
            }
        });
    });
}