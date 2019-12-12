<template>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Organizations</h1>
            <span class="float-right">
                <router-link :to="{name:'orgs.create'}" tag="button" class="btn btn-primary">
                    Add New
                </router-link>
            </span>
        </div>
        <div v-for="(org, orgIndex) in orgs" v-if="orgs.length > 0">
            <div class="card">
                <div class="card-header">
                    {{ org.info.name }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <label>Name</label>
                                <p>{{ org.info.name }}</p>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <p>{{ org.info.phone }}</p>
                            </div>
                            <div class="form-group">
                                <label>Reg No</label>
                                <p>{{ org.info.reg }}</p>
                            </div>
                            <router-link :to="{name: 'orgs.edit', params: {org_id:org.info.id}}" tag="button"
                                         class="btn btn-primary" v-if="org.is_manager">
                                Edit
                            </router-link>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <label>Address</label>
                                <p>{{ org.info.address }}</p>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <p>{{ org.info.email }}</p>
                            </div>
                            <div class="form-group">
                                <label>VAT</label>
                                <p>{{ org.info.vat }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h5>Managers</h5>
                            <hr>
                            <div v-for="(user, i) in org.all_users.managers">
                                {{ user.fname }} {{ user.lname }}
                            </div>
                            <div v-if="org.info.subscriptions.length > 0">
                                <h5 class="mt-lg-5">Subscriptions</h5>
                                <hr>
                                <div v-for="(sub, subIndex) in org.info.subscriptions">
                                    {{ sub.module.name }}, valid till {{ sub.module.valid_till | formatDate }}
                                    <span class="float-right" v-if="org.is_manager">
                                        <button type="button" class="btn btn-danger btn-sm"
                                                @click="cancelSubscription(sub.id, orgIndex, subIndex)">
                                            Cancel
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h5>Users</h5>
                            <hr>
                            <div v-for="(user, i) in org.all_users.users">
                                {{ user.fname }} {{ user.lname }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div v-else>
            <h4>
                You have 0 organizations,
                <router-link :to="{name:'orgs.create'}" tag="a">
                    create
                </router-link>
                one?
            </h4>
        </div>
    </main>
</template>
<script>
    export default {
        data() {
            return {
                orgs: []
            }
        },
        methods: {
            cancelSubscription(sub, org, index) {
                if (!window.confirm('Are you sure?')) {
                    return false;
                }
                api.call('post', '/api/module/'+sub+'/cancel').then(res => {
                    this.$toastr.s(res.data.message);
                    this.orgs[org].info.subscriptions.splice(index, 1);
                });
            },
            fetchUserOrgs() {
                api.call('get', '/api/organization').then(res => {
                    this.orgs = res.data;
                });
            }
        },
        created() {
            this.fetchUserOrgs();
        }
    }
</script>