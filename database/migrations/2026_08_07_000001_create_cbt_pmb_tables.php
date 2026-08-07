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
        // 1. admins
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // 2. exams
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->integer('duration')->default(90); // in minutes
            $table->boolean('shuffle_questions')->default(true);
            $table->boolean('shuffle_options')->default(true);
            $table->boolean('fullscreen_enabled')->default(true);
            $table->boolean('autosave_enabled')->default(true);
            $table->boolean('anti_cheat_enabled')->default(true);
            $table->integer('max_violation')->default(3);
            $table->string('status')->default('active'); // draft, active, finished
            $table->timestamps();
        });

        // 3. questions
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->cascadeOnDelete();
            $table->text('question_text');
            $table->decimal('weight', 8, 2)->default(2.00);
            $table->timestamps();
        });

        // 4. question_options
        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();
            $table->text('option_text');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });

        // 5. participants
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->cascadeOnDelete();
            $table->string('name');
            $table->string('school_origin');
            $table->string('major_choice_1');
            $table->string('major_choice_2');
            $table->timestamps();
        });

        // 6. exam_sessions
        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->constrained('participants')->cascadeOnDelete();
            $table->foreignId('exam_id')->constrained('exams')->cascadeOnDelete();
            $table->dateTime('started_at');
            $table->dateTime('finished_at')->nullable();
            $table->string('status')->default('ongoing'); // ongoing, finished
            $table->text('question_order')->nullable(); // JSON array
            $table->text('option_order')->nullable();   // JSON object
            $table->integer('violation_count')->default(0);
            $table->string('security_status')->default('Aman'); // Aman, Mendapat Peringatan, Terindikasi Pelanggaran, Perlu Review Admin
            $table->decimal('score', 8, 2)->nullable();
            $table->timestamps();
        });

        // 7. participant_answers
        Schema::create('participant_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('exam_sessions')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();
            $table->foreignId('option_id')->nullable()->constrained('question_options')->cascadeOnDelete();
            $table->boolean('is_doubt')->default(false);
            $table->timestamps();
        });

        // 8. exam_activity_logs
        Schema::create('exam_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('exam_sessions')->cascadeOnDelete();
            $table->string('activity_type');
            $table->text('description')->nullable();
            $table->integer('violation_number')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_activity_logs');
        Schema::dropIfExists('participant_answers');
        Schema::dropIfExists('exam_sessions');
        Schema::dropIfExists('participants');
        Schema::dropIfExists('question_options');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('exams');
        Schema::dropIfExists('admins');
    }
};
