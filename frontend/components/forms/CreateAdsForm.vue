<template>
  <FormBase class="ask-form" form-type="login" :Validator="Validator" :fields="fields" @submit="submitForm">
    <template v-slot:form-header>
      <div class="block-title">

      </div>
    </template>
  </FormBase>
</template>

<script>
import FormBase from "./FormBase";
import Validator from '../../custom-validators/CreateAdsValidator'
import {mapGetters} from "vuex";

export default {
  components: {FormBase},
  props: {},
  data() {
    return {
      Validator: Validator,
      login: null,
      email: null,
      fields: [
        {
          type: 'text',
          name: 'title',
          label: 'Название',
          value: null
        },
        {
          type: 'select',
          name: 'state',
          label: 'Статус',
          value: null,
          options: [
            {value: 0, title: 'Опубликованно'},
            {value: 1, title: 'Не опубликованно'}
          ]
        },
        {
          type: 'select',
          name: 'category',
          label: 'Выбирете категорию',
          value: null,
          options: []
        },
        {
          type: 'checkbox',
          name: 'delivery',
          label: 'Возможно доставка',
          value: null
        },
        {
          type: 'text',
          name: 'price_agreement',
          label: 'Цена по договорённости',
          value: null
        },
        {
          type: 'text',
          name: 'price',
          label: 'Цена',
          value: null
        },
        {
          type: 'text',
          name: 'weight',
          label: 'Вес г.',
          value: null
        },
        {
          type: 'textarea',
          name: 'detail_text',
          label: 'Описание',
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
      } catch (e) {
        console.log(e)
      }
    }
  },

  mounted() {
    const categories = this.$store.getters['menus/getMenusAll']
    if (categories.length) {


      let categoriesValues = []
      categories.forEach(cat => {
        const {id: value, title} = cat
        categoriesValues.push({value, title})
      })

      this.fields.forEach(item => {
        if (item.name === 'category') {
          item.options = categoriesValues
        }
      })
    }

    if (!this.hidden) return

    for (const [name, value] of Object.entries(this.hidden)) {
      this.fields.push({name: name, type: 'hidden', label: '', value: value})
    }

  }

}
</script>

<style scoped>

</style>
