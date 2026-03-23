@extends('layout.admin') @section('content')

<style>
    .message-bubble {
    max-width: 70%;
    padding: 10px 15px;
    border-radius: 15px;
    word-wrap: break-word;
}

.user-bubble {
    background-color: #1877f2;
    color: white;
    border-bottom-right-radius: 0;
}

.admin-bubble {
    background-color: #e4e6eb;
    color: black;
    border-bottom-left-radius: 0;
}

</style>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Support Ticket List</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">SupportTicket</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            
            <div class="card-title">
                <div class="container">
    <h3>Ticket: {{ $ticket->subject }}</h2>
    <hr>
    <p><strong>User:</strong> {{ $username ?? 'Unknown User' }}</p>
    <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>



    <hr>
            </div>
            <div class="card-body vendor-table">
                
               <h4>Conversation</h4>
<div class="border p-3 mb-3" style="background: #f9f9f9; max-height: 400px; overflow-y: auto;">
    @forelse ($messages as $message)
        <div class="d-flex mb-3 {{ $message->sender_role == 'user' ? 'justify-content-end' : 'justify-content-start' }}">
            <div class="message-bubble {{ $message->sender_role == 'user' ? 'user-bubble' : 'admin-bubble' }}">
                <strong>{{ ucfirst($message->sender_role) }}:</strong>
                <p class="mb-1">{{ $message->message }}</p>
                <small class="text-muted d-block text-end">{{ $message->created_at->format('Y-m-d H:i') }}</small>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">No messages yet.</p>
    @endforelse
</div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(ucfirst($ticket->status) == 'Open')
    <h4>Reply to User</h4>
    <form action="{{ route('admin.support.reply', $ticket->ticket_id) }}" method="GET">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}" />
        <br>
          <label>Change Status:</label>
        <select name="status"  class="form-select" style="width: 200px;">
            <option value="open" {{ ucfirst($ticket->status) == 'Open' ? 'selected' : '' }}>Open</option>
            <option value="Close" {{ ucfirst($ticket->status) == 'Close' ? 'selected' : '' }}>Closed</option>
        </select>
        <br>
        <textarea name="message" class="form-control" rows="4" required></textarea>
        <button type="submit" class="btn btn-success mt-2">Send Reply</button>
    </form>
    @endif
</div>
     
        
                  
            </div>
        </div>
    </div>
</div>
@stop