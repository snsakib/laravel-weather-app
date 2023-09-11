<script setup>
import LineChart from "@/Components/Charts/LineChart.vue";
import { ref, onMounted, watch } from "vue";
import axios from "axios";

const props = defineProps({
  city: {
    type: String,
    default: 'Dubai, UAE'
  }
});

const chartData = ref([]);

const fetchTempData = async () => {
  const app_url = import.meta.env.VITE_APP_URL;
    try {
        let res = await axios.get(
            app_url + `/api/getTemperature?city=${props.city}&date=2023-09-10`
        );
        return res.data;
    } catch (error) {
        console.error("Error fetching data from API:", error);
        throw error;
    }
};

onMounted(async () => {
    try {
        const data = await fetchTempData();
        chartData.value = {
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
                    data: data.data.map((item) => item.temperature),
                    fill: false,
                    borderColor: 'blue',
                    tension: 0.5,
                },
            ]
        };
    } catch (error) {
        console.error("Error fetching data from API:", error);
        throw error;
    }
});
</script>

<template>
    <div class="w-full">
      {{ city }}
        <div>
            <h1 class="font-bold text-xl my-3">Temperature (Last 24 Hours)</h1>
        </div>
        <div class="w-full h-96">
            <line-chart :data="chartData" class="h-96" />
        </div>
    </div>
</template>
