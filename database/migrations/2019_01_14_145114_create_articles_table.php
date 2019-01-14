<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',180)->comment('标题');
            $table->string('desc',255)->comment('描述');
            $table->string('type',50)->comment('文章类型');
            $table->string('cover')->comment('封面')->nullable();
            $table->integer('price')->comment('价格')->default(0);
            $table->text('content')->comment('内容');
            $table->integer('star')->comment('点赞')->default(0);
            $table->integer('view')->comment('浏览')->default(0);
            $table->integer('collect')->comment('收藏')->default(0);
            $table->integer('is_show')->comment('是否显示')->default(0);
            $table->integer('is_check')->comment('是否审核')->default(0);
            $table->integer('allow_comment')->comment('允许评论')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
