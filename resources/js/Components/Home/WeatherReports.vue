<script setup>
import WeatherCard from '@/Components/Home/WeatherCard.vue';
defineProps({
  data: {
    type: Array,
    default: []
  }
})
</script>

<template>
  <div class="w-full">
    <h1 class="font-bold text-2xl mb-5">Weather Reports</h1>
    <div class="grid grid-cols-3 gap-5">
      <WeatherCard v-for="(item, key) in data" :key="key" :data="item"/>
    </div>
    
  </div>
</template>