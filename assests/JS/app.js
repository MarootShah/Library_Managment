document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");

    if (passwordInput && togglePassword) {
        togglePassword.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                togglePassword.textContent = "Hide";
            } else {
                passwordInput.type = "password";
                togglePassword.textContent = "Show";
            }
        });
    }

    const confirm_passwordInput = document.getElementById("confirm_password");
    const toggleConfPassword = document.getElementById('toggleConfPassword');

    if (confirm_passwordInput && toggleConfPassword) {
        toggleConfPassword.addEventListener("click", function () {
            if (confirm_passwordInput.type === "password") {
                confirm_passwordInput.type = "text";
                toggleConfPassword.textContent = "Hide";
            } else {
                confirm_passwordInput.type = "password";
                toggleConfPassword.textContent = "Show";
            }
        });
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const role = document.getElementById("role");
    const studentFields = document.querySelectorAll(".student-field");
    const phoneInput = document.getElementById("phone");
    const classInput = document.getElementById("class");

    function toggleStudentFields() {
        if (!role) return;

        if (role.value === "student") {
            studentFields.forEach(function(field) {
                field.style.display = "block";
            });

            if (phoneInput) phoneInput.required = true;
            if (classInput) classInput.required = true;
        } else {
            studentFields.forEach(function(field) {
                field.style.display = "none";
            });

            if (phoneInput) {
                phoneInput.required = false;
                phoneInput.value = "";
            }

            if (classInput) {
                classInput.required = false;
                classInput.value = "";
            }
        }
    }

    toggleStudentFields();

    if (role) {
        role.addEventListener("change", toggleStudentFields);
    }

    const togglePassword = document.getElementById("togglePassword");
    const password = document.getElementById("password");

    if (togglePassword && password) {
        togglePassword.addEventListener("click", function () {
            if (password.type === "password") {
                password.type = "text";
                this.textContent = "Hide";
            } else {
                password.type = "password";
                this.textContent = "Show";
            }
        });
    }

    const toggleConfPassword = document.getElementById("toggleConfPassword");
    const confirmPassword = document.getElementById("confirm_password");

    if (toggleConfPassword && confirmPassword) {
        toggleConfPassword.addEventListener("click", function () {
            if (confirmPassword.type === "password") {
                confirmPassword.type = "text";
                this.textContent = "Hide";
            } else {
                confirmPassword.type = "password";
                this.textContent = "Show";
            }
        });
    }
});