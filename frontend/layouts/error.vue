<template>
<div>
  <div class="container">
    <component :is="errorPage" :error="error" />
  </div>

</div>
</template>
<script>
import error404 from '~/components/errors/404.vue';
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
      if (this.error.statusCode === 404) {
        return error404;
      }
      // catch everything else
      return error500;
    },
  }
}
</script>
