<?php

namespace App\Livewire\Common;

use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class FileUpload extends Component {

    use WithFileUploads;

    #[Modelable]
    public ?array $files;
    #[Locked]
    public array $rules;
    #[Locked]
    public string $uuid;
    public $upload;
    public string $error;
    public bool $multiple;
    public $content;
    public $emitter = null;

    public function mount(array $rules = [], bool $multiple = false, $content = null, $emitter = null): void {
        $this->uuid = Str::uuid();
        $this->multiple = $multiple;
        $this->rules = $rules;
        $this->files = [];
        $this->content = $content;
        $this->emitter = $emitter;
    }

    public function rules(): array {
        $field = $this->multiple ? 'upload.*' : 'upload';

        return [
            $field => [...$this->rules],
        ];
    }

    protected $messages = [
        '*.max' => 'The file exceeds the upload limit',
        '*.mimes' => 'The uploaded file is not allowed',
    ];

    public function updatedUpload(): void {
        $this->reset('error');

        try {
            $this->validate();
        } catch (ValidationException $e) {
            // If the upload validation fails, we trigger the following event
            $this->dispatch("{$this->uuid}:uploadError", $e->getMessage());
            return;
        }

        $this->upload = $this->multiple
            ? $this->upload
            : [$this->upload];

        foreach ($this->upload as $upload) {
            $this->handleUpload($upload);
        }

        $this->reset('upload');
    }

    public function handleUpload(TemporaryUploadedFile $file): void {
        $this->dispatch("{$this->uuid}:fileAdded", [
            'tmpFilename' => $file->getFilename(),
            'name' => $file->getClientOriginalName(),
            'extension' => $file->extension(),
            'path' => $file->path(),
            'temporaryUrl' => $file->isPreviewable() ? $file->temporaryUrl() : null,
            'size' => $file->getSize(),
        ]);
    }

    #[On('{uuid}:fileAdded')]
    public function onFileAdded(array $file): void {
        $files = $this->multiple ? array_merge($this->files, [$file]) : [$file];
        $this->files = $files;
        if ($this->emitter) {
            $this->dispatch("update-photo", files:$files, emitter: $this->emitter);
        }
    }

    #[On('{uuid}:fileRemoved')]
    public function onFileRemoved(string $tmpFilename): void {
        $this->files = array_filter($this->files, function ($file) use ($tmpFilename) {
            return $file['tmpFilename'] !== $tmpFilename;
        });
    }

    #[On('{uuid}:uploadError')]
    public function onUploadError(string $error): void {
        $this->error = $error;
    }

    #[Computed]
    public function mimes(): string {
        return collect($this->rules)
            ->filter(fn ($rule) => str_starts_with($rule, 'mimes:'))
            ->flatMap(fn ($rule) => explode(',', substr($rule, strpos($rule, ':') + 1)))
            ->unique()
            ->values()
            ->join(', ');
    }

    #[Computed]
    public function accept(): ?string {
        return ! empty($this->mimes) ? collect(explode(', ', $this->mimes))->map(fn ($mime) => '.'.$mime)->implode(',') : null;
    }

    #[Computed]
    public function maxFileSize(): ?string {
        return collect($this->rules)
            ->filter(fn ($rule) => str_starts_with($rule, 'max:'))
            ->flatMap(fn ($rule) => explode(',', substr($rule, strpos($rule, ':') + 1)))
            ->unique()
            ->values()
            ->first();
    }

    public function isImageMime($mime): bool {
        return in_array($mime, ['png', 'gif', 'bmp', 'svg', 'jpeg', 'jpg']);
    }

    public function render() {
        return view('livewire.common.file-upload');
    }
}
