<script setup>
import LineChart from "@/Components/Charts/LineChart.vue";
import * as chartConfig from "@/Components/Charts/chart.config.js";
import { ref, onMounted } from "vue";
import axios from "axios";

const chartData = ref([]);

const fetchTempData = async () => {
    try {
        let res = await axios.get(
            "http://localhost:8000/api/getTemperature?city=Abu Dhabi, UAE&date=2023-09-10"
        );
        return res.data;
    } catch (error) {
        console.error("Error fetching data from API:", error);
        throw error;
    }
};
// chartData.value = chartConfig.sampleChartData()
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
            ],
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: {
                        type: "time",
                        time: {
                            unit: "second",
                        },
                    },
                    yAxes: {
                        beginAtZero: true,
                    },
                },
            },
        };
    } catch (error) {
        console.error("Error fetching data from API:", error);
        throw error;
    }
});
</script>

<template>
    <div class="w-full">
        <div>
            <h1 class="font-bold text-xl my-3">Temperature (Last 24 Hours)</h1>
        </div>
        <div class="w-full h-96">
            <line-chart :data="chartData" class="h-96" />
        </div>
    </div>
</template>
