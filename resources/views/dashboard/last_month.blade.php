<section>
    <h2 class="ui header">Last month</h2>
    <div class="ui three statistics">


        <a class="ui statistic" href="/manage/products">
            <div class="value">
                {{$products_added}}
            </div>
            <div class="label">
                Products added
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

        <div class="ui statistic">
            <div class="value">
                {{$total_sold}}
            </div>
            <div class="label">
                Products sold
            </div>
        </div>
        <div class="ui statistic">
            <div class="value">
                {{$total_revenue}} $
            </div>
            <div class="label">
                Revenue
            </div>
        </div>
    </div>
</section>