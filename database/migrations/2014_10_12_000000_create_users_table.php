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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->enum('role',['user', 'admin', 'superadmin'])->default('user');

            $table->bigInteger('parent_id')->unsigned()->nullable();
            // $table->foreign('parent_id')->references('id')->on('users');
            $table->bigInteger('sponsor_id')->unsigned()->nullable();
            // $table->foreign('sponsor_id')->references('id')->on('users');

            $table->string('position')->nullable();
            $table->string('status')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contact_no')->unique()->nullable();
            $table->timestamp('contact_no_verified_at')->nullable();
            $table->string('password')->nullable();;
            $table->string('passcode')->nullable();;

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pincode')->nullable();
            $table->string('pancard')->nullable();
            $table->string('adharcard')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('branch_address')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('account_type')->nullable();
            $table->string('pancard_image')->nullable();
            $table->string('adharcard_image')->nullable();
            $table->string('passbook_image')->nullable();
            $table->string('address_proof_image')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
