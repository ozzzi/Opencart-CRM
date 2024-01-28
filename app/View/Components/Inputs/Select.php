<?php

namespace App\View\Components\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $name = null,
        public ?string $id = null,
        public mixed $value = null,
        public ?string $containerClass = null,
        public string $placeholder = '',
        public bool $required = false,
        public array|Collection $options = [],
        public bool $isLabel = true,
        public ?string $valueField = null,
        public ?string $labelField = null,
    ) {
        $this->id = $this->id ?? $this->name;
        $this->containerClass = $this->containerClass ?? 'mb-5';
        $this->valueField = $valueField ?? 'value';
        $this->labelField = $labelField ?? 'name';

        $this->options = $this->normalizeOptions($options);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inputs.select');
    }

    protected function normalizeOptions(array|Collection $options): Collection
    {
        return collect($options)
            ->map(function ($value, $key) {
                if ($value instanceof \BackedEnum) {
                    return [
                        $this->valueField => $value->value,
                        $this->labelField => $value->name,
                    ];
                }

                if (!is_numeric($key)) {
                    return [
                        $this->valueField => $key,
                        $this->labelField => $value,
                    ];
                }

                if (!is_iterable($value) && !$value instanceof Model) {
                    return [
                        $this->valueField => $value,
                        $this->labelField => $value,
                    ];
                }


                return $value;
            });
    }

    public function optionLabel($option, string $labelField = null, string $valueField = null)
    {
        return $this->optionProperty(
            $option,
            $labelField ?? $this->labelField,
            $this->optionValue($option, $valueField)
        );
    }

    public function optionValue($option, string $valueField = null)
    {
        return $this->optionProperty($option, $valueField ?? $this->valueField);
    }

    public function isSelected($value): bool
    {
        if ($this->value == $value) {
            return true;
        }

        return is_array($this->value) && in_array($value, $this->value, false);
    }

    protected function optionProperty($option, $field, $default = null)
    {
        if (is_array($option)) {
            return Arr::get($option, $field, $default);
        }

        if ($option instanceof Model) {
            $value = $option->{$field};

            return is_null($value) ? $default : $value;
        }

        return $option;
    }
}
