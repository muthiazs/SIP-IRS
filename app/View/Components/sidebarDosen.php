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
<<<<<<< HEAD
    public $Dosen;
    public function __construct()
    {
        $this->Dosen = $Dosen;
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
        return view('components.sidebar-dosen');
    }
}
