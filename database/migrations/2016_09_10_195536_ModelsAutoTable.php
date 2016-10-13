<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModelsAutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks_auto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        Schema::create('models_auto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mark_id');
            $table->string('name');
        });

        Schema::create('auto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('mark_id');
            $table->integer('model_id');
            $table->string('number');
            $table->integer('year')->nullable();
            $table->date('date_kont')->nullable();
            $table->date('date_rem')->nullable();
            $table->string('rem_kil')->nullable();
            $table->boolean('devices')->default(false);
            $table->text('comments')->nullable();
            $table->boolean('devise_bool')->default(false);
            $table->timestamps();
        });
        Schema::create('device', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('category')->nullable();
            $table->integer('mark_id');
            $table->integer('model_id');

            $table->string('version')->nullable();
            $table->integer('year')->nullable();

            $table->date('date_kont')->nullable();
            $table->date('date_rem')->nullable();
            $table->string('rem_time')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
        });
        Schema::create('zapros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('object')->nullable();
            $table->string('zadanie')->nullable();
            $table->text('description')->nullable();
            $table->text('comments_tehnics')->nullable();
            $table->integer('done')->default(0);
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('value');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marks_auto');
        Schema::dropIfExists('models_auto');
        Schema::dropIfExists('auto');
        Schema::dropIfExists('device');
        Schema::dropIfExists('zapros');
        Schema::dropIfExists('settings');
    }
}
