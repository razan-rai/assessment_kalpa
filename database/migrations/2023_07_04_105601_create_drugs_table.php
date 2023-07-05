<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('applicant_id')->unsigned();
            $table->foreign('applicant_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('verified_by')->unsigned();
            $table->foreign('verified_by')->references('id')->on('users')
                ->onUpdate('cascade')->nullable();
            $table->string('brand_name');
            $table->string('bar_code')->nullable();
            $table->string('application_type')->nullable();
            $table->boolean('status')->comment('0=>unverified, 1=>verified, 2=>rejected')->default(0);
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->longText('note')->nullable();
            $table->timestamp('verifiyed_on')->nullable();
            $table->timestamp('unverifiyed_on')->nullable();
            $table->timestamp('manufacture_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drugs');
    }
};
