<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Users implements FromView {

    protected $columns, $filters;
    public $start_date = null, $end_date = null;

    public function __construct($columns, $filters, $start_date = null, $end_date = null) {
        $this->columns = $columns;
        $this->filters = $filters;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function view(): View {
        $model = User::query();
        $model->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']);
        $users = $model->get();
        return view('exports.users', [
            'filters' => $this->filters,
            'columns' => $this->columns,
            'users' => $users
        ]);
    }
}
