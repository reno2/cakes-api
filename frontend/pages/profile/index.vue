<template>
  <div>
    admin
  </div>

</template>

<script>
export default {
  layout: 'profile',
  middleware: 'profile',
  data() {
    return {
      user: null
    }
  },
  async mounted() {

  },
  name: 'Profile',
  // async asyncData({$axios}) {
  //
  //
  //   const posts = await $axios.$get('/posts');
  //   console.log(posts)
  //   return { posts }
  //
  // }
}
</script>
