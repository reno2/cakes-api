<template>
  <div class="container">
    <p>Требуется подтверждение по почте</p>
    <p>Для продолжения, перейтиде по ссылке которая отправлена на Вашу почту.</p>

    <button class="btn btn-main btn-middle-round" @click="sendConfirm">Отправить повторно</button>
  </div>

</template>
<script>

import ErrorHandler from "../../../helpers/ErrorHandler";

export default {
  middleware: 'auth',
  layout: 'LayoutDefault',
  methods: {
    async sendConfirm(){
      try {
        const confirm = await this.$apitest.post('/email/resend')
        this.$modalBus.$emit('open.html', {html: 'Код подтверждения отправлен на почту', title: 'Успех!'})
      }catch (e) {
        const errorResponse = this.$errorHandler.setAndParse(e)
        this.$modalBus.$emit('open.html', {html: `${errorResponse.message}`, title: 'Ошибка'})
      }

    }
  },
  async asyncData({$apitest, $routes, error, redirect, $modalBus, $errorHandler}, ) {
    try {
      const res = await $apitest.post('/email/verify');
    } catch (e) {

      const errorResponse = $errorHandler.setAndParse(e)

      if (e.response.status === 301) {
        redirect('/profile/')
      }

      if (e.response.status === 429) {
        error({
          statusCode: errorResponse.status,
          message: errorResponse.message
        })
      }
      if (e.response.status === 401) {

      }

    }

  }
}
</script>
