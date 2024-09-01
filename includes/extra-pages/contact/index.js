const Login = document.querySelector(".Login");
const Profile = document.getElementById("Profile");
const computedStyle = window.getComputedStyle(Login);
let Loged_in;

if (computedStyle.display === "block") {
    Loged_in = true;
    Profile.style.display = "none";
}
else if (computedStyle.display === "none") {
    Loged_in = false;
    Profile.style.display = "block";
}
