<template>
  <FormBase class="ask-form" form-type="login" :Validator="Validator" :fields="fields" @submit="submitForm" view="third">
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
  props: {
  },
  data() {
    return {
      Validator: Validator,
      login: null,
      email: null,
      fields: [
        {
          type: 'hidden',
          name: 'user_id',
          value: this.$auth.user.id,
          pos: 'left',
        },
        {
          pos: 'left',
          type: 'text',
          name: 'title',
          label: 'Название',
          value: null
        },
        // {
        //   pos: 'right',
        //   type: 'file',
        //   name: 'file',
        //   rules: 'ruleMaxFiles:4,ruleFileSize:500000,ruleType:jpg|png|jpeg',
        //   label: 'Загрузите свои изображени <br> не более 5 файлов. (jpeg, png)',
        // },
        // {
        //   pos: 'left',
        //   type: 'select',
        //   name: 'state',
        //   label: 'Статус',
        //   value: null,
        //   options: [
        //     {value: 0, title: 'Опубликованно'},
        //     {value: 1, title: 'Не опубликованно'}
        //   ]
        // },
        // {
        //   pos: 'left',
        //   type: 'select',
        //   name: 'category',
        //   label: 'Выбирете категорию',
        //   value: null,
        //   options: []
        // },
        // {
        //   pos: 'left',
        //   type: 'checkbox',
        //   name: 'delivery',
        //   label: 'Возможно доставка',
        //   value: null
        // },
        // {
        //   pos: 'left',
        //   type: 'text',
        //   name: 'price_agreement',
        //   label: 'Цена по договорённости',
        //   value: null
        // },
        // {
        //   pos: 'left',
        //   type: 'text',
        //   name: 'price',
        //   label: 'Цена',
        //   value: null
        // },
        // {
        //   pos: 'left',
        //   type: 'text',
        //   name: 'weight',
        //   label: 'Вес г.',
        //   value: null
        // },
        {
          pos: 'left',
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
       // const response = (await this.$repositories.comment.create(data))
        const response = await this.$repositories.profileAds.create(data)
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

  }

}
</script>

<style scoped>

</style>
