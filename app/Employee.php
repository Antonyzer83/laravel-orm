<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'birth_date',
        'first_name',
        'last_name',
        'gender',
        'hire_date'
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'emp_no';

    /**
     * The relationship between departments and employees for managers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dept_managers()
    {
        return $this->belongsToMany('App\Department', 'dept_manager', 'emp_no', 'dept_no');
    }

    /**
     * The relationship between departments and employees for employees
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dept_emps()
    {
        return $this->belongsToMany('App\Department', 'dept_emp', 'emp_no', 'dept_no');
    }
}
