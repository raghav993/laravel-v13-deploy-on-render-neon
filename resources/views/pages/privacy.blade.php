@extends('layouts_site')
@section('content')
<div class="container py-5">
  <div class="row g-4 align-items-center mb-5">
    <div class="col-lg-7">
      <span class="badge rounded-pill text-bg-light border px-3 py-2 mb-3"><i class="bi bi-shield-lock me-1"></i> Privacy Policy</span>
      <h1 class="display-4 fw-bold mb-3">आपकी जानकारी,<br><span class="text-success">आपका भरोसा।</span></h1>
      <p class="lead text-secondary">Sahayika development version में user information को responsible तरीके से handle करने के सामान्य principles।</p>
    </div>
    <div class="col-lg-5 text-center">
      <div class="rounded-4 bg-success-subtle p-4 shadow-sm">
        <img src="{{ asset('assets/img/privacy.jpg') }}" class="rounded mx-auto mb-3 border border-4 border-white shadow" style="object-fit:cover;" alt="Privacy">
        <i class="bi bi-shield-check-fill text-success fs-1"></i>
      </div>
    </div>
  </div>
  <div class="row g-4">
    <div class="col-md-6"><div class="card h-100 border-0 shadow-sm p-4"><i class="bi bi-person-vcard fs-2 text-primary mb-3"></i><h2 class="h5 fw-bold">हम कौन-सी जानकारी लेते हैं?</h2><p class="text-secondary mb-0">Account के लिए नाम, email/phone और password जैसी authentication information। Helper profiles में services, experience, availability और locality जैसी marketplace information हो सकती है।</p></div></div>
    <div class="col-md-6"><div class="card h-100 border-0 shadow-sm p-4"><i class="bi bi-slash-circle fs-2 text-danger mb-3"></i><h2 class="h5 fw-bold">हम क्या नहीं माँगते?</h2><p class="text-secondary mb-0">Demo marketplace के लिए Aadhaar, PAN, bank account details या identity documents जैसी अनावश्यक sensitive information store नहीं की जानी चाहिए।</p></div></div>
    <div class="col-12"><div class="card border-0 shadow-sm p-4"><i class="bi bi-database-check fs-2 text-success mb-3"></i><h2 class="h5 fw-bold">आपकी जानकारी का उपयोग</h2><p class="text-secondary mb-0">Information का उपयोग account management, helper search, profiles और platform functionality देने के लिए किया जाता है। Production deployment से पहले privacy, consent, retention और security requirements के अनुसार legal review जरूरी है।</p></div></div>
    <!-- <div class="col-12"><div class="alert alert-warning border-0 shadow-sm"><i class="bi bi-info-circle-fill me-2"></i><strong>Demo environment:</strong> Development database में seeded users fictional testing records हैं। इन्हें वास्तविक लोगों की personal information न समझें।</div></div> -->
  </div>
</div>
@endsection
