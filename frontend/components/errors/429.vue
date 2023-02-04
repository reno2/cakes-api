<template>
  <div class="error-404">
    <h1>Слишком частый запрос</h1>
    <p>The link you clicked on may be broken or no longer exist.</p>
    <div>{{error}}</div>
  </div>
</template>
<script>
export default {
  name: 'error-429',
  props: {
    error: {
      type: Object,
      default: () => {},
    },
  },
};
</script>
