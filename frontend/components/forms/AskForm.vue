<template>
  <FormBase class="ask-form" form-type="login" :Validator="Validator" :fields="fields" @submit="submitForm"  view="col">
    <template v-slot:form-header>
      <div class="block-title">
        <div class="block-title__name">Задать вопрос</div>
      </div>
    </template>
  </FormBase>
</template>

<script>
import FormBase from "./FormBase";
import Validator from '../../custom-validators/AskValidator'
export default {
  components: {FormBase},
  props: {
    hidden: {
      type: Object,
      default: []
    }
  },
  data() {
    return {
      Validator: Validator,
      login: null,
      email: null,
      fields: [
        {
          type: 'textarea',
          name: 'question',
          label: 'Ваш вопрос',
        },
      ]
    }
  },
  methods: {
    async submitForm(data) {

      try {
        const response = (await this.$repositories.comment.create(data))
        //const response = await this.$axios.post('/profile/comments', data)
          console.log(response)
      }catch (e){
        console.log(e)
      }
    }
  },
  mounted() {



    if (!this.hidden) return

    for (const [name, value] of Object.entries(this.hidden)) {
      this.fields.push({name: name, type: 'hidden', label: '', value: value})
    }

    // this.hidden.forEach(f => {
    //   this.fields.push({name: f, type: 'hidden', label: 'l', })
    // })
  }

}
</script>

<style scoped>

</style>
