<template>
  <div class="ad">
    <nuxt-link :to="path('ads', card.id)" class="ad__head">
      <div class="ad__mobile">
        <img class="ad__img" :src="showPicture(card.images)">
      </div>
      <div class="ad__desktop js_ad__desktop">
        <img class="ad__img" :src="showPicture(card.images)">
      </div>

      <div v-if="card.tags" class="ad__tags">
        <div class="ad__tag">
          <a class="ad__link" href=""></a>
        </div>
      </div>
    </nuxt-link>

    <div class="ad__body">
      <div class="ad__info">
        <div class="ad__categories">
          <nuxt-link class="ad__category" :to="path('category', card.category.slug)">{{
              card.category.title
            }}
          </nuxt-link>
        </div>

        <h5 class="ad__title">
          <nuxt-link :to="path('ads', card.id)">{{ card.title }}</nuxt-link>
        </h5>

        <span class="ad__actions" v-if="isAuthenticated && canAsk && view !== 'profile'">
          <button class="btn btn-small btn-grey" @click.prevent="openModal">Задать вопрос</button>
        </span>
        <div class="ad__actions">
          <nuxt-link :to="getPath(card.id)" class="ad__actions-edit" v-if="userPost">
            редактировать
          </nuxt-link>
        </div>
      </div>
    </div>

  </div>
</template>

<script>

import {makePath} from '@/helpers/functions';
import {mapGetters} from 'vuex'
import AskForm from "@/components/forms/AskForm";

export default {
  props: {
    card: Object,
    view: {
      type: String,
      default: null
    }
  },
  components: {AskForm},
  methods: {
    showPicture(img){
      //console.log(img)
      if (!(img instanceof Object)) {
        return img
      }
      let src = ''
      for (var prop in img) {
        src = img[prop]['original_url']
        break;
      }
      return src
    },
    path(type, slug) {
      return makePath(type, slug)
    },
    openModal() {
      this.$modalBus.$emit('open.component', {
        component: AskForm, hidden: {
          from_user_id: this.loggedInUser.id,
          article_id: this.card.id,
          user_id: 20
        }
      });
    },
    userPost(){
      return this.isAuthenticated && this.loggedInUser.id === this.card.id
    },
    canAsk(){
      return this.isAuthenticated && this.loggedInUser.id !== this.card.id
    },
    getPath(id){
      if(this.view === 'profile'){
        return `/profile/articles/edit/${id}`
      }
    }
  },
  computed: {
    ...mapGetters(['isAuthenticated', 'loggedInUser'])
  },
  mounted() {
    //console.log(this.card)
  }
}
</script>

<style scoped lang="scss">

.ads {
  display: flex;
  flex-wrap: wrap;

}

.ad {
  width: calc(25% - 21px);
  @include shadow;
  margin-right: 24px;
  display: flex;
  flex-direction: column;
  margin-bottom: 24px;
}

.thirdWidth .ad {
  width: calc(48% - 21px);

}

.ads.treeColl {

}

.ads.treeColl .ad {
  width: calc(32% - 21px);
}

.ad:hover .ad__title {
  color: $blue;
}

.ad:nth-child(4n) {
  margin-right: 0;
}

.ad__head {
  position: relative;
}

.ad__mobile {
  display: none;
}

.ad__desktop {
  width: 100%;
  height: 240px;
  overflow: hidden;
}

.ad__img {
  width: 100%;
  max-height: 100%;
  object-fit: cover;
  border-radius: 10px 10px 0 0;
  font-family: 'object-fit: cover;';
}

.ad__head .ad__main_placeholder {
  width: 63%;
  text-align: center;
  margin: 20% auto;
  display: block;
}

.ad__tags {
  position: absolute;
  top: 24px;
  left: 24px;
  display: flex;
}

.ad__tag {
  @include shadow;
  display: flex;
  border-radius: 30px;
  align-items: center;
  height: 22px;
  background: $green2;
}

.ad__tag:not(:first-child) {
  margin-left: 8px;
}

.ad__tag .ad__link {
  text-decoration: none;
  padding: 0 12px;
  text-transform: capitalize;
  color: #fff;
  font-size: 11px;
  font-weight: 700;
}

.ad__body {
  padding: 24px;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.ad__title {
  font-size: 15px;
  line-height: 19px;
  font-weight: 900;
  transition: color .2s ease;
  color: $dark;
}

.ad__actions {
  margin-top: 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.ad__question {

  /// / background: $ yellow;
  /// / height: 29 px;
  /// / display: inline-flex;
  /// / align-items: center;
  /// / padding: 0 10 px;
  /// / border-radius: 24 px;
  /// / font-size: 12 px;
  /// / color: #fff;
  /// / font-weight: 700;
  /// / text-transform: uppercase;
  /// / letter-spacing: .5 px;


  &.gray {
    background: $gray;
    color: $dark;
    text-transform: none;
    font-weight: 700;

    i {
      color: $dark;
    }

  }
}

.ad__question:hover {
  /*//box-shadow: 0 4px 8px rgb(254 170 89 / 60%);*/
  /*//background: $yellow;*/
  /*//color: #fff;*/
}

.ad__question i {
  margin-right: 8px;
  color: #fff;
}

.ad__svg {
  width: 12px;
  height: 12px;
}

.ad__ask {

}

.ad__categories {
  margin-bottom: 4px;
  line-height: 0;
}

.ad__category {
  color: $brawn;
  font-weight: 900;
  text-transform: uppercase;
  text-decoration: none;
  font-size: 10px;
  line-height: 18px;
}

.ad__favorite.filled {
  fill: $pink;
  stroke-width: 0;
  stroke: unset;
}

.ad__favorite {
  fill: none;
  height: 18px;
  width: 20px;
  cursor: pointer;
  stroke-width: 3px;
  stroke: #f279b1;
}

@media (max-width: 1279px) {
  .ad {
    width: 46%;
  }
}

@media (max-width: 767px) {
  .ad {
    width: 90%;
    margin: 0 auto 24px !important;
  }

  .ad__desktop {
    display: none;
  }

  .ad__mobile {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .ad__default {
    width: 50%;
    padding: 24px;
  }

  .ads.treeColl .ad {
    width: 90%;
  }

}
</style>
