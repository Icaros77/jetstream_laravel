<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string("invoice_number")->index("invoice_number")->nullable(false);
            $table->string("vendor_name")->nullable(false);
            $table->string("vendor_company")->nullable(false);
            $table->string("vendor_address")->nullable(false);
            $table->string("vendor_phone_number")->nullable(false);
            $table->string("vendor_email")->nullable(false);
            $table->string("client_name")->nullable(false);
            $table->string("client_company")->nullable(false);
            $table->string("client_address")->nullable(false);
            $table->string("client_phone_number")->nullable(false);
            $table->string("client_email")->nullable(false);
            $table->string("order_number")->nullable(false)->index("order_number");
            $table->date("date_delivered")->nullable(false);
            $table->decimal("subtotal")->nullable(false);
            $table->decimal("taxes")->nullable(false);
            $table->decimal("grand_total")->nullable(false);
            $table->text("payment_terms")->nullable(false);
            $table->foreignId("vendor_id")->constrained();
            $table->foreignId("client_id")->constrained("users");
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
        Schema::dropIfExists('invoices');
    }
}
