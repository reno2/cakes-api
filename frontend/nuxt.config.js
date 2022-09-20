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
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      {
        rel: 'stylesheet',
        href:
          'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;900&display=swap'
      },
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    '@/assets/css/main.css',
    '@/assets/css/buttons',
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    {
      src: '~/plugins/api.js',
      ssr: true
    },
    {
      src: '~/plugins/repositories.js',
      ssr: true
    }
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    '@nuxtjs/svg-sprite',
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
    'nuxt-ssr-cache',
  ],
  cache: {
    cache: true,
   // useHostPrefix: false,
   // pages: [],

  },
  store: {
    type: 'memory',

    // maximum number of pages to store in memory
    // if limit is reached, least recently used page
    // is removed.
    max: 100,

    // number of seconds to store this page in cache
    ttl: 60,
  },
  svgSprite: {
    input: '~/assets/svg/'
  },
  auth: {
    strategies: {
      // laravelSanctum: {
      //   provider: 'laravel/sanctum',
      //   //url: process.env.BACKEND_PUBLIC_URL,
      //   url: process.env.BACKEND_PUBLIC_URL + process.env.REST_API_PATH,
      //   endpoints: {
      //     login: { url: '/login', method: 'post' },
      //     logout: { url: '/logout', method: 'post' },
      //     user: { url: '/user', method: 'get' }
      //   },
      //   user:{
      //     property:false
      //   }
      // },
      local: {
        token:{
          property: 'access_token',
          global: true,
          type: 'bearer'
        },
        user: {
            property: false // Данные не оборачиваются в обёртку
        },
        url: process.env.BACKEND_PUBLIC_URL + process.env.REST_API_PATH,
        endpoints: {
          login: { url: '/login', method: 'post' },
          logout: { url: '/logout', method: 'post' },
          user: { url: '/user', method: 'get' }
        }
      }
    },
    redirect:{
      login: '/login',
      logout: '/login',
      home: '/' // Редирект после успешной авторизации
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
  env: {
    baseUrl:  process.env.BACKEND_PUBLIC_URL + process.env.REST_API_PATH,
    backendUrl: process.env.BACKEND_PRIVATE_URL + process.env.REST_API_PATH
  }
}
