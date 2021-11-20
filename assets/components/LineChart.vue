<template>
    <div>
        <canvas id="line-chart"></canvas>
    </div>
</template>

<script>
    import Chart from 'chart.js'

    export default {
        name: 'LineChart',
        data() {
            return {
                data: {
                    type: "line"
                }
            }
        },
        mounted() {
            const ctx = document.getElementById('line-chart');
            if (ctx !== null) {
                new Chart(ctx, this.data);
            }
        },
        methods: {
            update: (labels, data, reviews) => {
                const ctx = document.getElementById('line-chart');
                if (ctx !== null) {
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                backgroundColor: 'transparent',
                                pointBackgroundColor: '#F2A727'
                            }]
                        },
                        options: {
                            responsive: true,
                            legend: {
                                display: false,
                            },
                            tooltips: {
                                enabled: true,
                                titleFontSize: 0,
                                bodyFontSize: 15,
                                displayColors: false,
                                bodyAlign: 'center',
                                callbacks: {
                                    title: () => null,
                                    label: ((tooltipItems) => {
                                        return [
                                            'Score: ' + tooltipItems.value,
                                            'Review Count: ' + reviews[tooltipItems.index]
                                        ];
                                    })
                                }
                            }
                        }
                    });
                }
            }
        }
    }
</script>