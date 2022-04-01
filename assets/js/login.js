up.compiler('.login-form', (element) => {
    const usernameField = document.querySelector(".login-form #username");
    const passwordField = document.querySelector(".login-form #password");
    const loginBtn = document.querySelector(".login-form #submit");

    // Add listener for "enter" key.
    element.addEventListener("keydown", (e) => {
        if (e.keyCode === 13) {
            loginBtn.click();
        }
    });

    loginBtn.addEventListener('click', (e) => {
        let error = 0;

        // Form validation
        for (let item of [
            [usernameField, "Please fill in a username."],
            [passwordField, "Please fill in a password."]
        ]) {
            if (!item[0].value) {
                item[0].classList.add('login-form__input-error');

                if (item[0].nextElementSibling && item[0].nextElementSibling.classList.contains('login-form__error-message')) {
                    item[0].nextElementSibling.remove();
                }

                const errorMessage = document.createElement('div');
                errorMessage.setAttribute('class', 'login-form__error-message');
                errorMessage.innerHTML = "*" + item[1];
                item[0].parentNode.appendChild(errorMessage);

                error++;
            } else {
                if (item[0].classList.contains("login-form__input-error")) {
                    item[0].classList.remove("login-form__input-error");
                }
                if (item[0].nextElementSibling && item[0].nextElementSibling.classList.contains('login-form__error-message')) {
                    item[0].nextElementSibling.remove();
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
                window.location = "profile";
            } else {
                alert("Wrong username or password, please try again.");
                usernameField.value = "";
                passwordField.value = "";
            }
        });
    });
});