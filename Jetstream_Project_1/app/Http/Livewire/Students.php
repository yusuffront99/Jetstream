<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\student;

class students extends Component
{
    public $students, $name, $email, $phone_number, $status, $student_id;
    public $isOpenModal = 0;

  	//FUNGSI INI UNTUK ME-LOAD VIEW YANG AKAN MENJADI TAMPILAN HALAMAN student
    public function render()
    {
        $this->items = student::orderBy('name', 'DESC')->get(); //MEMBUAT QUERY UNTUK MENGAMBIL DATA
        return view('livewire.students'); //LOAD VIEW studentS.BLADE.PHP YG ADA DI DALAM FOLDER /RESOURSCES/VIEWS/LIVEWIRE
    }

    //FUNGSI INI AKAN DIPANGGIL KETIKA TOMBOL TAMBAH ANGGOTA DITEKAN
    public function create()
    {
        //KEMUDIAN DI DALAMNYA KITA MENJALANKAN FUNGSI UNTUK MENGOSONGKAN FIELD
        $this->resetFields();
        //DAN MEMBUKA MODAL
        $this->openModal();
    }

    //FUNGSI INI UNTUK MENUTUP MODAL DIMANA VARIABLE isOpenModal KITA SET JADI FALSE
    public function closeModal()
    {
        $this->isOpenModal = false;
    }

    //FUNGSI INI DIGUNAKAN UNTUK MEMBUKA MODAL
    public function openModal()
    {
        $this->isOpenModal = true;
    }

    //FUNGSI INI UNTUK ME-RESET FIELD/KOLOM, SESUAIKAN FIELD APA SAJA YANG KAMU MILIKI
    public function resetFields()
    {
        $this->name = '';
        $this->age = '';
        $this->div = '';
        $this->gender = '';
        
    }

    //METHOD STORE AKAN MENG-HANDLE FUNGSI UNTUK MENYIMPAN / UPDATE DATA
    public function store()
    {
        //MEMBUAT VALIDASI
        $this->validate([
            'name' => 'required|string',
            'age' => 'required',
            'div' => 'required|numeric',
            'gender' => 'required'
        ]);

        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        student::updateOrCreate(['id' => $this->student_id], [
            'name' => $this->name,
            'age' => $this->age,
            'div' => $this->div,
            'gender' => $this->gender,
        ]);

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
        session()->flash('message', $this->student_id ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    //FUNGSI INI UNTUK MENGAMBIL DATA DARI DATABASE BERDASARKAN ID student
    public function edit($id)
    {
        $student = student::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->student_id = $id;
        $this->name = $student->name;
        $this->age = $student->age;
        $this->div = $student->div;
        $this->gender = $student->gender;

        $this->openModal(); //LALU BUKA MODAL
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $student = student::find($id); //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        $student->delete(); //LALU HAPUS DATA
        session()->flash('message', $student->name . ' Dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
    }
}