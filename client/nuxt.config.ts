// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    devtools: {enabled: true},
    vite: {
        server: {
            hmr: {
                protocol: "ws",
                clientPort: 3000,
                path: 'hmr/'
            },
        },
    },
    modules: [
        '@nuxtjs/tailwindcss',
    ],
})
