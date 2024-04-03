class Account {
    api;
    id;
    username;

    constructor(api_url) {
        this.api = new API(api_url);
    }

    create(username, password) {
        var error = "";

        if (password.length > 11) {
            this.api.post({ action: "create", username: username, password: password });
}