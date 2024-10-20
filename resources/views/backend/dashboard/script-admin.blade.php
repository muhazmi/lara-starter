<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        // total data
        $.ajax({
            url: '{{ route('dashboard.data') }}',
            method: 'GET',
            success: function(response) {
                $('#total_articles').text(response.total_articles);
                $('#total_tags').text(response.total_tags);
            }
        });
    });
</script>
