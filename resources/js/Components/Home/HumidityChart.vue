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
const humidityDate = ref(new Date().toISOString().split('T')[0]);

const data = {
    labels: ["00","02","04","06","08","10","12","14","16","18","20","22","24",],
    datasets: [
        {
            label: "Humidity",
            fill: false,
            borderColor: "blue",
            tension: 0.5,
            data: [],
        },
    ],
};

const options = {
    responsive: true,
    maintainAspectRatio: false,
};

const fetchHumidityData = async () => {
    const app_url = import.meta.env.VITE_APP_URL;
    try {
        let res = await axios.get(
            app_url + `/api/getHumidity?city=${props.city}&date=${humidityDate.value}`
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
        const humidityData = await fetchHumidityData();
        data.datasets[0].data = humidityData.data.map((item) => item.humidity);
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

watch([() => props.city, () => humidityDate.value], async ([newCity, newHumidityDate], [oldCity, oldHumidityDate]) => {
    if (newCity !== oldCity || newHumidityDate !== oldHumidityDate) {
        await updateChartData();
    }
});
</script>

<template>
    <div class="w-full my-5">
        <div class="flex flex-row justify-between my-3">
            <h1 class="font-bold text-xl my-3">Humidity (Last 24 Hours)</h1>
            <input type="date" name="humidity-date" id="humidity-date" class="border-none" v-model="humidityDate">
        </div>
        <div class="w-full h-96">
            <Line :data="data" :options="options" v-if="loaded"/>
        </div>
    </div>
</template>