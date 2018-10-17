import VueRouter from 'vue-router';
import Village from './../components/layouts/Village';
import Map from './../components/layouts/Map';

export default new VueRouter ({
    routes: [
        {
            path: '/',
            name: 'village',
            component: Village,
        },
        {
            path: '/map',
            name: 'map',
            component: Map,
        }
    ]
});
