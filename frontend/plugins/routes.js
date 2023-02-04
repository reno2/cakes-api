import routesHelper from '@/repositories/Routes/'

export default ({store, redirect , app}, inject) => {
  //console.log(context)
  //const isClient = process.client ? true : false

  inject('routes', url => routesHelper(store, redirect, url)
  )
}

