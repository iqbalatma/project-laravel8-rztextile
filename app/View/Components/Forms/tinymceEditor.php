<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class tinymceEditor extends Component
{
    public string $message;
    public string $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $message = "", string $name = "")
    {
        $this->message = $message;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.tinymce-editor');
    }
}
