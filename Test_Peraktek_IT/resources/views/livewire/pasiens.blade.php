<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Pasien</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <button wire:click="create()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Pasien</button>

            @if($isModal)
            @include('livewire.create')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Id Pasien</th>
                        <th class="px-4 py-2">Nama Pasien</th>
                        <th class="px-4 py-2">Jenis Kelamin</th>
                        <th class="px-4 py-2">No Telp</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>@forelse($pasiens as $row)
                    <?php    
                    $table_no = $row->id; 
                    $kodefikasi = 'P';
                    $tgl = substr(str_replace( '-', '', Carbon\carbon::now()), 0,1);
                    
                    $no= $kodefikasi.$table_no;
                    $auto=substr($no,1);
                    $auto=intval($auto)+1;
                    $auto_number=substr($no,0,1).str_repeat(0,(4-strlen($auto))).$auto;
                     ?>
                    <tr>
                        <td class="border px-4 py-2">{{ $auto_number }}</td>
                        <td class="border px-4 py-2">{{ $row->nama_pasien }}</td>
                        <td class="border px-4 py-2">{{$row->jenis_kelamin}}</td>
                        <td class="border px-4 py-2">{{ $row->no_telp }}</td>
                        <td class="border px-4 py-2">{{ $row->alamat }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $row->id }})"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $row->id }})"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="border px-4 py-2 text-center" colspan="5">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>