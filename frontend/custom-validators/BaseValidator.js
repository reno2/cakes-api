export default class BaseValidator {

  rules = []
  messages = []

  doValidate(){
    console.log(this.rules)
  }


  ruleRequire(val){
    return !!val
  }

  ruleNumber(val){
    return Number.isInteger(val)
  }

}
