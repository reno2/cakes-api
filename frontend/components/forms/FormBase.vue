<template>
  <div class="form-base">

    <slot name="form-left"/>

    <div class="form-base__content">
      <div class="form-base__header">
        <slot name="form-header"/>
      </div>
      <form class="form-base__form" :class="view" action="" @submit.prevent.self="mainHandler">

        <template v-if="view === 'col'">

          <template v-for="(field, index) in parsedComponents.center">
            <component :is="field.compFunc"
                       v-bind="field"
                       @input-change="changeValue(field.name, $event)"
                       @input="changeValue(field.name, $event)"
            />
          </template>

        </template>

        <template v-else>
          <div class="form-base__cols" :class="view">
            <div class="form-base__left">
              <template v-for="(field, index) in parsedComponents.left">
                <component :is="field.compFunc"
                           v-bind="field"
                           @input-change="changeValue(field.name, $event)"
                           @input="changeValue(field.name, $event)"
                />

              </template>
            </div>
            <div class="form-base__right">
              <template v-for="(field, index) in parsedComponents.right">
                <component :is="field.compFunc"
                           v-bind="field"
                           @input-change="changeValue(field.name, $event)"
                           @input="changeValue(field.name, $event)"
                />
              </template>
            </div>
          </div>
        </template>

        <slot></slot>
        <button class="btn-big btn-main">{{ actionValue }}</button>
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
  {name: 'FileBase', type: 'file'},
];
export default {
  props: {
    view: null,
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
      if (this.validateForm()) {
        this.$emit('submit', this.formData)
      }
    },
    validateForm() {

      if (!this.$children) return

      // Инициализируем начальное состояние
      let isErrors = true

      // Сохраняем для использования в дочернем компоненте как переменную
      const ValidateClass = this.ValidateClass

      this.$children.forEach(child => {
         const validateRules =  ValidateClass.rules[child._props.name] ?? false
         if(!validateRules) return

        const validateParams = {
          model: child.model,
          validateClass: ValidateClass,
          validateInputName: child._props.name,
          rules: validateRules
        }

         isErrors = ValidateClass.validateAdapter(child, validateParams)

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

          // Получаем название компонента
          const {type, pos = 'center'} = component || {};


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

          if (!components[pos]) {
            components[pos] = []
          }

          components[pos].push(componentMapped)

          return {...components, componentMapped}

        }, {})

        : []

    }
  },
  mounted() {
    this.ValidateClass = new this.Validator()
  }
}
</script>

<style>
.form-base.min_width {
  min-width: 450px;
}

.form-base__form {
  width: 100%;
}

.form-base__cols {
  display: flex;
}

.form-base__cols.third .form-base__left {
  width: calc(70% - 8px);
  margin-right: 16px;
}

.form-base__cols.third .form-base__right {
  width: calc(30% - 8px);
}


</style>
