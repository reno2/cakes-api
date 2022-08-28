export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'frontend',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    // {
    //   src: '~/plugins/api.js',
    //   ssr: true
    // }
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/auth-next'
  ],

  auth: {
    strategies: {
      laravelSanctum: {
        provider: 'laravel/sanctum',
        //url: process.env.BACKEND_PUBLIC_URL,
        url: process.env.BACKEND_PUBLIC_URL + process.env.REST_API_PATH,
        endpoints: {
          login: { url: '/login', method: 'post' },
          logout: { url: '/logout', method: 'post' },
          user: { url: '/user', method: 'get' }
        },
        user:{
          property:false
        }
      }
    }
  },

  axios:{
     baseURL: process.env.BACKEND_PRIVATE_URL + process.env.REST_API_PATH,
     browserBaseURL: process.env.BACKEND_PUBLIC_URL + process.env.REST_API_PATH,
     credentials: true,
     proxy: true
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  },

  server: {
    host: process.env.NUXT_HOST,
    port: process.env.NUXT_PORT,
  },
}