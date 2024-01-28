<?php

namespace App\View\Components\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $name = null,
        public ?string $id = null,
        public mixed $value = null,
        public ?string $containerClass = null,
        public string $placeholder = ''
    ) {
        $this->id = $this->id ?? $this->name;
        $this->value = $name ? old($name, $value) : $value;
        $this->containerClass = $this->containerClass ?? 'mb-5';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inputs.textarea');
    }
}
