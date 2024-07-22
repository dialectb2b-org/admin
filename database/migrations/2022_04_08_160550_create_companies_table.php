<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('pobox');
            $table->string('fax');
            $table->string('address');
            $table->string('zone');

            $table->string('street');
            $table->string('building');
            $table->string('unit');
            $table->string('country_id');
            $table->string('region_id');
         
            $table->string('logo')->nullable();
            $table->string('domain')->nullable();
            $table->integer('added_by')->nullable();
            $table->string('approval_status')->nullable();
            $table->string('isVerified')->nullable();
            $table->string('isDocVerified')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
