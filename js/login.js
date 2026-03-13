const loginForm = document.forms['loginForm']
if (loginForm) {
    loginForm.addEventListener('click', checkSignAccount);
}
function checkSignAccount(event) {
  let loginNoError1 = true;
  let loginDone1 = 0;
  if (loginForm.loginSignAccount.value == "") {
    loginNoError1 = false;
    document.getElementById("loginAccountError").innerText = "*Please enter your user email."
  }
  else {
    loginDone1 = loginDone1 + 1;
    document.getElementById("loginAccountError").innerText = ""
    userAccount = loginForm.loginSignAccount.value
  }

  if (loginForm.loginSignPassword.value == "") {
    loginNoError1 = false;
    document.getElementById("loginPasswordError").innerText = "*Please enter your password"
  }
  else {
    loginDone1 = loginDone1 + 1;
    document.getElementById("loginPasswordError").innerText = ""
    userAccount = loginForm.loginSignAccount.value
  }

  if (!loginNoError1) {
      event.preventDefault();
  }

  if (loginDone1 >= 2) {
        loginNoError1 = true;
        userOnline = true;
        userName = userAccount;
        document.getElementsByClassName("userNameDisplay").innerHTML = userName;
        // localStorage.setItem('userName', userName);
        // localStorage.setItem('userOnline', userOnline);
        console.log("loginNoError")
        var formB = document.getElementById("loginFormB"); 
        formB.submit(); 
    }
    console.log("loginDone");
}