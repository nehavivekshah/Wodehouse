@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Event Registrations</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="registrationsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event</th>
                            <th>Member</th>
                            <th>Status</th>
                            <th>Registered At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $reg)
                            <tr>
                                <td>{{ $reg->id }}</td>
                                <td>
                                    <strong>{{ $reg->event->title ?? 'Unknown Event' }}</strong><br>
                                    <small
                                        class="text-muted">{{ $reg->event ? $reg->event->event_date->format('d M Y') : '-' }}</small>
                                </td>
                                <td>
                                    {{ $reg->user->first_name }} {{ $reg->user->last_name }}<br>
                                    <small class="text-muted">{{ $reg->user->email }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-success">{{ ucfirst($reg->status) }}</span>
                                </td>
                                <td>{{ $reg->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#registrationsTable').DataTable({
                    "order": [[0, "desc"]]
                });
            });
        </script>
    @endpush
@endsection