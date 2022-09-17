import BaseValidator from './BaseValidator'


export default class LoginValidator extends BaseValidator{

  rules = [
    this.ruleRequire,
    this.ruleNumber,
  ]

  messages  = {
    ruleRequire: 'Поле объязательно к заполнению',
    ruleNumber: 'Должно быть числом'
  }


}
