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
            $table->uuid('id');
            $table->integer('version')->default(0)->comment('版本号');
            $table->string('name')->nullable()->comment('资源名称');
            $table->string('suffix')->nullable()->comment('后缀');
            $table->float('size')->nullable()->comment('资源大小'); // KB
            $table->string('url')->nullable()->comment('访问地址');
            $table->integer('creator')->nullable()->comment('创建者ID');
            $table->integer('modifier')->nullable()->comment('修改者ID');
            $table->morphs('resourceable');
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
        Schema::dropIfExists('rbac_permissions');
    }
}
