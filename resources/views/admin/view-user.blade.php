
@section('content')
    <h2>User Details</h2>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Contact No:</strong> {{ $user->ContactNo }}</p>
    <p><strong>Address:</strong> {{ $user->Address }}</p>
    <p><strong>Created At:</strong> {{ $user->created_at }}</p>
    <p><strong>Updated At:</strong> {{ $user->updated_at }}</p>

    @if($user->image)
        <img src="{{ asset('upload/users/' . $user->image) }}" alt="User Image" width="100">
    @endif
@endsection
