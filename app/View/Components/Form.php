<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public bool $spoofMethod;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $action = '',
        public string $method = 'POST',
        public bool $hasFiles = false
    ) {
        $this->method = strtoupper($this->method);
        $this->spoofMethod = in_array($this->method, ['PUT', 'PATCH', 'DELETE'], true);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}
