<section>
    <h2 class="ui header">Chung</h2>
    <div class="ui three statistics">


        <a class="ui statistic" href="/manage/products">
            <div class="value">
                {{\App\Product::count()}}
            </div>
            <div class="label">
                Sản phẩm
            </div>
        </a>

        <a class="ui statistic" href="/manage/products">
            <div class="value">
                {{\App\Category::count()}}
            </div>
            <div class="label">
                Danh mục
            </div>
        </a>


        <a class="ui statistic" href="/manage/users">
            <div class="value">
                {{\App\User::count()}}
            </div>
            <div class="label">
                Người dùng
            </div>
        </a>


        <a class="ui statistic" href="/manage/orders">
            <div class="value">
                {{\App\Order::count()}}
            </div>
            <div class="label">
                Đơn hàng
            </div>
        </a>
        <a class="ui statistic" href="/manage/orders">
            <div class="value">
                {{\App\Blog::count()}}
            </div>
            <div class="label">
                Bài viết
            </div>
        </a>

        <a class="ui statistic" href="/manage/orders">
            <div class="value">
                {{\App\Discount::count()}}
            </div>
            <div class="label">
                Mã giảm giá
            </div>
        </a>
    </div>
</section>