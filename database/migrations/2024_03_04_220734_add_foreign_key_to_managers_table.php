<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToManagersTable extends Migration
{
    public function up()
    {
        Schema::table('managers', function (Blueprint $table) {
            // Add foreign key constraint
            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade'); // This ensures that if a role is deleted, all associated managers will also be deleted.
        });
    }

    public function down()
    {
        Schema::table('managers', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['role_id']);
        });
    }
}
