<template>
  <div>
    <div
      v-for="component in parsedComponents"
      :key="component.type"
      class="mediator-wrapper"
    >
      <div class="component-title">
        {{ component.type }} : {{ component.name }}
      </div>

      <component :is="component.compFunc" v-bind="component"/>
    </div>
  </div>
</template>

<script>
const loadComponent = function (component) {
  return async () =>
    await import(/* webpackChunkName: "components" */ `@/views/${component}`);
};
const COMPONENTS = [
  {name: 'SectionFrontAds', type: 'ads-front'},
  {name: 'SectionProfileAds', type: 'profile-ads-list'},
  {name: 'SectionBanner', type: 'banner'},
];

export default {
  props: {
    components: {
      type: Array,
      default: () => []
    },
  },
  computed: {
    parsedComponents() {

      return this.components ? this.components.reduce((components, component, index, array) => {

          // Получаем названиекомпонента
          const {type} = component || {};
          // Мэпим нахвание для динамической загрузки компонента
          const {name: componentName} =
          COMPONENTS.find((comp) => {
            return comp.type === type;
          }) || [];

          // Собераем компонент
          const componentMapped = {
            ...component,
            name: componentName,
            compFunc: loadComponent(componentName)
          };

          return [...components, componentMapped]

        }, [])

        : []
    }
  }
}
</script>

<style>

</style>
