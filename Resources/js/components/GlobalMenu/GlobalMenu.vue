<template>
  <div class="container" @mouseover="loadingDataMenu">
    <ul class="list">
      <li v-for="tab in tabs"
          :key="tab"
          :class="{ active: currentTab === tab }"
          @click="currentTab = tab"
      >
        <i :class="tab.icon"></i>
        <span>
          {{ tab.name }}
        </span>

      </li>
    </ul>
      <div class="content">
        <div class="menu">
          <transition name="component-fade" mode="out-in">
            <component :is="currentTabComponent" class="tab"></component>
          </transition>
        </div>
      </div>

  </div>
</template>

<script>
import axios from 'axios';

import Shop from "./Tabs/Shop";
import Electronic from "./Tabs/Electronic";
import Garden from "./Tabs/Garden";
import Kids from "./Tabs/Kids";
import Technics from "./Tabs/Technics";
import Beauty from "./Tabs/Beauty";
import Computer from "./Tabs/Computer";
import Sport from "./Tabs/Sport";
import Relaxation from "./Tabs/Relaxation";
import Animal from "./Tabs/Animal";
import Home from "./Tabs/Home";
import Furniture from "./Tabs/Furniture";
import Promo from "./Tabs/Promo";

export default {
  name: "GlobalMenu",
  data() {
    return {
      currentTab: {
        name: 'Promo'
      },
      tabs: null
    }
  },
  computed: {
    currentTabComponent() {
      return this.currentTab.name
    },
  },
  components: {
    'Shop': Shop,
    'Electronic': Electronic,
    'Garden': Garden,
    'Kids': Kids,
    'Technics': Technics,
    'Beauty': Beauty,
    'Computer': Computer,
    'Sport': Sport,
    'Relaxation': Relaxation,
    'Animal': Animal,
    'Home': Home,
    'Furniture': Furniture,
    'Promo': Promo,
  },
  methods: {
    loadingDataMenu() {
      if(this.loadingMenu === false) {
        const APIRequest = '/api/v1/system/menu/';

        axios
            .get(APIRequest)
            .then(response => {
              this.tabs = response.data.result
            })

        return this.loadingMenu = true
      }

    }
  },
  mounted() {
    // Проверка, загружено ли API главного меню.
    // Если false, то выполняем функцию loadingDataMenu()
    this.loadingMenu = false
  }

}

</script>

<style scoped>
.component-fade-enter-active, .component-fade-leave-active {
  transition: opacity .3s ease;
}
.component-fade-enter, .component-fade-leave-to
  /* .component-fade-leave-active до версии 2.1.8 */ {
  opacity: 0;
}
</style>