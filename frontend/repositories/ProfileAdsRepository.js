import Repository from './Repository'
export default class ProfileAdsRepository extends Repository{

  resource = '/profile/article'
  constructor($axios) {
    super($axios);
  }
}
