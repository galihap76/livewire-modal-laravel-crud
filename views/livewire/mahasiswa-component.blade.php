<div>
    @section('title', 'Livewire Modal Laravel CRUD')

    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahMahasiswa">Tambah
        Mahasiswa</button>

    <div class="table-responsive">
        <table class="table table-bordered border-dark">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Aksi</th>
                </tr>

            </thead>

            <tbody>
                @php
                $no = 1;
                @endphp

                @foreach ($data_mahasiswa as $data)

                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->nim}}</td>
                    <td>{{$data->nama}}</td>
                    <td>{{$data->jurusan}}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal"
                                data-bs-target="#deleteMahasiswa"
                                wire:click="initDeleteData({{$data->id_mahasiswa}})">Hapus</button>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editMahasiswa"
                                wire:click="initEditData({{$data->id_mahasiswa}})">Edit</button>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <!-- Modal tambah-->
    <div wire:ignore.self class="modal fade" id="tambahMahasiswa" tabindex="-1" aria-labelledby="tambahMahasiswa"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahMahasiswa">Tambah Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="close()"></button>
                </div>

                {{-- Session store --}}
                @if (session()->has('store'))
                <div class="container d-flex align-items-center justify-content-center">
                    <div class="alert-dismissible fade show alert alert-success w-75 text-center mt-3" role="alert">
                        <strong>{{ session('store') }}</strong>
                    </div>
                </div>
                @endif

                <div class="modal-body">

                    <!-- Form tambah mahasiswa -->
                    <form wire:submit.prevent="storeData">

                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM Mahasiswa</label>
                            <input type="text" class="form-control" id="nim" wire:model="nim" autocomplete="off"
                                maxlength="8" required />
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama" wire:model="nama" autocomplete="off"
                                required />
                        </div>

                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" wire:model="jurusan" autocomplete="off"
                                required />
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                wire:click="close()">Tutup</button>
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                    <!-- Akhir form tambah karyawan-->

                </div>
            </div>
        </div>
    </div>
    <!-- </Akhir modal tambah-->

    <!-- Modal edit-->
    <div wire:ignore.self class="modal fade" id="editMahasiswa" tabindex="-1" aria-labelledby="editMahasiswa"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editMahasiswa">Edit Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="close()"></button>
                </div>

                {{-- Session edit --}}
                @if (session()->has('edit'))
                <div class="container d-flex align-items-center justify-content-center">
                    <div class="alert-dismissible fade show alert alert-success w-75 text-center mt-3" role="alert">
                        <strong>{{ session('edit') }}</strong>
                    </div>
                </div>
                @endif

                <div class="modal-body">

                    <!-- Form edit mahasiswa -->
                    <form wire:submit.prevent="editData">

                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM Mahasiswa</label>
                            <input type="text" class="form-control" id="nim" wire:model="nim" autocomplete="off"
                                maxlength="8" required />
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama" wire:model="nama" autocomplete="off"
                                required />
                        </div>

                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" wire:model="jurusan" autocomplete="off"
                                required />
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                wire:click="close()">Tutup</button>
                            <button type="submit" class="btn btn-warning">Edit</button>
                        </div>
                    </form>
                    <!-- Akhir form edit karyawan-->

                </div>
            </div>
        </div>
    </div>
    <!-- </Akhir modal edit-->

    <!-- Modal delete-->
    <div wire:ignore.self class="modal fade" id="deleteMahasiswa" tabindex="-1" aria-labelledby="deleteMahasiswa"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteMahasiswa">Delete Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="close()"></button>
                </div>

                {{-- Session delete --}}
                @if (session()->has('delete'))
                <div class="container d-flex align-items-center justify-content-center">
                    <div class="alert-dismissible fade show alert alert-success w-75 text-center mt-3" role="alert">
                        <strong>{{ session('delete') }}</strong>
                    </div>
                </div>
                @endif

                <div class="modal-body">
                    <h5>Apakah Anda yakin ingin menghapus data mahasiswa?</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            wire:click="close()">Cancel</button>
                        <button type="button" wire:click="deleteMahasiswa()" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </Akhir modal delete-->
</div>

@push('scripts')
<script>
    // Untuk menutup modal bootstrap
    window.addEventListener('close-modal', event =>{

        // Buat variabel hideTambahMahasiswa untuk menyembunyikan
        let hideTambahMahasiswa = function() {
            $('#tambahMahasiswa').modal('hide');
        };

        // Buat variabel hideEditMahasiswa untuk menyembunyikan
        let hideEditMahasiswa = function() {
                $('#editMahasiswa').modal('hide');
        };

        // Buat variabel hideDeleteMahasiswa untuk menyembunyikan
        let hideDeleteMahasiswa = function() {
                $('#deleteMahasiswa').modal('hide');
        };

        // Sembunyikan setelah dalam dua detik
        setTimeout(hideTambahMahasiswa, 2000);
        setTimeout(hideEditMahasiswa, 2000);
        setTimeout(hideDeleteMahasiswa, 2000);
    
        });
</script>
@endpush
