<template>
  <div class="section section__collections">
    <div class="container">
      <div class="ads">
        <template v-for="cart in listLocal">
          <DetailAds :card="cart" view="profile"/>
        </template>
      </div>
    </div>
    <BasePagination v-if="listLocal.length" :paginationObj="dynamicMeta" @paginate="paginate"/>

  </div>
</template>

<script>

import DetailAds from "./DetailAds";
import BasePagination from "../components/base/BasePagination";

export default {
  components: {
    DetailAds, BasePagination
  },
  data () {
    return {
      currentPage: 1,
      compData: [],
      compMeta: {}
    };
  },
  props: {
    links: {
      type: Object,
      default: null
    },
    meta: {},
    data: Array
  },
  inheritAttrs: false,
  computed: {
    listLocal() {
       return this.compData
    },
    dynamicMeta(){
      return  this.compMeta
    }
  },
  methods: {
    cutPath(filepath){
      return filepath.replace(process.env.baseUrl, '')
    },
    onPageChange(page) {
      this.currentPage = page;
    },

    async paginate(page, pageId, url){

      const section = await this.fetch(url + '?' + pageId + '='+ page )
      const { data = null, meta = null} = section
      if(!data || !meta){
        return
      }
      await this.$router.push({path: this.$route.path, query: {[pageId]: page}})

      this.compMeta = meta
      this.compData = data

    },
    async fetch(url) {
      try {
        const {sections} = (await this.$axios.$get(url, {params :{
          'perPage': 3
        }})).data
        return sections[0]

      }catch (e) {
        console.log(e)
      }

    },
  },
  mounted() {

    this.compData = this.data
    this.compMeta =  this.meta

  }
}
</script>

<style scoped>
.ads {
  display: flex;
  flex-wrap: wrap;
}
</style>
