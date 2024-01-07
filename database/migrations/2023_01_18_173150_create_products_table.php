<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\Csv\Reader;
use League\Csv\Writer;


return new class extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->longText('url');
            $table->string('status');
            $table->integer('price');
            $table->timestamps();
        });

        // sample products from public folder
        $filePath = public_path('') . '/products.csv';
        $csv = Reader::createFromPath( $filePath );
        $csv->setHeaderOffset(0);
        foreach ($csv as $record) {
            Product::create([
                "title" => $record['title'],
                "description" => $record['description'],
                "url" => $record['url'],
                "status" => $record['status'],
                "price" => $record['price']
            ]);

            
        }
        echo 'Sample products inserted';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
