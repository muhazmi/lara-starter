<div class="row">
    <div class="col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3 id="total_users"><i class="fas fa-sync-alt fa-spin"></i></h3>
                <p>User</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('users.index') }}" class="small-box-footer">
                Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3 id="total_customers"><i class="fas fa-sync-alt fa-spin"></i></h3>
                <p>Customer</p>
            </div>
            <div class="icon">
                <i class="fas fa-car-side"></i>
            </div>
            <a href="{{ route('customers.index') }}" class="small-box-footer">
                Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
