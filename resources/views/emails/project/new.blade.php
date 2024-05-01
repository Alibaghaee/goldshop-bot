@component('mail::message')
# New Project Form Rahco.de

You have new project

Info: <br>
<strong>fullname</strong>: {{ array_get($data, 'fullname') }} <br>
<strong>company</strong>: {{ array_get($data, 'company') }} <br>
<strong>email</strong>: {{ array_get($data, 'email') }} <br>
<strong>phone</strong>: {{ array_get($data, 'phone') }} <br>
<strong>detail</strong>: {{ array_get($data, 'detail') }} <br>
<strong>city</strong>: {{ array_get($data, 'city') }} <br>
<strong>country</strong>: {{ array_get($data, 'country') }} <br>

@component('mail::button', ['url' => request()->root() . '/' .$file_path])
View Attach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent