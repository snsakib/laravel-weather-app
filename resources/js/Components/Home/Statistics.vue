<script setup>
import TemperatureChart from '@/Components/Home/TemperatureChart.vue';
import WindChart from '@/Components/Home/WindChart.vue'
import HumidityChart from '@/Components/Home/HumidityChart.vue';
import { ref } from 'vue';

let selectedCity = ref('Abu Dhabi, UAE');
</script>

<template>
  <div class="w-full p-3">
    <div class="flex flex-row justify-between">
      <h1 class="font-bold text-2xl">Statistics</h1>
      <select class="border-none font-bold" name="city" id="city" v-model="selectedCity">
        <option class="font-bold" value="Abu Dhabi, UAE">Abu Dhabi, UAE</option>
        <option class="font-bold" value="Dubai, UAE">Dubai, UAE</option>
        <option class="font-bold" value="Sharjah, UAE">Sharjah, UAE</option>
        <option class="font-bold" value="London, UK">London, UK</option>
        <option class="font-bold" value="New York, USA">New York, USA</option>
        <option class="font-bold" value="Tokyo, Japan">Tokyo, Japan</option>
      </select>
    </div>
    <TemperatureChart :city="selectedCity"/>
    <WindChart :city="selectedCity"/>
    <HumidityChart :city="selectedCity"/>
  </div>
</template>