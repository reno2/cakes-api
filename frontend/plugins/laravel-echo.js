import Echo from 'laravel-echo'

window.io = require('socket.io-client')

export default ({app}, inject) => {

  inject('echo', {
    test: () => {

      if (!app.$auth.loggedIn) {
        return 'not auth'
      }
      window.io = require('socket.io-client')

      const host = window.location.hostname + ':6001'
      const bearer = 'Bearer ' + app.$auth.strategy.token.get().split(' ')[1]

      return new Echo({
        broadcaster: 'socket.io',
        host: host,
        auth: {
          headers: {
            Authorization: bearer
          }
        }
      })
    }

  })
}

