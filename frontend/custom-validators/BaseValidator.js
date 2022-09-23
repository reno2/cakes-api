export default class BaseValidator {

  rules = []
  messages = []

  doValidate(){
    console.log(this.rules)
  }

  ruleIsEmpty(value){
      if (value === null || value === undefined || value === '') {
        return true;
      }

      if (Array.isArray(value) && value.length === 0) {
        return true;
      }

      return false;
  }
  ruleEnAlphaDashValidator(val){
    return ( /^[0-9A-Z_-]*$/i).test(val);
  }
  ruleRequire(val){
    return !!val
  }

  ruleIsEmail(val){
    const re =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(val));
  }

  ruleNumber(val){
    return  /^-?[0-9]+$/.test(String(val));
  }

}
