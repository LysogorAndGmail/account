<template>
    <div>
        <link href="https://getbootstrap.com/docs/4.0/examples/dashboard/dashboard.css" rel="stylesheet">
        <app-nav></app-nav>
        <div class="container-fluid">
            <div class="row">
                <app-sidebar></app-sidebar>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    import appNav from './layout/Nav';
    import appSidebar from './layout/Sidebar';

    export default {
        components: {
            appNav,
            appSidebar,
        }
    }
</script>