<template>
    <footer id="footer">
        <div class="container">
            <div class="row align-items-center">
                <div id="footer-logo" class="col">
                    Account
                </div>
                <div id="footer-navigation" class="col-md-auto text-center">
                    <nav class="navigation-menu">
                        <ul class="clearfix">
                            <li>
                                <router-link to="/" tag="a">
                                    Home
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/login-register" tag="a">
                                    Register
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/login-register" tag="a">
                                    Log in
                                </router-link>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div id="copyright" class="col text-right">
                    <router-link to="/" tag="a">
                        Copyright &copy; {{ year }} Tinksmat Systems OÜ
                    </router-link>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
    export default {
        data() {
            return {
                year: new Date().getFullYear()
            };
        }
    }
</script>
