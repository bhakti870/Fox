let validate = true;

// Fullname validation
function nameValidate(Name, NameMsg) {
  if (Name.value === "") {
    NameMsg.innerHTML = "Required !";
    NameMsg.style.color = "red";
    validate = false;
  } else {
    let NameReg = /^[A-Za-z\s]{3,100}$/;
    if (NameReg.test(Name.value)) {
      NameMsg.innerHTML = "";
    } else {
      NameMsg.innerHTML = "Invalid- length should be 3 to 100";
      NameMsg.style.color = "red";
      validate = false;
    }
  }
}

//Email Validation
function emailValidate(email, emailMsg) {
  if (email.value === "") {
    emailMsg.innerHTML = "Required !";
    emailMsg.style.color = "red";
    validate = false;
  } else {
    let emailReg = /^[A-Za-z0-9._-]+@[A-Za-z]+\.[A-Za-z]{2,3}$/;
    if (emailReg.test(email.value)) {
      emailMsg.innerHTML = "";
    } else {
      emailMsg.innerHTML = "Invalid email format";
      emailMsg.style.color = "red";
      validate = false;
    }
  }
}

//Password Validation
function passwordValidate(password, passwordMsg) {
  if (password.value === "") {
    passwordMsg.innerHTML = "Enter Password";
    passwordMsg.style.color = "red";
    validate = false;
  } else {
    let passwordReg =
      /^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[@$!%?&])[A-Za-z\d@$!%?&]{8,10}$/;
    if (passwordReg.test(password.value)) {
      passwordMsg.innerHTML = "";
    } else {
      passwordMsg.innerHTML =
        "Password must be 8 to 10 characters long, contain an uppercase letter, a lowercase letter, a number, and a special character.";
      passwordMsg.style.color = "red";
      validate = false;
    }
  }

  if (validate) {
    // Form is valid, submit it
    document.forms["form"].submit();
  }
  
}

function User() {
  event.preventDefault();

  var name = document.getElementById('name');
  var name1 = document.getElementById('name1');
  var email = document.getElementById('email');
  var email1 = document.getElementById('email1');
  var password = document.getElementById('password');
  var password1 = document.getElementById('password1');

  nameValidate(name, name1);
  emailValidate(email, email1);
  passwordValidate(password, password1);

  if (validate) {
    // Form is valid, submit it
    document.forms["form"].submit();
  }
}