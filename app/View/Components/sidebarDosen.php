<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class sidebarDosen extends Component
{
    /**
     * Create a new component instance.
     */
    public $dosen;
    public function __construct($dosen)
    {
        $this->dosen = $dosen;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-dosen');
    }
}
