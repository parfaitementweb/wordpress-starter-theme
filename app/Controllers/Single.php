<?php

namespace App\Controllers;

use Parfaitement\Controller;

class Single extends Controller
{
    public function view()
    {
        // ACCESS REQUEST: $this->request
        // INCLUDE STYLE: $this->include_style('extra.css');
        // INCLUDE SCRIPT: $this->include_script('extra.js');

        return [
            'title' => 'Title',
            'name' => 'Name',
        ];
    }
}
