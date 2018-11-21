<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('father_name', 20);
            $table->date('birthday');
            $table->string('sex', 6);
            $table->string('passport_series', 3);
            $table->string('passport_id', 10);
            $table->string('issued_by', 40);
            $table->date('issue_date');
            $table->string('identification_number', 30);
            $table->string('birthplace', 30);
            $table->unsignedInteger('residence_cities_id');
            $table->string('address', 40);
            $table->string('home_phone', 20)->nullable();
            $table->string('mobile_phone', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('job', 50)->nullable();
            $table->string('position', 50)->nullable();
            $table->unsignedInteger('registration_cities_id');
            $table->unsignedInteger('family_positions_id');
            $table->unsignedInteger('citizenships_id');
            $table->unsignedInteger('disabilities_id');
            $table->string('pensioner', 5);
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->timestamps();

            $table->unique(["id"], 'id_user_informations_UNIQUE');
            $table->unique(["identification_number"], 'identification_number_user_informations_UNIQUE');

            $table->foreign('residence_cities_id')->references('id')->on('residence_cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('registration_cities_id')->references('id')->on('registration_cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('family_positions_id')->references('id')->on('family_positions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('citizenships_id')->references('id')->on('citizenships')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('disabilities_id')->references('id')->on('disabilities')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_informations');
    }
}
