<template>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>
        <button type="button" class="btn btn-success" @click="validateToken">Validate Token</button>
    </main>
</template>

<script>
    export default {
        methods: {
            validateToken() {
                axios.post('/api/token/validator', {access_token: localStorage.getItem('access_token')}).then(res => {
                    console.log(res.data)
                }).catch(err => console.log(err));
            }
        }
    }
</script>