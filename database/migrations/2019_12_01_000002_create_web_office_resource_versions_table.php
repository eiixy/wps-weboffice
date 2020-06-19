<?php

use Eiixy\Rbac\Models\Permission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebOfficeResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_office_resources', function (Blueprint $table) {
            $table->integer('version')->default(0)->comment('文件版本号');
            $table->integer('resource_id');
            $table->string('name');
            $table->string('url');
            $table->integer('size');
            $table->integer('modifier')->comment('修改者');
            $table->timestamps();

            $table->unique(['resource_id', 'version']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rbac_permissions');
    }
}
