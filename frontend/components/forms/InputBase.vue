<template>

  <div class="form-cell" :class="renderClasses()">
    <label class="form-cell__label js_label">{{ label }} </label>
    <input ref="input" class="form-cell__input js_input"  v-model="model" v-on="listeners">
    <svg v-if="model" class="form-cell__clean js_clean" @click="cleanInput">
      <use xlink:href="~/assets/icons/icons.svg#icon-close"></use>
    </svg>
    <div class="form-cell__errors" v-if="errors">
      <div v-for="error in errors" class="form-cell__error">{{error}}</div>
    </div>
  </div>

</template>

<script>
import {checkRequired} from "@/helpers/functions"
export default {
  inheritAttrs: false,
  name: 'InputBase',
  data() {
    return {
      errors: [],
      state: true,
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
  computed: {
    listeners() {
      return {
        ...this.$listeners,
        input: event => {
          this.errors = []
          this.$emit('input', event.target.value)
          this.classes.filled = !!(event.target.value)
        },
        focus: event => this.classes.onFocus = true,
        blur: event => this.classes.onFocus = false,
      }
    },

  },
  methods: {
    renderClasses() {
      return this.classArray.join(' ')
    },
    cleanInput() {
      this.model = ''
      this.errors = []
      this.classes.filled = false
      this.$emit('input', '')
    },
    inputEvent($event) {
      this.$emit('input-change', $event.target.value);
    },
    doValidate(){

      for(let rule in this.rules ){
        const ruleFunc = this.rules[rule].rule
        console.log(this[ruleFunc](this.model))
        // /console.log(ruleFunc.call(null, this.model))
      }
      return false
    }
  },
  mounted() {
    this.model = this.value;
    if (this.type === 'hidden' && this.value) {
      this.$emit('input-change', this.model);
    }
  }
}
</script>

<style>
.form-cell {
  margin-bottom: 8px;
  position: relative;
}

.form-cell__label {
  position: absolute;
  pointer-events: none;
  left: 16px;
  top: 15px;
  -webkit-transition: .2s ease all;
  -o-transition: .2s ease all;
  transition: .2s ease all;
  background-color: #fff;
  padding: 0 5px;
  line-height: 19px;
  font-size: 14px;
  letter-spacing: 0.02em;
  color: #6A747B;
}

.form-cell.onFocus .form-cell__label,
.form-cell.filled .form-cell__label {
  top: -8px;
  left: 16px !important;
  border-radius: 8px;
  color: #D3A1DF;
}

.form-cell.onFocus .form-cell__input,
.form-cell.filled .form-cell__input {
  border: 1px solid #D3A1DF;
}

.form-cell__input {
  width: 100%;
  background: #FFFFFF;
  border: 1px solid #D7DBDE;
  box-sizing: border-box;
  border-radius: 8px;
  -webkit-appearance: none;
  height: 48px;
  padding-left: 16px;
  padding-right: 24px;
  outline: unset;
}

.form-cell__clean {
  width: 18px;
  height: 18px;
  fill: #1D2F3C;
  opacity: 0.54;
  cursor: pointer;
  position: absolute;
  top: 15px;
  /*top: 50%;*/
  /*transform: translateY(-50%);*/
  right: 10px;
}

.form-cell__errors{
  margin-top: 4px;
}
.form-cell__error {
  font-size: 12px;
  color: tomato;
}
.form-cell__error:not(:last-child){
  margin-bottom: 2px;
}
</style>
