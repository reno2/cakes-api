<template>
  <div>
    <div class="hero">
      <div class="container">
        <div class="hero__inner">
          <div class="hero__content">
            <div class="hero__body">
              <div class="hero__title">{{list.title}}</div>
              <div class="hero__desc">{{list.desc}}</div>
              <div class="hero__actions"><a class="hero__buy btn-big btn-main">Заказать десерт</a> <a
                href="https://2cake.ru/register" class="hero__sell btn-big btn-secondary">Я кондитер</a></div>
            </div>
          </div>
          <div class="hero__banner"><img :src="list.images.desc" alt="" class="hero__banner_desc"> <img
            :src="list.images.mob" alt="" class="hero__banner_mob"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    list: Object
  },
 mounted(){
   console.log(this.isClient)
 }
}
</script>

<style>
.hero{
  margin-top: 40px;
  margin-bottom: 64px;
}
.hero__inner{
  display: flex;
  justify-content: space-between;
}
.hero__content {
  display: flex;
  align-items: center;
  flex-grow: 1;
  position: relative;
}
.hero__content:before {
  content: "";
  background-image: url("/images/hero/hero_bg.png");
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  z-index: -1;
}

.hero__body{
  max-width: 549px;
}
.hero__title{
  font-weight: 900;
  font-size: 52px;
  line-height: 68px;
  color: #231F20;
  margin-bottom: 16px;
}

.hero__desc {
  max-width: 505px;
  font-size: 24px;
  line-height: 160%;
  margin-bottom: 32px;
}

.hero__actions {
  display: flex;
}
.hero__buy{
  margin-right: 24px;
}

.hero__banner_mob{
  display: none;
}
@media (max-width: 1279px) {

}
@media (max-width: 767px) {
  .hero__inner{
    flex-direction: column;
  }
  .hero__title{
    font-weight: 700;
    font-size: 24px;
    line-height: 31px;
  }
  .hero__desc{
    font-weight: 400;
    font-size: 16px;
    line-height:  26px;
  }
  .hero__actions{
    flex-direction: column;
  }
  .hero__actions a{
    width: 100%;
  }
  .hero__actions a:first-child{
    margin-bottom: 16px;
  }
  .hero__banner{
    margin-top: 32px;
    border-radius: 16px;
    overflow: hidden;
  }
  .hero__banner_desc{
    display: none;
  }
  .hero__banner_mob{
    display: block;
  }
  .hero__banner .hero__banner_mob{
    height: 120px;
    width: 100%;
    object-fit: cover;
  }
}
</style>
