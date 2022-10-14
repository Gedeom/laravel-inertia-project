import './bootstrap';
import '../css/app.css';
import 'vue-select/dist/vue-select.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { setTranslations } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import vSelect from 'vue-select';
import VueMask from '@devindex/vue-mask';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

setTranslations({
  next: "Próximo",
  no_results_found: "Nenhum Resultado Encontrado",
  of: "de",
  per_page: "por página",
  previous: "Anterior",
  results: "resultados",
  to: "para",
});


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .use(ZiggyVue, Ziggy)
            .use(VueMask)
            .component('v-select', vSelect)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
