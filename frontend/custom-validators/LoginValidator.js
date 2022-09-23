import BaseValidator from './BaseValidator'


export default class LoginValidator extends BaseValidator{

  rules = {
    password: 'ruleRequire,ruleEnAlphaDashValidator',
    email: 'ruleRequire,ruleIsEmail',
  }

  messages  = {
    ruleRequire: 'Поле объязательно к заполнению',
    ruleEnAlphaDashValidator: 'Английсие буквы и _',
    ruleIsEmail: 'Не корректный email'
  }


}
