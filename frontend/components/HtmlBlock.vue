<template>
  <transition name="slide-fade" :delay="200">
    <div class="modal" @click.stop style="transition-delay: 1.5s">
      <svg-icon class="modal__close" @click="close" name="close-icon"/>
      <div class="modal__header">
        <div class="modal__title">{{ title }}</div>
      </div>
      <div class="modal__inner">
        <slot></slot>
      </div>
    </div>
  </transition>
</template>

<script>
import ModalBus from "@/helpers/ModalBus";
export default {
  name: "HtmlBlock",
  props: {
    title: "",
    html: ""
  },
  methods: {
    close() {
      ModalBus.$emit("close");
    }
  }
};
</script>

<style>
/*.slide-fade-enter-active {*/
/*  transition: all 0.3s ease;*/
/*}*/
/*.slide-fade-leave-active {*/
/*  transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);*/
/*}*/
/*.slide-fade-enter, .slide-fade-leave-to*/
/*  !* .slide-fade-leave-active до версии 2.1.8 *! {*/
/*  transform: translateX(10px);*/
/*  opacity: 0;*/
/*}*/
.modal {
  z-index: 999;
  width: 500px;
  height: fit-content;
  position: relative;

  padding: 40px 48px;
  background: #FFFFFF;
  border: 1px solid #F0F0F0;
  box-sizing: border-box;
  box-shadow: 0 4px 15px rgb(120 160 190 / 30%);
  border-radius: 10px;
  text-align: center;
}
.modal__close {
  position: absolute;
  top: 8px;
  right: 8px;
  width: 18px;
  height: 18px;
  fill: #1D2F3C;
  cursor: pointer;
  opacity: 0.54;
}

.modal__title {
  margin: 0 0 24px 0;
  font-size: 40px;
  line-height: 48px;
  font-weight: 700;
  color: #1D2F3C;
}
</style>
