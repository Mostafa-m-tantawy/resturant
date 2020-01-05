<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments=[
            ['name'=>'مطبخ'     ,'restaurant_id'=>1],
            ['name'=>"باريستا"    ,'restaurant_id'=>1]
        ];
        $dishcategories=[
            ['name'=>'اطباق رئيسية'  ,'restaurant_id'=>1],
            ['name'=>"اضافات"  ,'restaurant_id'=>1],
            ['name'=>'مشويات'  ,'restaurant_id'=>1],
            ['name'=>'مشروبات'  ,'restaurant_id'=>1],
            ['name'=>'باستا'  ,'restaurant_id'=>1]
        ];
        $productcategories=[
            ['name'=>'بهارات'   ,'restaurant_id'=>1],
            ['name'=>'خبز'  ,'restaurant_id'=>1],
            ['name'=>'مشروبات'  ,'restaurant_id'=>1],
            ['name'=>'سيرب'  ,'restaurant_id'=>1],
            ['name'=>'معلبات'  ,'restaurant_id'=>1],
            ['name'=>'البان'  ,'restaurant_id'=>1]];

        $units=[
            ['unit'=>'دسته','child_unit'=>'باكو','convert_rate'=>12,'restaurant_id'=>1],
            ['unit'=>'كيلو','child_unit'=>'جرام','convert_rate'=>1000,'restaurant_id'=>1],
            ['unit'=>'طن','child_unit'=>'كيلو','convert_rate'=>1000,'restaurant_id'=>1],
            ['unit'=>'لتر','child_unit'=>'ملي لتر ','convert_rate'=>1000,'restaurant_id'=>1],
        ];

        DB::table('departments')->insert($departments);
        DB::table('product_categories')->insert($productcategories);
        DB::table('dish_categories')->insert($dishcategories);
        DB::table('units')->insert($units);

    }
}
