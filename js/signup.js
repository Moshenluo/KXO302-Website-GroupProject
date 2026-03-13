/*
Sign up Page
Author:646883 Zian Zhao
*/

const registrationForm = document.forms['registrationForm']
//Storing User Information
let userName = "";
let userOnline = false;

if (registrationForm) {
  registrationForm.addEventListener('submit', checkCreateAccount);
}

// 检测用户注册的输入的方法
function checkCreateAccount(event) {
  let userAccount = "";
  let userEmail = "";
  let userPassword = "";
  let loginNoError = true;
  let loginDone = 0;
  const emailCheck = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const passwordCheck = /^(?=.*[A-Za-z])(?=.*\d).{8,}$/;  //至少8个字符，其中包含字母与数字

  //Check if incorrect account information has been entered, and if correct information has been entered, clear the displayed information
  if (registrationForm.loginCreateAccount.value == "") {
      loginNoError = false;
      document.getElementById("loginCreateAccountError").innerText = "*Please enter your user name/account."
  }
  else {
      loginDone = loginDone + 1;
      document.getElementById("loginCreateAccountError").innerText = ""
      userAccount = registrationForm.loginCreateAccount.value
  }

  //Check if the incorrect email information has been entered, and if the correct information has been entered, clear the displayed information
  if (!emailCheck.test(registrationForm.loginCreateEmail.value)) {
      loginNoError = false;
      document.getElementById("loginEmailError").innerText = "*Please enter a correct email address"
  }
  else {
      loginDone = loginDone + 1;
      document.getElementById("loginEmailError").innerText = "";
      userEmail = registrationForm.loginCreateEmail.value;
  }

  if (!passwordCheck.test(registrationForm.loginCreatePassword.value)) {
      loginNoError = false;
      document.getElementById("loginCreatePasswordError").innerText = "*Password less than 8 letters and numbers"
  }
  else {
      loginDone = loginDone + 1;
      document.getElementById("loginCreatePasswordError").innerText = ""
  }

  if (!(registrationForm.loginComfirmPassword.value == registrationForm.loginCreatePassword.value) || registrationForm.loginComfirmPassword.value == "") {
      loginNoError = false;
      document.getElementById("loginComfirmPasswordError").innerText = "*Please confirm your Password."
  }
  else {
      loginDone = loginDone + 1;
      document.getElementById("loginComfirmPasswordError").innerText = "";
      userPassword = registrationForm.loginCreatePassword.value;
  }

    var privacyPolicyCheckbox = document.getElementById('brand1');  //检查隐私协议勾选
    if (privacyPolicyCheckbox.checked) {
        
    }
    else {
        alert('You must agree to the private policy to register.');
        event.preventDefault();
    }
    

  //Check if the user input information is complete
  if (!loginNoError) {
      event.preventDefault();
  }

  //Check if the user has completed all information and stored account information locally
  if (loginDone >= 4) {
    loginNoError = true;
    userOnline = true;
    userName = userAccount;
    document.getElementsByClassName("userNameDisplay").innerHTML = userName;
    // localStorage.setItem('userName', userName);
    // localStorage.setItem('userOnline', userOnline);
  }

  console.log(loginNoError);
  console.log(loginDone);
}





































