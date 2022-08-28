<template>
  <div>
    auth
    {{$auth.loggedIn}}
    <button @click.prevent="check">check</button>
  </div>
</template>
<script>
export default {
  mounted() {
    //console.log(this.$auth)
  },
  methods: {

    async check() {
      try {
        const data = await this.$axios.$get('/check', {
          headers: {
              "Accept": "application/json",
              'Authorization': 'Bearer 138|bevT92qPsPZJR56R7N9Ez7fZcQNw4dzk4o5LKeE3'

          },
        })
        console.log(data)
      } catch (e) {
        console.log(e.message)
      }

    }
  }
}
</script>
