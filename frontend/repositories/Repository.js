export default class Repository {

  resource = null

  constructor(axios) {
    this.axios = axios
  }

  all() {
    return this.axios.get(`${this.resource}`)
  }

  show(id) {

    return this.axios.get(`${this.resource}/${id}`)
  }

  create(payload) {
    try {
      this.axios.post(`${this.resource}`, payload)
    }catch (e){
      console.log(e)
    }

  }

  update(id, payload) {
    return this.axios.post(`${resource}/${id}`, payload)
  }

  delete(id) {
    return this.axios.delete(`${resource}/${id}`)
  }
}


