<template>

  <div class="form-cell element-upload" :class="renderClasses()">

    <transition-group ref="container" tag="div" class="element-upload__previews" name="slide" v-show="renderData">
      <div v-for="(file, key) in Object.entries(renderData)"
           ref="previews"
           @click="selectItem(file[0], key)"
           class="element-upload__preview js_element"
           :key="file[0]"
           :data-index="key"
           draggable="true"
      >
        <img class="element-upload__img" :src="getImg(file[1])" alt="">
        <span class="element-upload__name">{{ file[1].name }}</span>
        <svg-icon @click.stop="removeItem($event, file[0], key)" class="element-upload__remove" name="close-icon"/>
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
import login from "../../pages/login";

export default {
  inheritAttrs: false,
  name: 'FileBase',
  data() {
    return {
      errors: [],
      state: true,
      model: {},
      BaseValidator: Function,
      classes: {
        filled: false,
        onFocus: false,
      },
      classArray: [],

      filesToRender: [],
      filesToDelete: [],
      tmp: {},
      old: {},
      selected: null,
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
      type: String | Object,
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
    renderData() {
      const result = {}
      if (!this.filesToRender.length) {
        return result
      }
      const files = {...this.old, ...this.tmp}
      // Собераем новый объекст для вывода
      this.filesToRender.forEach(fileName => {
        result[fileName] = files[fileName]
      })
      // Метод для добавления обработчиков событий
      this.setEvents()

      return result
    },

  },
  methods: {
    selectItem(filename, inx) {
      // Удаляем элемент по интексу
      this.filesToRender.splice(inx, 1)
      // Добавляем в начало массива
      this.filesToRender.unshift(filename)
    },
    removeItem(el, fileName, inx) {
      if (this.old[fileName]) {
        delete this.old[fileName]
        this.filesToDelete.push(fileName)
      }
      if (this.tmp[fileName]) {
        delete this.tmp[fileName]
      }
      this.filesToRender.splice(inx, 1)
    },
    sortObj(obj, filename) {
      const reduce = Object.entries(obj).reduce((acc, [val, key]) => {
        if (val === filename) {
          acc.unshift([val, key])
        } else {
          acc.push([val, key])
        }
        return [...acc]
      }, [])
      return Object.fromEntries(reduce)
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
    storeFiles(file) {
      const name = this.ifNotExists(file)
      if (!name) {
        return
      }
      this.filesToRender.push(name)
      this.$set(this.tmp, name, file)
      this.setModel(name)
    },
    ifNotExists(file) {
      const hash = md5(file.name)
      const ext = file.name.split('.').pop()
      const name = `${hash}.${ext}`
      if (this.tmp.hasOwnProperty(name)) {
        return null
      }
      return name
    },
    setModel(name) {
      const dt = new DataTransfer();
      for (let key in this.tmp) {
        dt.items.add(this.tmp[key])
      }
      this.model = dt.files
      // Передаём значение в основную форму
      const event = {
        aliasName: 'image',
        model: this.model
      }
      this.$emit('input-change', event);
    },

    getImg(file) {
      if (file instanceof File) {
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
    setOldFiles(oldFiles) {
      // Устанавливаем основныйм первый
      if (!this.selected) {
        this.selected = this.filesToRender[0]
      }
      // Собераем массив для вывода
      // Сохраняем файлы для редиктирования
      for (let file in oldFiles) {
        this.filesToRender.push(oldFiles[file]['file_name'])
        this.$set(this.old, oldFiles[file]['file_name'], oldFiles[file])
      }
    },
    setEvents(){
      this.$nextTick(() => {
         // console.log(this.$refs.previews)
      })
    },
    drugElement(evt){
      evt.preventDefault();
        const activeElement =  this.$refs.container.$el.querySelector(`.dragging`);
        const currentElement = evt.target.closest('.js_element');
        if(activeElement === currentElement){
          return
        }

      const nextElement = this.drugGetNextElement(evt.clientY, evt.clientX, currentElement)

      if(!nextElement){
        return
      }

      const inx = Number(activeElement.dataset.index)
      const f = this.filesToRender[activeElement.dataset.index]
      const nextInx = Number(nextElement.dataset.index)
      this.filesToRender.splice(inx, 1)
      this.filesToRender.splice(nextInx, 0, f);



    },

    drugGetNextElement(positionY, positionX, currentElement){
      if(currentElement) {

        const currentElementCord = currentElement.getBoundingClientRect();
        const currentHeightCenter = currentElementCord.y + currentElementCord.height / 2;
        const currentWidthCenter = currentElementCord.x;

        if (positionY > currentHeightCenter) {
          return currentElement
        }
      }

    }
  },
  mounted() {
    this.BaseValidator = new BaseValidator
    if (this.value) {
      this.setOldFiles(this.value)
    }

    this.$refs.container.$el.addEventListener(`dragstart`, (evt) => {
      evt.target.closest('.js_element').classList.add(`dragging`);
    });
    this.$refs.container.$el.addEventListener(`dragend`, (evt) => {
      evt.target.closest('.js_element').classList.remove(`dragging`);
    });
    // Обрабатываем событие перетаскивание на элементе
    this.$refs.container.$el.addEventListener(`dragover`, this.drugElement)

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
.element-upload__preview.dragging{
  background: #eee;
  transform: scale(0.9);
  cursor: move;
  opacity: .5;
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

.element-upload__selected {
  display: none;
}

.element-upload__preview:first-child .element-upload__selected {
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
