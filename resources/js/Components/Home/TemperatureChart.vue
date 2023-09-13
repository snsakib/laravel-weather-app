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
    },
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

const loaded = ref(false);
const tempDate = ref(new Date().toISOString().split('T')[0]);

const data = {
    labels: [
        "00",
        "02",
        "04",
        "06",
        "08",
        "10",
        "12",
        "14",
        "16",
        "18",
        "20",
        "22",
        "24",
    ],
    datasets: [
        {
            label: "Temperature",
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

const fetchTempData = async () => {
    const app_url = import.meta.env.VITE_APP_URL;
    try {
        let res = await axios.get(
            app_url + `/api/getTemperature?city=${props.city}&date=${tempDate.value}`
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
        const tempData = await fetchTempData();
        data.datasets[0].data = tempData.data.map((item) => item.temperature);
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

watch([() => props.city, () => tempDate.value], async ([newCity, newTempDate], [oldCity, oldTempDate]) => {
    if (newCity !== oldCity || newTempDate !== oldTempDate) {
      console.log(newCity)
      console.log(newTempDate)
        await updateChartData();
    }
});
</script>

<template>
    <div class="w-full my-5 chart-container">
        <div class="flex flex-row justify-between my-3">
            <h1 class="font-bold text-xl my-3">Temperature (Last 24 Hours)</h1>
            <input
                type="date"
                name="temp-date"
                id="temp-date"
                class="border-none"
                v-model="tempDate"
            />
        </div>
        <div class="w-full h-96">
            <Line :data="data" :options="options" v-if="loaded" />
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
