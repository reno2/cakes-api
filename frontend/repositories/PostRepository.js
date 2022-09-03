import Repository from './Repository'
export default class PostRepository extends Repository{

  resource = '/posts'
  constructor($axios) {
    super($axios);
  }
}
