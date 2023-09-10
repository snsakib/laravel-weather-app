<script setup>
defineProps({
  data: Array,
  default: []
})
</script>

<template>
  <div class="bg-purple rounded-3xl p-3">
    <p class="font-bold text-xl text-white">{{ data.city.split(',')[0].trim() }}</p>
    <p class="text-white">{{ data.city.split(',')[1].trim() }}</p>
    <img class="text-center py-3" src="assets/img/rain.svg" alt="weather-icon"/>
    <p class="text-4xl text-center font-bold pt-3 pb-5 text-purple-100">{{ data.data.main.temp }} <span class="text-blue-400">&#8451;</span></p>
  </div>
</template>

<style scoped>
  .bg-purple {
    background-color: #736099;
  }
</style>