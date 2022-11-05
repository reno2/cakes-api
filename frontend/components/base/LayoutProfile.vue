<template>
  <div class="page-wrapper">

    <header class="page-header">
      <slot name="page-header"/>
    </header>

    <main class="page-content">
      <div class="container">
        <div class="profile">

          <div class="profile__sidebar">
            <slot name="page-sidebar"/>
          </div>

          <div class="profile__main">
            <slot name="page-content"/>
          </div>

        </div>
      </div>
    </main>

    <footer class="page-footer">
      <slot name="page-footer"/>
    </footer>

  </div>
</template>

<script>
export default {
  name: 'LayoutProfile',
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
<style>
.profile {
  display: flex;
}
.profile__sidebar{
  flex: 1 1 20%
}
.profile__main{
  flex: 1 1 calc(80% - 24px);
  margin-left: 24px;
}
</style>
