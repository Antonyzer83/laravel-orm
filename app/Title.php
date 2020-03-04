<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'emp_no',
        'title',
        'from_date',
        'to_date'
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'emp_no';

    public $timestamps = false;

    public $incrementing = false;

    /**
     * The relationship between titles and employees
     * One title can be only for one employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo('App\Employee', 'emp_no', 'emp_no');
    }
}
