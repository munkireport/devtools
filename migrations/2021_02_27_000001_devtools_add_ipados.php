<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class DevtoolsAddIpados extends Migration
{
    private $tableName = 'devtools';

    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->text('ipados_sdks')->nullable();
            $table->text('ipados_simulator_sdks')->nullable();
        });
    }

    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->dropColumn('ipados_sdks');
            $table->dropColumn('ipados_simulator_sdks');
        });
    }
}
