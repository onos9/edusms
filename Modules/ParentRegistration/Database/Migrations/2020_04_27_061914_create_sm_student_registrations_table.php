<?php

use App\SmLanguagePhrase;
use App\SmGeneralSettings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Modules\MenuManage\Entities\Sidebar;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\RolePermission\Entities\InfixModuleInfo;
use Modules\RolePermission\Entities\InfixPermissionAssign;

class CreateSmStudentRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $config = SmGeneralSettings::first();
        if (@$config->ParentRegistration == 1) {
            Schema::create('sm_student_registrations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();

                $table->integer('class_id')->nullable();
                // $table->foreign('class_id')->references('id')->on('sm_classes')->onDelete('cascade');
                $table->integer('section_id')->nullable();
                // $table->foreign('section_id')->references('id')->on('sm_sections')->onDelete('cascade');
                $table->date('date_of_birth')->nullable();
                $table->string('age')->nullable();
                $table->integer('academic_year')->nullable();

                $table->integer('gender_id')->nullable();
                // $table->foreign('gender_id')->references('id')->on('sm_base_setups')->onDelete('cascade');

                $table->string('student_email')->nullable();
                $table->string('student_mobile')->nullable();
                $table->string('guardian_name')->nullable();
                $table->string('guardian_mobile')->nullable();
                $table->string('guardian_email')->nullable();
                $table->string('guardian_relation')->nullable()->comment('F father, M mother, O other');
                $table->text('how_do_know_us')->nullable();
                $table->integer('created_by')->nullable()->default(1)->unsigned();
                $table->integer('updated_by')->nullable()->default(1)->unsigned();
                $table->integer('school_id')->nullable()->default(1)->unsigned();
                $table->integer('academic_id')->nullable()->default(1)->unsigned();
                // $table->foreign('academic_id')->references('id')->on('sm_academic_years')->onDelete('cascade');

                $table->timestamps();
            });
        }
        try{
            if (Schema::hasTable('sm_general_settings')){
                $academic_id=SmGeneralSettings::first('academic_id');
                DB::table('sm_student_registrations')->insert([
                    [
                        'academic_id' => $academic_id
                    ]
                ]);
        }

        $admins=[542,543,544,545,546];
        
        foreach ($admins as $key => $value) {
                 $admins_check=InfixPermissionAssign::where('module_id',$value)->where('role_id',5)->first();              
                $permission = new InfixPermissionAssign();
                $permission->module_id = $value;
                $permission ->module_info = InfixModuleInfo::find($value)->name;
                $permission->role_id = 5;
                if($admins_check){
                    continue;
                }
                $permission->save();
          
        }
        if (Schema::hasTable('sm_general_settings')){
            $academic_id = SmGeneralSettings::first('academic_id')->academic_id;
            DB::table('sm_student_registrations')->insert([
                [
                    'academic_id' => $academic_id
                ]
            ]);
            }

        }catch(\Exception $e){
            Log::info($e);
        }



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_student_registrations');
    }
}
