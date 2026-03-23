@extends('todo.layouts')

@section('title', 'Contact Details')

@section('header-actions')
    <a href="{{ route('contacts.index') }}" class="text-gray-600 hover:text-gray-900 flex items-center gap-1">
        <span>&larr;</span> Back to Contacts
    </a>
@endsection

@section('content')
    <div class="max-w-3xl mx-auto card">

        <div class="d-flex align-items-center">
            <div class="avatar-circle mr-3">{{ strtoupper(substr($contact->name,0,1)) }}</div>
            <div>
                <h2>{{ $contact->name }}</h2>
                <p class="mb-0">{{ $contact->mobile }} &nbsp; <i class="far fa-envelope"></i> {{ $contact->email }}</p>
            </div>
        </div>

        <form action="{{ route('contacts.update', $contact) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Name</label>
                    <input name="name" value="{{ old('name', $contact->name) }}" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Mobile</label>
                    <input name="mobile" value="{{ old('mobile', $contact->mobile) }}" class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input name="email" value="{{ old('email', $contact->email) }}" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ optional($contact->date_of_birth)->format('Y-m-d') }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control">{{ old('address', $contact->address) }}</textarea>
            </div>

            <div class="form-row align-items-center">
                <div class="form-group col-md-6">
                    <label>Schedule Next Call</label>
                    <input type="datetime-local" name="next_call_at" class="form-control"
                        value="{{ old('next_call_at', optional($contact->next_call_at)->format('Y-m-d\TH:i')) }}">
                </div>

                <div class="form-group col-md-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        @foreach(['Active','Pending','Follow-up Required','Inactive','On Hold'] as $s)
                            <option value="{{ $s }}" {{ $contact->status === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3 text-right">
                    <button class="btn btn-primary mt-4">Save Changes</button>
                </div>
            </div>
        </form>

        <form method="POST" action="{{ route('contacts.destroy', $contact) }}" onsubmit="return confirm('Delete contact?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mt-3">Delete</button>
        </form>
   
</div>
@endsection
