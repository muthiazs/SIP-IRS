<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class sidebarMahasiswa extends Component
{
    /**
     * Create a new component instance.
     */
    public $Mahasiswa;
    public function __construct($Mahasiswa)
    {
        $this->Mahasiswa = $Mahasiswa;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-mahasiswa');
    }
}
