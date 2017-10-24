@extends('layouts.app')
@section('script')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <test-exam value="{{ $subject }}"></test-exam>
    </div>
</div>
@endsection
