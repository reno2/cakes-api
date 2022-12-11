import Repository from '~/repositories/Repository'
import PostRepository from '~/repositories/PostRepository'
import CategoryRepository from '~/repositories/CategoryRepository'
import CommentRepository from '~/repositories/CommentRepository'
import ProfileAdsRepository from '~/repositories/ProfileAdsRepository'

const repositoryBuilder = ($axios, $route) => ({
  ads: new PostRepository( $axios, $route ),
  category: new CategoryRepository($axios),
  comment: new CommentRepository($axios),
  profileAds: new ProfileAdsRepository($axios, $route),
})

export default (ctx, inject) => {

  inject('repositories', repositoryBuilder(ctx.app.$apitest, ctx.route))
}
