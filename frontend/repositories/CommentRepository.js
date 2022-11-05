import Repository from './Repository'
export default class CommentRepository extends Repository{

  resource = '/profile/comments'
  constructor($axios) {
    super($axios);
  }
}
