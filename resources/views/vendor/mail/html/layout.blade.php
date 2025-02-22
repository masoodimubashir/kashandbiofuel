<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{{ config('app.name') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<style>
@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}
</style>

<style>
body {
font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
line-height: 1.6;
color: #2d3748;
margin: 0;
padding: 20px;
background-color: #f7fafc;
}
.invoice-container {
width: 100vw;
margin: 0 auto;
background: white;
padding: 40px;
border-radius: 10px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.header {
border-bottom: 2px solid #edf2f7;
padding-bottom: 20px;
margin-bottom: 30px;
}
.company-logo {
font-size: 24px;
font-weight: bold;
color: #2d3748;
margin-bottom: 20px;
}
.customer-details {
display: grid;
grid-template-columns: 1fr 1fr;
gap: 30px;
margin-bottom: 30px;
}
.job-details {
background: #f8fafc;
padding: 20px;
border-radius: 8px;
margin-bottom: 30px;
}
.job-details div {
margin-bottom: 10px;
}
.service-header {
display: flex;
justify-content: flex-end;
margin-bottom: 20px;
color: #4a5568;
}
table {
width: 100%;
border-collapse: collapse;
margin: 20px 0;
}
th {
background: #f8fafc;
padding: 12px;
text-align: left;
font-weight: 600;
color: #4a5568;
border-bottom: 2px solid #edf2f7;
}
td {
padding: 12px;
border-bottom: 1px solid #edf2f7;
}
.amount-column {
text-align: right;
}
.totals {
margin-top: 30px;
border-top: 2px solid #edf2f7;
padding-top: 20px;
}
.totals-row {
display: flex;
justify-content: space-between;
padding: 10px 0;
font-size: 16px;
}
.footer-notes {
margin-top: 40px;
padding-top: 20px;
border-top: 1px solid #edf2f7;
color: #718096;
font-size: 14px;
}
@media print {
body {
background: white;
}
.invoice-container {
box-shadow: none;
padding: 0;
}
}
</style>

{{ $head ?? '' }}
</head>
<body>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
{{ $header ?? '' }}

<!-- Email Body -->
<tr>
<td class="body" width="100%" cellpadding="0" cellspacing="0" style="border: hidden !important;">
<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<!-- Body content -->
<tr>
<td class="content-cell">
{{ Illuminate\Mail\Markdown::parse($slot) }}

{{ $subcopy ?? '' }}
</td>
</tr>
</table>
</td>
</tr>

{{ $footer ?? '' }}
</table>
</td>
</tr>
</table>
</body>
</html>
