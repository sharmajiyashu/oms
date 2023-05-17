<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryFollowUp extends Model
{
    use HasFactory;

    protected $fillable = ['note','date','enquiry_id'];
}
