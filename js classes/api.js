class API {
    url;

    constructor(url) {
        this.url = url;
    }

    async post(data) {
        const options = {
            method: "POST",
            headers: { 'Content-Type': 'application/json' },
            credentials: 'include'
        };

        if (data) {
            options.body = JSON.stringify(data);
        }

        const response = await fetch(this.url, options);
        return await response.text();
    }
}