<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Liên hệ — Công ty</title>
  <meta name="description" content="Trang liên hệ hiện đại, tông màu xám đen, với bản đồ tương tác và biểu mẫu liên hệ." />
  <style>
    /* Google font import (inside style tag to comply with inline styles requirement) */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&family=Rubik:wght@400;500;700&display=swap');

    :root{
      --bg-1:#0b0b0b;
      --bg-2:#141414;
      --card:#111216;
      --muted:#9aa0a6;
      --accent:#bdbdbd;
      --glass: rgba(255,255,255,0.03);
      --accent-soft: rgba(255,255,255,0.04);
      --success: #2ecc71;
      --danger: #ff6b6b;
      --shadow: 0 8px 30px rgba(2,6,23,0.6);
      --radius: 14px;
    }

    /* Reset & base */
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background: linear-gradient(180deg,var(--bg-1) 0%, #0f1114 35%, #1a1b1d 100%);
      color: #e6e6e6;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      line-height:1.45;
      padding:40px;
      display:flex;
      align-items:center;
      justify-content:center;
      min-height:100vh;
      transition: background 0.4s ease;
    }

    /* Container */
    .wrap{
      width:100%;
      max-width:1150px;
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border-radius: calc(var(--radius) + 6px);
      padding:28px;
      box-shadow: var(--shadow);
      position:relative;
      overflow:hidden;
      border:1px solid rgba(255,255,255,0.03);
    }

    /* Decorative gradient */
    .wrap::before{
      content:"";
      position:absolute;
      inset: -30% -40% auto auto;
      width:500px;
      height:500px;
      background: radial-gradient(closest-side, rgba(255,255,255,0.02), rgba(255,255,255,0) 40%), linear-gradient(180deg, rgba(255,255,255,0.01), rgba(0,0,0,0));
      transform:rotate(25deg);
      pointer-events:none;
    }

    header.top{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:20px;
      margin-bottom:18px;
    }
    .title{
      display:flex;
      gap:16px;
      align-items:center;
    }
    .logo{
      width:56px;
      height:56px;
      border-radius:12px;
      background: linear-gradient(135deg,#2b2b2b 0%, #111 100%);
      display:flex;
      align-items:center;
      justify-content:center;
      box-shadow: 0 6px 18px rgba(2,6,23,0.45), inset 0 1px 0 rgba(255,255,255,0.02);
      border:1px solid rgba(255,255,255,0.03);
      font-weight:700;
      color:var(--accent);
      font-family:'Rubik', sans-serif;
    }
    .heading h1{
      margin:0;
      font-size:20px;
      font-weight:700;
      letter-spacing:0.2px;
      color:#f5f5f5;
    }
    .heading p{
      margin:0;
      color:var(--muted);
      font-size:13px;
    }

    /* Layout columns */
    .cols{
      display:grid;
      grid-template-columns: 1fr 420px;
      gap:22px;
      align-items:start;
    }

    /* Form card */
    .card{
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border-radius: var(--radius);
      padding:22px;
      border:1px solid rgba(255,255,255,0.03);
      box-shadow: 0 10px 30px rgba(2,6,23,0.45);
    }

    form{
      display:flex;
      flex-direction:column;
      gap:12px;
    }

    .row{
      display:flex;
      gap:12px;
    }
    .col{
      flex:1;
    }

    /* Floating labels */
    .field{
      position:relative;
    }
    input[type="text"], input[type="email"], textarea{
      width:100%;
      background:var(--glass);
      border:1px solid rgba(255,255,255,0.04);
      padding:14px 14px 12px 14px;
      color:#eaeaea;
      border-radius:10px;
      outline:none;
      font-size:14px;
      transition: box-shadow .18s ease, border-color .18s ease, transform .12s ease;
      resize:vertical;
      min-height:44px;
    }
    input:focus, textarea:focus{
      box-shadow: 0 6px 18px rgba(20,20,20,0.6), 0 0 0 4px rgba(255,255,255,0.01) inset;
      border-color: #8f8f8f;
      transform: translateY(-1px);
    }
    label.floating{
      position:absolute;
      left:14px;
      top:12px;
      font-size:13px;
      color:var(--muted);
      pointer-events:none;
      transition: all .18s ease;
    }
    input:not(:placeholder-shown) + label.floating,
    textarea:not(:placeholder-shown) + label.floating,
    input:focus + label.floating,
    textarea:focus + label.floating{
      transform: translateY(-10px) scale(.86);
      color: #cfcfcf;
      background: transparent;
      padding:0 4px;
    }

    textarea{ min-height:120px; padding-top:18px; }

    .meta{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:12px;
    }

    .btn{
      background: linear-gradient(180deg,#2a2a2a,#1a1a1a);
      color:#fff;
      border:1px solid rgba(255,255,255,0.04);
      padding:12px 16px;
      border-radius:10px;
      cursor:pointer;
      font-weight:600;
      display:inline-flex;
      align-items:center;
      gap:10px;
      box-shadow: 0 8px 18px rgba(0,0,0,0.6);
      transition: transform .14s ease, box-shadow .14s ease, background .12s ease;
    }
    .btn:active{ transform: translateY(1px) }
    .btn.primary{
      background: linear-gradient(90deg,#2e2e2e,#0f0f0f);
      border: 1px solid rgba(255,255,255,0.06);
    }

    .hint{
      font-size:13px;
      color:var(--muted);
    }

    /* Right column: contact & map */
    .contact-side{
      display:flex;
      flex-direction:column;
      gap:12px;
    }

    .map-wrap{
      border-radius:12px;
      overflow:hidden;
      border:1px solid rgba(255,255,255,0.03);
      box-shadow: 0 10px 30px rgba(2,6,23,0.55);
      height:260px;
      position:relative;
      background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
    }
    .map-wrap iframe{
      width:100%;
      height:100%;
      border:0;
      display:block;
    }
    .map-actions{
      position:absolute;
      right:10px;
      top:10px;
      display:flex;
      gap:8px;
      z-index:4;
    }
    .chip{
      padding:8px 10px;
      background: rgba(0,0,0,0.4);
      border-radius:10px;
      color:#eaeaea;
      font-size:13px;
      display:inline-flex;
      gap:8px;
      align-items:center;
      border:1px solid rgba(255,255,255,0.03);
      cursor:pointer;
      transition: transform .12s ease;
    }
    .chip:active{ transform: translateY(1px) }

    .info{
      padding:12px;
      display:flex;
      flex-direction:column;
      gap:8px;
      background: linear-gradient(180deg, rgba(255,255,255,0.015), transparent);
      border-radius:8px;
    }
    .info .item{
      display:flex;
      gap:12px;
      align-items:center;
    }
    .icon{
      width:42px;
      height:42px;
      border-radius:10px;
      background: rgba(255,255,255,0.02);
      display:flex;
      align-items:center;
      justify-content:center;
      border:1px solid rgba(255,255,255,0.03);
      color:var(--accent);
    }
    .info .content{
      display:flex;
      flex-direction:column;
    }
    .info .content .label{ font-size:13px; color:var(--muted) }
    .info .content .value{ font-weight:600; color:#efefef }

    /* small footer row */
    .foot{
      display:flex;
      gap:10px;
      align-items:center;
      justify-content:space-between;
      margin-top:8px;
      color:var(--muted);
      font-size:13px;
    }

    /* Snackbar */
    .snack{
      position:fixed;
      left:50%;
      transform:translateX(-50%) translateY(20px);
      bottom:24px;
      background: linear-gradient(180deg,#1e1f21,#0f0f10);
      color:#fff;
      padding:12px 18px;
      border-radius:10px;
      box-shadow:0 8px 30px rgba(0,0,0,0.6);
      border:1px solid rgba(255,255,255,0.03);
      opacity:0;
      pointer-events:none;
      transition:opacity .22s ease, transform .22s ease;
      z-index:1000;
    }
    .snack.show{
      opacity:1;
      pointer-events:auto;
      transform:translateX(-50%) translateY(0);
    }

    /* Map fullscreen modal */
    .map-modal{
      position:fixed;
      inset:0;
      background: rgba(5,5,5,0.85);
      display:flex;
      align-items:center;
      justify-content:center;
      z-index:1200;
      padding:20px;
      visibility:hidden;
      opacity:0;
      transition: opacity .18s ease, visibility .18s;
    }
    .map-modal.show{
      visibility:visible;
      opacity:1;
    }
    .map-modal .modal-card{
      width:100%;
      max-width:1100px;
      height:80vh;
      border-radius:14px;
      overflow:hidden;
      border:1px solid rgba(255,255,255,0.04);
      box-shadow: 0 20px 60px rgba(0,0,0,0.7);
    }
    .close-btn{
      position:absolute;
      right:22px;
      top:22px;
      background: rgba(0,0,0,0.45);
      color:#fff;
      border-radius:10px;
      padding:8px 10px;
      border:1px solid rgba(255,255,255,0.03);
      cursor:pointer;
    }

    /* Responsive */
    @media (max-width:980px){
      body{ padding:20px; }
      .cols{ grid-template-columns:1fr; }
      .map-wrap{ height:220px; }
      .wrap{ padding:18px; }
      header.top{ flex-direction:column; align-items:flex-start; gap:8px; }
    }

    @media (max-width:420px){
      .logo{ width:48px; height:48px; border-radius:10px; }
      .map-wrap{ height:200px; border-radius:12px; }
      .card{ padding:16px; }
      input, textarea{ padding:12px; }
    }

    /* Tiny helpers */
    .muted{ color:var(--muted); font-size:13px }
    .socials{ display:flex; gap:10px }
    .socials a{ display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:10px; background: rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.03); color:var(--accent) }
    .small{ font-size:13px; color:var(--muted) }
  </style>
</head>
<body>
  <div class="wrap" role="main" aria-labelledby="main-title">
    <header class="top">
      <div class="title">
        <div class="logo" aria-hidden="true">CT</div>
        <div class="heading">
          <h1 id="main-title">Liên hệ</h1>
          <p>Chúng tôi sẵn sàng hỗ trợ bạn 24/7 — gửi tin nhắn hoặc đến trực tiếp</p>
        </div>
      </div>
      <div class="small muted">
        <div style="display:flex;gap:14px;align-items:center">
          <div style="display:flex;flex-direction:column;align-items:flex-end">
            <span style="font-weight:600;color:#eee">Giờ làm việc</span>
            <span class="muted">Thứ 2 - Thứ 7, 9:00 - 18:00</span>
          </div>
          <div style="width:1px;height:28px;background:rgba(255,255,255,0.03);margin-left:6px"></div>
        </div>
      </div>
    </header>

    <section class="cols" aria-label="Contact form and map">
      <div class="card" aria-labelledby="form-title">
        <h2 id="form-title" style="margin:0 0 8px 0;font-family:'Rubik',sans-serif;color:#fff">Gửi cho chúng tôi một tin nhắn</h2>
        <p class="muted" style="margin:0 0 16px 0">Vui lòng cung cấp thông tin để chúng tôi phản hồi nhanh nhất có thể.</p>

        <form id="contactForm" novalidate>
          <div class="row">
            <div class="col field">
              <input id="name" name="name" type="text" placeholder=" " autocomplete="name" required />
              <label class="floating" for="name">Họ & tên</label>
            </div>
            <div class="col field">
              <input id="company" name="company" type="text" placeholder=" " autocomplete="organization" />
              <label class="floating" for="company">Công ty (tùy chọn)</label>
            </div>
          </div>

          <div class="row">
            <div class="col field">
              <input id="email" name="email" type="email" placeholder=" " autocomplete="email" required />
              <label class="floating" for="email">Email</label>
            </div>
            <div class="col field">
              <input id="phone" name="phone" type="text" placeholder=" " autocomplete="tel" />
              <label class="floating" for="phone">Số điện thoại</label>
            </div>
          </div>

          <div class="field">
            <textarea id="message" name="message" placeholder=" " required></textarea>
            <label class="floating" for="message">Nội dung tin nhắn</label>
          </div>

          <div class="meta">
            <div class="hint muted">Chúng tôi trả lời trong vòng 24 giờ làm việc.</div>
            <div style="display:flex;gap:8px;align-items:center">
              <button type="submit" class="btn primary" id="submitBtn" aria-live="polite">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="opacity:.9"><path d="M2 21l21-9L2 3v7l15 2-15 2v7z" fill="currentColor"/></svg>
                Gửi liên hệ
              </button>
              <button type="button" class="btn" id="clearBtn" title="Xóa biểu mẫu">
                Xóa
              </button>
            </div>
          </div>
        </form>
        <div style="margin-top:14px;display:flex;align-items:center;gap:12px;flex-wrap:wrap">
          <div class="muted">Hoặc:</div>
          <div style="display:flex;gap:10px;align-items:center">
            <button class="chip" id="copyPhone" title="Sao chép số điện thoại">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M16 2H4c-1.1 0-2 .9-2 2v14h2V4h12V2zm3 4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm0 14H8V10h11v12z" fill="currentColor"/></svg>
              <span id="phoneText">+84 912 345 678</span>
            </button>
            <button class="chip" id="copyEmail" title="Sao chép email">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M20 4H4c-1.1 0-2 .9-2 2v12a2 2 0 0 0 2 2h16c1.1 0 2-.9 2-2V6a2 2 0 0 0-2-2zm0 4-8 5L4 8V6l8 5 8-5v2z" fill="currentColor"/></svg>
              <span id="emailText">lienhe@congty.vn</span>
            </button>
          </div>
        </div>
      </div>

      <aside class="contact-side">
        <div class="map-wrap card" aria-label="Bản đồ vị trí">
          <div class="map-actions" role="toolbar" aria-label="Map actions">
            <button class="chip" id="openMap" title="Xem bản đồ lớn">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 2L2 7l10 5 10-5L12 2zm0 7.5L6.5 8 12 5l5.5 3-5.5 4.5zM2 17l10 5 10-5v-2L12 20 2 15v2z" fill="currentColor"/></svg>
              Xem lớn
            </button>
            <button class="chip" id="getDirections" title="Mở điều hướng">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 2C8.1 2 5 5.1 5 9c0 5.2 7 13 7 13s7-7.8 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5 14.5 7.6 14.5 9 13.4 11.5 12 11.5z" fill="currentColor"/></svg>
              Hướng dẫn
            </button>
          </div>

          <!-- Embedded Google Maps (search query for Hanoi as example) -->
          <iframe
            title="Bản đồ vị trí công ty"
            src="https://maps.google.com/maps?q=Hanoi%20Vietnam&t=&z=13&ie=UTF8&iwloc=&output=embed"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>

        <div class="card info" aria-label="Thông tin liên hệ">
          <div class="item">
            <div class="icon" aria-hidden="true">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 2C8.1 2 5 5.1 5 9c0 5.2 7 13 7 13s7-7.8 7-13c0-3.9-3.1-7-7-7zM12 11.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z" fill="currentColor"/></svg>
            </div>
            <div class="content">
              <span class="label">Địa chỉ</span>
              <span class="value">Số 1, Phố Mẫu, Quận Hoàn Kiếm, Hà Nội</span>
            </div>
          </div>

          <div class="item">
            <div class="icon" aria-hidden="true">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M21 8V7l-3 2-2-1-3 2-4-3-7 4 2 3 4 1 1 4 4-2 2 2 1-3 3-1V8z" fill="currentColor"/></svg>
            </div>
            <div class="content">
              <span class="label">Điện thoại</span>
              <span class="value">+84 912 345 678</span>
            </div>
          </div>

          <div class="item">
            <div class="icon" aria-hidden="true">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M20 4H4c-1.1 0-2 .9-2 2v12a2 2 0 0 0 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" fill="currentColor"/></svg>
            </div>
            <div class="content">
              <span class="label">Email</span>
              <span class="value">lienhe@congty.vn</span>
            </div>
          </div>

          <div style="display:flex;justify-content:space-between;align-items:center;margin-top:6px">
            <div class="small muted">Kết nối với chúng tôi</div>
            <div class="socials" aria-hidden="true">
              <a href="#" title="Facebook" aria-label="Facebook">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12C22 6.48 17.52 2 12 2S2 6.48 2 12c0 4.84 3.44 8.84 8 9.8V14.7h-2.4v-2.7H10V9.6c0-2.4 1.43-3.7 3.62-3.7 1.05 0 2.15.19 2.15.19v2.36h-1.21c-1.2 0-1.57.75-1.57 1.52v1.83h2.66l-.43 2.7H14V21.8c4.56-.96 8-4.96 8-9.8z"/></svg>
              </a>
              <a href="#" title="LinkedIn" aria-label="LinkedIn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3A2 2 0 0 1 21 5v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14zM8.34 17.5v-6H6.14v6h2.2zM7.24 10.9a1.28 1.28 0 1 0 0-2.56 1.28 1.28 0 0 0 0 2.56zM18 17.5v-3.2c0-1.67-.9-2.45-2.1-2.45-1.03 0-1.5.57-1.76.98v-0.84H12.9v6h2.1v-3.4c0-.9.17-1.77 1.28-1.77 1.03 0 1.06 1 1.06 1.8V17.5H18z"/></svg>
              </a>
              <a href="#" title="Twitter" aria-label="Twitter">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M22 5.9c-.6.3-1.2.5-1.9.6.7-.4 1.3-1.1 1.6-1.8-.7.4-1.4.6-2.2.8C18.1 4.6 17.1 4 16 4c-1.6 0-2.9 1.3-2.9 2.9 0 .2 0 .4.1.6-2.4-.1-4.5-1.3-5.9-3.1-.2.4-.3.8-.3 1.3 0 1.1.6 2 1.6 2.5-.5 0-1-.1-1.4-.4v.1c0 1.4 1 2.6 2.3 2.8-.4.1-.8.1-1.2.1-.3 0-.6 0-.9-.1.6 1.9 2.4 3.3 4.5 3.3-1.6 1.2-3.6 1.9-5.7 1.9H6c2 1.2 4.3 1.9 6.8 1.9 8.1 0 12.6-6.7 12.6-12.6v-.6c.9-.6 1.6-1.3 2.2-2.2-.9.4-1.9.7-3 1z"/></svg>
              </a>
            </div>
          </div>
        </div>

        <div class="foot muted">
          <div>© <strong style="color:#fff">Công ty</strong> — Tất cả quyền được bảo lưu</div>
          <div class="muted">Bản quyền &bull; Chính sách bảo mật</div>
        </div>
      </aside>
    </section>
  </div>

  <!-- Map modal -->
  <div class="map-modal" id="mapModal" role="dialog" aria-modal="true" aria-label="Bản đồ toàn màn hình">
    <div class="modal-card">
      <iframe
        title="Bản đồ toàn màn hình"
        src="https://maps.google.com/maps?q=Hanoi%20Vietnam&t=&z=14&ie=UTF8&iwloc=&output=embed"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
    <button class="close-btn" id="closeMap">Đóng</button>
  </div>

  <div class="snack" id="snack" role="status" aria-live="polite">Đã gửi</div>

  <script>
    // Small utilities
    const $ = (s, root = document) => root.querySelector(s);
    const $$ = (s, root = document) => Array.from(root.querySelectorAll(s));

    // Elements
    const form = $('#contactForm');
    const submitBtn = $('#submitBtn');
    const clearBtn = $('#clearBtn');
    const snack = $('#snack');
    const mapModal = $('#mapModal');
    const openMap = $('#openMap');
    const closeMap = $('#closeMap');
    const getDirections = $('#getDirections');
    const copyPhone = $('#copyPhone');
    const copyEmail = $('#copyEmail');
    const phoneText = $('#phoneText').textContent.trim();
    const emailText = $('#emailText').textContent.trim();

    // Simple snackbar
    function showSnack(message, ok=true){
      snack.textContent = message;
      snack.style.background = ok ? '' : 'linear-gradient(180deg,#2b2b2b,#1a0f0f)';
      snack.classList.add('show');
      setTimeout(()=> snack.classList.remove('show'), 3500);
    }

    // Basic validation
    function validateForm(data){
      const errors = [];
      if(!data.get('name') || data.get('name').trim().length < 2) errors.push('Vui lòng nhập họ tên hợp lệ.');
      const email = data.get('email') || '';
      if(!email.match(/^[^@\s]+@[^@\s]+\.[^@\s]+$/)) errors.push('Vui lòng nhập email hợp lệ.');
      if(!data.get('message') || data.get('message').trim().length < 6) errors.push('Vui lòng nhập nội dung (ít nhất 6 ký tự).');
      return errors;
    }

    // Fake submit (replace with real API)
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      submitBtn.disabled = true;
      const origText = submitBtn.innerHTML;
      submitBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="opacity:.9"><path d="M12 2L2 7l10 5 10-5L12 2zm0 7.5L6.5 8 12 5l5.5 3-5.5 4.5zM2 17l10 5 10-5v-2L12 20 2 15v2z" fill="currentColor"/></svg> Đang gửi...';

      const data = new FormData(form);
      const errors = validateForm(data);
      if(errors.length){
        showSnack(errors[0], false);
        submitBtn.disabled = false;
        submitBtn.innerHTML = origText;
        return;
      }

      try{
        // Simulate network delay
        await new Promise(r => setTimeout(r, 900));

        // If integrating, replace the following with real fetch:
        // await fetch('/api/contact', {...})

        showSnack('Gửi liên hệ thành công. Cảm ơn bạn!');
        form.reset();
        // reset floating labels position by blurring (they use :placeholder-shown)
        $$('input, textarea').forEach(i => i.blur());
      }catch(err){
        showSnack('Có lỗi khi gửi. Vui lòng thử lại.', false);
      }finally{
        submitBtn.disabled = false;
        submitBtn.innerHTML = origText;
      }
    });

    // Clear form
    clearBtn.addEventListener('click', () => {
      form.reset();
      $$('input, textarea').forEach(i => i.blur());
      showSnack('Biểu mẫu đã được làm mới.');
    });

    // Open map modal
    openMap.addEventListener('click', () => {
      mapModal.classList.add('show');
      document.body.style.overflow = 'hidden';
    });
    closeMap.addEventListener('click', () => {
      mapModal.classList.remove('show');
      document.body.style.overflow = '';
    });
    mapModal.addEventListener('click', (e) => {
      if(e.target === mapModal){ mapModal.classList.remove('show'); document.body.style.overflow = ''; }
    });

    // Get directions (open Google Maps in new tab)
    getDirections.addEventListener('click', () => {
      const q = encodeURIComponent('Số 1, Phố Mẫu, Quận Hoàn Kiếm, Hà Nội');
      window.open('https://www.google.com/maps/dir/?api=1&destination=' + q, '_blank');
    });

    // Copy to clipboard helpers
    async function copyText(text){
      try{
        await navigator.clipboard.writeText(text);
        showSnack('Đã sao chép: ' + text);
      }catch(e){
        // fallback
        const tmp = document.createElement('textarea');
        tmp.value = text; document.body.appendChild(tmp);
        tmp.select(); try { document.execCommand('copy'); showSnack('Đã sao chép: ' + text); } catch(err){ showSnack('Không thể sao chép', false); }
        tmp.remove();
      }
    }
    copyPhone.addEventListener('click', ()=> copyText(phoneText));
    copyEmail.addEventListener('click', ()=> copyText(emailText));

    // Small accessibility: focus visible style for keyboard users
    document.addEventListener('keydown', (e) => {
      if(e.key === 'Tab') document.documentElement.classList.add('show-focus');
    });

    // Ensure floating labels keep correct state on autofill
    window.addEventListener('load', () => {
      // trigger blur on all to reposition labels if necessary
      setTimeout(() => $$('input, textarea').forEach(i => i.dispatchEvent(new Event('input'))), 200);
    });
  </script>
</body>
</html>