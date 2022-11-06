<template>

  <div class="form-cell form-cell__checkbox element-checkbox" @click="change" :class="renderClasses()">
    <div class="element-checkbox__values">
      <div class="form-cell__icons">
        <svg-icon v-if="model" class="element-checkbox__icon element-checkbox__checked" name="icon-checked"/>
        <svg-icon v-else class="element-checkbox__icon element-checkbox_unchecked" name="icon-unchecked"/>
      </div>

      <label class="element-checkbox__label js_label">{{ label }} </label>
      <input class="element-checkbox__input js_input" type="checkbox" v-model="model" v-on="listeners">
    </div>

    <transition-group tag="div" name="slide" class="form-cell__errors" v-if="errors">
      <div v-for="error in errors" :key="error" class="form-cell__error">{{ error }}</div>
    </transition-group>

  </div>

</template>

<script>
export default {
  inheritAttrs: false,
  name: 'CheckboxBase',
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
    change() {
      this.model = !this.model
      if(this.model){
        this.errors = []
      }
    },
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
    doValidate() {

      for (let rule in this.rules) {
        const ruleFunc = this.rules[rule].rule
        this[ruleFunc](this.model)
      }
      return false
    }
  },
  mounted() {
    this.model = this.value;
  }
}
</script>

<style>
.form-cell {
  margin-bottom: 16px;
  position: relative;
}

.element-checkbox {
  display: flex;
  align-items: flex-start;
  flex-direction: column;
}
.element-checkbox__values{
  display: flex;
  align-items: center;
}
.element-checkbox__icon {
  width: 16px;
  height: 16px;
}

.element-checkbox__label {
  position: static;
  -webkit-transition: .2s ease all;
  -o-transition: .2s ease all;
  transition: .2s ease all;
  background-color: #fff;
  padding: 0 8px;
  line-height: 19px;
  font-size: 14px;
  letter-spacing: 0.02em;
  color: #6A747B;
}

.element-checkbox__input {
  position: absolute;
  visibility: hidden;
}

.form-cell__errors {
  margin-top: 4px;
}

.form-cell__error {
  font-size: 12px;
  color: tomato;
}

.form-cell__error:not(:last-child) {
  margin-bottom: 2px;
}
</style>
