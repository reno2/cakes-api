<template>

  <div class="form-cell element-upload" :class="renderClasses()">

    <transition-group tag="div" class="element-upload__previews" name="slide" v-if="computedTmp">
      <div ref="previews" @click="select(file[0])" class="element-upload__preview" v-for="file in Object.entries(computedTmp)" :key="file[0]">
        <img class="element-upload__img" :src="getImg(file[1])" alt="">
        <span class="element-upload__name">{{file[1].name}}</span>
        <svg-icon @click.stop="remove($event, file[0])" class="element-upload__remove" name="close-icon"/>
        <span class="element-upload__selected">Главный</span>
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
      tmp: {},
      old: {},
      selected: null,
      remove: []
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
      type: String|Object,
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
    computedTmp(){
      let result = {}

      if(Object.keys(this.old).length){
        result  = Object.assign(this.old)
      }

      if(Object.keys(this.tmp).length){
        result  = Object.assign(result, this.tmp)
      }

      return result
    }
  },
  methods: {
    select(filename){

      this.selected = filename
      if(this.old[filename]){
        this.old = this.sortObj(this.old, filename)
      }
      if(this.tmp[filename]){
        this.tmp = this.sortObj(this.tmp, filename)
      }
    },

    sortObj(obj, filename){
      const reduce = Object.entries(obj).reduce((acc, [val, key]) => {
        if(val === filename){
          acc.unshift([val, key])
        }else{
          acc.push([val, key])
        }
        return [...acc]
      }, [])
      return  Object.fromEntries(reduce)
    },

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

        if (isValid) {
          this.storeFiles(file)

        }

      })

    },
    ifNotExists(file){
      const hash = md5(file.name)
      const ext = file.name.split('.').pop()
      const name = `${hash}.${ext}`
      if(this.tmp.hasOwnProperty(name)){
        return null
      }
      return name
    },

    storeFiles(file){
      const name = this.ifNotExists(file)
      if(!name){
        return
      }
      this.$set(this.tmp, name, file )
      this.setModel(name)
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
      if(file instanceof File){
        return URL.createObjectURL(file)
      }
      return file.original_url

    },
    cleanInput() {
      this.model = ''
      this.errors = []
      this.classes.filled = false
      this.$emit('input', '')
    },

    remove(el, fileName) {

      console.log(el)
      // if (this.tmp[fileName]) {
      //   delete this.tmp[fileName]
      //   el.target.closest('.element-upload__preview').remove()
      // }
      //
      // this.setModel(fileName)
    },

    setOldFiles(oldFiles){
      for(let file in oldFiles){
        if(!this.selected){
          this.selected = oldFiles[file]['file_name']
        }
        this.$set(this.old, oldFiles[file]['file_name'],oldFiles[file])
      }
    }

  },
  mounted() {
    this.BaseValidator = new BaseValidator
    if (this.value) {
     this.setOldFiles(this.value)
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
  margin-bottom: 8px;
  padding: 8px;
  box-shadow: 0 1px 8px -7px #000;
  border-radius: 5px;
  margin-right: 8px;
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
  margin: 4px 0 8px;
  text-overflow: ellipsis;
  max-width: 100px;
  overflow: hidden;
}
.element-upload__selected{
  display: none;
}
.element-upload__preview:first-child .element-upload__selected{
  display: block;
  position: absolute;
  bottom: 0;
  font-size: 10px;
  width: 100%;
  background: #D3A1DF;
  text-align: center;
  padding: 2px 0;
  color: #fff;
}
</style>
