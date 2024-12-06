const themeToggle = document.getElementById('theme-toggle');
const body = document.body;

// Check if user has a preferred theme
const currentTheme = localStorage.getItem('theme');
if (currentTheme === 'dark') {
    body.classList.add('dark-mode');
    themeToggle.textContent = '☀️';
}

// Toggle between light and dark mode
themeToggle.addEventListener('click', () => {
    body.classList.toggle('dark-mode');

    // Save the current theme in localStorage
    if (body.classList.contains('dark-mode')) {
        themeToggle.textContent = '☀️';
        localStorage.setItem('theme', 'dark');
    } else {
        themeToggle.textContent = '🌙';
        localStorage.setItem('theme', 'light');
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const signInForm = document.getElementById("signInForm");
    const signUpForm = document.getElementById("signUpForm");
    const formHeader = document.getElementById("formHeader");
    const formMessages = document.querySelectorAll(".formMessage");

    // Initially show the sign in form
    signInForm.classList.add("active-form");
    signUpForm.classList.remove("active-form");

    // Event listener for the Sign Up link to switch to Sign In form
    formMessages.forEach(message => {
        message.addEventListener("click", function (event) {
            if (event.target.id === "toSignUp") {
                signInForm.classList.remove("active-form");
                signUpForm.classList.add("active-form");
                formHeader.textContent = "Sign Up to Biomedical IQ"; // Change header to Sign Up
            } else if (event.target.id === "toSignIn") {
                signUpForm.classList.remove("active-form");
                signInForm.classList.add("active-form");
                formHeader.textContent = "Sign In"; // Change header to Sign In
            }
        });
    });
});



