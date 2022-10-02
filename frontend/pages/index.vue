<template>
  <div>
    <mediator :components="sections"/>
  </div>

</template>

<script>
import sectionsAdapters from '../adapters/sections'
import Mediator from "../components/Mediator";

export default {
  components: {Mediator},
  layout: 'LayoutDefault',
  data() {
    return {
      sectionsOrder: ['banner', 'list_ads']
    }
  },
  name: 'IndexPage',
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
