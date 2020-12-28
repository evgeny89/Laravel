<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')
                ->unique();
            $table->timestamp('email_verified_at')
                ->nullable();
            $table->string('password');
            $table->integer('rank')
                ->default(0)
                ->comment('вклад участника');
            $table->bigInteger('role')
                ->unsigned()
                ->default(1)
                ->comment('роль (user, admin,...)');
            $table->rememberToken();
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title')
                ->unique();
            $table->text('description');
            $table->bigInteger('author_id')
                ->unsigned();
            $table->string('source')
                ->nullable();
            $table->string('attach_media')
                ->nullable();
            $table->bigInteger('category_id')
                ->unsigned();
            $table->set('status', ['added', 'published', 'hidden'])
                ->default('added');
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->bigInteger('parent_id')
                ->unsigned()
                ->nullable()
                ->default(null);
            $table->bigInteger('access')
                ->unsigned()
                ->nullable()
                ->default(null)
                ->comment('минимальная роль для доступа к этому пункту меню');
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));


            $table->foreign('parent_id')
                ->references('id')
                ->on('menu')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('access');
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role')
                ->references('id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('menu', function (Blueprint $table) {
            $table->foreign('access')
                ->references('id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });


        DB::table('roles')->insert([
            [
                'name' => 'user',
                'access' => 1
            ],
            [
                'name' => 'moder',
                'access' => 2
            ],
            [
                'name' => 'admin',
                'access' => 3
            ],
            [
                'name' => 'root',
                'access' => 4
            ]
        ]);

        DB::table('menu')->insert(
            [
                [
                    'name' => 'главная',
                    'path' => '/',
                    'parent_id' => null,
                    'access' => null
                ],
                [
                    'name' => 'новости',
                    'path' => '/news',
                    'parent_id' => null,
                    'access' => null
                ],
                [
                    'name' => 'категории',
                    'path' => '/news/categories',
                    'parent_id' => 2,
                    'access' => null
                ],
                [
                    'name' => 'о нас',
                    'path' => '/about',
                    'parent_id' => null,
                    'access' => null
                ],
                [
                    'name' => 'вход',
                    'path' => '/auth',
                    'parent_id' => null,
                    'access' => null
                ],
                [
                    'name' => 'выход',
                    'path' => '/auth',
                    'parent_id' => null,
                    'access' => 1
                ],
                [
                    'name' => 'admin',
                    'path' => '/admin',
                    'parent_id' => null,
                    'access' => 2
                ],
                [
                    'name' => 'добавить новость',
                    'path' => '/admin/news/add',
                    'parent_id' => 7,
                    'access' => 2
                ],
                [
                    'name' => 'добавить категорию',
                    'path' => '/admin/category/add',
                    'parent_id' => 7,
                    'access' => 3
                ]
            ]
        );

        DB::table('categories')->insert([
            [
                'name' => 'политика',
                'path' => '/news/category/1'
            ],
            [
                'name' => 'спорт',
                'path' => '/news/category/2'
            ],
            [
                'name' => 'культура',
                'path' => '/news/category/3'
            ],
            [
                'name' => 'погода',
                'path' => '/news/category/4'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu');

        Schema::drop('news');

        Schema::drop('categories');

        Schema::drop('users');

        Schema::drop('roles');
    }
}
