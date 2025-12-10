<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 20px auto; background: white; border-radius: 8px; overflow: hidden;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px 20px; text-align: center;">
            <h1 style="margin: 0; font-size: 24px;">🎯 New Lead Received!</h1>
            <p style="margin: 10px 0 0 0;">Someone just submitted a contact form</p>
        </div>

        <div style="padding: 30px 20px;">
            <div style="margin: 15px 0; padding: 15px; background: #f8f9fa; border-left: 4px solid #667eea;">
                <div style="font-weight: 600; color: #667eea; font-size: 14px;">NAME</div>
                <div style="color: #333; font-size: 16px;">{{ $leadName }}</div>
            </div>

            <div style="margin: 15px 0; padding: 15px; background: #f8f9fa; border-left: 4px solid #667eea;">
                <div style="font-weight: 600; color: #667eea; font-size: 14px;">EMAIL</div>
                <div style="color: #333; font-size: 16px;"><a href="mailto:{{ $leadEmail }}">{{ $leadEmail }}</a></div>
            </div>

            @if($leadPhone)
            <div style="margin: 15px 0; padding: 15px; background: #f8f9fa; border-left: 4px solid #667eea;">
                <div style="font-weight: 600; color: #667eea; font-size: 14px;">PHONE</div>
                <div style="color: #333; font-size: 16px;">{{ $leadPhone }}</div>
            </div>
            @endif

            @if($companyName)
            <div style="margin: 15px 0; padding: 15px; background: #f8f9fa; border-left: 4px solid #667eea;">
                <div style="font-weight: 600; color: #667eea; font-size: 14px;">COMPANY</div>
                <div style="color: #333; font-size: 16px;">{{ $companyName }}</div>
            </div>
            @endif

            <div style="margin: 15px 0; padding: 15px; background: #f8f9fa; border-left: 4px solid #667eea;">
                <div style="font-weight: 600; color: #667eea; font-size: 14px;">BUSINESS TYPE</div>
                <div style="color: #333; font-size: 16px;">{{ ucfirst(str_replace('-', ' ', $businessType)) }}</div>
            </div>

            <div style="margin: 15px 0; padding: 15px; background: #f8f9fa; border-left: 4px solid #667eea;">
                <div style="font-weight: 600; color: #667eea; font-size: 14px;">LEAD SCORE</div>
                <div style="color: #333; font-size: 16px;">
                    <span style="padding: 8px 16px; background: #10b981; color: white; border-radius: 20px; font-weight: 600;">
                        {{ $leadScore }}/100
                    </span>
                </div>
            </div>

            @if($message)
            <div style="font-weight: 600; color: #667eea; font-size: 14px; margin-top: 20px;">MESSAGE</div>
            <div style="background: #f8f9fa; padding: 20px; border-radius: 4px; margin: 10px 0; border-left: 4px solid #667eea;">
                {{ $message }}
            </div>
            @endif

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ $adminUrl }}" style="display: inline-block; padding: 12px 30px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; text-decoration: none; border-radius: 50px; font-weight: 600;">
                    View Lead in Admin Panel
                </a>
            </div>
        </div>

        <div style="background: #f8f9fa; padding: 20px; text-align: center; color: #6b7280; font-size: 14px;">
            <p>This is an automated notification from 10x Global EPOS</p>
        </div>
    </div>
</body>
</html>