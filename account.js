document.addEventListener("DOMContentLoaded", function () {
    var change_username_onclick = async function () {
        var account = new Account(window.location.origin + "/TodoManager/account_api.php");
        var username = document.getElementById("username").value;
        var error_div = document.getElementById("error");
        error_div.innerHTML = "";

        var error = await account.change_username(username);
        if (error !== "") {
            error_div.innerHTML = error;
        }
    }
    document.getElementById("change_username").onclick = change_username_onclick;
