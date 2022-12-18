<!-- Custom the search form UI -->
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo get_home_url(); ?>">
    <div class="form-group">
        <div class="d-flex align-items-center wrapper rounded">
            <label class="search-label" for="s">
                <i class="fa fa-search" aria-hidden="true"></i>
            </label>
            <input type="text" value="" name="s" id="s" class="form-control" placeholder="<?php echo Resource::text('header.search.placeholder', 'homepage'); ?>">
            <input type="submit" id="searchsubmit" value="Search" class="d-none">
        </div>
    </div>
</form>