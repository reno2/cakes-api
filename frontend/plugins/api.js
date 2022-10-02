export default ({$axios, store, redirect, error: nuxtError, app}, inject) => {
  // Create a custom axios instance
  const api = $axios.create()

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

  const baseURL = process.browser ? process.env.baseUrl : process.env.backendUrl
  api.baseURL = baseURL

  inject('apitest', api)

}
