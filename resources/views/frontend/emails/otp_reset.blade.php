<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Password Reset Code</title>
</head>
<body style="margin:0;padding:0;background:#f0f4f9;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f4f9;padding:40px 16px;">
  <tr>
    <td align="center">
      <table width="560" cellpadding="0" cellspacing="0" style="max-width:560px;width:100%;background:#fff;border-radius:16px;overflow:hidden;border:1px solid #e4ecf5;box-shadow:0 4px 24px rgba(0,30,60,0.08);">

        {{-- Header --}}
        <tr>
          <td style="background:linear-gradient(135deg,#001e3c,#002d5c);padding:36px 40px;text-align:center;">
            <div style="width:60px;height:60px;border-radius:16px;background:rgba(250,176,5,0.15);border:2px solid rgba(250,176,5,0.35);display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;">
              <span style="font-size:1.6rem;">🔐</span>
            </div>
            <h1 style="color:#fff;font-size:1.3rem;font-weight:800;margin:0 0 6px;">Password Reset Code</h1>
            <p style="color:rgba(255,255,255,0.5);font-size:0.83rem;margin:0;">TechPark English</p>
          </td>
        </tr>

        {{-- Body --}}
        <tr>
          <td style="padding:36px 40px;">
            <p style="font-size:0.95rem;color:#4a5568;margin:0 0 20px;">Hi <strong style="color:#001e3c;">{{ $userName }}</strong>,</p>
            <p style="font-size:0.88rem;color:#6b7a90;line-height:1.7;margin:0 0 28px;">
              We received a request to reset your TechPark English account password. Use the verification code below to complete the process.
            </p>

            {{-- OTP Box --}}
            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
              <tr>
                <td align="center">
                  <div style="background:#f0f4f9;border:2px dashed #c8d9f0;border-radius:14px;padding:28px;text-align:center;display:inline-block;width:100%;box-sizing:border-box;">
                    <div style="font-size:0.72rem;font-weight:700;color:#6b7a90;text-transform:uppercase;letter-spacing:1px;margin-bottom:12px;">Your Verification Code</div>
                    <div style="font-size:2.8rem;font-weight:900;letter-spacing:12px;color:#001e3c;font-family:'Courier New',monospace;">{{ $otp }}</div>
                    <div style="font-size:0.75rem;color:#9baec4;margin-top:10px;">⏱ Expires in 15 minutes</div>
                  </div>
                </td>
              </tr>
            </table>

            <p style="font-size:0.85rem;color:#6b7a90;line-height:1.7;margin:0 0 20px;">
              Enter this code on the verification page to set your new password.
            </p>

            <div style="background:#fff8e6;border:1px solid #ffe0a3;border-radius:10px;padding:14px 18px;margin-bottom:24px;">
              <p style="font-size:0.8rem;color:#92601a;margin:0;">
                ⚠️ If you did not request a password reset, please ignore this email. Your account is safe.
              </p>
            </div>

            <p style="font-size:0.8rem;color:#9baec4;margin:0;">
              This code will expire automatically after 15 minutes for your security.
            </p>
          </td>
        </tr>

        {{-- Footer --}}
        <tr>
          <td style="background:#f7faff;border-top:1px solid #e4ecf5;padding:20px 40px;text-align:center;">
            <p style="font-size:0.75rem;color:#9baec4;margin:0;">
              © {{ date('Y') }} TechPark English. All rights reserved.
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>
</body>
</html>
