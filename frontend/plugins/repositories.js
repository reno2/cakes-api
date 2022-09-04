import Repository from '~/repositories/Repository'
import PostRepository from '~/repositories/PostRepository'
import CategoryRepository from '~/repositories/CategoryRepository'

const repositoryyBuilder = ($axios) => ({
  ads: new PostRepository( $axios ),
  //category: new CategoryRepository('category', $axios),
})

export default (ctx, inject) => {
  inject('repositories', repositoryyBuilder(ctx.app.$apitest))
}
