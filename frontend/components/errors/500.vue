<template>
  <div class="error-404">
    <h1>500 ошибка</h1>
    <p>The link you clicked on may be broken or no longer exist.</p>
  </div>
</template>
<script>
export default {
  name: 'error-404',
  props: {
    error: {
      type: Object,
      default: () => {},
    },
  },
};
</script>
