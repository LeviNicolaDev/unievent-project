document.addEventListener('DOMContentLoaded', function() {
    const signinBtn = document.getElementById('signin');
    const signupBtn = document.getElementById('signup');
    const loginContainer = document.querySelector('.login-container');

    signinBtn.addEventListener('click', function() {
        loginContainer.classList.remove('sign-up-js');
        loginContainer.classList.add('sign-in-js');
    });

    signupBtn.addEventListener('click', function() {
        loginContainer.classList.remove('sign-in-js');
        loginContainer.classList.add('sign-up-js');
    });
});