<?php

namespace App\Models;

use App\Events\DriverAdded;
use App\Interfaces\ResourceModel;
use Illuminate\Notifications\Notifiable;

class Driver extends Base implements ResourceModel
{
    use Notifiable;

    protected $dispatchesEvents = [
        'created' => DriverAdded::class,
    ];

    public $casts = [
        'is_admin' => 'bool',
        'break' => 'bool',
    ];

    public $fillable = [
        'name',
        'email',
        'pin',
        'phone',
        'date_of_birth',
        'comments',
        'depo_id',
        'image_url',
    ];

    public $table = 'users';

    protected static function booted()
    {
        static::addGlobalScope('driver', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->where('role', 'driver');
        });
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class, 'depo_id', 'id')->withDefault(new Depot);
    }

    public $rules = [
        'create' => [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'comments' => 'required',
            'depo_id' => 'required',
        ],
        'update' => [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'comments' => 'required',
            'depo_id' => 'required',
        ],
    ];
}
