// Set click listener
let loginButton = document.querySelector("#loginSubmit");
loginButton.addEventListener("click", (event) => {
    sendLoginInfo(event);
});

// Sends a login request
let sendLoginInfo = (event) => {
    console.dir("--- sending login info ---");
    $.ajax({
        type: "post",
        url: "php/login.php",
        data: $("#login-form").serialize(),
        // The most basic, error and complete exist as well
        success: (response) => {
            console.dir("received the following response: ");
            console.log(response);
        },
    });
    return false;
};
