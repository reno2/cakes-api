export default class BaseValidator {

  rules = []
  messages = {
    ruleRequire: 'Поле объязательно к заполнению',
    ruleEnAlphaDashValidator: 'Английсие буквы и _',
    ruleIsEmail: 'Не корректный email',
    ruleMaxFiles: 'Максимально количество %d',
    ruleFileSize: 'Максимально размер %d',
    ruleType: 'Допустимые форматы %d'
  }


  validateAdapter(component, validateParams) {

    const rules = validateParams.rules ?? false

    if (!rules) return true

    if (!('validateClass' in validateParams)) {
      validateParams.validateClass = this
    }


    validateParams.rules = rules.split(',')

    // Проверка вызвана из компонета
    if ('verifiable' in validateParams ) {
      return this.validate(component, validateParams)
    }

    // Проверяем на тип
   // if(Object.prototype.toString.call(validateParams.model) === '[object Object]'){
    if(validateParams.model instanceof FileList){

      if(Object.values(validateParams.model).length === 0){
        validateParams.model = {}
        return this.validate(component, validateParams)
      }

      Object.values(validateParams.model).forEach(item => {
        validateParams.verifiable = item
        return this.validate(component, validateParams)
      })

    }

    return this.validate(component, validateParams)

  }


  /**
   *
   * @param component
   * @param validateParams
   */
  validate(component, validateParams) {


    let isErrors = true
    component.errors = []


    const {model, verifiable, validateClass, rules} = validateParams

    rules.forEach(rule => {

      const fnParams = []

      // Значение или объект
      fnParams.push(model)

      // Проверяем есть ли параметры для правила валидации
      const ruleParams = rule.split(':')

      // Получаем если есть значения нужные для проверки
      if (ruleParams.length > 1) {
        fnParams.push(ruleParams[1])

        // Если есть параметры переопределяем значение правила
        rule = ruleParams[0]
      }

      if (verifiable) {
        fnParams.push(verifiable)
      }

      // Валидируем
      const isValid = validateClass[rule].apply(this, fnParams)

      // Если True выходим из текущего правила
      if (isValid) return

      // Устанавливаем в компоненте значение ошибки валидации
      isErrors = false

      // Получаем сообщение об ошибки
      const message = ruleParams.length > 1 ? validateClass.messages[rule].replace(/%d/, this.convertData(rule, ruleParams[1])) : validateClass.messages[rule]

      // Передаём тест ошибки в компонент
      component.errors.push(message)


    })
    return isErrors
  }

  convertData(rule, param) {
    let message = param
    if (rule === 'ruleFileSize') {
      let i = 0;
      let type = ['б', 'Кб', 'Мб', 'Гб', 'Тб', 'Пб'];
      while ((param / 1000 | 0) && i < type.length - 1) {
        param /= 1024;
        i++;
      }
      message = param.toFixed(2) + ' ' + type[i];
    }
    return message
  }

  getRule(rule) {
    const tmp = rule.split(':')

    const ruleArray = {}
    ruleArray.rule = tmp[0]

    if (tmp.length <= 1) {
      return ruleArray
    }

    if (!(/\|/.test(tmp[1]))) {
      ruleArray.param = tmp[1]
      return ruleArray
    }

    ruleArray.param = tmp[1].split('|')
    return ruleArray
  }


  ruleIsEmpty(value) {
    if (value === null || value === undefined || value === '') {
      return true;
    }

    if (Array.isArray(value) && value.length === 0) {
      return true;
    }

    return false;
  }

  ruleEnAlphaDashValidator(val) {
    return (/^[0-9A-Z_@.-]*$/i).test(val);
  }

  ruleRequire(val) {
    if (Array.isArray(val)) {
      return !!val.length
    }
    return !!val
  }

  ruleIsEmail(val) {
    const re =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(val));
  }

  ruleNumber(val) {
    return /^-?[0-9]+$/.test(String(val));
  }

  ruleMaxFiles(model, limit) {
    if (typeof model === "object") {
      return Object.keys(model).length + 1 <= limit
    }

  }

  ruleFileSize(model, limit, verifiable) {

    if (typeof verifiable !== "object") {
      return false
    }
    return (Number(limit) > verifiable.size)
  }

  ruleType(model, allowTypes, verifiable) {
    if (typeof verifiable !== "object") {
      return false
    }
    const fileExtension = verifiable.type.split("/")
      .pop()
      .toLowerCase()

    const allowTypesArray = allowTypes.split('|')

    return !!allowTypesArray.includes(fileExtension)
  }
}
