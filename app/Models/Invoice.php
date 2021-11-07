<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        // indexes
        "invoice_number",
        "order_number",
        
        // vendor info
        "vendor_name",
        "vendor_company",
        "vendor_address",
        "vendor_phone_number",
        "vendor_email",
        
        // client info
        "client_name",
        "client_company",
        "client_address",
        "client_phone_number",
        "client_email",
        
        //invoice info
        "date_delivered",
        "subtotal",
        "taxes",
        "grand_total",
        "payment_terms",

        // foreign_ids
        "vendor_id",
            // references users
        "client_id",
    ];
}
