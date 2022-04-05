<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care-Hub</title>
</head>
<body>
<h1>Join US Information</h1>

@if(isset($data['name']))
<p>Name :  {{ $data['name'] }} </p>
@endif 
@if(isset($data['email2']))
<p>Email :  {{ $data['email2'] }} </p>
@endif 
@if(isset($data['birth_date']))
<p>Birth Date :  {{ $data['birth_date'] }} </p>
@endif 
@if(isset($data['phone']))
<p>Phone :  {{ $data['phone'] }} </p>
@endif
@if(isset($data['phone2']))
<p>Other Phone :  {{ $data['phone2'] }} </p>
@endif
@if(isset($data['governorate_id']))
<p>Governorate :  {{ \App\Models\Governorate::getNameEN($data['governorate_id']) }} </p>
@endif
@if(isset($data['city_id']))
<p>City :  {{ \App\Models\City::getNameEN($data['governorate_id']) }} </p>
@endif
@if(isset($data['adress']))
<p>Adress :  {{ $data['adress'] }} </p>
@endif
@if(isset($data['adress2']))
<p>Adress 2 :  {{ $data['adress2'] }} </p>
@endif
@if(isset($data['job_title']))
<p>Job Title :  {{ $data['job_title'] }} </p>
@endif

@if(isset($data['specialty_id']))
<p>Specialty :  {{ \App\Models\Specialty::getNameEN($data['specialty_id']) }} </p>
@endif

@if(isset($data['comp_name']))
<p>Company Name  :  {{ $data['comp_name'] }} </p>
@endif
@if(isset($data['comp_work_on']))
<p>Company Work on  :  {{ $data['comp_work_on'] }} </p>
@endif
@if(isset($data['comp_profile']))
<p>Company Profile  :  {{ $data['comp_profile'] }} </p>
@endif



<p></p>

</body>
</html>
