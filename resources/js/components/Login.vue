<template>
    <div>
        <app-header></app-header>

        <section id="main" class="builder-elements">
            <div class="builder-element element-bg-white">
                <div class="element-inner">
                    <div class="container">
                        <div class="element-header text-center">
                            <h2>Log in / Register</h2>
                        </div>
                        <div class="element-body">
                            <div class="editor-content">
                                <div class="row login-register">
                                    <div class="col-12 col-lg-5">
                                        <h4>Log in</h4>
                                        <form @submit.prevent="validateForm('login_form')" data-vv-scope="login_form">
                                            <div class="form-group">
                                                <input type="email"
                                                       placeholder="Email"
                                                       v-model="login_form.username"
                                                       data-vv-name="login_form.username"
                                                       data-vv-as="Email"
                                                       :class="{'form-control': true, 'is-invalid': errors.has('login_form.username') }"
                                                       v-validate="'required|email'"
                                                       ref="username">
                                                <span class="invalid-feedback" role="alert"
                                                      v-show="errors.has('login_form.username')">
                                                    <strong>{{ errors.first('login_form.username') }}</strong>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <input type="password"
                                                       placeholder="Password"
                                                       v-model="login_form.password"
                                                       data-vv-name="login_form.password"
                                                       data-vv-as="Password"
                                                       :class="{'form-control': true, 'is-invalid': errors.has('login_form.password') }"
                                                       v-validate="'required'">
                                                <span class="invalid-feedback" role="alert"
                                                      v-show="errors.has('login_form.password')">
                                                    <strong>{{ errors.first('login_form.password') }}</strong>
                                                </span>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="button" class="btn btn-primary" @click="login">
                                                    Log in
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-12 col-lg-2 col-seperator">
                                        <div class="row align-items-center justify-content-center">
                                            <div class="col">
                                                <span>OR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-5">
                                        <h4>Register</h4>
                                        <form @submit.prevent="validateForm('register_form')"
                                              data-vv-scope="register_form">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <input type="text"
                                                               placeholder="First Name"
                                                               v-model="register_form.fname"
                                                               data-vv-name="register_form.fname"
                                                               data-vv-as="First Name"
                                                               :class="{'form-control': true, 'is-invalid': errors.has('register_form.fname') }"
                                                               v-validate="'required'">
                                                        <span class="invalid-feedback" role="alert"
                                                              v-show="errors.has('register_form.fname')">
                                                            <strong>{{ errors.first('register_form.fname') }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <input type="text"
                                                               placeholder="Last Name"
                                                               v-model="register_form.lname"
                                                               data-vv-name="register_form.lname"
                                                               data-vv-as="Last Name"
                                                               :class="{'form-control': true, 'is-invalid': errors.has('register_form.lname') }"
                                                               v-validate="'required'">
                                                        <span class="invalid-feedback" role="alert"
                                                              v-show="errors.has('register_form.lname')">
                                                            <strong>{{ errors.first('register_form.lname') }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="email"
                                                       placeholder="Email"
                                                       v-model="register_form.email"
                                                       data-vv-name="register_form.email"
                                                       data-vv-as="Email"
                                                       :class="{'form-control': true, 'is-invalid': errors.has('register_form.email') }"
                                                       v-validate="'required|email'">
                                                <span class="invalid-feedback" role="alert"
                                                      v-show="errors.has('register_form.email')">
                                                    <strong>{{ errors.first('register_form.email') }}</strong>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <input ref="password"
                                                       type="password"
                                                       placeholder="Password"
                                                       v-model="register_form.password"
                                                       data-vv-name="register_form.password"
                                                       data-vv-as="Password"
                                                       :class="{'form-control': true, 'is-invalid': errors.has('register_form.password') }"
                                                       v-validate="'required'">
                                                <span class="invalid-feedback" role="alert"
                                                      v-show="errors.has('register_form.password')">
                                                    <strong>{{ errors.first('register_form.password') }}</strong>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <input type="password"
                                                       placeholder="Confirm Password"
                                                       v-model="register_form.password_confirmation"
                                                       data-vv-name="register_form.password_confirmation"
                                                       data-vv-as="Confirm Password"
                                                       :class="{'form-control': true, 'is-invalid': errors.has('register_form.password_confirmation') }"
                                                       v-validate="'required|confirmed:password'">
                                                <span class="invalid-feedback" role="alert"
                                                      v-show="errors.has('register_form.password_confirmation')">
                                                    <strong>{{ errors.first('register_form.password_confirmation') }}</strong>
                                                </span>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-primary" @click="register">
                                                    Register
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <app-footer></app-footer>
    </div>
</template>

<script>
    import appHeader from './layout/Header';
    import appFooter from './layout/Footer';

    export default {
        data() {
            return {
                login_form: {
                    redirect_url: null,
                    module: null
                },
                register_form: {}
            };
        },
        methods: {
            validateForm(scope) {
                this.$validator.validateAll(scope).then(isValid => {
                });
            },
            login() {
                axios.post('/api/login', this.login_form).then(res => {
                    auth.login(res.data.access_token, res.data.user);
                    this.$router.push({name: 'dashboard'});
                }).catch(err => console.log(err));
            },
            register() {
                axios.post('/api/register', this.register_form).then(res => {
                    this.$toastr.i(res.data.message);
                    this.$router.push('/login');
                }).catch(err => console.log(err));
            }
        },
        components: {
            appHeader,
            appFooter
        }
    }
</script>
