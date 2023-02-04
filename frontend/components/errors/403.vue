<template>
  <div class="error-403">
    <h1>Доступ к странце закрыт</h1>
    <p>Авторизуйтесь или проверьте свои права</p>
    <div>{{error}}</div>
  </div>
</template>
<script>
export default {
  name: 'error-403',
  props: {
    error: {
      type: Object,
      default: () => {},
    },
  },
};
</script>
