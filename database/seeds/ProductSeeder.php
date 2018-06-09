<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = file_get_contents('~/sandal.json');
        $all_images="";
        foreach (collect(json_decode($contents,true))->sortBy("_id")->take(100) as $row) {
            $model = \App\Product::firstOrNew(['id'=>$row['_id']]);
//            $model->delete();
            $model->name=$row['name'];
            $model->full_html_detail=$row['full_html_detail'];
            $model->image_urls=$row['image_urls'];
            $model->category_id=4;
            $model->price=$row['price'];
            $model->sale_off=$row['sale_off'];
            $model->save();
            $all_images=$all_images.$model->image_urls.";";
        }
        file_put_contents("~/sandal.txt",str_replace(';',"\n",$all_images));
    }
}
