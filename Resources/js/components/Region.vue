<template>
  <div class="region">
    <a href="#" rel="" title="Местонахождение">
      <span>
        {{ region }} <i class="fas fa-angle-down"></i>
      </span>
    </a>
  </div>
    <div class="switcher">
      <div class="switcher-item">
        <span class="switcher-name">Язык</span>

        <div class="switcher-selector">
          <a href="#">
            <span>
              Georgia
            </span>
          </a>
        </div>
      </div>

      <div class="switcher-item">
        <span class="switcher-name">Валюта</span>

        <div class="switcher-selector">
          <a href="#">
            <span>
              Lari
            </span>
          </a>
        </div>
      </div>

  </div>

</template>

<script>
import axios from 'axios'

const APIRequest = '/api/v1/geo/';

export default {
  name: "Region",
  data() {
    return {
        region: null
    }

  },
  mounted() {
    axios
        .get(APIRequest)
        .then(response => {
          const data = response.data.result

          let city = 'ФБР всё видит, '
          let country = 'ФБР всё знает.'

          if(data[0] !== false) {
            city = data.city.name_en
            country = data.country.iso
          }

          let result = city + ', ' + country

          if (city === '') {
             result = 'Неизвестный город, ' + country
          } else if(country === '') {
             result = 'Неизвестная страна'
          } else if(country && city === '') {
            result = 'Неизвестная страна'
          }

          this.region = result
        })

  }
}
</script>

<style>

</style>