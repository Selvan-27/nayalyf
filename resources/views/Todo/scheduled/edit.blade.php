@extends('Todo.layouts')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            ✏️ Update / Re-Schedule Call
        </div>
        <div class="card-body">
            <form action="{{ route('scheduled.update', $call->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    
                    
                    <input type="hidden" name="contact_id" value="{{ $call->contact_id }}" readonly=""/>
                  
                </div>
                
                 <div class="mb-3">
                    <label class="form-label">Action</label>
                    <select name="status" class="form-select">
                        <option value="pending" selected>Reschedule</option>
                        <option value="new">New User</option>
                           <option value="order">Product Order</option>
                    </select>
                </div>
                

                <div class="mb-3">
                    <label class="form-label">Scheduled Date & Time</label>
                    <input type="datetime-local" name="scheduled_date" class="form-control"
                        value="{{ \Carbon\Carbon::parse($call->scheduled_date)->format('Y-m-d\TH:i') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="3" placeholder="Add call notes...">{{ $call->notes }}</textarea>
                </div>

                
                <button class="btn btn-success">💾 Update Schedule</button>
                <a href="{{ route('scheduled.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
