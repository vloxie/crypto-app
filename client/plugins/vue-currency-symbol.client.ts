import CurrencyBadge from 'vue-currency-symbol'
import {OhVueIcon} from "oh-vue-icons";

export default defineNuxtPlugin((nuxtApp) => {
    nuxtApp.vueApp.use(CurrencyBadge);
})
