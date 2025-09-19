<?php $page = 'farmers'; ?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Farmers</h4>
                    <h6>Manage your farmers</h6>
                </div>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-farmer">
                    <i class="ti ti-circle-plus me-1"></i>Add Farmer
                </a>
            </div>
        </div>

        <!-- farmer list -->
        <div class="card">
            <div class="card-header">
                <h5 class="fw-bold mb-0">Farmers List</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>NIK</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Birth Date</th>
                                <th>Gender</th>
                                <th>Land Area</th>
                                <th>Status</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($farmers as $farmer)
                            <tr>
                                <td>{{ $farmer->nik }}</td>
                                <td>{{ $farmer->farmer_name }}</td>
                                <td>{{ $farmer->address }}</td>
                                <td>{{ $farmer->phone_number }}</td>
                                <td>{{ $farmer->birth_date }}</td>
                                <td>{{ $farmer->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $farmer->land_area }} Ha</td>
                                <td>
                                    @if ($farmer->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2 mb-0" href="{{ route('farmers.show', $farmer->id) }}">
                                            <i data-feather="eye" class="action-eye"></i>
                                        </a>
                                        <a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-farmer-{{ $farmer->id }}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <form action="{{ route('farmers.destroy', $farmer->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 mb-0 btn btn-link text-danger">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Farmer Modal -->
                            <div class="modal fade" id="edit-farmer-{{ $farmer->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('farmers.update', $farmer->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Farmer</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">NIK</label>
                                                    <input type="text" name="nik" class="form-control" value="{{ $farmer->nik }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" name="farmer_name" class="form-control" value="{{ $farmer->farmer_name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Address</label>
                                                    <textarea name="address" class="form-control" required>{{ $farmer->address }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Phone</label>
                                                    <input type="text" name="phone_number" class="form-control" value="{{ $farmer->phone_number }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Birth Date</label>
                                                    <input type="date" name="birth_date" class="form-control" value="{{ $farmer->birth_date }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Gender</label>
                                                    <select name="gender" class="form-select" required>
                                                        <option value="L" {{ $farmer->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                        <option value="P" {{ $farmer->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Land Area (Ha)</label>
                                                    <input type="number" step="0.01" name="land_area" class="form-control" value="{{ $farmer->land_area }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="active" {{ $farmer->status == 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="inactive" {{ $farmer->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Farmer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /farmer list -->
    </div>
</div>

<!-- Add Farmer Modal -->
<div class="modal fade" id="add-farmer" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('farmers.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Farmer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="farmer_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone_number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Birth Date</label>
                        <input type="date" name="birth_date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Land Area (Ha)</label>
                        <input type="number" step="0.01" name="land_area" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Farmer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection