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
        'emp_no',
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

    public $timestamps = false;

    public $incrementing = false;

    /**
     * The relationship between departments and employees for managers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function managedDepartments()
    {
        return $this->belongsToMany('App\Department', 'dept_manager', 'emp_no', 'dept_no')->withPivot(['from_date', 'to_date']);
    }

    /**
     * The relationship between departments and employees for employees
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany('App\Department', 'dept_emp', 'emp_no', 'dept_no')->withPivot(['from_date', 'to_date']);
    }

    /**
     * The relationship between employees and salaries
     * An employee can have many salaries
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function salaries()
    {
        return $this->belongsToMany('App\Salary', 'employees', 'emp_no', 'emp_no');
    }

    /**
     * The relationship between employees and titles
     * An employee can have many titles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function titles()
    {
        return $this->belongsToMany('App\Title', 'employees', 'emp_no', 'emp_no');
    }

    /**
     * The relationship between employees and users
     * An employee has one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\User', 'emp_no', 'emp_no');
    }

    /**
     * Check if the employee is a manager
     *
     * @return bool
     */
    public function isManager()
    {
        $title = $this->titles()->where('to_date', '9999-01-01')->first();

        if (!empty($title))
            $status = ($title->title === 'Manager') ? true : false;
        else
            $status = false;
        return $status;
    }

    /**
     * Get the current department
     *
     * @return mixed
     */
    public function myDepartment()
    {
        $department = $this->departments()->where('to_date', '9999-01-01')->first();

        return $department;
    }
}
