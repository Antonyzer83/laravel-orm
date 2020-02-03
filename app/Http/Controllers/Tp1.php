<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\Salary;
use App\Title;

class Tp1 extends Controller
{
    /**
     * Trouver les employées de sexe féminin classés par emp_no, limité aux 10 premiers résultats
     */
    public function rqt1() {
        return Employee::where('gender', 'F')
            ->orderBy('emp_no')
            ->offset(0)->limit(10)
            ->get();
    }

    /**
     * Trouver tous les employés dont le prénom est 'Troy'.
     */
    public function rqt2() {
        return Employee::where('first_name', 'Troy')->get();
    }

    /**
     *
     * Trouver tous les employés de sexe masculin nés après le 31 janvier 1965
     *
     * */
    public function rqt3() {
        return Employee::where([
            ['gender', 'M'],
            ['hire_date', '>', '1965-01-31']
        ])->get();
    }


    /**
     *
     * Combien y a t'il de départements
     *
     * */
    public function rqt4() {
        return Department::count();
    }

    /**
     *
     *  Combien de personnes dont le prénom est 'Richard' sont des femmes
     *
     * */
    public function rqt5() {
        return Employee::where([
            ['first_name', 'Richard'],
            ['gender', 'F']
        ])->count();
    }


    /**
     *
     * Combien y a t'il de titre différents d'employés
     *
     * */
    public function rqt6() {
        return Title::distinct('title')->count('title');
    }


    /**
     *
     * Le salaire moyen de l'employé numéro 287323 toute période confondu
     *
     * */
    public function rqt7() {
        return Salary::where('emp_no', '287323')->avg('salary');
    }


    /**
     *
     * Quel était le titre de Danny Rando le 12 janvier 1990
     *
     * */
    public function rqt8() {
        return Employee::where([
            ['first_name', 'Danny'],
            ['last_name', 'Rando']
        ])
            ->whereRaw('? between from_date and to_date', [date('1990-01-12')])
            ->join('titles', 'titles.emp_no', '=', 'employees.emp_no')
            ->select('title')
            ->get();
    }

    /**
     *
     * L'employé qui a eu le salaire maximum de tous les temps, et quel est le montant de ce salaire
     *
     * */
    public function rqt9() {
        return Employee::join('salaries', 'salaries.emp_no', '=', 'employees.emp_no')
            ->whereIn('salaries.salary', function ($query) {
                $query->selectRaw('max(salary)')->from('salaries');
            })
            ->get();
    }

    /**
     *
     * Combien d'employés travaillaient dans le département 'Sales' le 1er Janvier 2000
     *
     */
    public function rqt10() {
        return Employee::where('dept_name', 'Sales')
            ->join('dept_emp', 'employees.emp_no', '=', 'dept_emp.emp_no')
            ->join('departments', 'departments.dept_no', '=', 'dept_emp.dept_no')
            ->whereRaw('? between from_date and to_date', [date('2000-01-01')])
            ->count();
    }

    /**
     * Qui est le manager de Martine Hambrick actuellement et quel est son titre
     */
    public function rqt11() {
        return Employee::join('dept_manager', 'dept_manager.emp_no', 'employees.emp_no')
            ->join('departments', 'departments.dept_no', 'dept_manager.dept_no')
            ->join('titles', 'titles.emp_no', 'employees.emp_no')
            ->where([
                ['title', 'Manager']
            ])
            ->whereRaw('now() between dept_manager.from_date and dept_manager.to_date')
            ->whereIn('dept_manager.dept_no', function ($query) {
                $query->selectRaw('dept_no')
                    ->from('dept_emp')
                    ->join('employees', 'dept_emp.emp_no', 'employees.emp_no')
                    ->where([
                        ['first_name', 'Martine'],
                        ['last_name', 'Hambrick']
                    ]);
            })
            ->get();
    }
}
