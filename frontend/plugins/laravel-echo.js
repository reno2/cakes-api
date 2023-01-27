import Echo from 'laravel-echo'

window.io = require('socket.io-client')

export default ({app}, inject) => {

  const echo = () => {

     return app.$auth

  }

 //  const baseURL = process.browser ? process.env.baseUrl : process.env.backendUrl
 //
 // let echo = null
 //
 //  if ($auth.loggedIn) {
 //    const bearer = 'Bearer ' + app.$auth.strategy.token.get().split(' ')[1]
 //    echo = new Echo({
 //      broadcaster: 'socket.io',
 //      host: window.location.hostname+':6001',
 //      auth: {
 //        headers: {
 //          Authorization: bearer
 //        }
 //      }
 //    })
 //    console.log(io)
 //  }

  inject('echo', {
    test: () =>{

      if(!app.$auth.loggedIn) {
        return 'not auth'
      }
      window.io = require('socket.io-client')

      const host = window.location.hostname+':6001'
      const bearer = 'Bearer ' + app.$auth.strategy.token.get().split(' ')[1]

      const ech = new Echo({
             broadcaster: 'socket.io',
             host: host,
             auth: {
               headers: {
                 Authorization: bearer
               }
             }
           })
      return ech
    }

  })
}

