NEW LEAD RECEIVED
==================

Name: {{ $leadName }}
Email: {{ $leadEmail }}
@if($leadPhone)Phone: {{ $leadPhone }}@endif
@if($companyName)Company: {{ $companyName }}@endif
Business Type: {{ ucfirst(str_replace('-', ' ', $businessType)) }}
Source: {{ ucfirst(str_replace('_', ' ', $source)) }}
Lead Score: {{ $leadScore }}/100

@if($message)
Message:
--------
{{ $message }}
@endif

View Lead: {{ $adminUrl }}

---
10x Global EPOS - Automated Notification