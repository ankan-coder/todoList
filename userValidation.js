document.addEventListener("DOMContentLoaded", function () {
  var password = document.getElementById("password");
  var cpassword = document.getElementById("cpassword");
  var passmsg = document.getElementById("pass");
  var cpassmsg = document.getElementById("cpass");

  password.addEventListener("input", validatePassword);
  cpassword.addEventListener("input", validatePassword);
  password.addEventListener("input", passLen);

  function validatePassword() {
    var passwordValue = password.value;
    var cpasswordValue = cpassword.value;

    var passwordValue = password.value;
    if (passwordValue.length >= 12) {
      passmsg.style.color = "green";
      passmsg.textContent = "Strong";
      passmsg.style.display = "block";
    } else if (passwordValue.length >= 8 && passwordValue.length < 12) {
      passmsg.textContent = "Medium";
      passmsg.style.color = "orange";
      passmsg.style.display = "block";
    } else if (passwordValue.length == 0) {
      passmsg.textContent = "";
      passmsg.style.display = "none"; // Add quotes around 'none'
    } else {
      passmsg.style.color = "red";
      passmsg.textContent = "Weak";
      passmsg.style.display = "block";
    }

    if (cpasswordValue === "") {
      // Check if cpassword is empty
      cpassmsg.textContent = "";
      cpassmsg.style.display = "none";
    } else {
      // If cpassword is not empty, then compare passwords
      if (passwordValue !== cpasswordValue) {
        cpassmsg.textContent = "Passwords don't match";
        cpassmsg.style.color = "red";
        cpassmsg.style.display = "block";
      } else {
        cpassmsg.textContent = "Passwords match";
        cpassmsg.style.color = "green";
        cpassmsg.style.display = "block";
      }
    }
  }
});
