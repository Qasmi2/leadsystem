<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExceldatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exceldatas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('sur_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('position')->nullable();
            $table->string('company')->nullable();
            $table->string('department')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('telephone_country')->nullable();
            $table->string('telephone_area')->nullable();
            $table->string('telephone')->nullable();
            $table->string('extention')->nullable();
            $table->string('facsimile_country')->nullable();
            $table->string('facsimile_area')->nullable();
            $table->string('facsimile')->nullable();
            $table->string('mobile_area')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('mobile_area_2')->nullable();
            $table->string('mobile_number_2')->nullable();
            $table->string('email_work')->nullable();
            $table->string('email_private')->nullable();
            $table->string('email')->nullable();
            $table->string('company_website')->nullable();
            $table->string('age_group')->nullable();
            $table->string('nationality')->nullable();
            $table->string('nature_of_business')->nullable();
            $table->string('category')->nullable();
            $table->string('event_id')->nullable();
            $table->string('event_name')->nullable();
            $table->string('event_date')->nullable();
            $table->string('maretingoptns')->nullable();
            $table->string('unsubscribes')->nullable();
            $table->string('history_mwan_events_attend')->nullable();
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('exceldatas');
    }
}
