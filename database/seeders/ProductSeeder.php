<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        DB::table('product_tag')->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();
        Tag::query()->truncate();

        Tag::factory(15)->create();
        foreach(['S','M','L','XL','XXL'] as $size) {

            ProductSize::query()->create([

                'name'=> $size
            ]);
        }

        //white, black , red , lime(green) , blue, yellow
        foreach(['#FFFFFF','#000000','#FF0000','#00FF00','#0000FF','#FFFF00'] as $color) {

            ProductColor::query()->create([

                'name'=> $color
            ]);
        }

        for ($i=0; $i <100 ; $i++) { 
            $priceRegular = fake()->numberBetween(100000, 1000000);

            // Tính tỷ lệ giảm giá ngẫu nhiên từ 10% đến 20%
            $discountRate = fake()->numberBetween(10, 20) / 100;
        
            // Tạo giá trị cho price_sale dựa trên tỷ lệ giảm giá
            $priceSale = $priceRegular * (1 - $discountRate);
        
            $name = fake()->text(100);

            Product::query()->create([

                'catelogue_id' => rand(1,10 ), 
                'name' => $name,
                'slug' => Str::slug($name). '-'. Str::random(8), 
                'sku' => Str::random(7).$i, 
                'img_thumbnail' =>'https://canifa.com/img/1000/1500/resize/8/b/8bj24s003-sj859-31-1-u.webp', 
                'price_regular' =>$priceRegular,
                'price_sale' => round($priceSale),   

            ]);
        }

        for ($i=0; $i <101 ; $i++) { 
            ProductGallery::query()->insert([
                    [
                        'product_id' => $i, 
                        'image' =>'https://canifa.com/img/1000/1500/resize/8/b/8bj24s003-sj859-31-1-u.webp', 
                    ],
                    [
                        'product_id'=> $i,
                        'image'=> 'https://canifa.com/img/486/733/resize/8/b/8bs24s002-sk010-1-thumb.webp',
                    ]
            
            ]);
        }

        for ($i=0; $i <101 ; $i++) { 
           DB::table('product_tag')->insert([

           [
            'product_id' =>$i,
            'tag_id' => rand(1, 8)],

           [
            'product_id' => $i,
             'tag_id' =>rand(9, 15)],
        
        ]);

        }

        for ($productID=1; $productID <101 ; $productID++) { 
            $data = [];
            for ($sizeID=1; $sizeID <6 ; $sizeID++) { 
                for ($colorID=1; $colorID <7 ; $colorID++) { 
                    $data= [
                        'product_id' => $productID, 
                        'product_size_id' => $sizeID, 
                        'product_color_id' => $colorID, 
                        'quantity' => fake()->numberBetween(1, 20),
                        'image' => 'https://canifa.com/img/486/733/resize/8/b/8bs23s015-sk010-xl-1.webp',
                    ];
                }
            }
            DB::table('product_variants')->insert($data);
        }
    }
}
