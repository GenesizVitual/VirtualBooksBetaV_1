<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Model\Apps\Provinsi;
class InstansiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name_instansi'=>$this->name_instansi,
            'singkatan_instansi'=>$this->singkatan_instansi,
            'alamat'=>$this->alamat,
            'no_telp'=>$this->no_telp,
            'fax'=>$this->fax,
            'email'=>$this->email,
            'logo'=>$this->logo,
            'status_langganan'=>$this->status_langganan,
            'trial_aktif'=>$this->trial_aktif,
            'id_provinsi' =>new ProvinsiResource($this->BelongsToProvinsi),
            'id_kab_kota' => new  KabupateKotaResource($this->BelongsToKabupatenKot),
        ];
    }
}
