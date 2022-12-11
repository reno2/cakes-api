import Repository from './Repository'
export default class ProfileAdsRepository extends Repository{

  resource = '/profile/articles'
  constructor($axios, route) {
    super($axios, route);
    this.getUrl()
  }
}
