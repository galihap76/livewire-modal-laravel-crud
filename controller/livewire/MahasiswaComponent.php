<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MahasiswaModel;

class MahasiswaComponent extends Component
{

    // Public property nama, jurusan, nim
    public $nama, $jurusan, $nim;

    // Method render() digunakan untuk menampilkan komponen dan mengembalikan view dengan data yang diperlukan
    public function render()
    {
        // Mengambil semua data mahasiswa
        $data_mahasiswa = MahasiswaModel::all();

        // Mengembalikan view 'livewire.mahasiswa-component' dengan data data_mahasiswa
        return view('livewire.mahasiswa-component', ['data_mahasiswa' => $data_mahasiswa]);
    }

    // Method close() untuk membersihkan kolom inputan bidang nama dan jurusan jika menekan tombol cancel atau silang
    public function close()
    {
        $this->nama = null;
        $this->jurusan = null;
    }

    // Method storeData() digunakan untuk menyimpan data mahasiswa baru ke dalam tabel
    public function storeData()
    {
        // Menyimpan data mahasiswa ke dalam tabel
        $insertTable = MahasiswaModel::create([
            'nama' => $this->nama,
            'jurusan' => $this->jurusan
        ]);

        // Jika penyimpanan berhasil
        if ($insertTable) {
            // Menampilkan flash message store
            session()->flash('store', 'Data mahasiswa berhasil ditambahkan.');

            // Mengosongkan input nama dan jurusan
            $this->nama = null;
            $this->jurusan = null;

            // Menutup modal dengan menggunakan event browser
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    // Method initEditData() digunakan untuk menginisialisasi data yang akan diubah
    public function initEditData($nim)
    {
        // Menginisialisasi data yang akan diubah
        $mahasiswa = MahasiswaModel::where('nim', $nim)->first();

        // Menetapkan nilai pada property nim, nama, dan jurusan
        $this->nim = $mahasiswa->nim;
        $this->nama = $mahasiswa->nama;
        $this->jurusan = $mahasiswa->jurusan;
    }

    // Method editData() digunakan untuk mengubah data mahasiswa
    public function editData()
    {
        // Mengambil data mahasiswa yang akan diubah
        $editMahasiswa = MahasiswaModel::where('nim', $this->nim)->first();

        // Jika data mahasiswa ditemukan
        if ($editMahasiswa) {
            // Mengubah nilai pada property nama dan jurusan
            $editMahasiswa->nama = $this->nama;
            $editMahasiswa->jurusan = $this->jurusan;

            // Jika perubahan berhasil disimpan
            if ($editMahasiswa->save()) {
                // Menampilkan flash message edit
                session()->flash('edit', 'Data mahasiswa berhasil diubah.');

                // Mengosongkan input nama dan jurusan
                $this->nama = null;
                $this->jurusan = null;

                // Menutup modal dengan menggunakan event browser
                $this->dispatchBrowserEvent('close-modal');
            }
        }
    }

    // Method initDeleteData() digunakan untuk menginisialisasi data yang akan dihapus
    public function initDeleteData($nim)
    {
        // Menginisialisasi data yang akan dihapus
        $mahasiswa = MahasiswaModel::where('nim', $nim)->first();

        // Menetapkan nilai pada property nim, nama, dan jurusan
        $this->nim = $mahasiswa->nim;
        $this->nama = $mahasiswa->nama;
        $this->jurusan = $mahasiswa->jurusan;
    }

    // Method deleteMahasiswa() digunakan untuk menghapus data mahasiswa
    public function deleteMahasiswa()
    {
        // Mengambil data mahasiswa yang akan dihapus
        $deleteMahasiswa = MahasiswaModel::where('nim', $this->nim)->first();

        // Jika penghapusan berhasil
        if ($deleteMahasiswa->delete()) {
            // Mengosongkan input nama dan jurusan
            $this->nama = null;
            $this->jurusan = null;

            // Menampilkan flash message delete
            session()->flash('delete', 'Data mahasiswa berhasil dihapus.');

            // Menutup modal dengan menggunakan event browser
            $this->dispatchBrowserEvent('close-modal');
        }
    }
}
