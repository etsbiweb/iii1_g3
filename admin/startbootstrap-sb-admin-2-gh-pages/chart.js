<script>
const ctx = document.getElementById('zaradaChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun'],
        datasets: [{
            label: 'Zarada ($)',
            data: [5000, 7000, 9000, 12000, 15000, 17000],
            backgroundColor: 'rgba(255, 0, 0, 0.2)',
            borderColor: '#c8102e',
            borderWidth: 3
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
