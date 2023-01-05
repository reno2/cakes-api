export default class Repository {

  resource = null
  url = null

  constructor(axios, route) {
    this.axios = axios
    this.route = ''

    if(route) {
      this.route = '?' + new URLSearchParams(route.query).toString()
    }

  }

  getUrl(){
    return  this.url = this.resource + this.route
  }

  all(params = {}) {
    return this.axios.get(`${this.url}`, {params})
  }

  show(id) {

    return this.axios.get(`${this.resource}/${id}`)
  }

  create(payload) {
    try {
      return this.axios.post(`${this.resource}`, payload)
    }catch (e){
      console.log(e)
    }

  }

  update(id, payload) {
    return this.axios.post(`${resource}/edit/${id}`, payload)
  }

  delete(id) {
    return this.axios.delete(`${resource}/${id}`)
  }
}


