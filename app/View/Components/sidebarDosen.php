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
    public $Dosen;
    public function __construct()
    {
        $this->Dosen = $Dosen;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-dosen');
    }
}
