<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_contact_number')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_skype_url')->nullable();
            $table->string('client_linkedin_url')->nullable();
            $table->string('lead_url')->nullable();
            $table->text('lead_proposal')->nullable();
            $table->unsignedBigInteger('lead_payment_type_id');
            $table->foreign('lead_payment_type_id')->references('id')->on('lead_payment_types')->onDelete('cascade');
            $table->unsignedBigInteger('lead_type_id');
            $table->foreign('lead_type_id')->references('id')->on('lead_types')->onDelete('cascade');
            $table->unsignedBigInteger('lead_type_category_id')->nullable();
            $table->foreign('lead_type_category_id')->references('id')->on('lead_type_categories')->onDelete('cascade');

            $table->decimal('amount',8,2);
            $table->decimal('estimated_time_line',8,2);
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->unsignedBigInteger('parent_department_id');
            $table->foreign('parent_department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('leads');
    }
}
