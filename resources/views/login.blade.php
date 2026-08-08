<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Log In — Sahayika</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;0,9..144,900;1,9..144,500&family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --ink:#16302E; --paper:#FBF5EA; --marigold:#E8A33D; --marigold-deep:#C97F1F;
    --maroon:#A63446; --teal:#2F6E68; --card:#FFFDF8; --line: rgba(22,48,46,0.12);
  }
  *{box-sizing:border-box;}
  body{margin:0;background:var(--paper);color:var(--ink);font-family:'Inter',sans-serif;-webkit-font-smoothing:antialiased;min-height:100vh;}
  h1,h2,h3,.display{font-family:'Fraunces',serif;}
  .label{font-family:'Space Grotesk',sans-serif;text-transform:uppercase;letter-spacing:.14em;font-weight:600;font-size:.72rem;}
  a{color:inherit;text-decoration:none;}
  .stamp svg{display:block;}
  .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:13px 22px;border-radius:100px;font-weight:600;font-size:.95rem;cursor:pointer;border:1.5px solid transparent;transition:all .2s ease;}
  .btn-primary{background:var(--marigold);color:var(--ink);}
  .btn-primary:hover{background:var(--marigold-deep);transform:translateY(-1px);}
  .btn-ghost{border-color:var(--line);color:var(--ink);background:var(--card);}
  .btn-ghost:hover{border-color:var(--ink);}

  .page{display:grid;grid-template-columns:1fr 1fr;min-height:100vh;}

  /* LEFT PANEL */
  .panel{
    background:linear-gradient(165deg,var(--ink) 0%, #0f2422 100%);
    color:var(--paper);
    padding:52px 56px;
    display:flex;flex-direction:column;justify-content:space-between;
    position:relative;overflow:hidden;
  }
  .panel-stamps{position:absolute;inset:0;opacity:.05;background-image:
    radial-gradient(circle at 15% 20%, transparent 38px, transparent 40px),
    none;
  }
  .brand{display:flex;align-items:center;gap:10px;font-family:'Fraunces',serif;font-weight:700;font-size:1.35rem;position:relative;z-index:1;}
  .panel-mid{position:relative;z-index:1;}
  .panel-mid .label{color:var(--marigold);margin-bottom:16px;display:block;}
  .panel-mid h2{font-size:clamp(1.9rem,3vw,2.5rem);line-height:1.15;margin:0 0 20px;font-weight:600;max-width:420px;}
  .panel-mid h2 em{font-style:italic;color:var(--marigold);}
  .panel-mid p{color:rgba(251,245,234,.68);font-size:1rem;line-height:1.6;max-width:400px;margin:0;}

  .panel-cards{position:relative;z-index:1;display:flex;flex-direction:column;gap:14px;margin-top:36px;}
  .p-card{background:rgba(251,245,234,.08);border:1px solid rgba(251,245,234,.18);border-radius:16px;padding:16px 18px;display:flex;align-items:center;gap:14px;}
  .p-card strong{display:block;font-size:.95rem;}
  .p-card small{color:rgba(251,245,234,.6);font-size:.82rem;}

  .panel-foot{position:relative;z-index:1;display:flex;align-items:center;gap:16px;}
  .panel-foot .avatars{display:flex;}
  .panel-foot .avatars span{width:32px;height:32px;border-radius:50%;border:2px solid var(--ink);margin-left:-9px;}
  .panel-foot .avatars span:first-child{margin-left:0;}
  .panel-foot small{color:rgba(251,245,234,.65);font-size:.85rem;}

  /* RIGHT FORM */
  .form-side{display:flex;align-items:center;justify-content:center;padding:48px 32px;}
  .form-wrap{width:100%;max-width:400px;}
  .form-top-link{display:flex;justify-content:flex-end;margin-bottom:8px;}
  .form-top-link a{font-size:.88rem;font-weight:500;color:rgba(22,48,46,.6);}
  .form-wrap h1{font-size:2rem;margin:12px 0 8px;font-weight:600;}
  .form-wrap > p.intro{color:rgba(22,48,46,.65);margin:0 0 32px;font-size:.98rem;}

  .role-toggle{display:flex;background:var(--card);border:1px solid var(--line);border-radius:100px;padding:4px;margin-bottom:28px;}
  .role-toggle button{flex:1;border:none;background:none;padding:10px 8px;border-radius:100px;font-weight:600;font-size:.86rem;cursor:pointer;color:rgba(22,48,46,.55);font-family:'Inter',sans-serif;transition:all .2s;}
  .role-toggle button.active{background:var(--ink);color:var(--paper);}

  form{display:flex;flex-direction:column;gap:18px;}
  .fieldset{display:flex;flex-direction:column;gap:7px;}
  .fieldset label{font-size:.85rem;font-weight:600;color:rgba(22,48,46,.8);}
  .input-shell{position:relative;display:flex;align-items:center;}
  .input-shell svg{position:absolute;left:14px;pointer-events:none;}
  input[type="text"], input[type="email"], input[type="password"], input[type="tel"]{
    width:100%;padding:13px 14px 13px 42px;border-radius:12px;border:1.5px solid var(--line);
    background:var(--card);font-family:'Inter',sans-serif;font-size:.95rem;color:var(--ink);outline:none;transition:border-color .2s;
  }
  input:focus{border-color:var(--teal);}
  .toggle-pass{position:absolute;right:14px;background:none;border:none;cursor:pointer;padding:4px;}

  .row-between{display:flex;align-items:center;justify-content:space-between;font-size:.85rem;}
  .remember{display:flex;align-items:center;gap:8px;color:rgba(22,48,46,.7);}
  .remember input{accent-color:var(--marigold-deep);width:15px;height:15px;}
  .row-between a{color:var(--maroon);font-weight:600;}

  .submit-btn{width:100%;padding:15px;margin-top:6px;}

  .divider{display:flex;align-items:center;gap:12px;margin:26px 0;color:rgba(22,48,46,.45);font-size:.82rem;}
  .divider::before, .divider::after{content:"";flex:1;height:1px;background:var(--line);}

  .social-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
  .social-btn{display:flex;align-items:center;justify-content:center;gap:10px;padding:12px;border-radius:12px;border:1.5px solid var(--line);background:var(--card);font-weight:600;font-size:.88rem;cursor:pointer;color:var(--ink);}
  .social-btn:hover{border-color:var(--ink);}

  .switch-line{text-align:center;margin-top:28px;font-size:.92rem;color:rgba(22,48,46,.65);}
  .switch-line a{color:var(--marigold-deep);font-weight:700;}

  @media (max-width:940px){
    .page{grid-template-columns:1fr;}
    .panel{display:none;}
    .form-side{padding:32px 20px;min-height:100vh;}
  }
  @media (max-width:420px){
    .form-wrap h1{font-size:1.7rem;}
    .social-row{grid-template-columns:1fr;}
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
      <span class="label">Welcome Back</span>
      <h2>Your trusted home help is <em>one login away.</em></h2>
      <p>Manage bookings, message your helpers, and track schedules — all from one place.</p>

      <div class="panel-cards">
        <div class="p-card">
          <span class="stamp"><svg width="30" height="30" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="rgba(232,163,61,0.18)"/><path d="M8 12.5 L11 15.5 L16 9" stroke="#E8A33D" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <div><strong>Verified helpers only</strong><small>Every profile is background-checked</small></div>
        </div>
        <div class="p-card">
          <span class="stamp"><svg width="30" height="30" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="rgba(232,163,61,0.18)"/><path d="M12 7 V12 L15.5 14" stroke="#E8A33D" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <div><strong>Book in under a minute</strong><small>Real-time availability near you</small></div>
        </div>
      </div>
    </div>

    <div class="panel-foot">
      <div class="avatars">
        <span style="background-color:#c98b4a;"></span>
        <span style="background-color:#7a9e9f;"></span>
        <span style="background-color:#c15b5b;"></span>
      </div>
      <small>Joined by 24,000+ families and helpers across India</small>
    </div>
  </div>

  <!-- RIGHT: form -->
  <div class="form-side">
    <div class="form-wrap">
      <div class="form-top-link"><a href="/">← Back to home</a></div>
      <h1>Log in to Sahayika</h1>
      <p class="intro">Enter your details to access your account.</p>

      <div class="role-toggle" role="tablist">
        <button type="button" class="active" id="tabCustomer" onclick="setRole('customer')">I need help</button>
        <button type="button" id="tabHelper" onclick="setRole('helper')">I'm a helper</button>
      </div>

      <form action="#" method="POST">
        <div class="fieldset">
          <label for="identifier">Email or Phone Number</label>
          <div class="input-shell">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 6 H20 V18 H4 Z" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/><path d="M4 7 L12 13 L20 7" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/></svg>
            <input type="text" id="identifier" name="identifier" placeholder="you@example.com" required>
          </div>
        </div>

        <div class="fieldset">
          <label for="password">Password</label>
          <div class="input-shell">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><rect x="5" y="10" width="14" height="10" rx="2" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/><path d="M8 10 V7 A4 4 0 0 1 16 7 V10" stroke="#16302E" stroke-opacity="0.45" stroke-width="1.6"/></svg>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <button type="button" class="toggle-pass" onclick="togglePassword('password', this)" aria-label="Show password">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M2 12 C4.5 7 8 4.5 12 4.5 C16 4.5 19.5 7 22 12 C19.5 17 16 19.5 12 19.5 C8 19.5 4.5 17 2 12 Z" stroke="#16302E" stroke-opacity="0.5" stroke-width="1.6"/><circle cx="12" cy="12" r="3" stroke="#16302E" stroke-opacity="0.5" stroke-width="1.6"/></svg>
            </button>
          </div>
        </div>

        <div class="row-between">
          <label class="remember"><input type="checkbox" name="remember"> Remember me</label>
          <a href="#">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-primary submit-btn">Log In</button>
      </form>

      <div class="divider">or continue with</div>

      <div class="social-row">
        <button class="social-btn"><svg width="18" height="18" viewBox="0 0 24 24"><path d="M21.35 11.1h-9.17v2.92h5.27c-.23 1.4-1.66 4.1-5.27 4.1-3.17 0-5.76-2.62-5.76-5.85s2.59-5.85 5.76-5.85c1.8 0 3.01.77 3.7 1.43l2.52-2.43C16.86 3.7 14.7 2.7 12.18 2.7 6.98 2.7 2.77 6.9 2.77 12.17s4.21 9.47 9.41 9.47c5.43 0 9.03-3.82 9.03-9.2 0-.62-.07-1.09-.14-1.34z" fill="#16302E"/></svg> Google</button>
        <button class="social-btn"><svg width="18" height="18" viewBox="0 0 24 24"><path d="M14 8H16V5H14C12 5 10.5 6.5 10.5 8.5V10H8.5V13H10.5V20H13.5V13H15.5L16 10H13.5V8.7C13.5 8.3 13.7 8 14 8Z" fill="#16302E"/></svg> Facebook</button>
      </div>

      <p class="switch-line">Don't have an account? <a href="/register">Register free</a></p>
    </div>
  </div>

</div>

<script>
  function setRole(role){
    document.getElementById('tabCustomer').classList.toggle('active', role==='customer');
    document.getElementById('tabHelper').classList.toggle('active', role==='helper');
  }
  function togglePassword(id, btn){
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
  }
</script>

</body>
</html>