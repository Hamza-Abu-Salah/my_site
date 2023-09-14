<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $table = "about";
    protected $guarded = [];

    public function scopeChangeStatus()
    {
        if($this->status == "ACTIVE"){
            $this->update(['status' => 'NACTIVE']);
        }else{
            $this->update(['status' => 'ACTIVE']);
        }
    }
}
