@extends('layouts_site')
@section('content')
<div class="container py-5">
  <div class="row align-items-center g-5">
    <div class="col-lg-6">
      <span class="badge rounded-pill text-bg-light border px-3 py-2 mb-3"><i class="bi bi-briefcase me-1"></i> Careers at Sahayika</span>
      <h1 class="display-4 fw-bold mb-3">कुछ अच्छा बनाने का <span class="text-success">हिस्सा बनिए।</span></h1>
      <p class="lead text-secondary">हम ऐसा platform बना रहे हैं जो families को domestic और family-support services खोजने में आसान, साफ़ और भरोसेमंद experience दे।</p>
      <div class="d-flex flex-wrap gap-2 mt-4">
        <span class="badge rounded-pill bg-success-subtle text-success-emphasis px-3 py-2"><i class="bi bi-heart me-1"></i> People first</span>
        <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis px-3 py-2"><i class="bi bi-lightbulb me-1"></i> Build with purpose</span>
        <span class="badge rounded-pill bg-primary-subtle text-primary-emphasis px-3 py-2"><i class="bi bi-code-slash me-1"></i> Modern technology</span>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card border-0 shadow overflow-hidden">
        <img src="{{ asset('assets/img/testimonials/3.png') }}" class="w-100" style="height:360px;object-fit:cover;" alt="Join Sahayika">
        <div class="card-body p-4">
          <div class="d-flex align-items-center gap-3 mb-3"><span class="rounded-circle bg-success-subtle p-3"><i class="bi bi-people-fill text-success fs-4"></i></span><div><h2 class="h5 mb-1">हमारी टीम से जुड़ना चाहते हैं?</h2><p class="small text-secondary mb-0">Openings उपलब्ध होने पर यही page update होगा।</p></div></div>
          <a class="btn btn-dark rounded-pill px-4" href="{{ route('contact') }}">हमसे संपर्क करें <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
