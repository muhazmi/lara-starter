<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RemoveItemButton extends Component
{
    public $id;
    public $url;

    public function __construct($id, $url)
    {
        $this->id = $id;
        $this->url = $url;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.remove-item-button');
    }
}
