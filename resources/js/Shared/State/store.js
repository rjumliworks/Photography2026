import Vuex from 'vuex';

import layout from './modules/layout';

const store = new Vuex.Store({
  modules: {
    layout: layout, // Register the layout module
  },
});

export default store;

