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
  layout: 'LayoutDefault',
  data() {
    return {
      posts: null
    }
  },
  async mounted() {
   // console.log(process.env)
    if(!this.posts) {
      //this.posts = await this.$apitest.get('/posts');
      //console.log(this.posts )
    }
  //this.$apitest('rewr')

  },
  name: 'IndexPage',
  async asyncData( {$repositories} ){

    const {data : posts}  = await $repositories.ads.all()
    return { posts }

  },
  async middleware({ store, app }) {
    await store.dispatch('menus/fetchMenu', app.$apitest)
  }
}
</script>
