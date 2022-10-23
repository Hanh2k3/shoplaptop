<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('category_id')
                -> foreign('category_id') 
                ->references('id') ;
                    

            $table ->bigInteger('brand_id')
                    -> foreign('brand_id') 
                    ->references('id') 
                    -> on('brand');
            $table ->text('description');
            $table ->text('content');
            $table ->string('price');
            $table ->string('image');
            $table->tinyInteger('status');
            $table->timestamps();

           
         
                   
                   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
