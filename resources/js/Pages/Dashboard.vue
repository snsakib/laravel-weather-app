<script setup>
import { Head } from '@inertiajs/vue3';
import SectionMain from '@/Components/SectionMain.vue';
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue';
import WeatherReports from '@/Components/Home/WeatherReports.vue';
import Statistics from '@/Components/Home/Statistics.vue';

defineProps({
  data: {
    type: Array,
    default: []
  }
})
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Dashboard" />
    <SectionMain>
      <div class="flex flex-col md:flex-row">
        <WeatherReports :data="data"/>
        <Statistics/>
      </div>
    </SectionMain>
  </LayoutAuthenticated>
</template>