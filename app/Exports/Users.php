<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Users implements FromView {

    protected $columns, $filters;

    public function __construct($columns, $filters) {
        $this->columns = $columns;
        $this->filters = $filters;
    }

    public function view(): View {
        $model = User::query();
        $users = $model->get();
        return view('exports.users', [
            'filters' => $this->filters,
            'columns' => $this->columns,
            'users' => $users
        ]);
    }
}
