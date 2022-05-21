<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_branch', function (Blueprint $table) {
            $table->primary( [ 'user_id', 'branch_id' ] );
            $table->unsignedBigInteger( 'branch_id' );
            $table->unsignedBigInteger( 'user_id' );
            $table->timestamps();

            $table->foreign( 'branch_id' )
                  ->references( 'id' )
                  ->on( 'pest_pac_branches' )
                  ->onDelete( 'cascade' );

            $table->foreign( 'user_id' )
                  ->references( 'id' )
                  ->on( 'users' )
                  ->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_branch');
    }
}
