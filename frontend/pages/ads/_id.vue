<template>
  <div>
    {{post}}

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
    if(!this.posts) {
      //this.posts = await this.$apitest.get('/posts');
      //console.log(this.posts )
    }
  },
  name: 'Post',
  async asyncData( {$repositories, params} ){

    const { data : {data : post}}= await $repositories.ads.show(params.id)
    return { post }

  },
  async middleware({ store, app }) {
    await store.dispatch('menus/fetchMenu', app.$apitest)
  }
}
</script>
