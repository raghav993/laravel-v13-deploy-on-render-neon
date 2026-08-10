@extends('layouts.app')
@section('title','Register — Sahayika')
@section('content')
<section class="form-hero"><div class="container"><span class="eyebrow">SAHAYIKA ACCOUNT</span><h1>अपना Sahayika account बनाएं.</h1><p>Account authentication को आपके existing auth implementation से connect किया जा सकता है. Local worker profile के लिए सीधे professional registration भी available है.</p><a href="{{ route('workers.create') }}" class="btn btn-primary">Local Worker Profile बनाएं →</a></div></section>
@endsection
