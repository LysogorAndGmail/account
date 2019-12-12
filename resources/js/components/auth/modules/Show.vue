<template>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Apps</h1>
        </div>
        <div v-for="(module, i) in modules" v-if="modules.length > 0">
            <div class="card">
                <div class="card-header">
                    {{ module.name }}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <p>{{ module.name }}</p>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <p>{{ module.price }} &euro; {{ module.pay_period == 12 ? 'per/year' : 'per/month' }}</p>
                    </div>
                    <button type="button" class="btn btn-primary"
                            @click="openBuyModal(module.id, module.name, module.price)">
                        Buy
                    </button>
                    <span v-for="(sub, i) in subs" v-if="sub.module_id === module.id">
                        <button type="button" class="btn btn-primary" @click="loginToWorkforce">
                            <small>Log in to</small> <b>{{ sub.org.name }}</b> <small>WORKFORCE</small>
                        </button>
                    </span>
                </div>
            </div>
            <hr>
        </div>
        <div v-else>
            <h4>
                We have 0 modules at the moment
            </h4>
        </div>

        <!--BUY MODAL-->
        <b-modal v-model="buy_modal" centered :title="'Buy '+selected_module_name">
            <div class="form-group">
                <label>Organization</label>
                <select v-model="form.org"
                        data-vv-name="org"
                        data-vv-as="Organization"
                        :class="{'form-control': true, 'is-invalid': errors.has('org') }"
                        v-validate="'required'">
                    <option :value="org.info.id" v-for="(org, i) in orgs" v-if="org.is_manager">{{ org.info.name }}
                    </option>
                </select>
                <span class="invalid-feedback" role="alert" v-show="errors.has('org')">
                    <strong>{{ errors.first('org') }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label>Years</label>
                <select v-model="form.years"
                        data-vv-name="years"
                        data-vv-as="Years"
                        :class="{'form-control': true, 'is-invalid': errors.has('year') }"
                        v-validate="'required'">
                    <option :value="year" v-for="(year, i) in years">{{ year }}</option>
                </select>
                <span class="invalid-feedback" role="alert" v-show="errors.has('year')">
                    <strong>{{ errors.first('year') }}</strong>
                </span>
            </div>
            <div class="form-group text-center" v-if="totalPrice">
                <label>Total Price</label>
                <h5>{{ totalPrice }} &euro;</h5>
            </div>
            <div slot="modal-footer">
                <button class="btn btn-success" @click="buyModule">
                    BUY
                </button>
                <button class="btn btn-primary" @click="closeBuyModal">
                    Cancel
                </button>
            </div>
        </b-modal>
    </main>
</template>
<script>
    export default {
        data() {
            return {
                form: {
                    years: 1,
                    access_token: localStorage.getItem('access_token')
                },
                modules: [],
                subs: [],
                years: [1, 2, 3, 4, 5],
                orgs: [],
                buy_modal: false,
                selected_module_name: '',
                selected_module_price: 0
            }
        },
        computed: {
            totalPrice() {
                return this.form.years * this.selected_module_price;
            }
        },
        methods: {
            loginToWorkforce() {
                api.call('post', '/api/log-to-workforce', {access_token: localStorage.getItem('access_token')}).then(res => {
                    if (res.data.url) {
                        window.open(res.data.url, '_blank');
                    }
                }).catch(err => {
                    this.error = err.response.data.message;
                });
            },
            buyModule() {
                this.$validator.validateAll().then(isValid => {
                    if (isValid) {
                        api.call('post', '/api/module/buy', this.form).then(res => {
                            this.$toastr.s(res.data.message);
                            console.log(res.data);
                            this.closeBuyModal();
                        });
                    }
                });
            },
            fetchModules() {
                api.call('get', '/api/module').then(res => {
                    this.modules = res.data.modules;
                    this.subs = res.data.subs;
                });
            },
            openBuyModal(id, name, price) {
                this.form.module = id;
                this.selected_module_name = name;
                this.selected_module_price = price;
                this.fetchUserOrgs();
                this.buy_modal = true;
            },
            closeBuyModal() {
                this.form.module = null;
                this.selected_module_name = '';
                this.selected_module_price = 0;
                this.buy_modal = false;
            },
            fetchUserOrgs() {
                api.call('get', '/api/organization').then(res => {
                    this.orgs = res.data;
                });
            }
        },
        created() {
            this.fetchModules();
        }
    }
</script>