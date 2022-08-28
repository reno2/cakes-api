<template>
  <div>
    <div v-if="posts">
      <div v-for="post in posts.data" :key="post.id">
        <span>{{post.title}}</span>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      posts: null
    }
  },
  async mounted() {
   // console.log(process.env)
    if(!this.posts) {
      this.posts = await this.$axios.$get('/posts');
    }
  console.log(this.posts)

  },
  name: 'IndexPage',
  async asyncData({$axios}) {


   const posts = await $axios.$get('/posts');
    console.log(posts)
  return { posts }

  }
}
</script>
