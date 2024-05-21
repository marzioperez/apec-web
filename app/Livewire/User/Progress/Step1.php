<?php

namespace App\Livewire\User\Progress;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Step1 extends Component {

    public User $user;
    public $quantity = 5, $current = 1;
    public bool $lock_fields = false;

    public $data  = [
        'title' => null,
        'name' => null,
        'last_name' => null,
        'gender' => null,
        'document_type' => null,
        'document_number' => null,
        'email' => null,
        'date_of_issue' => null,
        'place_of_issue' => null,
        'date_of_birth' => null,
        'nationality' => null,
        'city_of_permanent_residency' => null
    ];

    protected $messages = [
        'data.*.required' => 'Required field',
        'data.*.email' => 'Incorrect email format',
        'data.*.date' => 'Incorrect date format',
        'data.*.unique' => 'Email already exists',
    ];

    public $rules = [
        'data.title' => 'required',
        'data.name' => 'required',
        'data.last_name' => 'required',
        'data.gender' => 'required',
        'data.document_type' => 'required',
        'data.document_number' => 'required',
        'data.email' => 'required|email',
        'data.date_of_issue' => 'required|date',
        'data.place_of_issue' => 'required',
        'data.date_of_birth' => 'required|date',
        'data.nationality' => 'required',
        'data.city_of_permanent_residency' => 'required',
    ];

    public function mount(User $user, $quantity = 5, $current = 1) {
        $this->user = $user;
        $this->lock_fields = (boolean) $user['lock_fields'];
        $this->quantity = $quantity;
        $this->current = $current;

        $this->data = [
            'title' => $user['title'],
            'name' => $user['name'],
            'last_name' => $user['last_name'],
            'gender' => $user['gender'],
            'document_type' => $user['document_type'],
            'document_number' => $user['document_number'],
            'email' => $user['email'],
            'date_of_issue' => $user['date_of_issue'],
            'place_of_issue' => $user['place_of_issue'],
            'date_of_birth' => $user['date_of_birth'],
            'nationality' => $user['nationality'],
            'city_of_permanent_residency' => $user['city_of_permanent_residency']
        ];

        $this->rules['data.email'] = 'required|email|unique:users,email,' . $user['id'] . ',id';
    }

    public function save() {
        $this->user->update($this->data);
        $this->toast('It has been saved. Your profile will be updated shortly.');
    }

    public function process() {
        $rules = [
            'title' => 'required',
            'name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'document_type' => 'required',
            'document_number' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user['id'] . ',id',
            'date_of_issue' => 'required|date',
            'place_of_issue' => 'required',
            'date_of_birth' => 'required|date',
            'nationality' => 'required',
            'city_of_permanent_residency' => 'required',
        ];

        $messages = [
            '*.required' => 'Required field',
            '*.email' => 'Incorrect email format',
            '*.date' => 'Incorrect date format',
            '*.unique' => 'Email already exists',
        ];

        $validator = Validator::make($this->data, $rules, $messages);

        if ($validator->fails()) {
            $this->toast('There are fields with errors', 'Errors', 'error');
        }

        $this->validate($this->rules);

        $current_step = $this->user['current_step'];

        $result = 100 / $this->quantity;
        $progress = $this->user['register_progress'];
        if ($current_step <= 1) {
            $progress = $progress + $result;
        }

        $to_save = $this->data;
        $to_save['register_progress'] = $progress;
        $to_save['current_step'] = ($this->user['current_step'] > 2 ? $this->user['current_step'] : 2);
        $this->user->update($to_save);

        // Actualizamos la barra de progreso solo si el usuario se encuentra en el paso 1
        if ($current_step <= 1) {
            $this->dispatch('update-progress', value: $progress);
        }
        $this->dispatch('update-step', step: 2);
    }

    public function render() {
        return view('livewire.user.progress.step1');
    }
}
