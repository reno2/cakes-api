import BaseValidator from './BaseValidator'


export default class CreateAdsValidator extends BaseValidator{

  rules = {
    state: 'ruleRequire',
    title: 'ruleRequire',
    categories: 'ruleRequire',
    detail_text: 'ruleRequire',
    email: 'ruleRequire,ruleIsEmail',
    file: 'ruleRequire,ruleMaxFiles:4,ruleFileSize:500000,ruleType:jpg|png|jpeg'
  }

  messages  = {
    ruleRequire: 'Поле объязательно к заполнению',
    ruleEnAlphaDashValidator: 'Английсие буквы и _',
    ruleIsEmail: 'Не корректный email',
    ruleMaxFiles: 'Максимально количество %d',
    ruleFileSize: 'Максимально размер %d',
    ruleType: 'Допустимые форматы %d'
  }


}
