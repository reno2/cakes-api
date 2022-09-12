export const state = () => ({
  menu: {}
})

export const mutations = {
  SET_MENU(state, menu) {
    state.menu = menu
  },
  SET_ERROR(state, error) {
    state.menu = error
  }
}

export const getters = {
  getMenus: (state) => state.menu,
}


export const actions = {
  async fetchMenu({ commit }, $apitest=null) {
    console.log('log menu store')
    try {
      const {data: { menu } } = await $apitest.get('/menu')
      commit('SET_MENU', menu)
    } catch (e) {
      const error = 'Please create a menu document'

      commit('SET_ERROR', error);
    }
  }
}
