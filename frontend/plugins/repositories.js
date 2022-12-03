import Repository from '~/repositories/Repository'
import PostRepository from '~/repositories/PostRepository'
import CategoryRepository from '~/repositories/CategoryRepository'
import CommentRepository from '~/repositories/CommentRepository'
import ProfileAdsRepository from '~/repositories/ProfileAdsRepository'

const repositoryBuilder = ($axios) => ({
  ads: new PostRepository( $axios ),
  category: new CategoryRepository($axios),
  comment: new CommentRepository($axios),
  profileAds: new ProfileAdsRepository($axios),
})

export default (ctx, inject) => {
  inject('repositories', repositoryBuilder(ctx.app.$apitest))
}
