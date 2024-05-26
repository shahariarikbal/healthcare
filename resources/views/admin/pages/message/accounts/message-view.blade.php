@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                          <span>{{ $account->full_name ?? 'Doctor name' }}</span>
                          <a href="{{ route('doctor.list') }}" class="btn btn-sm float-end btn-add">
                              <i class="fa-solid fa-arrow-left"></i> Back
                          </a>
                    </div>
                    <div class="card-body">
                         <div class="message-body">

                              <div class="sent-messages">
                                   @foreach ($sentMessages as $message)
                                       <div class="message sent-message">
                                           <img src="{{ $account->avatar }}" class="avatar" />
                                           <div class="details-info">
                                               <span class="name">{{ $account->full_name ?? 'Sender name' }}</span>
                                               <span>{{ $message->message ?? '' }}</span>
                                               <span class="text-primary">{{ $message->created_at->diffForHumans() ?? '' }}</span>
                                           </div>
                                       </div>
                                   @endforeach

                                   @foreach ($receivedMessages as $message)
                                       <div class="message received-message">
                                           <img src="{{ $message->sender?->avatar }}" class="avatar" />
                                           <div class="details-info">
                                               <span class="name">{{ $message->sender?->name ?? 'Receiver name' }}</span>
                                               <span>{{ $message->message ?? '' }}</span>
                                               <span class="text-primary">{{ $message->created_at->diffForHumans() ?? '' }}</span>
                                           </div>
                                       </div>
                                   @endforeach
                               </div>

                               <div class="received-messages">
                                   
                               </div>

                         </div>
                        <form action="{{ route('accounts.message.store', $account->id) }}" method="post">
                         @csrf
                         <div class="form-group mt-2">
                              <textarea name="message" class="form-control" placeholder="Enter message here..."></textarea>
                              <button type="submit" class="btn btn-submit float-end mt-2">Send</button>
                         </div>
                        </form>
                    </div>
               </div>
          </div>
    </div>
@endsection