const API_FRONT = '/front'



export default class Auto {
  constructor(ctx) {
    this.$ctx = ctx;
  }
  async getFront() {
    const params = { params: { ...this.$ctx.route.query } };

    //return { page: await request(this.$ctx, 'get', API_ROUTES_ABOUT, params) };
  }
}
