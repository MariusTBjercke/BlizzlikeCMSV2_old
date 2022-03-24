const loginForm = document.querySelector(".login-form");

if (loginForm) {
    const usernameField = document.querySelector(".login-form #username");
    const passwordField = document.querySelector(".login-form #password");
    const loginBtn = document.querySelector(".login-form #submit");

    // Add listener for "enter" key.
    loginForm.addEventListener("keydown", (e) => {
        if (e.keyCode === 13) {
            loginBtn.click();
        }
    });

    let fieldsError = "All fields needs to be filled out, please try again.";

    loginBtn.addEventListener('click', (e) => {
        let error = 0;

        // Form validation
        for (let item of [
            [usernameField, "Please fill inn a username."],
            [passwordField, "Please fill inn a password."]
        ]) {
            if (!item[0].value) {
                item[0].classList.add('login-form__input-error');
                console.log(item[1]);
                error++;
            } else {
                if (item[0].classList.contains("login-form__input-error")) {
                    item[0].classList.remove("login-form__input-error");
                }
            }
        }

        if (error > 0) {
            return;
        }

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