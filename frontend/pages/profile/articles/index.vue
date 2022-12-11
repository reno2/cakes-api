<template>
  <div>
    <mediator :components="sections"/>
  </div>

</template>

<script>



import { sectionsAdapters, seoAdapters } from '@/adapters';
import Mediator from "@/components/Mediator";
import AskForm from "@/components/forms/AskForm";
export default {
  layout: 'profile',
  middleware: 'profile',
  components: {Mediator, AskForm},
  data() {
    return {
      user: null
    }
  },
  async mounted() {

  },
  name: 'ProfileAds',

  async asyncData({$repositories, route  }) {
    try {
      const response = (await  $repositories.profileAds.all()).data
      const {sections, seo} = response.data
      return {
        seo : seoAdapters.seoPage(seo),
        sections: sectionsAdapters.sections(sections, ['ads-front']),
      }
    } catch (e) {
      console.log(e)
    }
  },
  head() {
    return {
      title: this.seo.title || '2cakes',
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: this.seo.description || 'Торты'
        }
      ],
      //seoDescription: this.seo.description || this.defaultSeo.description,
      // seoImage: this.seo.image || this.defaultSeo.image,
      // keywords: this.seo.keywords || this.defaultSeo.keywords,
      // url: `${process.env.BASE_URL}${this.$route.path}`,
      // type: 'website',
      // isMain: true
    };
  }
}
</script>
