<template>
    <div id="login-page">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-6">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="login-greeting text-center">
                            <p>Log in to continue to</p>
                        </div>
                        <div class="dashboard-logo text-center">
                            WorkForce
                        </div>
                        <p class="text-center">
                            <small>(Workforce Management System)</small>
                        </p>
                        <div class="login-form">
                            <form @submit.prevent="login">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email"
                                           v-model="form.username"
                                           data-vv-name="username"
                                           data-vv-as="Email"
                                           :class="{'form-control': true, 'is-invalid': errors.has('username') }"
                                           v-validate="'required|email'">
                                    <span class="invalid-feedback" role="alert" v-show="errors.has('username')">
                                        <strong>{{ errors.first('username') }}</strong>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password"
                                           v-model="form.password"
                                           data-vv-name="password"
                                           data-vv-as="Password"
                                           :class="{'form-control': true, 'is-invalid': errors.has('password') }"
                                           v-validate="'required'">
                                    <span class="invalid-feedback" role="alert" v-show="errors.has('password')">
                                        <strong>{{ errors.first('password') }}</strong>
                                    </span>
                                </div>
                                <div class="alert alert-danger" role="alert" v-if="errorMessage">
                                    {{ errorMessage }}
                                </div>
                                <div class="form-group text-center">
                                    <button type="button" class="btn btn-primary" @click="login">Login</button>
                                    <a :href="$route.query.redirect_url+'/login-register'" class="btn btn-warning">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    redirect_url: this.$route.query.redirect_url,
                    module: this.$route.query.module
                },
                error: null
            }
        },
        computed: {
            errorMessage() {
                return this.error;
            }
        },
        methods: {
            login() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.post('/api/login', this.form).then(res => {
                            auth.login(res.data.access_token, res.data.user);
                            if (res.data.url) {
                                window.location.replace(res.data.url);
                            }
                        }).catch(err => {
                            this.error = err.response.data.message;
                        });
                    }
                });
            }
        }
    }
</script>