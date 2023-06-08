<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class PorductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        return new Product([
            'id'                => Str::uuid(),
            'user_id'           => $row['0'],
            'product'           => $row['1'],
            'category_id'       => $row['2'],
            'subcategory_id'    => $row['3'],
            'brand_id'          => $row['4'],
            'slug'              => $row['5'],
            'sku'               => $row['6'],
            'price'             => $row['7'],
            'discount'          => $row['8'],
            'comission'         => $row['9'],
            'shipping_cost'     => $row['10'],
            'quantity'          => $row['11'],
            'published'         => $row['12'],
            'short_description' => $row['13'],
            'featured'          => $row['14'],
            'status'            => $row['15'],
            'order'             => $row['16']
        ]);
    }
}
