<template>
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <router-link :to="{name: 'dashboard'}" tag="a" class="nav-link" exact>
                        Dashboard
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name: 'profile'}" tag="a" class="nav-link" exact>
                        Profile
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name: 'orgs'}" tag="a" class="nav-link" exact>
                        Organizations
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name: 'apps'}" tag="a" class="nav-link" exact>
                        Apps
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>