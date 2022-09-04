
import Repository from './Repository'
export default class CategoryRepository extends Repository{

  resource = '/category'
  constructor($axios) {
    super($axios);
  }
}

