import { createApp } from 'vue';


import App from './components/App'
import Search from './components/Search/Search'
import Region from './components/Region'
import GlobalNavMenu from './components/GlobalNavMenu'

createApp(GlobalNavMenu).mount('#userMenu')
createApp(Region).mount('#region')
createApp(Search).mount('#search')
createApp(App).mount("#app")