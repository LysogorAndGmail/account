<template>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Profile
            </h1>
            <span class="float-right">
                <router-link :to="{name:'profile.edit'}" tag="button" class="btn btn-primary">
                    Edit
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
                            <label>First Name *</label>
                            <p>{{ user.fname }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Name *</label>
                            <p>{{ user.lname }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <p>{{ user.email }}</p>
                </div>
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
                user: {},
            }
        },
        methods: {
            fetchUser() {
                api.call('get', '/api/user').then(res => {
                    this.user = res.data.user;
                });
            }
        },
        created() {
            this.fetchUser();
        }
    }
</script>