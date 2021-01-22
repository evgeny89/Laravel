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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('access');
            $table->timestamps();

        });

        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->unsignedBigInteger('parent_id')
                ->nullable()
                ->default(null);
            $table->bigInteger('min_access')
                ->unsigned()
                ->comment('минимальная роль для доступа к этому пункту меню');
            $table->bigInteger('max_access')
                ->unsigned()
                ->comment('максимальная роль для доступа к этому пункту меню');
            $table->timestamps();


            $table->foreign('min_access')
                ->references('id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('max_access')
                ->references('id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('parent_id')
                ->references('id')
                ->on('menu')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

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
            $table->bigInteger('role_id')
                ->unsigned()
                ->default(2)
                ->comment('роль (user, admin,...)');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
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
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });


        DB::table('roles')->insert([
            [
                'name' => 'guest',
                'access' => 1
            ],
            [
                'name' => 'user',
                'access' => 2
            ],
            [
                'name' => 'moder',
                'access' => 3
            ],
            [
                'name' => 'admin',
                'access' => 4
            ],
            [
                'name' => 'root',
                'access' => 5
            ]
        ]);

        DB::table('menu')->insert(
            [
                [
                    'name' => 'главная',
                    'path' => '/',
                    'parent_id' => null,
                    'min_access' => 1,
                    'max_access' => 5
                ],
                [
                    'name' => 'новости',
                    'path' => '/news',
                    'parent_id' => null,
                    'min_access' => 1,
                    'max_access' => 5
                ],
                [
                    'name' => 'категории',
                    'path' => '/news/categories',
                    'parent_id' => 2,
                    'min_access' => 1,
                    'max_access' => 5
                ],
                [
                    'name' => 'о нас',
                    'path' => '/about',
                    'parent_id' => null,
                    'min_access' => 1,
                    'max_access' => 5
                ],
                [
                    'name' => 'admin',
                    'path' => '/admin',
                    'parent_id' => null,
                    'min_access' => 3,
                    'max_access' => 5
                ],
                [
                    'name' => 'добавить новость',
                    'path' => '/admin/news/add',
                    'parent_id' => 5,
                    'min_access' => 3,
                    'max_access' => 5
                ],
                [
                    'name' => 'категории',
                    'path' => '/admin/category',
                    'parent_id' => 5,
                    'min_access' => 4,
                    'max_access' => 5
                ],
                [
                    'name' => 'Вход',
                    'path' => '/login',
                    'parent_id' => null,
                    'min_access' => 1,
                    'max_access' => 1
                ],
                [
                    'name' => 'личный кабинет',
                    'path' => '/user',
                    'parent_id' => null,
                    'min_access' => 2,
                    'max_access' => 5
                ],
                [
                    'name' => 'Выход',
                    'path' => '/logout',
                    'parent_id' => 9,
                    'min_access' => 2,
                    'max_access' => 5
                ],
                [
                    'name' => 'Пользователи',
                    'path' => '/admin/users',
                    'parent_id' => 5,
                    'min_access' => 4,
                    'max_access' => 5
                ]
            ]
        );
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
