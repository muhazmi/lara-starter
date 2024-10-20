<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3 id="total_ready_vehicles"><i class="fas fa-sync-alt fa-spin"></i></h3>
                <p>Mobil Tersedia</p>
            </div>
            <div class="icon">
                <i class="fas fa-car"></i>
            </div>
            <a href="{{ route('products.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3 id="total_booked_vehicles"><i class="fas fa-sync-alt fa-spin"></i></h3>
                <p>Mobil Terpakai</p>
            </div>
            <div class="icon">
                <i class="fas fa-car-side"></i>
            </div>
            <a href="{{ route('categories.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-purple">
            <div class="inner">
                <h3 id="total_maintenance_vehicles"><i class="fas fa-sync-alt fa-spin"></i></h3>
                <p>Mobil Maintenance</p>
            </div>
            <div class="icon">
                <i class="fas fa-screwdriver-wrench"></i>
            </div>
            <a href="{{ route('tags.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3 id="total_vehicles"><i class="fas fa-sync-alt fa-spin"></i></h3>
                <p>Mobil Keseluruhan</p>
            </div>
            <div class="icon">
                <i class="fas fa-car-on"></i>
            </div>
            <a href="{{ route('customers.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3 id="total_products"><i class="fas fa-sync-alt fa-spin"></i></h3>
                <p>Pendapatan Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-rupiah-sign"></i>
            </div>
            <a href="{{ route('products.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3 id="monthly_bookings"><i class="fas fa-sync-alt fa-spin"></i></h3>
                <p>Pendapatan Bulan Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-rupiah-sign"></i>
            </div>
            <a href="{{ route('categories.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3 id="total_tags"><i class="fas fa-sync-alt fa-spin"></i></h3>
                <p>Pendapatan Tahun Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-rupiah-sign"></i>
            </div>
            <a href="{{ route('tags.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-olive">
            <div class="inner">
                <h3 id="total_customers"><i class="fas fa-sync-alt fa-spin"></i></h3>
                <p>Pendapatan Keseluruhan</p>
            </div>
            <div class="icon">
                <i class="fas fa-rupiah-sign"></i>
            </div>
            <a href="{{ route('customers.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
