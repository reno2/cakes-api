
export default  ({ $axios, store, redirect, error: nuxtError  }, inject) => {
  // Create a custom axios instance
  const api = $axios.create()

  api.onError(error => {
    nuxtError({
      statusCode: error.response.status,
      message: error.message,
    });
    return Promise.resolve(false);
  })

  const baseURL =  process.browser ? process.env.baseUrl : process.env.backendUrl
  api.baseURL = baseURL

  inject('apitest', api)

}
