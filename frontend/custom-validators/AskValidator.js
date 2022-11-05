import BaseValidator from './BaseValidator'


export default class LoginValidator extends BaseValidator{

  rules = {
    question: 'ruleRequire,ruleEnAlphaDashValidator',
  }

  messages  = {
    ruleRequire: 'Поле объязательно к заполнению',
    ruleEnAlphaDashValidator: 'Английсие буквы и _',
  }


}
