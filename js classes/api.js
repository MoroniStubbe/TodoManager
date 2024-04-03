class API {
    url;
    method;

    constructor(url, method = "GET") {
        this.url = url;
        this.method = method;
    }

    async send(data, method = this.method) {
        const options = {
            method,
            headers: { 'Content-Type': 'application/json' }
        };

        if (data) {
            options.body = JSON.stringify(data);
        }

        const response = await fetch(this.url, options);
        return await response.json();
    }
}