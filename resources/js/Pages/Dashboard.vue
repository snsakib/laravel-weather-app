<script setup>
import { Head } from '@inertiajs/vue3';
import SectionMain from '@/Components/SectionMain.vue';
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue';
import WeatherReports from '@/Components/Home/WeatherReports.vue';
import Statistics from '@/Components/Home/Statistics.vue';
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Dashboard" />
    <SectionMain>
      <div class="flex flex-col md:flex-row">
        <WeatherReports/>
        <Statistics/>
      </div>
    </SectionMain>
  </LayoutAuthenticated>
</template>