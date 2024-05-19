<?php

namespace App\Livewire\User\Progress;

use App\Actions\GenerateCode;
use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
use App\Mail\InviteCompanion;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Step3 extends Component {

    public $types_of_food, $require_special_assistance;
    public $with_companion = 'no', $with_staff = 'no';
    public $current_user_step;
    public User $user;
    public $quantity = 5, $current = 3, $complete = 2;

    public $companion = [
        'name',
        'last_name',
        'phone',
        'email'
    ];

    public $staff = [
        'name',
        'last_name',
        'phone',
        'email'
    ];

    protected $messages = [
        '*.*.required' => 'Required field',
        '*.*.email' => 'Incorrect email format',
        '*.*.unique' => 'Email already exists',
    ];

    public function mount(User $user, $quantity = 5, $current = 3, $complete = 2) {
        $this->user = $user;
        $this->quantity = $quantity;
        $this->current = $current;
        $this->complete = $complete;

        $this->current_user_step = $user['current_step'];
        $this->types_of_food = $user['types_of_food'];
        $this->require_special_assistance = $user['require_special_assistance'];
        $this->with_companion = ($user['with_companion'] ? 'yes' : 'no');
        $this->with_staff = ($user['with_staff'] ? 'yes' : 'no');

        if ($user['with_companion']) {
            $companion = User::where('parent_id', $user['id'])->where('type', Types::COMPANION->value)->get()->first();
            if ($companion) {
                $this->companion = [
                    'name' => $companion['name'],
                    'last_name' => $companion['last_name'],
                    'phone' => $companion['phone'],
                    'email' => $companion['email']
                ];
            }
        }

        if ($user['with_staff']) {
            $staff = User::where('parent_id', $user['id'])->where('type', Types::STAFF->value)->get()->first();
            if ($staff) {
                $this->staff = [
                    'name' => $staff['name'],
                    'last_name' => $staff['last_name'],
                    'phone' => $staff['phone'],
                    'email' => $staff['email']
                ];
            }
        }
    }

    public function save($process) {
        $current_step = $this->user['current_step'];

        $result = 100 / $this->quantity;
        $progress = $this->user['register_progress'];
        $step = $current_step;

        if ($process) {
            if ($current_step === $this->current) {
                $progress = $progress + $result;
                $step = $step + 1;
            }
        }

        $this->user->update([
            'types_of_food' => $this->types_of_food,
            'require_special_assistance' => $this->require_special_assistance,
            'with_companion' => $this->with_companion === 'yes',
            'with_staff' => $this->with_staff === 'yes',
            'register_progress' => $progress,
            'current_step' => $step
        ]);

        $rules = [];

        $companion = User::where('parent_id', $this->user['id'])->where('type', Types::COMPANION->value)->get()->first();
        $staff = User::where('parent_id', $this->user['id'])->where('type', Types::STAFF->value)->get()->first();
        if ($this->with_companion === 'yes') {
            $rules['companion.name'] = 'required';
            $rules['companion.last_name'] = 'required';
            $rules['companion.phone'] = 'required';
            $rules['companion.email'] = 'required|email|unique:users,email';
            if ($companion) {
                $rules['companion.email'] = 'required|email|unique:users,email,' . $companion['id'] . ',id';
            }
        } else {
            if ($companion) {
                $companion->delete();
            }
        }

        if ($this->with_staff === 'yes') {
            $rules['staff.name'] = 'required';
            $rules['staff.last_name'] = 'required';
            $rules['staff.phone'] = 'required';
            $rules['staff.email'] = 'required|email|unique:users,email';
            if ($staff) {
                $rules['staff.email'] = 'required|email|unique:users,email,' . $staff['id'] . ',id';
            }
        } else {
            if ($staff) {
                $staff->delete();
            }
        }

        if (count($rules) > 0) {
            $this->validate($rules);
        }

        if ($this->with_companion === 'yes') {
            if ($companion) {
                $companion->update($this->companion);
            } else {
                $companion = User::create([
                    'name' => $this->companion['name'],
                    'last_name' => $this->companion['last_name'],
                    'phone' =>  $this->companion['phone'],
                    'email' =>  $this->companion['email'],
                    'password' => bcrypt($this->companion['phone']),
                    'type' => Types::COMPANION->value,
                    'parent_id' => $this->user['id'],
                    'status' => Status::CONFIRMED->value
                ]);
            }
        }

        if ($this->with_staff === 'yes') {
            if ($staff) {
                $staff->update($this->staff);
            } else {
                $staff = User::create([
                    'name' => $this->staff['name'],
                    'last_name' => $this->staff['last_name'],
                    'phone' =>  $this->staff['phone'],
                    'email' =>  $this->staff['email'],
                    'password' => bcrypt($this->staff['phone']),
                    'type' => Types::STAFF->value,
                    'parent_id' => $this->user['id'],
                    'status' => Status::CONFIRMED->value
                ]);
            }
        }

        if ($process) {
            if (in_array($this->user['type'], [
                Types::PARTICIPANT->value,
                Types::FREE_PASS_PARTICIPANT->value,
                Types::VIP->value
            ])){
                // Enviamos el correo solo si el usuario ha marcado que desea ir con acompañante
                if ($this->with_companion === 'yes') {
                    // Y se encuentra en el paso 3 actualmente
                    if ($current_step === $this->current) {
                        Mail::to($companion['email'])->send(new InviteCompanion($companion));
                    }
                }
                // Enviamos el correo solo si el usuario ha marcado que desea ir con staff
                if ($this->with_staff === 'yes') {
                    // Y se encuentra en el paso 3 actualmente
                    if ($current_step === $this->current) {
                        Mail::to($staff['email'])->send(new InviteCompanion($staff));
                    }
                }
            }
            // Actualizamos la barra de progreso solo si el usuario se encuentra en el paso 3
            if ($current_step === $this->current) {
                $this->dispatch('update-progress', value: $progress);
            }
            $this->dispatch('update-step', step: $this->current + 1);
            $this->dispatch('update-user-step', step: $this->current + 1);
        } else {
            $this->toast('It has been saved. Your profile will be updated shortly.');
        }
    }

    public function render() {
        return view('livewire.user.progress.step3');
    }
}
