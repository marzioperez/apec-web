<?php

namespace App\Livewire\User\Progress;

use App\Models\User;
use Livewire\Component;

class Step1 extends Component {

    public $title, $name, $last_name, $gender, $document_type, $document_number, $email, $date_of_issue;
    public $place_of_issue, $date_of_birth, $nationality, $city_of_permanent_residency;
    public bool $lock_fields = false;
    public User $user;

    protected $messages = [
        '*.required' => 'Required field',
        '*.email' => 'Incorrect email format',
        '*.date' => 'Incorrect date format',
        '*.unique' => 'Email already exists',
    ];

    public function mount(User $user) {
        $this->user = $user;
        if ($user['current_step'] > 1) {
            $this->lock_fields = true;
        }
        $this->title = $user['title'];
        $this->name = $user['name'];
        $this->last_name = $user['last_name'];
        $this->gender = $user['gender'];
        $this->document_type = $user['document_type'];
        $this->document_number = $user['document_number'];
        $this->email = $user['email'];
        $this->date_of_issue = $user['date_of_issue'];
        $this->place_of_issue = $user['place_of_issue'];
        $this->date_of_birth = $user['date_of_birth'];
        $this->nationality = $user['nationality'];
        $this->city_of_permanent_residency = $user['city_of_permanent_residency'];
    }

    public function save() {
        $this->user->update([
            'title' => $this->title,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'document_type' => $this->document_type,
            'document_number' => $this->document_number,
            'email' => $this->email,
            'date_of_issue' => $this->date_of_issue,
            'place_of_issue' => $this->place_of_issue,
            'date_of_birth' => $this->date_of_birth,
            'nationality' => $this->nationality,
            'city_of_permanent_residency' => $this->city_of_permanent_residency
        ]);
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
        $this->validate($rules, $this->messages);

        $current_step = $this->user['current_step'];
        $this->user->update([
            'register_progress' => ($this->user['current_step'] > 2 ? $this->user['register_progress'] : 20),
            'current_step' => ($this->user['current_step'] > 2 ? $this->user['current_step'] : 2),
            'title' => $this->title,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'document_type' => $this->document_type,
            'document_number' => $this->document_number,
            'email' => $this->email,
            'date_of_issue' => $this->date_of_issue,
            'place_of_issue' => $this->place_of_issue,
            'date_of_birth' => $this->date_of_birth,
            'nationality' => $this->nationality,
            'city_of_permanent_residency' => $this->city_of_permanent_residency
        ]);

        // Actualizamos la barra de progreso solo si el usuario se encuentra en el paso 1
        if ($current_step === 1) {
            $this->dispatch('update-progress', value: 20);
        }
        $this->dispatch('update-step', step: 2);
    }

    public function render() {
        return view('livewire.user.progress.step1');
    }
}
