<template>
    <a href="#" rel="" title="Местонахождение">
      {{ region }} <i></i>
    </a>
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