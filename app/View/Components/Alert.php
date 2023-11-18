<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Alert extends Component
{

    public $type;
    public $message;

    /**
     * Alert constructor.
     * @param $type
     * @param $message
     */
    public function __construct(string $type = null, string $message = null)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Create a new component instance.
     *
     * @return void
     */


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render(): View
    {
        return view('components.alert');
    }
}
