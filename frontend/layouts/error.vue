<template>
<div>
  <div class="container">
    This is error
    <h2>{{error.statusCode}}</h2>
  </div>

</div>
</template>
<script>
export default {
  layout: 'error-layout',
  props: {
    error: {
      type: Object,
      default: null
    }
  }
}
</script>
