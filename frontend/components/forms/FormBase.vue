<template xmlns="http://www.w3.org/1999/html">
  <form action="" @submit.prevent="mainHandler">
    <div  v-for="(field, index) in parsedComponents">
      <component :is="field.compFunc"
                 v-bind="field"
                 @input-change="changeValue(field.name, $event)"
                 @input="changeValue(field.name, $event)"
      />
    </div>
    <input type="text" value="tesr">
      <slot></slot>
    <button >Отправить</button>
  </form>

</template>

<script>
const loadComponent = function (component) {
  return async () =>
    await import(/* webpackChunkName: "components" */ `@/components/forms/${component}`);
};
const COMPONENTS = [
  {name: 'InputBase', type: 'text'},
];
export default {
  props:{
      fields: [],
      Validator: Function
  },
  data(){
    return {
      ValidateClass: Function,
      formData: {},
      tiker: "default",
    }
  },
  methods:{
    mainHandler(){
      //console.log(this.$children)
        this.$emit('submit', this.fields)
        this.validateForm()
    },
    validateForm(){
      if(!this.$children) return



      сonst newItem = { name: this.tiker };

      console.log(this.ValidateClass.rules)


      const isErrors = this.$children.forEach(child => {
       // console.log(child)
        //if(child.validate === undefined) return false;
      //  let res = child.doValidate()

       // return res

      })
      console.log('errors: ', isErrors)
    },
    changeValue(name, event){

      this.$set(this.formData, name, event)
     //this.formData.name = event
    }

  },
  computed:{
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

<style scoped>

</style>
