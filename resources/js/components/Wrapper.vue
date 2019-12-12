<template>
    <router-view></router-view>
</template>

<script>
    export default {
        data() {
            return {
                authenticated: auth.check(),
                user: auth.user
            };
        },
        methods: {
            logout() {
                auth.logout();
            }
        },
        mounted() {
            Event.$on('userLoggedIn', () => {
                this.authenticated = true;
                this.user = auth.user;
            });
        }
    }
</script>
