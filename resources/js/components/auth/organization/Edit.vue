<template>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Organization</h1>
            <span class="float-right">
                <router-link :to="{name:'orgs'}" tag="button" class="btn btn-primary">
                    Cancel
                </router-link>
            </span>
        </div>
        <div class="card">
            <div class="card-header">
                Contact Info
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="text"
                                   v-model="form.name"
                                   data-vv-name="fname"
                                   data-vv-as="Name"
                                   :class="{'form-control': true, 'is-invalid': errors.has('name') }"
                                   v-validate="'required'">
                            <span class="invalid-feedback" role="alert"
                                  v-show="errors.has('name')">
                                <strong>{{ errors.first('name') }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address *</label>
                            <input type="text"
                                   v-model="form.address"
                                   data-vv-name="address"
                                   data-vv-as="Address"
                                   :class="{'form-control': true, 'is-invalid': errors.has('address') }"
                                   v-validate="'required'">
                            <span class="invalid-feedback" role="alert"
                                  v-show="errors.has('address')">
                                <strong>{{ errors.first('address') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone *</label>
                            <input type="text"
                                   v-model="form.phone"
                                   data-vv-name="phone"
                                   data-vv-as="Phone"
                                   :class="{'form-control': true, 'is-invalid': errors.has('phone') }"
                                   v-validate="'required'">
                            <span class="invalid-feedback" role="alert"
                                  v-show="errors.has('phone')">
                                <strong>{{ errors.first('phone') }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="text"
                                   v-model="form.email"
                                   data-vv-name="email"
                                   data-vv-as="Email"
                                   :class="{'form-control': true, 'is-invalid': errors.has('email') }"
                                   v-validate="'required'">
                            <span class="invalid-feedback" role="alert"
                                  v-show="errors.has('email')">
                                <strong>{{ errors.first('email') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Reg No *</label>
                            <input type="text"
                                   v-model="form.reg"
                                   data-vv-name="reg"
                                   data-vv-as="Reg No"
                                   :class="{'form-control': true, 'is-invalid': errors.has('reg') }"
                                   v-validate="'required'">
                            <span class="invalid-feedback" role="alert"
                                  v-show="errors.has('reg')">
                                <strong>{{ errors.first('reg') }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>VAT</label>
                            <input type="text"
                                   v-model="form.vat"
                                   :class="{'form-control': true}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" @click="update">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
    export default {
        data() {
            return {
                form: {}
            }
        },
        methods: {
            fetchOrg() {
                api.call('get', '/api/organization/' + this.$route.params.org_id + '/show').then(res => {
                    this.form = res.data;
                });
            },
            update() {
                this.$validator.validateAll().then(isValid => {
                    if (isValid) {
                        api.call('put', '/api/organization/' + this.$route.params.org_id + '/update', this.form).then(res => {
                            this.$toastr.s(res.data.message);
                            this.$router.push({name: 'orgs'});
                        });
                    }
                });
            },
        },
        created() {
            this.fetchOrg();
        }
    }
</script>