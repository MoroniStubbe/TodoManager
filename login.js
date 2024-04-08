document.addEventListener("DOMContentLoaded", function () {
    var log_in_onclick = async function () {
        var account = new Account(window.location.origin + "/TodoManager/account_api.php");
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var error_div = document.getElementById("error");
        error_div.innerHTML = "";

        var error = await account.log_in(username, password);
        if (error === "" || error === "already logged in") {
            window.location.href = "http://localhost/TodoManager/";
        }
        else{
            error_div.innerHTML = error;
        }
    }
    document.getElementById("log_in").onclick = log_in_onclick;
});