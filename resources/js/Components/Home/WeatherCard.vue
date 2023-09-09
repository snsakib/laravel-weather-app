<script setup>
defineProps({
  data: Array,
  default: []
})
</script>

<template>
  <div class="bg-purple rounded-3xl p-3">
    <p class="font-bold text-xl">{{ data.city.split(',')[0].trim() }}</p>
    <p>{{ data.city.split(',')[1].trim() }}</p>
  </div>
</template>

<style scoped>
  .bg-purple {
    background-color: #736099;
  }
</style>