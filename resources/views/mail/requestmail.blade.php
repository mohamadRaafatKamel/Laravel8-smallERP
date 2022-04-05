<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareHub</title>
</head>
<body>

@if(isset($data['type']))
<h1>{{ \App\Models\Requests::getRequestType($data['type']) }} </h1>
@else
    <h1>Request Information</h1>
@endif

@if(isset($data['fullname']))
<p>Name :  {{ $data['fullname'] }} </p>
@endif 
@if(isset($data['phone']))
<p>Phone :  {{ $data['phone'] }} </p>
@endif 
@if(isset($data['specialty_id']))
<p>Specialty :  {{ \App\Models\Specialty::getNameEN($data['specialty_id']) }} </p>
@endif
@if(isset($data['service_id']))
<p>Service :  {{ \App\Models\Service::getNameEN($data['service_id']) }} </p>
@endif

<p></p>

</body>
</html>
