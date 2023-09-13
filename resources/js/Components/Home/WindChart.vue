<script setup>
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
} from "chart.js";
import { Line } from "vue-chartjs";
import { onMounted, ref, watch } from "vue";
import axios from "axios";
import { average } from '@/Utils/helpers'

const props = defineProps({
    city: {
        type: String,
        default: "Abu Dhabi, UAE",
    }
});

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
);

const loaded = ref(false)
let windDate = ref(new Date().toISOString().split('T')[0]);

const data = {
    labels: ["00","02","04","06","08","10","12","14","16","18","20","22","24",],
    datasets: [
        {
            label: "Wind Speed",
            fill: false,
            borderColor: "red",
            tension: 0.5,
            data: [],
        },
    ],
};

const options = {
    responsive: true,
    maintainAspectRatio: false,
};

const fetchWindData = async () => {
    const app_url = import.meta.env.VITE_APP_URL;
    try {
        let res = await axios.get(
            app_url + `/api/getWind?city=${props.city}&date=${windDate.value}`
        );
        return res.data;
    } catch (error) {
        console.error("Error fetching data from API:", error);
        throw error;
    }
};

const updateChartData = async () => {
    try {
        loaded.value = false;
        const windData = await fetchWindData();
        data.datasets[0].data = windData.data.map((item) => item.wind_speed);
        loaded.value = true;
    } catch (error) {
        console.error("Error fetching data from API:", error);
        throw error;
    }
};

onMounted(async () => {
    try {
        await updateChartData();
    } catch (error) {
        console.error("Error fetching data from API:", error);
        throw error;
    }
});

watch([() => props.city, () => windDate.value], async ([newCity, newWindDate], [oldCity, oldWindDate]) => {
    if (newCity !== oldCity || newWindDate !== oldWindDate) {
        await updateChartData();
    }
});
</script>

<template>
    <div class="w-full chart-container">
        <div class="flex flex-row justify-between my-3">
            <h1 class="font-bold text-xl">Wind (Last 24 Hours)</h1>
            <input type="date" name="wind-date" id="wind-date" class="border-none" v-model="windDate">
        </div>
        <div class="flex flex-row justify-between items-center h-96">
          <div class="font-bold text-2xl">
            {{ average(data.datasets[0].data) }} km/h
          </div>
          <div class="w-full">
            <Line :data="data" :options="options" v-if="loaded"/>
          </div>
        </div>
    </div>
</template>

<style scoped>
.chart-container {
    flex-grow: 1;
    min-height: 0;

    > div {
        position: relative;
        height: 50%;
    }
}
</style>
