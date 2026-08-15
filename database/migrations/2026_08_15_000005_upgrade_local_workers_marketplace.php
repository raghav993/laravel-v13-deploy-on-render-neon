<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::table('local_workers', function(Blueprint $t) { $t->string('gender',20)->nullable()->index(); $t->json('languages')->nullable(); $t->json('certifications')->nullable(); $t->decimal('expected_salary',10,2)->nullable(); $t->string('working_hours',100)->nullable(); $t->enum('verification_status',['unverified','pending','verified'])->default('unverified')->index(); $t->boolean('is_verified')->default(false)->index(); $t->unsignedTinyInteger('profile_completion')->default(0); $t->decimal('rating',3,2)->default(0); $t->unsignedInteger('ratings_count')->default(0); $t->index(['category','city','availability_status']); });
  Schema::create('worker_favorites', function(Blueprint $t){$t->id();$t->foreignId('user_id')->constrained()->cascadeOnDelete();$t->foreignId('local_worker_id')->constrained()->cascadeOnDelete();$t->timestamps();$t->unique(['user_id','local_worker_id']);});
  Schema::create('worker_recent_views', function(Blueprint $t){$t->id();$t->foreignId('user_id')->constrained()->cascadeOnDelete();$t->foreignId('local_worker_id')->constrained()->cascadeOnDelete();$t->timestamps();$t->unique(['user_id','local_worker_id']);});
  Schema::create('worker_reports', function(Blueprint $t){$t->id();$t->foreignId('user_id')->nullable()->constrained()->nullOnDelete();$t->foreignId('local_worker_id')->constrained()->cascadeOnDelete();$t->string('reason',100);$t->text('details')->nullable();$t->timestamps();});
 }
 public function down(): void { Schema::dropIfExists('worker_reports');Schema::dropIfExists('worker_recent_views');Schema::dropIfExists('worker_favorites');Schema::table('local_workers',function(Blueprint $t){$t->dropIndex(['category','city','availability_status']);$t->dropColumn(['gender','languages','certifications','expected_salary','working_hours','verification_status','is_verified','profile_completion','rating','ratings_count']);}); }
};
