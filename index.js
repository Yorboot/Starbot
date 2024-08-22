//ts compiler command : tsc index.ts --watch -w
var Login = document.querySelector(".Login");
var Profile = document.getElementById("Profile");
var computedStyle = window.getComputedStyle(Login);
var Loged_in;
if (computedStyle.display === "block") {
    Loged_in = true;
    Profile.style.display = "none";
}
else if (computedStyle.display === "none") {
    Loged_in = false;
    Profile.style.display = "block";
}
