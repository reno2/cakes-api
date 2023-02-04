<template>
<div>
  <div class="container">
    <component :is="errorPage" :error="error" />
  </div>

</div>
</template>
<script>
import error404 from '~/components/errors/404.vue';
import error403 from '~/components/errors/403.vue';
import error429 from '~/components/errors/429.vue';
import error500 from '~/components/errors/500.vue';
export default {
  name: 'nuxt-error',
  layout: 'error-layout',
  props: {
    error: {
      type: Object,
      default: null
    }
  },
  computed: {
    errorPage() {
     // console.log(this.error)

      if (this.error.statusCode === 404) {
        return error404;
      }
      if (this.error.statusCode === 429) {
        return error429;
      }
      if (this.error.statusCode === 403) {
        return error403;
      }
      // catch everything else
      return error500;
    },
  }
}
</script>
