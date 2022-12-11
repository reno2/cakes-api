<template>
  <div>
    <mediator :components="sections"/>
  </div>

</template>

<script>
import sectionsAdapters from '../adapters/sections'
import Mediator from "../components/Mediator";
import AskForm from "@/components/forms/AskForm";
export default {
  components: {Mediator, AskForm},
  layout: 'LayoutDefault',
  data() {
    return {
      sectionsOrder: ['banner', 'list_ads']
    }
  },

  name: 'IndexPage',
  methods:{
  },
  async asyncData({$repositories}) {
    try {
      const response = (await $repositories.ads.all()).data
      const {sections, seo} = response

      return {
        seo,
        sections: sectionsAdapters.sections(sections, ['banner', 'ads-front']),
      }
    } catch (e) {
      console.log('index ')
    }
  },

}
</script>
