<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonDropdown extends Component
{
    public $book;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($book)
    {
        $this->book = $book;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.button-dropdown');
    }
}
