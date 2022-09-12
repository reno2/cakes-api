import Repository from '~/repositories/Repository'
import PostRepository from '~/repositories/PostRepository'
import CategoryRepository from '~/repositories/CategoryRepository'

const repositoryBuilder = ($axios) => ({
  ads: new PostRepository( $axios ),
  category: new CategoryRepository($axios),
})

export default (ctx, inject) => {
  inject('repositories', repositoryBuilder(ctx.app.$apitest))
}
