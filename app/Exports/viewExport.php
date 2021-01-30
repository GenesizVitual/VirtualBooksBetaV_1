<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;

class viewExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
//    use Exportable;
    protected $view_name;
    protected $data;

    public function __construct($view_name, $data)
    {
        $this->view_name = $view_name;
        $this->data = $data;
    }

    public function view(): View
    {
        return view($this->view_name, $this->data);
    }

}
