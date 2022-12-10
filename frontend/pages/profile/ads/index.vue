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
  name: 'ProfileAds',

  async asyncData({$repositories}) {
    try {
      const posts = (await $repositories.profileAds.all()).data
      console.log(posts)
      //return {posts}

    } catch (e) {
      console.log(e)
    }
  }
}
</script>
