//ts compiler command : tsc index.ts --watch -w
let Login:HTMLElement|null = document.querySelector(".Login");
let Profile: HTMLElement = document.getElementById("Profile");
let computedStyle: CSSStyleDeclaration = window.getComputedStyle(Login);
let Loged_in: boolean;


if(computedStyle.display === "block"){
    Loged_in = true;
    Profile.style.display = "none";
}else if(computedStyle.display === "none"){
    Loged_in = false;
    Profile.style.display = "block";
}
