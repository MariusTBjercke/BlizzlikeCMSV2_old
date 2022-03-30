up.compiler('.register-form', (element) => {
    const usernameField = document.querySelector(".register-form #username");
    const passwordField = document.querySelector(".register-form #password");
    const emailField = document.querySelector(".register-form #email");
    const registerBtn = document.querySelector(".register-form #submit");

    // Add listener for "enter" key.
    element.addEventListener("keydown", (e) => {
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
            [emailField, "Please fill in a email address.", [/^(.+)@(.+)$/, "Please fill in a valid email address."]]
        ]) {
            if (!item[0].value) {
                item[0].classList.add('register-form__input-error');

                if (item[0].nextElementSibling && item[0].nextElementSibling.classList.contains('login-form__error-message')) {
                    item[0].nextElementSibling.remove();
                }

                const errorMessage = document.createElement('div');
                errorMessage.setAttribute('class', 'login-form__error-message');
                errorMessage.innerHTML = "*" + item[1];
                item[0].parentNode.appendChild(errorMessage);

                error++;
            } else {
                if (item[0].classList.contains("register-form__input-error")) {
                    item[0].classList.remove("register-form__input-error");
                }
                if (item[0].nextElementSibling && item[0].nextElementSibling.classList.contains('login-form__error-message')) {
                    item[0].nextElementSibling.remove();
                }

                // If regex is set, check if the email is valid.
                if (item[2]) {
                    if (item[0].value.match(item[2][0])) {
                        console.log("Email is valid.");
                    } else {
                        const errorMessage = document.createElement('div');
                        errorMessage.setAttribute('class', 'login-form__error-message');
                        errorMessage.innerHTML = "*" + item[2][1];
                        item[0].parentNode.appendChild(errorMessage);
                    }
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
                window.location = "index.php?action=registerSuccess";
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
});