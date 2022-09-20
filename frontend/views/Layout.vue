<template>
  <div class="page-wrapper">

    <header class="page-header">
      <slot name="page-header"/>
    </header>

    <main class="page-content">
        <slot name="page-content"/>
    </main>

    <footer class="page-footer">
      <slot name="page-footer"/>
    </footer>

  </div>
</template>

<script>
export default {
  name: 'Layout',
  data() {
    return {
      isRouteChanged: false
    };
  },
  watch: {
    $route: {
      immediate: true,
      handler(route) {
        switch (route.name) {
          case 'archive':
            break;
          case 'archive-slug':
            break;
          default:
            break;
        }
        this.isRouteChanged = true;
      }
    }
  },
}
</script>
