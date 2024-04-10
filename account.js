document.addEventListener("DOMContentLoaded", function () {
    var change_username_onclick = async function () {
        var account = new Account(window.location.origin + "/TodoManager/account_api.php");
        var username = document.getElementById("username").value;
        var error_div = document.getElementById("error");
        error_div.innerHTML = "";
        error_div.classList.add("hidden");

        var error = await account.change_username(username);
        if (error !== "") {
            error_div.innerHTML = error;
            error_div.classList.remove("hidden");
        }
    }
    document.getElementById("change_username").onclick = change_username_onclick;


    var change_password_onclick = async function () {
        var account = new Account(window.location.origin + "/TodoManager/account_api.php");
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

        var error = await account.change_password(password);
        if (error !== "") {
            error_div.innerHTML = error;
            error_div.classList.remove("hidden");
        }
    }
    document.getElementById("change_password").onclick = change_password_onclick;


    var delete_account_onclick = async function () {
        var account = new Account(window.location.origin + "/TodoManager/account_api.php");
        var error_div = document.getElementById("error");
        error_div.innerHTML = "";
        error_div.classList.add("hidden");

        if (confirm("Weet je zeker dat je je account wilt verwijderen?")) {
            var error = await account.delete();
            if (error !== "") {
                error_div.innerHTML = error;
                error_div.classList.remove("hidden");
            }

            window.location.href = window.location.origin + "/TodoManager";
        }
    }
    document.getElementById("delete_account").onclick = delete_account_onclick;
});