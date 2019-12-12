import VueRouter from 'vue-router';

let routes = [
    {path: '/', component: require('./components/Home').default},
    {path: '/login-register', component: require('./components/Login').default},
    {
        path: '/module-login/workforce', component: require('./components/login_pages/Workforce').default, name: 'login.workforce'
    },
    {
        path: '/auth', component: require('./components/auth/Auth').default, meta: {middlewareAuth: true},
        children: [
            {path: 'dashboard', component: require('./components/auth/Dashboard').default, name: 'dashboard'},

            {path: 'profile', component: require('./components/auth/profile/Show').default, name: 'profile'},
            {path: 'profile/edit', component: require('./components/auth/profile/Edit').default, name: 'profile.edit'},

            {path: 'organizations', component: require('./components/auth/organization/Show').default, name: 'orgs'},
            {path: 'organizations/create', component: require('./components/auth/organization/Create').default, name: 'orgs.create'},
            {path: 'organizations/:org_id/edit', component: require('./components/auth/organization/Edit').default, name: 'orgs.edit'},

            {path: 'apps', component: require('./components/auth/modules/Show').default, name: 'apps'},
        ]
    },
    {path: '*', redirect: '/'}
];

const router = new VueRouter({
    mode: 'history',
    routes,
    linkActiveClass: 'active'
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.middlewareAuth)) {
        if (!auth.check()) {
            next({path: '/', query: {redirect: to.fullPath}});
            return;
        }
    }
    next();
});

export default router;
