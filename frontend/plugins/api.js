import Api from '~/api';


export default function(ctx, inject) {
  const api = new Api(ctx);
  ctx.$api = api;

  inject('api', api);
}
