class Auth {
    constructor() {
        this.access_token = window.localStorage.getItem('access_token');

        let userData = window.localStorage.getItem('user');
        this.user = userData ? JSON.parse(userData) : null;

        if (this.access_token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.access_token;

            this.getUser();
        }
    }

    login(access_token, user) {
        if (access_token && user) {
            window.localStorage.setItem('access_token', access_token);
            window.localStorage.setItem('user', JSON.stringify(user));

            axios.defaults.headers.common['Authorization'] = 'Bearer ' + access_token;
            this.access_token = access_token;
            this.user = user;

            Event.$emit('userLoggedIn');
        }
    }

    check() {
        return !!this.access_token;
    }

    logout() {
        axios.post('/api/logout').then(() => {
            window.localStorage.removeItem('access_token');
            window.localStorage.removeItem('user');
            window.location.replace('/');
        });
    }

    getUser() {
        api.call('get', '/api/user').then(({data}) => {
            this.user = data;
        });
    }
}

export default Auth;