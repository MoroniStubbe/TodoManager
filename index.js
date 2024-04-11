function toggleCheck(item) {
    item.classList.toggle("checked");
}


document.addEventListener("DOMContentLoaded",
    function () {
        if (document.getElementById("log_out")) {
            var log_out_onclick = async function () {
                var account = new Account(window.location.origin + "/TodoManager/account_api.php");
                await account.log_out();
                location.reload();
            }

            document.getElementById("log_out").onclick = log_out_onclick;
        }
    }
);
