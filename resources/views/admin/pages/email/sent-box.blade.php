@extends('admin.master')

@push('style')
    <style>
        .truncated-body, .full-body {
            display: inline;
        }

        .full-body{
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header hc-header-outer">
                        <h4 class="hc-header-title">
                            Sending E-mail list
                        </h4>
                        <a href="{{ route('email.create') }}" class="btn btn-sm btn-manage email-btn">
                            <i class="fa-solid fa-circle-plus"></i> Compose
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-data">
                          <thead>
                              <tr>
                                 <th class="table-sl">SL</th>
                                 <th>Sending date</th>
                                 <th>Email</th>
                                 <th>Subject</th>
                                 <th>Message</th>
                                 <th class="table-action">Action</th>
                              </tr>
                         </thead>
                         <tbody>

                         </tbody>
                       </table>
                    </div>
               </div>
          </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">
          $(function () {
            
            var table = $('.table-data').DataTable({
                processing: true,
                serverSide: true,
                responsive:true,
                ajax: "{{ route('email.manage') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            var date = new Date(data);
                            return date.toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                        }
                    },
                    {data: 'email_to', name: 'email_to'},
                    {data: 'subject', name: 'subject'},
                    {
                        data: 'body', 
                        name: 'body',
                        render: function(data, type, row){
                            let truncatedBody = data.length > 80 ? data.substring(0, 80) + '...' : data;
                            let fullBody = $('<div/>').text(data).html();
                            return `
                                <span class="truncated-body">${truncatedBody}</span>
                                <span class="full-body">${fullBody}</span>
                                <a href="#" class="toggle-body" data-truncated="${truncatedBody}" data-full="${fullBody}">Read More</a>
                            `;
                        }
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $(document).on('click', '.toggle-body', function(e){
                e.preventDefault();
                let $link = $(this);
                let $truncate = $link.siblings('.truncated-body');
                let $full = $link.siblings('.full-body');

                if($truncate.is(':visible')){
                    $truncate.hide();
                    $full.show();
                    $link.text('Read less')
                }else{
                    $full.hide();
                    $truncate.show();
                    $link.text('Read More')
                }
            })
            
          });
</script>
@endpush