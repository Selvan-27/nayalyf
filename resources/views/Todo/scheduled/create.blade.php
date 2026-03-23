@extends('Todo.layouts')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            ➕ Schedule a New Call
        </div>
        <div class="card-body">
            <form action="{{ route('scheduled.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Select Contact</label>
                    <select name="contact_id" class="form-select" required>
                        <option value="">-- Choose Contact --</option>
                        @foreach ($contacts as $contact)
                            <option value="{{ $contact->id }}">{{ $contact->name }} ({{ $contact->phone_number }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Scheduled Date & Time</label>
                    <input type="datetime-local" name="scheduled_date" class="form-control" required>
                </div>

                <button class="btn btn-success">Save Schedule</button>
                <a href="{{ route('scheduled.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
