import('./menu')

import Vuex from 'vuex'

import { createApp } from 'vue';
import Search from './components/Search/Search'
import Region from './components/Region'
import GlobalNavMenu from './components/GlobalMenu/GlobalMenu'


createApp(GlobalNavMenu).mount('#userMenu')
createApp(Region).mount('#region')
createApp(Search).mount('#search')