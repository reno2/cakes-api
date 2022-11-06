export const state = () => ({
  menu: [],
  menuAll: []
})

export const mutations = {
  SET_MENU(state, menu) {
    if (!menu.length) return

    state.menuAll = menu

    const max = 4;
    state.menu = menu.reduce((accumulator, currentValue, index, array) => {
      if (index > max) {
        if (accumulator[max]["children"]) {
          accumulator[max]["children"].push(currentValue);
        } else {
          accumulator[max].children = [currentValue];
        }
      } else {
        accumulator.push(currentValue);
      }

      return accumulator;
    }, [])
  },


  SET_ERROR(state, error) {
    state.menu = error
  }
}

export const getters = {
  getMenus: (state) => state.menu,
  getMenusAll: (state) => state.menuAll,
}


export const actions = {
  async fetchMenu({commit}, $apitest = null) {
    console.log('log menu store')
    try {
      const {data: {menu}} = await $apitest.get('/menu')
      commit('SET_MENU', menu)
    } catch (e) {
      const error = 'Please create a menu document'

      commit('SET_ERROR', error);
    }
  }
}
