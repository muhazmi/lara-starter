<div class="row">
    <div class="col-lg-6 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3 id="total_articles"><i class="fas fa-sync-alt fa-spin"></i></h3>
                <p>{{ __('Article') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-credit-card"></i>
            </div>
            <a href="{{ route('articles.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-6 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3 id="total_tags"><i class="fas fa-sync-alt fa-spin"></i></h3>
                <p>{{ __('Tags') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-tag"></i>
            </div>
            <a href="{{ route('tags.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
