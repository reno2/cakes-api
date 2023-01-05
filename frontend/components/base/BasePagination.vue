<template>
  <div class="base-pagination">
    <ul class="base-pagination__ul" v-if="showPagination">

      <li class="base-pagination__arrows" :class="{'disable': showPrev}">
        <button class="base-pagination__prev" type="button" @click.stop="changePage(currentPage - 1)">
          <svg-icon class="base-pagination__svg" name="icon-more"/>
        </button>
      </li>

      <li class="base-pagination__li" v-for="item in paginationArray"
          :class="{'current': item.page === currentPage}">
        <button type="button" @click.stop="changePage(item.page)">{{ item.symbol }}</button>
      </li>

      <li class="base-pagination__arrows" :class="{'disable': showNext}">
        <button class="base-pagination__next" type="button" @click.stop="changePage(currentPage + 1)">
          <svg-icon class="base-pagination__svg" name="icon-more"/>
        </button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    paginationObj: Object
  },
  data(){
    return {
      currentPage: 1,
      totalPages: null,
      paginationArray: [],
      paginateId: 'page',
      hasPaginate: false
    }
  },
  computed:{
    showPagination(){
      let isShow = false
      if(this.hasPaginate){
        isShow = true
      }
      return isShow
    },
    showPrev(){
      return (this.currentPage === 1)
    },
    showNext(){
      return (this.currentPage === this.totalPages)
    }
  },
  methods: {
    changePage(page){
      if(page === this.currentPage || page < 1 || page > this.totalPages) return
      this.$emit('paginate', page, 'ads', this.paginationObj.path)
    },
    buildDots(start, end){
      const res = [];
      for (let i = start; i < end; i++) {
        res.push({
          page: i,
          symbol: i
        });
      }
      return res;
    },
    buildPagination(){

      ({current_page: this.currentPage, last_page: this.totalPages, page_id: this.paginateId } = this.paginationObj)
      this.hasPaginate = true

      if(this.totalPages < 9){
        this.paginationArray = this.buildDots(1, this.totalPages  + 1)
        return
      }

      let firstDots = [];
      let curDots = [];
      let lastDots = [];

      const currentLast = this.currentPage === this.totalPages ? this.totalPages + 1 : this.currentPage + 2;
      const lastFirst = this.totalPages === this.currentPage ? this.currentPage - 2 : this.currentPage - 1;

      if (this.currentPage === 1) {
        firstDots = this.buildDots(1, 4);
      } else if (this.currentPage < 6) {
        firstDots = this.buildDots(1, currentLast);
      } else {
        firstDots.push({
          page: 1,
          symbol: 1
        });
        firstDots.push({
          page: Math.ceil((this.currentPage - 1) / 2),
          symbol: "..."
        });

        curDots = this.buildDots(lastFirst, currentLast);
      }

      // Строим пагинацию после середины
      if (this.totalPages - this.currentPage < 5) {
        lastDots = this.buildDots(this.currentPage + 2, this.totalPages + 1);
      } else {
        lastDots.push({
          page: Math.ceil((this.totalPages - this.currentPage) / 2) + this.currentPage,
          symbol: "..."
        });
        lastDots.push({
          page: this.totalPages,
          symbol: this.totalPages
        });
      }

      // Кладём в дату
      this.paginationArray = [...firstDots, ...curDots, ...lastDots]

    }
  },
  watch: {
    paginationObj: function (newValue, oldValue) {
      this.paginationObj = newValue
      this.buildPagination()
    },
  },
  mounted() {
    if(!this.paginationObj){
      return
    }

    this.buildPagination()
  }
}
</script>

<style>
.base-pagination__ul {
  display: flex;
}
.base-pagination__li{
  display: flex;
  align-items: center;
  justify-content: center;
}
.base-pagination__arrows:not(:last-child),
.base-pagination__li:not(:last-child){
  margin-right:  8px;
}

.base-pagination__arrows button,
.base-pagination__li button{
  border-style: solid;
  border-radius: 8px;
  border-width: 1px;
  width: 32px;
  height: 32px;

  font-weight: 900;
  cursor: pointer;

  display: inherit;
  align-items: inherit;
  justify-content: inherit;
}

.base-pagination__arrows button{
  fill: #fff;
  border-color: transparent;
  display: flex;
  align-items: center;
  justify-content: center;
}

.base-pagination__li button {
  background: #d3a1df;
  border-color: #d3a1df;
  color: #fff;
}


/* region States */
.base-pagination__li.current button{
  background: #CB7DD4;
  border-color: #CB7DD4;
}
.base-pagination__li button:hover{
  background: #D9B1E3;
  border-color: #D9B1E3;
}
.base-pagination__arrows.disable button{
  cursor: default;
}
.base-pagination__arrows:not(.disable) button{
  background: #E9CCF5;
}
.base-pagination__arrows:not(.disable) button:hover{
  background: #D9B1E3;
}
/* endregion States */


.base-pagination__svg{
  width: 22px;
  height: 22px;
  fill: #fff;
}
.base-pagination__prev .base-pagination__svg{
  transform: rotate(90deg);
}
.base-pagination__next .base-pagination__svg{
  transform: rotate(-90deg);
}
</style>
