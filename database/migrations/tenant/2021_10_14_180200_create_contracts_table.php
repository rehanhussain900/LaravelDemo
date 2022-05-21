<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'contracts', function( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'user_id' )->nullable();
            $table->string( 'envelope_id' )->nullable();
            $table->string( 'customer_name' );
            $table->string( 'service_address' );
            $table->string( 'service_city' );
            $table->unsignedBigInteger( 'service_state_id' );
            $table->string( 'service_zip' );
            $table->string( 'business_name' )->nullable();
            $table->string( 'billing_name' );
            $table->string( 'billing_address' );
            $table->string( 'billing_city' );
            $table->unsignedBigInteger( 'billing_state_id' );
            $table->string( 'billing_zip' );
            $table->string( 'phone_1' );
            $table->string( 'phone_2' );
            $table->string( 'attention_line' );
            $table->string( 'email' );
            $table->string( 'account_number' );
            $table->string( 'proposed_by' );
            $table->date( 'contract_date' );
            $table->double( 'total_all_programs', 10, 2 );
            $table->enum( 'status', [ 'Pending', 'Sent', 'Signed', 'Sold', 'Declined' ] );
            $table->timestamps();
            $table->softDeletes();

            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'contracts' );
    }
}
