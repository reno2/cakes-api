<template>

  <div class="form-cell element-select js_element-select" ref="select" @click="showValues" :class="renderClasses()">

    <div class="element-select__label">

      <button class="element-select__name">{{ label }}</button>
      <label class="element-select__selected" v-if="model">{{ text }}</label>
      <div class="element-select__icons js_select__icons" ref="icons">
        <svg-icon v-if="model" ref="close" class="element-select__icon element-select__close js_close"
                  name="close-icon"/>
        <svg-icon v-else class="element-select__icon element-select__more" name="icon-more2"/>
      </div>
    </div>

    <transition name="list-complete">
      <div v-if="isOpen" class="element-select__values">
        <ul class="element-select__ul">
          <li class="element-select__li js_select__option" :data-value="val.value" v-for="val in options">{{
              val.title
            }}
          </li>
        </ul>
      </div>
    </transition>

    <transition-group tag="div" name="slide" class="form-cell__errors" v-if="errors">
        <div v-for="error in errors" :key="error" class="form-cell__error">{{ error }}</div>
    </transition-group>

  </div>

</template>

<script>
import {checkRequired} from "@/helpers/functions"

export default {
  inheritAttrs: false,
  name: 'SelectBase',
  data() {
    return {
      errors: [],
      text: null,
      isOpen: false,
      model: '',
      classes: {
        filled: false,
        onFocus: false,
      },
      classArray: []
    }
  },
  props: {
    type: null,
    rules: [],
    name: null,
    label: {
      type: String,
      required: true,
    },
    value: {
      type: String,
    },
    options: {
      type: Array
    }
  },
  watch: {
    classes: {
      handler(value) {
        let updateArray = []
        for (let key in this.classes) {
          if (this.classes[key]) {
            updateArray.push(key)
          }
        }
        this.classArray = updateArray
      },
      immediate: true,
      deep: true
    }
  },
  computed: {},
  methods: {
    renderClasses() {
      return this.classArray.join(' ')
    },
    showValues(event) {

      const {target} = event
      event.stopPropagation()

      // По крестику, очищаем выбранное значение
      if (this.$refs.icons.contains(target) && this.model) {
        this.cleanInput()
        return
      }

      // По выбору, устанавливаем и закрываем
      if (target.matches('.js_select__option')) {
        this.inputEvent(target)
        return
      }

      // По root селекту, открываем
      if (!this.isOpen) {
        this.classes.onFocus = true
        this.isOpen = true
      }

    },
    cleanInput() {
      this.classes.filled = false
      this.model = ''
      this.text = ''
      this.errors = []
      this.$emit('input', '')
    },
    inputEvent(target) {
      this.isOpen = false
      this.model = target.dataset.value
      this.text = target.innerHTML
      this.$emit('input-change', target.value);
      this.classes.filled = true
      this.classes.onFocus = false
      this.errors = []
    },

    doValidate() {
      for (let rule in this.rules) {
        const ruleFunc = this.rules[rule].rule
      }
      return false
    }

  },
  mounted() {
    this.model = this.value;

    window.addEventListener("click", ({target}) => {

      if (!this.$refs.select.contains(target)) {
        this.isOpen = false
        this.classes.onFocus = false
      }
    })
  }
}
</script>

<style>
.form-cell {
  margin-bottom: 16px;
  position: relative;
  width: 100%;
}

.element-select {
  position: relative;
}

.element-select__selected {
  padding: 0 21px;
  line-height: 19px;
  font-size: 14px;
  letter-spacing: 0.02em;
  color: #6A747B;
}

.element-select__label {
  width: 100%;
  background: #FFFFFF;
  border: 1px solid #D7DBDE;
  box-sizing: border-box;
  border-radius: 5px;
  -webkit-appearance: none;
  height: 42px;
  outline: unset;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.element-select__name {
  left: 16px;
  top: 11px;
  -webkit-transition: .2s ease all;
  -o-transition: .2s ease all;
  transition: .2s ease all;
  background-color: #fff;
  padding: 0 5px 0 24px;
  line-height: 19px;
  font-size: 14px;
  letter-spacing: 0.02em;
  color: #6A747B;
  border: unset;
}

.element-select__values {
  border: 1px solid #F0F0F0;
  box-shadow: 0 11px 11px rgb(120 160 190 / 50%);
  border-radius: 0 0 10px 10px;
  overflow: auto;
  max-height: 300px;
  width: 100%;
  position: absolute;
  background: #fff;
  z-index: 20;
}

.element-select__li {
  line-height: 19px;
  font-size: 14px;
  letter-spacing: 0.02em;
  color: #6A747B;
  padding: 8px 16px;
  cursor: pointer;
}

.element-select__li:hover {
  background: #f6f6f6;
}

.element-select__li:first-child {
  padding-top: 16px;
}

.element-select__li:last-child {
  padding-bottom: 16px;
}

/* region On focus */
.element-select.onFocus .element-select__label {
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

/* endregion On focus */

/* region On filled */
.element-select.filled .element-select__name {
  position: absolute;
  top: 0;
  transform: translateY(-50%);
  padding: 0 4px;
  color: #D3A1DF;
}

.element-select.filled .element-select__label {
  border: 1px solid #D3A1DF;
}

/* endregion On filled */


.form-cell.onFocus .form-cell__label,
.form-cell.filled .form-cell__label {
  top: -8px;
  left: 16px !important;
  border-radius: 8px;
  color: #D3A1DF;
}

.form-cell.onFocus .form-cell__textarea,
.form-cell.filled .form-cell__textarea {
  border: 1px solid #D3A1DF;
}


/* region icons */
.element-select__icons {
  height: 100%;
  width: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.element-select__icon {
  width: 18px;
  height: 18px;
  fill: #1D2F3C;
  opacity: 0.54;
  cursor: pointer;
  right: 10px;
}

/*.element-select__more {*/
/*  width: 25px;*/
/*  height: 25px;*/
/*}*/
/* endregion icons */


.form-cell__errors {
  margin-top: 4px;
}

.form-cell__error {
  font-size: 10px;
  color: tomato;
  text-align: left;
}


</style>
