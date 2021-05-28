<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pasien;

class Pasiens extends Component
{
    public $pasiens, $nama_pasien, $jenis_kelamin, $no_telp, $alamat, $id_pasien;
    public $isModal;
    public $isModalUpdate;
    public function render()
    {
        $this->pasiens = Pasien::orderBy('created_at', 'DESC')->get();
        return view('livewire.pasiens');
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function resetFields()
    {
        $this->nama_pasien = '';
        $this->jenis_kelamin = '';
        $this->no_telp = '';
        $this->alamat = '';
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function closeModal()
    {
        $this->isModal = false;
    }

    public function store()
    {
        $this->validate([
            'nama_pasien' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'no_telp' => 'required|max:13',
            'alamat' => 'required|string'
        ]);

        Pasien::updateOrCreate(['id' => $this->id_pasien], [
            'nama_pasien' => $this->nama_pasien,
            'jenis_kelamin' => $this->jenis_kelamin,
            'no_telp' => $this->no_telp,
            'alamat' => $this->alamat,
        ]);

        session()->flash('message', $this->id_pasien ? $this->nama_pasien . ' Diperbaharui' : $this->nama_pasien . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }


    public function edit($id)
    {
        $pasien = Pasien::find($id);
        $this->id_pasien = $id;
        $this->nama_pasien = $pasien->nama_pasien;
        $this->jenis_kelamin = $pasien->jenis_kelamin;
        $this->no_telp = $pasien->no_telp;
        $this->alamat = $pasien->alamat;

        $this->openModal();
    }

    public function delete($id)
    {

        $pasien = Pasien::find($id);
        $pasien->delete();
        session()->flash('message', $pasien->name . ' Dihapus');
    }
}
