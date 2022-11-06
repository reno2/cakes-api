import BaseValidator from './BaseValidator'


export default class LoginValidator extends BaseValidator{

  rules = {
    state: 'ruleRequire',
    category: 'ruleRequire',
    delivery: 'ruleRequire',
    detail_text: 'ruleRequire',
    email: 'ruleRequire,ruleIsEmail',
  }

  messages  = {
    ruleRequire: 'Поле объязательно к заполнению',
    ruleEnAlphaDashValidator: 'Английсие буквы и _',
    ruleIsEmail: 'Не корректный email'
  }


}
