import BaseValidator from './BaseValidator'


export default class LoginValidator extends BaseValidator{

  rules = {
    name: 'ruleRequire,ruleNumber',
    email: 'ruleIsEmail',
  }

  messages  = {
    ruleRequire: 'Поле объязательно к заполнению',
    ruleNumber: 'Должно быть числом',
    ruleIsEmail: 'Не корректный email'
  }


}
