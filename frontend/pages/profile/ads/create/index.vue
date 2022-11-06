<template>
  <div class="ad-create">
    <div class="ad-create__top">
        <h1>Создать объявление</h1>
    </div>
    <div class="ad-create__content">
        <CreateAdsForm />
    </div>
  </div>
</template>

<script>
import CreateAdsForm from "@/components/forms/CreateAdsForm";

export default {
  layout: 'profile',
  middleware: 'profile',
  components: {CreateAdsForm},
}
</script>

<style>
.ad-create{

}
.ad-create__content{
  max-width: 660px;

}
</style>
