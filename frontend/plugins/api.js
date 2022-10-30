export default ({$axios, store, redirect, $cookies, error: nuxtError, app}, inject) => {
  // Create a custom axios instance
  const baseURL = process.browser ? process.env.baseUrl : process.env.backendUrl

  const api = $axios.create({
    baseURL: baseURL,
    withCredentials: true,
    headers: {
      common: {
        Accept: 'application/json', //accept json
      },
    },
  })

  api.onError(error => {
    nuxtError({
      statusCode: error.response.status,
      message: error.message,
    });
    return Promise.resolve(false);
  })


  api.onResponse((response) => {
    if (response.status === 404) {
      console.log('Oh no it returned a 404')
    }
  })

  // Here is the magic, onRequest is an interceptor, so every request made will go trough this, and then we try to access app.$auth inside it, it is defined
  api.onRequest((config) => {
    // Here we check if user is logged in
    if (app.$auth.loggedIn) {
      // If the user is logged in we can now get the token, we get something like `Bearer yourTokenJ9F0JFODJ` but we only need the string without the word **Bearer**, So we split the string using the space as a separator and we access the second position of the array **[1]**
      const token = app.$auth.strategy.token.get().split(' ')[1]
      api.setToken(token, 'Bearer') // Here we specify the token and now it works!!
    }
  })

  inject('apitest', api)

}
