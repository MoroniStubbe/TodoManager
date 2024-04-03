class Account {
    api;
    id;
    username;

    constructor(api_url) {
        this.api = new API(api_url);
    }

}