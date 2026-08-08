<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register — Sahayika</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;0,9..144,900;1,9..144,500&family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --ink:#16302E; --paper:#FBF5EA; --marigold:#E8A33D; --marigold-deep:#C97F1F;
    --maroon:#A63446; --teal:#2F6E68; --card:#FFFDF8; --line: rgba(22,48,46,0.12);
  }
  *{box-sizing:border-box;}
  body{margin:0;background:var(--paper);color:var(--ink);font-family:'Inter',sans-serif;-webkit-font-smoothing:antialiased;min-height:100vh;}
  h1,h2,h3{font-family:'Fraunces',serif;}
  .label{font-family:'Space Grotesk',sans-serif;text-transform:uppercase;letter-spacing:.14em;font-weight:600;font-size:.72rem;}
  a{color:inherit;text-decoration:none;}
  .stamp svg{display:block;}
  .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:13px 22px;border-radius:100px;font-weight:600;font-size:.95rem;cursor:pointer;border:1.5px solid transparent;transition:all .2s ease;}
  .btn-primary{background:var(--marigold);color:var(--ink);}
  .btn-primary:hover{background:var(--marigold-deep);transform:translateY(-1px);}

  .page{display:grid;grid-template-columns:.92fr 1.08fr;min-height:100vh;}

  /* LEFT PANEL */
  .panel{
    background:linear-gradient(165deg,var(--ink) 0%, #0f2422 100%);
    color:var(--paper);
    padding:52px 48px;
    display:flex;flex-direction:column;justify-content:space-between;
    position:relative;overflow:hidden;
  }
  .brand{display:flex;align-items:center;gap:10px;font-family:'Fraunces',serif;font-weight:700;font-size:1.35rem;position:relative;z-index:1;}
  .panel-mid{position:relative;z-index:1;}
  .panel-mid .label{color:var(--marigold);margin-bottom:16px;display:block;}
  .panel-mid h2{font-size:clamp(1.7rem,2.6vw,2.2rem);line-height:1.18;margin:0 0 18px;font-weight:600;max-width:400px;}
  .panel-mid h2 em{font-style:italic;color:var(--marigold);}
  .panel-mid p{color:rgba(251,245,234,.68);font-size:.98rem;line-height:1.6;max-width:380px;margin:0;}

  .benefit-list{position:relative;z-index:1;display:flex;flex-direction:column;gap:16px;margin-top:32px;}
  .benefit{display:flex;gap:14px;align-items:flex-start;}
  .benefit .stamp{flex-shrink:0;margin-top:2px;}
  .benefit strong{display:block;font-size:.95rem;}
  .benefit small{color:rgba(251,245,234,.6);font-size:.82rem;line-height:1.5;}

  .panel-quote{position:relative;z-index:1;background:rgba(251,245,234,.08);border:1px solid rgba(251,245,234,.18);border-radius:16px;padding:18px 20px;}
  .panel-quote p{font-size:.9rem;color:rgba(251,245,234,.85);line-height:1.55;margin:0 0 10px;font-style:italic;}
  .panel-quote strong{font-size:.82rem;color:var(--marigold);}

  /* RIGHT FORM */
  .form-side{display:flex;align-items:center;justify-content:center;padding:44px 32px;}
  .form-wrap{width:100%;max-width:460px;}
  .form-top-link{display:flex;justify-content:flex-end;margin-bottom:4px;}
  .form-top-link a{font-size:.88rem;font-weight:500;color:rgba(22,48,46,.6);}
  .form-wrap h1{font-size:1.9rem;margin:10px 0 6px;font-weight:600;}
  .form-wrap > p.intro{color:rgba(22,48,46,.65);margin:0 0 24px;font-size:.96rem;}

  .role-toggle{display:flex;background:var(--card);border:1px solid var(--line);border-radius:100px;padding:4px;margin-bottom:26px;}
  .role-toggle button{flex:1;border:none;background:none;padding:11px 8px;border-radius:100px;font-weight:600;font-size:.86rem;cursor:pointer;color:rgba(22,48,46,.55);font-family:'Inter',sans-serif;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:6px;}
  .role-toggle button.active{background:var(--ink);color:var(--paper);}

  form{display:flex;flex-direction:column;gap:16px;}
  .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
  .fieldset{display:flex;flex-direction:column;gap:7px;}
  .fieldset label{font-size:.85rem;font-weight:600;color:rgba(22,48,46,.8);}
  .input-shell{position:relative;display:flex;align-items:center;}
  .input-shell svg{position:absolute;left:14px;pointer-events:none;}
  input, select{
    width:100%;padding:12px 14px 12px 42px;border-radius:12px;border:1.5px solid var(--line);
    background:var(--card);font-family:'Inter',sans-serif;font-size:.94rem;color:var(--ink);outline:none;transition:border-color .2s;
    appearance:none;-webkit-appearance:none;
  }
  select{padding-right:36px;}
  .select-arrow{position:absolute;right:14px;pointer-events:none;left:auto;}
  input:focus, select:focus{border-color:var(--teal);}
  .toggle-pass{position:absolute;right:14px;background:none;border:none;cursor:pointer;padding:4px;}

  .helper-only{display:none;}
  .helper-only.show{display:flex;}
  .helper-only.show-grid{display:grid;}

  .terms{display:flex;align-items:flex-start;gap:9px;font-size:.85rem;color:rgba(22,48,46,.7);line-height:1.5;}
  .terms input{width:16px;height:16px;margin-top:2px;accent-color:var(--marigold-deep);flex-shrink:0;padding:0;}
  .terms a{color:var(--maroon);font-weight:600;}

  .submit-btn{width:100%;padding:15px;margin-top:2px;}

  .switch-line{text-align:center;margin-top:24px;font-size:.92rem;color:rgba(22,48,46,.65);}
  .switch-line a{color:var(--marigold-deep);font-weight:700;}

  @media (max-width:940px){
    .page{grid-template-columns:1fr;}
    .panel{display:none;}
    .form-side{padding:32px 20px;min-height:100vh;align-items:flex-start;}
  }
  @media (max-width:520px){
    .grid-2{grid-template-columns:1fr;}
    .form-wrap h1{font-size:1.6rem;}
  }
</style>
</head>
<body>

<div class="page">

  <!-- LEFT: brand panel -->
  <div class="panel">
    <a href="/" class="brand">
      <span class="stamp"><svg width="32" height="32" viewBox="0 0 40 40" fill="none"><path d="M20 2 L23.5 5.5 L28.3 4.3 L30 9 L34.7 10.7 L33.5 15.5 L37 19 L33.5 22.5 L34.7 27.3 L30 29 L28.3 33.7 L23.5 32.5 L20 36 L16.5 32.5 L11.7 33.7 L10 29 L5.3 27.3 L6.5 22.5 L3 19 L6.5 15.5 L5.3 10.7 L10 9 L11.7 4.3 L16.5 5.5 Z" fill="#E8A33D"/><path d="M13.5 20 L18 24.5 L27 14.5" stroke="#16302E" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
      Sahayika
    </a>

    <div class="panel-mid">
      <span class="label">Join Sahayika</span>
      <h2>Create your account and get <em>verified help</em> — or start earning.</h2>
      <p>Whether you're hiring or looking for work, it takes less than two minutes to get started.</p>

      <div class="benefit-list">
        <div class="benefit">
          <span class="stamp"><svg width="26" height="26" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="rgba(232,163,61,0.18)"/><path d="M8 12.5 L11 15.5 L16 9" stroke="#E8A33D" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <div><strong>Free to join, always</strong><small>No hidden fees for families or helpers</small></div>
        </div>
        <div class="benefit">
          <span class="stamp"><svg width="26" height="26" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="rgba(232,163,61,0.18)"/><path d="M12 7 V12 L15.5 14" stroke="#E8A33D" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <div><strong>Get matched within 24 hours</strong><small>Fast onboarding &amp; verification</small></div>
        </div>
        <div class="benefit">
          <span class="stamp"><svg width="26" height="26" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="rgba(232,163,61,0.18)"/><path d="M8 16 L8 10 L12 7 L16 10 L16 16" stroke="#E8A33D" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <div><strong>Trusted across 30 cities</strong><small>24,000+ families and helpers, and growing</small></div>
        </div>
      </div>
    </div>

    <div class="panel-quote">
      <p>"Registering as a helper on Sahayika was the easiest sign-up I've done — verified and got my first booking in 3 days."</p>
      <strong>— Kamla Bai, Helper Partner, Indore</strong>
    </div>
  </div>

  <!-- RIGHT: form -->
  <div class="form-side">
    <div class="form-wrap">
      <div class="form-top-link"><a href="/">← Back to home</a></div>
      <h1>Create your account</h1>
      <p class="intro">Tell us a little about yourself to get started.</p>

      <div class="role-toggle" role="tablist">
        <button type="button" class="active" id="tabCustomer" onclick="setRole('customer')">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M6 20 C6 15.5 8.5 13 12 13 C15.5 13 18 15.5 18 20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="7" r="3.5" stroke="currentColor" stroke-width="1.8"/></svg>
          I need help
        </button>
        <button type="button" id="tabHelper" onclick="setRole('helper')">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M4 20 L20 20 M6 20 V10 L12 4 L18 10 V20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          I want to work
        </button>
      </div>

      <form action="#" method="POST">
        <div class="grid-2">
          <div class="fieldset">
            <label for="fname">Full Name</label>
            <div class="input-shell">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="3.5" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/><path d="M5 20 C5 16 8 14 12 14 C16 14 19 16 19 20" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/></svg>
              <input type="text" id="fname" name="full_name" placeholder="Full name" required>
            </div>
          </div>
          <div class="fieldset">
            <label for="phone">Phone Number</label>
            <div class="input-shell">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M6 4 H9 L11 9 L8.5 10.5 C9.5 13 11 14.5 13.5 15.5 L15 13 L20 15 V18 C20 19.1 19.1 20 18 20 C11.4 20 6 14.6 6 8 C6 6.9 6 4 6 4 Z" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.5"/></svg>
              <input type="tel" id="phone" name="phone" placeholder="+91 98xxxxxx" required>
            </div>
          </div>
        </div>

        <div class="fieldset">
          <label for="email">Email Address</label>
          <div class="input-shell">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 6 H20 V18 H4 Z" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/><path d="M4 7 L12 13 L20 7" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/></svg>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>
          </div>
        </div>

        <!-- CUSTOMER-ONLY FIELD -->
        <div class="fieldset role-field customer-only">
          <label for="address">Home Address / Area</label>
          <div class="input-shell">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 21 C12 21 5 14.5 5 9.5 C5 5.9 8.1 3 12 3 C15.9 3 19 5.9 19 9.5 C19 14.5 12 21 12 21Z" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/><circle cx="12" cy="9.5" r="2.3" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/></svg>
            <input type="text" id="address" name="address" placeholder="Area, city or pincode">
          </div>
        </div>

        <!-- HELPER-ONLY FIELDS -->
        <div class="grid-2 helper-only" id="helperGrid">
          <div class="fieldset">
            <label for="service_type">Service You Offer</label>
            <div class="input-shell">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 20 L20 20 M6 20 V10 L12 4 L18 10 V20" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/></svg>
              <select id="service_type" name="service_type">
                <option>Maid / House Help</option>
                <option>Cook</option>
                <option>Babysitter</option>
                <option>Elderly Care</option>
                <option>Driver</option>
                <option>Patient Care</option>
              </select>
              <svg class="select-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M6 9 L12 15 L18 9" stroke="#16302E" stroke-opacity="0.5" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
          </div>
          <div class="fieldset">
            <label for="experience">Experience</label>
            <div class="input-shell">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="8.5" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/><path d="M12 7 V12 L15.5 14" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/></svg>
              <select id="experience" name="experience">
                <option>Less than 1 year</option>
                <option>1–3 years</option>
                <option>3–5 years</option>
                <option>5+ years</option>
              </select>
              <svg class="select-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M6 9 L12 15 L18 9" stroke="#16302E" stroke-opacity="0.5" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
          </div>
        </div>

        <div class="fieldset helper-only" id="helperCity">
          <label for="city">City / Preferred Work Area</label>
          <div class="input-shell">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 21 C12 21 5 14.5 5 9.5 C5 5.9 8.1 3 12 3 C15.9 3 19 5.9 19 9.5 C19 14.5 12 21 12 21Z" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/><circle cx="12" cy="9.5" r="2.3" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/></svg>
            <input type="text" id="city" name="city" placeholder="e.g. Indore, Vijay Nagar">
          </div>
        </div>

        <div class="fieldset">
          <label for="password">Create Password</label>
          <div class="input-shell">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><rect x="5" y="10" width="14" height="10" rx="2" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/><path d="M8 10 V7 A4 4 0 0 1 16 7 V10" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/></svg>
            <input type="password" id="password" name="password" placeholder="At least 8 characters" required>
            <button type="button" class="toggle-pass" onclick="togglePassword('password')" aria-label="Show password">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M2 12 C4.5 7 8 4.5 12 4.5 C16 4.5 19.5 7 22 12 C19.5 17 16 19.5 12 19.5 C8 19.5 4.5 17 2 12 Z" stroke="#16302E" stroke-opacity="0.5" stroke-width="1.6"/><circle cx="12" cy="12" r="3" stroke="#16302E" stroke-opacity="0.5" stroke-width="1.6"/></svg>
            </button>
          </div>
        </div>

        <label class="terms">
          <input type="checkbox" required>
          <span>I agree to Sahayika's <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>, and consent to background verification checks.</span>
        </label>

        <button type="submit" class="btn btn-primary submit-btn" id="submitBtn">Create Account</button>
      </form>

      <p class="switch-line">Already have an account? <a href="/login">Log in</a></p>
    </div>
  </div>

</div>

<script>
  function setRole(role){
    const isHelper = role === 'helper';
    document.getElementById('tabCustomer').classList.toggle('active', !isHelper);
    document.getElementById('tabHelper').classList.toggle('active', isHelper);

    document.getElementById('helperGrid').classList.toggle('show-grid', isHelper);
    document.getElementById('helperCity').classList.toggle('show', isHelper);

    document.querySelectorAll('.customer-only').forEach(el=>{
      el.style.display = isHelper ? 'none' : 'flex';
    });

    document.getElementById('submitBtn').textContent = isHelper ? 'Register as Helper' : 'Create Account';
  }
  function togglePassword(id){
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
  }
</script>

</body>
</html>