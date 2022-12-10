<template>

  <div class="form-cell element-upload" :class="renderClasses()">
    <transition-group tag="div" class="element-upload__previews" name="slide" v-if="tmp">
      <div ref="previews" class="element-upload__preview" v-for="file in Object.entries(tmp)" :key="file[0]">
        <img class="element-upload__img" :src="getImg(file[1])" alt="">
        <span class="element-upload__name">{{file[1].name}}</span>
        <svg-icon @click="remove($event, file[0])" class="element-upload__remove" name="close-icon"/>
      </div>
    </transition-group>
    <div class="element-upload__desc" v-html="label"></div>
    <button class="btn-middle btn-main element-upload__button  wide" @click.prevent="openDialog">
      <svg-icon class="element-upload__load" name="icon-plus"/>
      <span>Загрузить </span>
    </button>
    <input type="file" name="images[]" multiple ref="input" @change="loadFile" class="element-upload__input">
    <transition-group tag="div" name="slide" class="form-cell__errors" v-if="errors">
      <div v-for="error in errors" :key="error" class="form-cell__error">{{ error }}</div>
    </transition-group>

  </div>

</template>

<script>
import md5 from 'md5'
import {checkRequired} from "@/helpers/functions"
import BaseValidator from "../../custom-validators/BaseValidator";

export default {
  inheritAttrs: false,
  name: 'FileBase',
  data() {
    return {
      errors: [],
      state: true,
      model: {},
      classes: {
        filled: false,
        onFocus: false,
      },
      classArray: [],
      files: [],
      BaseValidator: Function,
      tmp: {}
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
    // listeners() {
    //   return {
    //     ...this.$listeners,
    //     input: event => {
    //       this.errors = []
    //       this.$emit('input', event.target.value)
    //       this.classes.filled = !!(event.target.value)
    //     },
    //     focus: event => this.classes.onFocus = true,
    //     blur: event => this.classes.onFocus = false,
    //   }
    // },

  },
  methods: {
    renderClasses() {
      return this.classArray.join(' ')
    },
    openDialog() {
      this.$refs.input.value = ''
      this.$refs.input.click()
    },

    loadFile({target: {files}}) {


      if (!files.length) return

      let isValid = true;



      [...files].forEach(file => {

        const validateParams = {
          model: this.model,
          verifiable: file,
          validateInputName: this.name,
          rules: this.rules
        }

        //isValid = this.BaseValidator.validateAdapter(this, validateParams)
        if (isValid) {
          this.storeFiles(file)

        }

      })

    },

    storeFiles(file){

      const hash = md5(file.name)
      const ext = file.name.split('.').pop()
      const name = `${hash}.${ext}`

      if(this.tmp.hasOwnProperty(name)){
          return
      }
      this.$set(this.tmp,name, file )
     // this.tmp[name] = file
      this.setModel(name)


      //console.log( Object.values(this.tmp), Object.entries(this.tmp) )
    },

    setModel(name){
      const dt = new DataTransfer();
      for (let key in this.tmp) {
        dt.items.add(this.tmp[key])
      }

      this.model = dt.files

      // Передаём значение в основную форму
      const event = {
        aliasName: 'image',
        model : this.model
      }
      this.$emit('input-change', event);
    },

    getImg(file) {
      return URL.createObjectURL(file)
    },
    cleanInput() {
      this.model = ''
      this.errors = []
      this.classes.filled = false
      this.$emit('input', '')
    },

    remove(el, fileName) {

      console.log(this.tmp, fileName, el )

      if (this.tmp[fileName]) {
        delete this.tmp[fileName]
        el.target.closest('.element-upload__preview').remove()
      }

      this.setModel(fileName)

      console.log(this.tmp)

    },

  },
  mounted() {
    this.BaseValidator = new BaseValidator
    if (this.value) {
      this.model = this.value
    }
  }
}
</script>

<style>
.form-cell {
  margin-bottom: 16px;
  position: relative;
}

.element-upload__button {
  display: flex;

}

svg.element-upload__load {
  padding: 8px;
  background: #fff;
  fill: #D3A1DF;
  width: 28px;
  height: 28px;
  border-radius: 100px;
}

.element-upload__desc {
  margin-bottom: 16px;
  font-size: 12px;
  line-height: 1.4;
}

.element-upload__input {
  display: none;
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

.element-upload__previews {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  background: #fff;
  padding: 5px;
}

.element-upload__preview {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 16px;
  padding: 8px;
  box-shadow: 0 1px 8px -7px #000;
  border-radius: 5px;
  margin-right: 4px;
  width: fit-content;
  overflow: hidden;
  max-height: 100%;
  border: 2px dashed #cccccc;
}

.element-upload__remove {
  position: absolute;
  width: 20px;
  height: 20px;
  fill: #e78a8a;
  top: 0;
  left: 0;
  cursor: pointer;
}

.element-upload__img {
  height: 127px;
  width: 100px;
  object-fit: contain;
}
.element-upload__name {
  font-size: 10px;
  color: #6A747B;
  margin: 4px 0;
}
</style>
