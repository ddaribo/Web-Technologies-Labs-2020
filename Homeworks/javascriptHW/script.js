const register = {
    onFormSubmitted: event => {
        event.preventDefault();
        
        hideErrorMessages(); /* When submitting again without refreshing */

        const formElement = event.target;

        const formData = {
            username: formElement.querySelector("input[name='username']").value,
            fullName: formElement.querySelector("input[name='full-name']").value,
            email: formElement.querySelector("input[name='email']").value,
            password: formElement.querySelector("input[name='password']").value,
            street: formElement.querySelector("input[name='street']").value,
            city: formElement.querySelector("input[name='city']").value,
            postalCode: formElement.querySelector("input[name='postal-code']").value,
        };
        
        console.log(formData);
    
        fetch('https://jsonplaceholder.typicode.com/users', {
                method: 'GET',
            })
            .then(response => response.json())
            .then(result => {
                if(validateForm(formData)){
                    hideErrorMessages();

                    var hasMatch = false;

                    for (var i = 0; i < result.length; i++) {
                        var user = result[i];
                        console.log(user);

                        if(user.username == formData["username"]){
                            hasMatch = true;
                            break;
                        }
                    }

                    if(hasMatch){
                        createErrorLabel("A user with this username already exists! Please, choose a new username.", "errLabelUserExists", "errUserExists");
                    }
                    else {
                        createErrorLabel("Successfully registered!", "errLabelSuccess", "errSuccess");
                    }
                }
            })
    }
};

function validateForm(formData){
    noError = true;
    if(formData["username"] == ''){
        createErrorLabel("Username is a required field!", "errLabelNameRequired", "errUnameRequired");
        noError = false;
    }
    if(formData["username"].length < 3 || formData["username"].length > 10){
        createErrorLabel("Username must be between 3 and 10 characters!", "errLabelName", "errUname");
        noError = false;
    }
    if(formData["fullName"] == ''){
        createErrorLabel("Full name is a required field!", "errLabelFullNameRequired", "errFullUnameRequired");
        noError = false;
    }
    if(formData["fullName"].length > 50){
        createErrorLabel("Your full name should not surpass 50 characters!", "errLabelFullName", "errFullUname");
        noError = false;
    }
    if(formData["email"] == ''){
        createErrorLabel("Email is a required field!", "errLabelEmailRequired", "errEmailRequired");
        noError = false;
    }
    if(formData["password"] == ''){
        createErrorLabel("Password is a required field!", "errLabelPassRequired", "errPassRequired");
        noError = false;
    }
    if(formData["password"] != '' && !/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,10}$/.test(formData["password"])){
        createErrorLabel("Password should be at least 6 characters long and no longer than 10 characters! It should contain at least one lowercase and uppercase letters and at least one digit!", "errLabelPass", "errPass");
        noError = false;
    }
    if(formData["postalCode"] != '' && !/[0-9]{5}-[0-9]{4}/.test(formData["postalCode"])){
        createErrorLabel("Postal code should be in the following format: 11111-1111", "errPostalCode", "errPostalCode");
        noError = false;
    }
    console.log(noError);
    return noError;
}

function createErrorLabel(errorMessage, errLabel, errId){
    errDiv = document.getElementById('errors');
    label = document.createElement('p');

    if(errId != "errSuccess"){
        label.setAttribute('class', 'errLabel');
    } else {
        label.setAttribute('class', 'successLabel');
    }
    label.setAttribute('id', errId);
    label.innerHTML += errorMessage;

    /* This is needed to check if the current error message is already displayed so it does not repeat. */
    let errMsg= document.getElementById(errId);
    if(!errDiv.contains(errMsg)){
        errDiv.appendChild(label);
    }
}


function hideErrorMessages(){
    errDiv = document.getElementById('errors');
    errDiv.innerHTML = '';
}

document.getElementById('register').addEventListener('submit', register.onFormSubmitted);
