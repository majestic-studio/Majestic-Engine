import { createApp } from 'vue';


import App from './components/App'
import Search from './components/Search'
import Region from './components/Region'

createApp(Region).mount('#region')
createApp(Search).mount('#search')
createApp(App).mount("#app")