@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Penduduk</h1>
    </div>

    {{-- cek error --}}
    {{-- @if ($errors->any())
        @dd($errors->all())
    @endif --}}

    <div class="row">
        <div class="col">
            <form action="/resident" method="post">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nik">NIK</label>
                            <input type="number" name="nik" id="nik" class="form-control" value="{{ old('nik') }}">
                            @error('nik')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old(key: 'name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="form-control @error('gener')
                            is-invalid
                            @enderror">
                            @foreach ([
                                (object)[
                                    'label' => 'Laki-Laki',
                                    'value' => 'male',
                        ],
                        (object)[
                            'label' => 'Perempuan',
                            'value' => 'female',
                        ],
                            ] as $item)
                                <option value="{{ $item->value }}" @selected(old('gender') == $item->value)>{{ $item->label }}</option>
                            @endforeach
                            </select>
                            @error('gender')
                                <span class="invalid-feedback"></span>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="birth_date">Tanggal Lahir</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date')
                            is-invalid
                            @enderror" value="{{ old('birth_date') }}">
                            @error('birth_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="birth_place">Tempat Lahir</label>
                            <input type="text" name="birth_place" id="birth_place" class="form-control " value="{{ old(key: 'birth_place') }}">
                            @error('birth_place')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Alamat</label>
                            <textarea type="text" name="address" id="address" class="form-control" cols="5"
                            rows="5">{{ old("address") }}</textarea>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="religion">Agama</label>
                            <input type="text" name="religion" id="religion" class="form-control" value="{{ old('religion') }}">
                            @error('religion')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="marital_status">Status Perkawinan</label>
                            <select name="marital_status" id="marital_status" class="form-control @error('marital_status')
                            is-invalid
                            @enderror">
                            @foreach ([
                                (object) [
                                    'label' => 'Belum Kawin',
                                    'value' => 'single',
                        ],
                        (object) [
                                    'label' => 'Sudah Menikah',
                                    'value' => 'married',
                        ],
                        (object) [
                                    'label' => 'Cerai',
                                    'value' => 'divorced',
                        ],
                        (object) [
                                    'label' => 'Janda/Duda',
                                    'value' => 'widowed',
                        ],
                            ] as $item)
                                
                                <option value="{{ $item->value }}" @selected(old('marital_status') == $item->value)>{{ $item->label }}</option>
                            @endforeach
                            </select>
                            @error('marital_status')
                                <span class="invalid-feedback"></span>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone_number">Phone Number</label>
                            <input type="number" name="phone_number" id="phone_number" class="form-control">
                            @error('phone_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="occupation">Pekerjaan</label>
                            <input type="text" name="occupation" id="occupation" class="form-control">
                            @error('occupation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control @error('status')
                            is-invalid
                            @enderror">
                            @foreach ([
                                (object) [
                                    'label' => 'Aktif',
                                    'value' => 'active',
                        ],
                        (object) [
                            'label' => 'Pindah',
                            'value' => 'moved',
                        ],
                        (object) [
                            'label' => 'Almarhum',
                            'value' => 'deseased',
                        ],
                            ] as $item)
                                <option value="{{ $item->value }}" @selected(old('status') == $item->value)>{{ $item->label }}</option>
                            @endforeach
                            </select>
                            @error('status')
                                <span class="invalid-feedback"></span>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end" style="gap:10px">
                            <a href="/resident" class="btn btn-outline-secondary">
                            Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    
    
@endsection