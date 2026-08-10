@extends('layouts.app')
@section('title','Login — Sahayika')
@section('content')
<section class="form-hero"><div class="container"><span class="eyebrow">SAHAYIKA ACCOUNT</span><h1>Welcome back.</h1><p>यह starter project authentication UI को अलग रखता है. Existing login/authentication flow को यहाँ plug-in किया जा सकता है.</p><a href="{{ route('workers.index') }}" class="btn btn-primary">Local Workers देखें →</a></div></section>
@endsection
