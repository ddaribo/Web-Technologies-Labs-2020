function validate() {
  
    let username = document.getElementById("username").value;
    let usernameRegex = /^[a-zA-Z0-9_]{3,10}$/;

    let pass = document.getElementById("pass").value;
    let passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/; 

    let passConfrim = document.getElementById("passCheck").value;

    var errorsLabel = document.getElementById('errors');
    errorsLabel.innerHTML = '';
    errorsLabel.style.display = 'block';
    errorsLabel.style.color = 'red';

    if(username.match(usernameRegex) == null){
        errorsLabel.innerHTML += "Username " + username + " not correct. It should be between 3 and 10 symbols containing letters, digits and _." + "\n";
        return false;
    }

    if(pass.match(passRegex) == null){
        errorsLabel.innerHTML += "Password should be at least 6 symbols containing at least 1 capital letter, 1 small letter and 1 digit!" + "\n";
        return false;
    }

    if(pass != passConfrim){
        errorsLabel.innerHTML += "Reentered password should be the same as the first one!" + "\n";
        return false;
    }

    alert("validations passed");
    return true;
}

