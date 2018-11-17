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
            $table->dateTime('birthday');
            $table->string('sex', 6);
            $table->string('passport_series', 10);
            $table->string('passport_id', 10);
            $table->string('issued_by', 40);
            $table->date('issue_date');
            $table->string('identification_number', 30);
            $table->string('birthplace', 30);
            $table->string('residence_city', 30);
            $table->string('address', 40);
            $table->string('home_phone', 20)->nullable();
            $table->string('mobile_phone', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('job', 50)->nullable();
            $table->string('position', 50)->nullable();
            $table->string('registration_city', 30);
            $table->string('family_position', 20);
            $table->string('citizenship');
            $table->string('disability', 20);
            $table->string('pensioner', 5);
            $table->string('monthly_income', 50)->nullable();
            $table->timestamps();

            $table->unique(["id"], 'id_user_informations_UNIQUE');
            $table->unique(["identification_number"], 'identification_number_user_informations_UNIQUE');
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
