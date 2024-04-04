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
}