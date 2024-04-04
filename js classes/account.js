class Account {
    api;
    id;
    username;

    constructor(api_url) {
        this.api = new API(api_url);
    }

    async create(username, password) {
        var error = "";

        if (password.length > 11) {
            error = await this.api.post({ action: "create", username: username, password: password });
        }
        else {
            error = "password too short";
        }

        return error;
    }

    async log_in(username, password) {
        var error = await this.api.post({ action: "log_in", username: username, password: password });
        return error;
    }

    async log_out() {
        var error = await this.api.post({ action: "log_out" });
        return error;
    }

    async delete() {
        var error = await this.api.post({ action: "delete" });
        return error;
    }

    async change_username(username) {
        var error = await this.api.post({ action: "change_username", username: username });
        return error;
    }

    async change_password(password) {
        var error = await this.api.post({ action: "change_password", password: password });
        return error;
    }
}