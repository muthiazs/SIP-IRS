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
<<<<<<< HEAD
    public $Mahasiswa;
    public function __construct($Mahasiswa)
    {
        $this->Mahasiswa = $Mahasiswa;
=======
    public function __construct()
    {
        //
>>>>>>> 17c21c2baba16b05bc793df7f89949cb911bc190
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-mahasiswa');
    }
}
