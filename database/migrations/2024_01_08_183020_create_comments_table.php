<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Post::class)->nullable();
            $table->foreignIdFor(Comment::class)->nullable();
            $table->unsignedBigInteger('parent_post')->nullable();;
            $table->foreign('parent_post')->references('id')->on('posts')->onDelete('cascade');
            $table->unsignedBigInteger('parent_comment')->nullable();
            $table->foreign('parent_comment')->references('id')->on('comments')->onDelete('cascade');
            $table->string('header');
            $table->text('content');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};
