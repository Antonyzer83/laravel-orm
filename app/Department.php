<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dept_name'];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'dept_no';

    public $incrementing = false;

    protected $keyType = "string";

    /**
     * The relationship between departments and employees for managers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function managers()
    {
        return $this->belongsToMany('App\Employee', 'dept_manager', 'dept_no', 'emp_no')->withPivot(['from_date', 'to_date']);
    }

    /**
     * The relationship between departments and employees for employees
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employees()
    {
        return $this->belongsToMany('App\Employee', 'dept_emp', 'dept_no', 'emp_no')->withPivot(['from_date', 'to_date']);
    }
}
