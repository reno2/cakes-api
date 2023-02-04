// plugins/error-handler.js

import ErrorHandler from '@/helpers/ErrorHandler'

export default (context, inject) => {
  inject('errorHandler', new ErrorHandler())
}
