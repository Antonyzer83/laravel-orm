<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class Tp1 extends Controller
{
    /**
     * Trouver les employées de sexe féminin classés par emp_no, limité aux 10 premiers résultats
     */
    public function rqt1() {
        return Employee::where('gender','F')->orderBy('emp_no')->offset(0)->limit(10)->get();
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
        return null;
    }


    /**
     *
     * Combien y a t'il de départements
     *
     * */
    public function rqt4() {
        return null;
    }

    /**
     *
     *  Combien de personnes dont le prénom est 'Richard' sont des femmes
     *
     * */
    public function rqt5() {
        return null;
    }


    /**
     *
     * Combien y a t'il de titre différents d'employés
     *
     * */
    public function rqt6() {
        return null;
    }


    /**
     *
     * Le salaire moyen de l'employé numéro 287323 toute période confondu
     *
     * */
    public function rqt7() {
        return null;
    }


    /**
     *
     * Quel était le titre de Danny Rando le 12 janvier 1990
     *
     * */
    public function rqt8() {
        return null;
    }

    /**
     *
     * L'employé qui a eu le salaire maximum de tous les temps, et quel est le montant de ce salaire
     *
     * */
    public function rqt9() {
        return null;
    }

    /**
     *
     * Combien d'employés travaillaient dans le département 'Sales' le 1er Janvier 2000
     *
     */
    public function rqt10() {
        return null;
    }

    /**
     * Qui est le manager de Martine Hambrick actuellement et quel est son titre
     */
    public function rqt11() {
        return null;
    }
}
