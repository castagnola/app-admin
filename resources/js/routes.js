import VueRouter from 'vue-router';
import Vue from 'vue'

Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        {
            path: '/',
            component: require('./components/DashboardComponent').default
        },
        {
            path: '/dashboard',
            component: require('./components/DashboardComponent').default
        },
        {
            path: '/users',
            component: require('./components/users/UsersComponent').default
        },
        {
            path: '/users/:id',
            name: 'user',
            component: require('./components/roles/RolesModalComponent').default,
            props: true
        },
        {
            path: '/roles',
            component: require('./components/roles/RolesComponent').default
        },
        {
            path: '/profile',
            component: require('./components/profile/ProfileComponent').default
        },

        {
            path: '*',
            component: require('./views/404').default,
        },
    ],
    // mode: 'history' //evita que aparezca #/ en las rutas
})

