<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MahasiswaModel;

class MahasiswaComponent extends Component
{

    // Public property id mahasiswa, nim, nama, jurusan
    public $id_mahasiswa, $nim, $nama, $jurusan;

    // Method render() digunakan untuk menampilkan komponen dan mengembalikan view dengan data yang diperlukan
    public function render()
    {
        // Mengambil semua data mahasiswa
        $data_mahasiswa = MahasiswaModel::all();

        // Mengembalikan view 'livewire.mahasiswa-component' dengan data data_mahasiswa
        return view('livewire.mahasiswa-component', ['data_mahasiswa' => $data_mahasiswa]);
    }

    // Method close() untuk membersihkan kolom inputan bidang nim, nama, dan jurusan jika menekan tombol cancel atau silang
    public function close()
    {
        $this->nim = null;
        $this->nama = null;
        $this->jurusan = null;
    }

    // Method storeData() digunakan untuk menyimpan data mahasiswa baru ke dalam tabel
    public function storeData()
    {
        // Menyimpan data mahasiswa ke dalam tabel
        $insertTable = MahasiswaModel::create([
            'nim' => $this->nim,
            'nama' => $this->nama,
            'jurusan' => $this->jurusan
        ]);

        // Jika penyimpanan berhasil
        if ($insertTable) {
            // Menampilkan flash message store
            session()->flash('store', 'Data mahasiswa berhasil ditambahkan.');

            // Mengosongkan input nim, nama, dan jurusan
            $this->nim = null;
            $this->nama = null;
            $this->jurusan = null;

            // Menutup modal dengan menggunakan event browser
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    // Method initEditData() digunakan untuk menginisialisasi data yang akan diubah
    public function initEditData($id_mahasiswa)
    {
        // Menginisialisasi data yang akan diubah
        $mahasiswa = MahasiswaModel::where('id_mahasiswa', $id_mahasiswa)->first();

        // Menetapkan nilai pada property id_mahasiswa, nim, nama, dan jurusan
        $this->id_mahasiswa = $mahasiswa->id_mahasiswa; // -> Otomatis akan mempengaruhi where id_mahasiswa pada function editData() menggunakan livewire
        $this->nim = $mahasiswa->nim;
        $this->nama = $mahasiswa->nama;
        $this->jurusan = $mahasiswa->jurusan;
    }

    // Method editData() digunakan untuk mengubah data mahasiswa
    public function editData()
    {
        // Mengambil data mahasiswa yang akan diubah
        $editMahasiswa = MahasiswaModel::where('id_mahasiswa', $this->id_mahasiswa)->first();

        // Jika data mahasiswa ditemukan
        if ($editMahasiswa) {

            // Mengubah nilai pada property nim, nama, dan jurusan
            $editMahasiswa->nim = $this->nim;
            $editMahasiswa->nama = $this->nama;
            $editMahasiswa->jurusan = $this->jurusan;

            // Jika perubahan berhasil disimpan
            if ($editMahasiswa->save()) {
                // Menampilkan flash message edit
                session()->flash('edit', 'Data mahasiswa berhasil diubah.');

                // Mengosongkan input nim, nama, dan jurusan
                $this->nim = null;
                $this->nama = null;
                $this->jurusan = null;

                // Menutup modal dengan menggunakan event browser
                $this->dispatchBrowserEvent('close-modal');
            }
        }
    }

    // Method initDeleteData() digunakan untuk menginisialisasi data yang akan dihapus
    public function initDeleteData($id_mahasiswa)
    {
        // Menginisialisasi data yang akan dihapus
        $mahasiswa = MahasiswaModel::where('id_mahasiswa', $id_mahasiswa)->first();

        // Menetapkan nilai pada property id_mahasiswa, nim, nama, dan jurusan
        $this->id_mahasiswa = $mahasiswa->id_mahasiswa; // -> Otomatis akan mempengaruhi where id_mahasiswa pada function deleteMahasiswa() menggunakan livewire
        $this->nama = $mahasiswa->nama;
        $this->jurusan = $mahasiswa->jurusan;
    }

    // Method deleteMahasiswa() digunakan untuk menghapus data mahasiswa
    public function deleteMahasiswa()
    {
        // Mengambil data mahasiswa yang akan dihapus
        $deleteMahasiswa = MahasiswaModel::where('id_mahasiswa', $this->id_mahasiswa)->first();

        // Jika penghapusan berhasil
        if ($deleteMahasiswa->delete()) {

            // Mengosongkan input nim, nama, dan jurusan
            $this->nim = null;
            $this->nama = null;
            $this->jurusan = null;

            // Menampilkan flash message delete
            session()->flash('delete', 'Data mahasiswa berhasil dihapus.');

            // Menutup modal dengan menggunakan event browser
            $this->dispatchBrowserEvent('close-modal');
        }
    }
}
