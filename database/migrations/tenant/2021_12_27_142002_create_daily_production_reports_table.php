<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyProductionReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_production_reports', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger( 'customer_number' );
            $table->string('customer_name');
            $table->string('address');
            $table->string('service_code');
            $table->double('value', 8, 2);
            $table->time('time_in');
            $table->time('time_out');
            $table->time('service_time');
            $table->boolean('confirmed');
            $table->enum( 'status', [ 'Submitted', 'Approved', 'Declined', 'Uploaded' ] );
            $table->unsignedBigInteger( 'tech_id' );
            $table->timestamps();
            $table->softDeletes();

            $table->foreign( 'tech_id' )->references( 'id' )->on( 'users' )->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_production_reports');
    }
}
