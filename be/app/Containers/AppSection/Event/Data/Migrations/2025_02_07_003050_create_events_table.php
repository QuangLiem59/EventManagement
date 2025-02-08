<?php

use App\Containers\AppSection\Event\Models\Event;
use App\Containers\AppSection\Event\Models\EventRegister;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Event::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('content', 500);
            $table->date('date');
            $table->string('location', 200);
            $table->unsignedSmallInteger('capacity');

            $table->timestamps();
        });

        Schema::create(EventRegister::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->string('name', 20);
            $table->enum('gender', config('appSection-event.genders'))->default('unspecified');
            $table->string('email', 100);
            $table->string('phone', 20);

            $table->timestamps();
            $table->foreign('event_id')->references('id')->on(Event::getTableName())->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(EventRegister::getTableName());
        Schema::dropIfExists(Event::getTableName());
    }
};
