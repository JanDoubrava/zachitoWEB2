@props(['url'])

<tr>
<td>
<table class="header" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<a href="{{ $url }}" target="_blank" rel="noopener">
<img src="{{ asset('images/logo.png') }}" class="logo" alt="{{ config('app.name') }}">
</a>
</td>
</tr>
</table>
</td>
</tr> 