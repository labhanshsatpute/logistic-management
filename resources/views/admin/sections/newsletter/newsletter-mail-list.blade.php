@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Newsletter Mails</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.newsletter.publish') }}">Newsletter</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.newsletter.mail.list') }}">Newsletter Mails</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Records</h1>
                <p class="panel-card-description">All available records </p>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($newsletter_mails as $newsletter_mail)
                            <tr>
                                <td>{{ $newsletter_mail->id }}</td>
                                <td>{{ $newsletter_mail->email }}</td>
                                <td>
                                    <label class="relative cursor-pointer">
                                        <input onchange="handleUpdateStatus({{$newsletter_mail->id}})" @checked($newsletter_mail->status) type="checkbox" class="sr-only peer">
                                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2.5px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-admin-ascent"></div>
                                    </label>
                                </td>
                                <td>
                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down" class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="javascript:handleDelete({{$newsletter_mail->id}});" class="dropdown-link-danger"><i data-feather="trash-2" class="mr-1"></i> Delete Email</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="panel-card-footer">

        </div>
    </figure>
@endsection

@section('panel-script')
    <script>
        document.getElementById('newsletter-tab').classList.add('active');

        const handleUpdateStatus = (id) => {
            fetch("{{ route('admin.handle.newsletter.mail.status') }}", {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    _token: "{{ csrf_token() }}"
                })
            }).then((response) => {
                return response.json();
            }).then((result) => {
                console.log(result);
            }).catch((error) => {
                console.error(error);
            });
        }

        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this mail!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/newsletter/mail/delete')}}/${id}`;
                    }
                });
        }
    </script>
@endsection
