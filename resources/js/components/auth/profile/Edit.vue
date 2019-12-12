<template>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Profile</h1>
            <span class="float-right">
                <router-link :to="{name:'profile'}" tag="button" class="btn btn-primary">
                    Cancel
                </router-link>
            </span>
        </div>
        <div class="card">
            <div class="card-header">
                Contact Info
            </div>
            <div class="card-body">
                <form @submit.prevent="validateForm('profile_form')" data-vv-scope="profile_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name *</label>
                                <input type="text"
                                       v-model="profile_form.fname"
                                       data-vv-name="profile_form.fname"
                                       data-vv-as="First Name"
                                       :class="{'form-control': true, 'is-invalid': errors.has('profile_form.fname') }"
                                       v-validate="'required'">
                                <span class="invalid-feedback" role="alert"
                                      v-show="errors.has('profile_form.fname')">
                                    <strong>{{ errors.first('profile_form.fname') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name *</label>
                                <input type="text"
                                       v-model="profile_form.lname"
                                       data-vv-name="profile_form.lname"
                                       data-vv-as="Last Name"
                                       :class="{'form-control': true, 'is-invalid': errors.has('profile_form.lname') }"
                                       v-validate="'required'">
                                <span class="invalid-feedback" role="alert"
                                      v-show="errors.has('profile_form.lname')">
                                    <strong>{{ errors.first('profile_form.lname') }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email"
                               v-model="profile_form.email"
                               data-vv-name="profile_form.email"
                               data-vv-as="Email"
                               :class="{'form-control': true, 'is-invalid': errors.has('profile_form.email') }"
                               v-validate="'required|email'">
                        <span class="invalid-feedback" role="alert"
                              v-show="errors.has('profile_form.email')">
                            <strong>{{ errors.first('profile_form.email') }}</strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" @click="update">
                            Update
                        </button>
                    </div>
                </form>
                <form @submit.prevent="validateForm('password_form')" data-vv-scope="password_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password *</label>
                                <input ref="password"
                                       type="password"
                                       v-model="password_form.password"
                                       data-vv-name="password_form.password"
                                       data-vv-as="Password"
                                       :class="{'form-control': true, 'is-invalid': errors.has('password_form.password') }"
                                       v-validate="'required'">
                                <span class="invalid-feedback" role="alert"
                                      v-show="errors.has('password_form.password')">
                                    <strong>{{ errors.first('password_form.password') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm Password *</label>
                                <input type="password"
                                       v-model="password_form.password_confirmation"
                                       data-vv-name="password_form.password_confirmation"
                                       data-vv-as="Confirm Password"
                                       :class="{'form-control': true, 'is-invalid': errors.has('password_form.password_confirmation') }"
                                       v-validate="'required|confirmed:password'">
                                <span class="invalid-feedback" role="alert"
                                      v-show="errors.has('password_form.password_confirmation')">
                                    <strong>{{ errors.first('password_form.password_confirmation') }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" @click="updatePassword">
                            Update password
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                Billing Info
            </div>
            <div class="card-body">
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        data() {
            return {
                profile_form: {},
                password_form: {}
            }
        },
        methods: {
            fetchUser() {
                api.call('get', '/api/user').then(res => {
                    this.profile_form = res.data.user;
                });
            },
            validateForm(scope) {
                this.$validator.validateAll(scope).then(isValid => {
                });
            },
            update() {
                api.call('put', '/api/profile/update', this.profile_form).then(res => {
                    this.$toastr.i(res.data.message);
                    this.$router.push({name: 'profile'});
                });
            },
            updatePassword() {
                api.call('put', '/api/profile/update-password', this.password_form).then(res => {
                    this.$router.push({name: 'profile'});
                    this.$toastr.i(res.data.message);
                });
            }
        },
        created() {
            this.fetchUser();
        }
    }
</script>