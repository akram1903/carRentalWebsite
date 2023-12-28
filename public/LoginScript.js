
const form = document.getElementById('form');
const email = document.getElementById('email');

form.addEventListener('submit', e => {
   
        
        e.preventDefault();
    
   // validate forms
   let isEmailValid = checkEmail()

// submit to the server if the form is valid
if (isEmailValid) {
    form.action = 'handleLogin.php';
    form.submit();
}
});
 
const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    if (inputControl.classList.contains('success')){
        
        inputControl.classList.remove('success')
    }
    inputControl.classList.add('error');
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    if (inputControl.classList.contains('error')){
        inputControl.classList.remove('error');
    }
    inputControl.classList.add('success');
};

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}


const checkEmail = () => {
    let valid = false;
    const emailValue = email.value.trim();
    if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email address');
    } else {
        setSuccess(email);
        valid=true;
    }
    return valid;
}

