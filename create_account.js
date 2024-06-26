document.addEventListener("DOMContentLoaded", function () {
    var create_account_onclick = async function () {
        var account = new Account(window.location.origin + "/TodoManager/account_api.php");
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var password_confirm = document.getElementById("password_confirm").value;
        var error_div = document.getElementById("error");
        error_div.innerHTML = "";
        error_div.classList.add("hidden");

        if (password !== password_confirm) {
            error_div.innerHTML = "passwords don't match";
            error_div.classList.remove("hidden");
            return false;
        }

        var error = await account.create(username, password);
        if (error !== "") {
            error_div.innerHTML = error;
            error_div.classList.remove("hidden");
        }
        else {
            document.location.href = "login.php";
        }
    }
    document.getElementById("create_account").onclick = create_account_onclick;
});