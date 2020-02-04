<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = "salaries";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salary',
        'from_date',
        'to_date'
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'emp_no';

    /**
     * The relationship between salaries and employees
     * One salary can be only for one employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo('App\Employee', 'emp_no');
    }
}
