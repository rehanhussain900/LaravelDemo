<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiscDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'misc_deposits', function( Blueprint $table ) {
            $table->id();
            $table->unsignedInteger( 'branch_id' );
            $table->unsignedInteger( 'gl_account_number' );
            $table->date( 'deposit_at' );
            $table->double( 'amount', 10, 2, true );
            $table->string( 'vendor' );
            $table->text( 'purpose' )->nullable();
            $table->unsignedBigInteger( 'user_id' );
            $table->timestamps();
            $table->softDeletes();

            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->cascadeOnDelete();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'misc_deposits' );
    }
}
