<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class MasterStyle extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function style()
    {
        return $this->belongsTo(Style::class, 'style_id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function wash()
    {
        return $this->belongsTo(Wash::class, 'wash_id');
    }

    public function garmentType()
    {
        return $this->belongsTo(GarmentType::class, 'garment_type_id');
    }

    public function creater()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
