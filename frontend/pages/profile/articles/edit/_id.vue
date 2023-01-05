<template>
  <div class="ad-create">
    <div class="ad-create__top">
        <h1>Изменить объявление</h1>
    </div>
    <div class="ad-create__content">
        <CreateAdsForm :values="values"/>
    </div>
  </div>
</template>

<script>
import CreateAdsForm from "@/components/forms/CreateAdsForm";
import ProfileAdsRepository from "../../../../repositories/ProfileAdsRepository";

export default {
  layout: 'profile',
  middleware: 'profile',
  components: {CreateAdsForm},
  data(){
    return {
      values: null
    }
  },
  async asyncData( { params, $axios, route} ){
    try {


      const rep = new ProfileAdsRepository($axios, route)
      const {data : {data: values}}  = await rep.show(params.id)

     return {values}
    }catch (e) {
      console.log('errro', e)
    }
  }
}
</script>

<style>
.ad-create{

}
.ad-create__content{
  /*max-width: 660px;*/

}
</style>
