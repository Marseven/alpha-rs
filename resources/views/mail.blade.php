@component('mail::message')
<h1>Hello {{ config('app.name') }},</h1>

<p>
  Sujet : {{ $data['subject'] }} <br>
  {{ $data['message'] }} <br>


  Cordialment,<br>
{{ $data['name'] }} <br>
{{ $data['email'] }} , {{ $data['phone'] }}
</p>


@endcomponent
