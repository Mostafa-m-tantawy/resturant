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
            ['name'=>'اطباق رئيسية'  ,'restaurant_id'=>1,'show'=>1],
            ['name'=>'مشويات'  ,'restaurant_id'=>1,'show'=>1],
            ['name'=>'مشروبات'  ,'restaurant_id'=>1,'show'=>1],
            ['name'=>'باستا'  ,'restaurant_id'=>1,'show'=>1],
            ['name'=>"اضافات"  ,'restaurant_id'=>1,'show'=>1],
            ['name'=>'اطباق جانبية'  ,'restaurant_id'=>1,'show'=>0]
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
        $halls=[
            ['name'=>' صالة واحد'  ,'restaurant_id'=>1,'status'=>1],
            ['name'=>'صالة اتنين'  ,'restaurant_id'=>1,'status'=>1],
            ['name'=>'خارجي'  ,'restaurant_id'=>1,'status'=>1],
            ];
        $tables=[
            ['name'=>'S1 - T1' , 'status'=>1,'hall_id'=>1],
            ['name'=>'S1 - T2' ,'status'=>1,'hall_id'=>1],
            ['name'=>'S1 - T3'  ,'status'=>1,'hall_id'=>1],
            ['name'=>'S1 - T4'  ,'status'=>1,'hall_id'=>1],
            ['name'=>'S1 - T5'  ,'status'=>1,'hall_id'=>1],
            ['name'=>'S1 - T6'  ,'status'=>1,'hall_id'=>1],
            ['name'=>'S1 - T7'  ,'status'=>1,'hall_id'=>1],
            ['name'=>'S1 - T8'  ,'status'=>1,'hall_id'=>1],
            ['name'=>'S2 - T1'  ,'status'=>1,'hall_id'=>2],
            ['name'=>'S2 - T2' ,'status'=>1,'hall_id'=>2],
            ['name'=>'S2 - T3'  ,'status'=>1,'hall_id'=>2],
            ['name'=>'S2 - T4'  ,'status'=>1,'hall_id'=>2],
            ['name'=>'S2 - T5'  ,'status'=>1,'hall_id'=>2],
            ['name'=>'S2 - T6'  ,'status'=>1,'hall_id'=>2],
            ['name'=>'S2 - T7' ,'status'=>1,'hall_id'=>2],
            ['name'=>'S2 - T8'  ,'status'=>1,'hall_id'=>2],
            ['name'=>'S3 - T1'  ,'status'=>1,'hall_id'=>3],
            ['name'=>'S3 - T2'  ,'status'=>1,'hall_id'=>3],
            ['name'=>'S3 - T3' ,'status'=>1,'hall_id'=>3],
            ['name'=>'S3 - T4'  ,'status'=>1,'hall_id'=>3],
            ];

        DB::table('departments')->insert($departments);
        DB::table('product_categories')->insert($productcategories);
        DB::table('dish_categories')->insert($dishcategories);
        DB::table('units')->insert($units);
        DB::table('halls')->insert($halls);
        DB::table('tables')->insert($tables);

    }
}
