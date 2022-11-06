<template>
  <div class="form-base">

    <slot name="form-left"/>

    <div class="form-base__content">
      <div class="form-base__header">
        <slot name="form-header"/>
      </div>
      <form class="form-base__form" action="" @submit.prevent="mainHandler">
        <template v-for="(field, index) in parsedComponents">
          <component :is="field.compFunc"
                     v-bind="field"
                     @input-change="changeValue(field.name, $event)"
                     @input="changeValue(field.name, $event)"
          />
        </template>
        <slot></slot>
        <button class="btn-big btn-main">{{actionValue}}</button>
      </form>
    </div>

  </div>

</template>

<script>
const loadComponent = function (component) {
  return async () =>
    await import(/* webpackChunkName: "components" */ `@/components/forms/${component}`);
};
const COMPONENTS = [
  {name: 'InputBase', type: 'text'},
  {name: 'SelectBase', type: 'select'},
  {name: 'HiddenBase', type: 'hidden'},
  {name: 'TextareaBase', type: 'textarea'},
  {name: 'CheckboxBase', type: 'checkbox'},
];
export default {
  props: {
    formType: null,
    fields: [],
    Validator: Function,
    actionValue: {
      default: 'Отправить',
      type: String
    }
  },
  data() {
    return {
      ValidateClass: Function,
      formData: {},
    }
  },
  methods: {
    mainHandler() {
      //this.$emit('submit', this.formData)
      if (this.validateForm()) {
        this.$emit('submit', this.formData)
      }
    },
    validateForm() {
      if (!this.$children) return

      let isErrors = true

      this.$children.forEach(child => {
        child.errors = []

        const inputName = child._props.name

        if(!this.ValidateClass.rules[inputName]) return

        const rules = (this.ValidateClass.rules[inputName]).split(',')

        rules.forEach(rule => {

          if (!this.ValidateClass[rule](child.model)) {
            if (isErrors) isErrors = !isErrors

            child.errors.push(this.ValidateClass.messages[rule])
          }
        })
      })

      return isErrors
    },
    changeValue(name, event) {

      this.$set(this.formData, name, event)
      //this.formData.name = event
    }

  },
  computed: {
    parsedComponents() {

      return this.fields ? this.fields.reduce((components, component, index, array) => {

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
            componentName: componentName,
            compFunc: loadComponent(componentName)
          };
          return [...components, componentMapped]

        }, [])

        : []
    }
  },
  mounted() {
    this.ValidateClass = new this.Validator()
  }
}
</script>

<style>
.form-base.min_width{
  min-width: 450px;
}

.form-base__form {
  width: 100%;
}
</style>
