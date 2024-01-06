import path from 'path';

export default defineNuxtConfig({
    target: 'static',
    ssr: false,
    devtools: { enabled: true },
    title: 'Multishop',
    alias: {
        "@": __dirname + "/resources/app"
    },

    css: [
        '~/assets/css/animate.min.css',
        '~/assets/css/owl/owl.carousel.min.css',
        '~/assets/css/style.min.css'
    ],

    app: {
        // baseURL: process.env.APP_URL,
        head: {
            script: [
                {src: 'https://code.jquery.com/jquery-3.4.1.min.js'},
                {src: 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js'},
                {src: '~/assets/js/easing.min.js'},
                {src: '~/assets/js/owl.carousel.min.js'},
                {src: '~/assets/js/main.js'},
            ],
            link: [
                {rel: 'icon', href: "img/favicon.ico"},
                {rel: 'preconnect', href: "https://fonts.gstatic.com"},
                {rel: 'stylesheet', href: "https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"},
                {rel: 'stylesheet', href: "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"}
            ]
        }
    },
    runtimeConfig: {
        public: {
            baseApiURL: 'http://multishop.loc/api/',
            baseURL: 'http://multishop.loc'
        },
    },
    imports: {
        dirs: [
            'composables/**', // scan all modules,
            'services/**'
        ]
    },
    buildDir: __dirname + "/../../public/themes/default/.nuxt",
    srcDir: "./resources/app",
    nitro: {
        output: {
            publicDir: path.join(__dirname, './../../public/themes/default/.output')
        }
    },
    // ------ modules -----------
    modules: [
        '@pinia/nuxt'
    ],
})
