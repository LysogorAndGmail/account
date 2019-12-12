class Api {
    constructor() {
    }

    call(requestType, url, data = null) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, data).then(response => {
                resolve(response);
            }).catch(({response}) => {
                console.log(response)
                if (response.status === 401) {
                    window.localStorage.removeItem('access_token');
                    window.localStorage.removeItem('user');
                    window.location.replace('/');
                }
                reject(response);
            });
        });
    }
}

export default Api;