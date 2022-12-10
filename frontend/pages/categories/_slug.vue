<template>
  <div>
    {{posts}}
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
  name: 'Category',
  async asyncData( {$repositories, params} ){
    try {
      const {data: {data: posts}} = await $repositories.category.show(params.slug)
      return {posts}
    }catch (e) {
      
    }
  },
  async middleware({ store, app }) {
    await store.dispatch('menus/fetchMenu', app.$apitest)
  }
}
</script>
