
export default  ({ $axios, store }, inject) => {
  // Create a custom axios instance
  const api = $axios.create()
  const baseURL =  process.browser ? process.env.baseUrl : process.env.backendUrl
  api.baseURL = baseURL

  inject('apitest', api)

}
