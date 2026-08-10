@extends('layouts_site')
@section('content')
<div class="container py-5">
  <div class="row align-items-center g-4 mb-5">
    <div class="col-lg-7">
      <span class="badge rounded-pill text-bg-light border px-3 py-2 mb-3"><i class="bi bi-life-preserver me-1"></i> Help Center</span>
      <h1 class="display-4 fw-bold mb-3">सवाल है? <span class="text-success">जवाब यहाँ है।</span></h1>
      <p class="lead text-secondary">Sahayika पर helper खोजने, profile समझने और account इस्तेमाल करने से जुड़े common सवालों के आसान जवाब।</p>
    </div>
    <div class="col-lg-5">
      <div class="card border-0 shadow-sm overflow-hidden">
        <img src="{{ asset('assets/img/help1.jpg') }}" class="w-100" style="height:240px;object-fit:cover;" alt="Sahayika support">
        <div class="card-body">
          <div class="d-flex align-items-center gap-2"><i class="bi bi-chat-heart-fill text-danger fs-4"></i><strong>Need more help?</strong></div>
          <p class="small text-secondary mb-3">हमसे संपर्क करें और अपनी query बताएं।</p>
          <a href="{{ route('contact') }}" class="btn btn-dark rounded-pill px-4">Contact support</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row g-4">
    <div class="col-md-6"><div class="card h-100 border-0 shadow-sm p-4"><i class="bi bi-search-heart fs-2 text-success mb-3"></i><h3 class="h5 fw-bold">सहायिका कैसे खोजें?</h3><p class="text-secondary mb-0">Home page पर service और locality चुनकर “सहायिका/सहायक खोजें” दबाएँ। Results में profiles देखें और details खोलें।</p></div></div>
    <div class="col-md-6"><div class="card h-100 border-0 shadow-sm p-4"><i class="bi bi-ui-checks-grid fs-2 text-warning mb-3"></i><h3 class="h5 fw-bold">Multiple services चुन सकते हैं?</h3><p class="text-secondary mb-0">हाँ। Helper profile में एक helper कई services से जुड़ सकता है, जैसे झाड़ू-पोंछा, बर्तन और घर की सफाई।</p></div></div>
    <div class="col-md-6"><div class="card h-100 border-0 shadow-sm p-4"><i class="bi bi-geo-alt fs-2 text-danger mb-3"></i><h3 class="h5 fw-bold">Locality से search कैसे करें?</h3><p class="text-secondary mb-0">Vijay Nagar, Nipania, Palasia जैसी locality या उपलब्ध होने पर pincode से search किया जा सकता है।</p></div></div>
    <div class="col-md-6"><div class="card h-100 border-0 shadow-sm p-4"><i class="bi bi-person-plus fs-2 text-primary mb-3"></i><h3 class="h5 fw-bold">Helper बनने के लिए?</h3><p class="text-secondary mb-0">Register करें और Helper account चुनें। Services, experience, availability और expected salary की जानकारी भरें।</p></div></div>
  </div>
</div>
@endsection
