<template>
  <div>
    <button @click="click3">Html 3</button>
  </div>
</template>

<script>
import ModalBus from "@/helpers/ModalBus";
import AskForm from "@/components/forms/AskForm";
export default {
  layout: 'LayoutDefault',
  components: {
    AskForm
  },
  methods:{

    click3(){
     // ModalBus.$emit('html', {html: '<h2></h2>', title: 'Задать вопрос\n'});
      ModalBus.$emit('open', {component: AskForm});
      //this.$modals.$emit('new');
    }
  }
}
</script>

<style scoped>

</style>
