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
    return this.axios.post(`${resource}`, payload)
  }

  update(id, payload) {
    return this.axios.post(`${resource}/${id}`, payload)
  }

  delete(id) {
    return this.axios.delete(`${resource}/${id}`)
  }
}


