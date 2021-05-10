<template>
    <a href="#" rel="" title="Местонахождение" class="red-hover region">{{ region }} <i></i></a>
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

          const city = data.city.name_en
          const country = data.country.iso

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

<style scoped>

</style>