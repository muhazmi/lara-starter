@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <form action="{{ route('reports.export_income_statements') }}" method="POST">
            @csrf
            <div class="card-body">
                {{-- <!-- Pilih Jenis Laporan -->
                <div class="form-group">
                    <label for="time_filter_type">{{ __('Select Report Period') }}</label>
                    <select name="time_filter_type" id="time_filter_type" class="form-control">
                        <option value="monthly">{{ __('Monthly') }}</option>
                        <option value="quarterly">{{ __('Quarterly') }}</option>
                        <option value="yearly">{{ __('Yearly') }}</option>
                        <option value="date_range">{{ __('Custom Date Range') }}</option>
                    </select>
                </div>

                <!-- Input Bulan dan Tahun -->
                <div class="form-group" id="month_picker">
                    <label for="month">{{ __('Select Month') }}</label>
                    <input type="month" name="month" id="month" class="form-control">
                </div> --}}

                <!-- Input Tahun -->
                <div class="form-group" id="year_picker">
                    <label for="year">{{ __('Select Year') }}</label>
                    <input type="number" name="year" id="year" class="form-control" placeholder="{{ __('Enter Year') }}" min="2000" value="{{ date('Y')}}">
                </div>

                {{-- <!-- Input Rentang Tanggal (Date Range) -->
                <div class="form-group" id="date_range_picker">
                    <label for="date_range">{{ __('Date Range') }}</label>
                    <input type="text" name="date_range" id="date_range" class="form-control">
                </div> --}}
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary form-control">
                    <i class="fa fa-file-excel"></i> {{ __('Download') }}
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script_addon_footer')
    <!-- daterangepicker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <script type="text/javascript" src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $(function() {
            // Initialize date range picker for custom date range selection
            $('#date_range').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

            // Initially hide month picker and date range picker
            $('#month_picker').hide();
            $('#date_range_picker').hide();

            // Handle form display based on selected report period
            $('#time_filter_type').on('change', function() {
                const filterType = $(this).val();
                
                if (filterType === 'monthly') {
                    $('#month_picker').show();
                    $('#year_picker').show();
                    $('#date_range_picker').hide();
                } else if (filterType === 'yearly') {
                    $('#year_picker').show();
                    $('#month_picker').hide();
                    $('#date_range_picker').hide();
                } else if (filterType === 'date_range') {
                    $('#date_range_picker').show();
                    $('#month_picker').hide();
                    $('#year_picker').hide();
                } else {
                    $('#month_picker').hide();
                    $('#year_picker').hide();
                    $('#date_range_picker').hide();
                }
            });

            // SweetAlert loading for All Export Form Submissions
            const exportForms = document.querySelectorAll('form');

            exportForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent default form submission

                    // Show SweetAlert loading animation
                    Swal.fire({
                        title: '{{ __('Processing') }}',
                        text: '{{ __('Please wait while we generate your report') }}',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Submit form after small delay
                    setTimeout(() => {
                        Swal.close(); // Close SweetAlert before submitting
                        form.submit(); // Proceed with form submission
                    }, 1000);
                });
            });
        });
    </script>
@endsection
