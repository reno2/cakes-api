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
    values: {
      type: Object,
      default: {}
    }
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
          label: '',
        },
        {
          pos: 'left',
          type: 'text',
          name: 'title',
          label: 'Название',
          value: (this.values) ? this.values.title : null
        },
        {
          pos: 'right',
          type: 'file',
          name: 'file',
          value: (this.values) ? this.values.images : null,
          rules: 'ruleMaxFiles:4,ruleFileSize:500000,ruleType:jpg|png|jpeg',
          label: 'Загрузите свои изображени <br> не более 5 файлов. (jpeg, png)',
        },
        {
          pos: 'left',
          type: 'select',
          name: 'published',
          label: 'Статус',
          value: (this.values) ? this.values.published : null,
          options: [
            {value: 1, title: 'Опубликованно'},
            {value: 0, title: 'Не опубликованно'}
          ]
        },
        {
          pos: 'left',
          type: 'select',
          name: 'categories',
          label: 'Выбирете категорию',
          value:  null,
          options: []
        },
        {
          pos: 'left',
          type: 'checkbox',
          name: 'delivery',
          label: 'Возможно доставка',
          value: null
        },
        {
          pos: 'left',
          type: 'text',
          name: 'price_agreement',
          label: 'Цена по договорённости',
          value: null
        },
        {
          pos: 'left',
          type: 'text',
          name: 'price',
          label: 'Цена',
          value: (this.values) ? this.values.price : null
        },
        {
          pos: 'left',
          type: 'text',
          name: 'weight',
          label: 'Вес г.',
          value:  (this.values) ? this.values.weight : null
        },
        {
          pos: 'left',
          type: 'textarea',
          name: 'description',
          value:  (this.values) ? this.values.description : null,
          label: 'Описание',
        },
      ]
    }
  },
  methods: {
    async submitForm(data) {


      const frmData =  new FormData()
      for(const i in data){

        if(data[i] instanceof FileList){

          [...data[i]].forEach((file, inx) =>  frmData.append(`${i}[${inx}]`, file))

        }else {
          frmData.append(i, data[i])
        }
      }
      try {
        const response = await this.$repositories.profileAds.create(frmData)
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
        if (item.name === 'categories') {
          item.options = categoriesValues
        }
      })
    }

  }

}
</script>

<style scoped>

</style>
