<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<link href="{{ asset('assets/datatable/css/datatable.bootstrap5.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/datatable/js/datatbales.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/datatables.bootstrap5.min.js') }}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    $("#department_id").select2({
        placeholder: "Select a Department",
        allowClear: true
    });

    $("#doctor_id").select2({
        placeholder: "Select a Doctor",
        allowClear: true
    });

    $("#patient_id").select2({
        placeholder: "Select a Patient",
        allowClear: true
    });

    $("#email_to").select2({
        placeholder: "Emails",
        allowClear: true
    });
</script>

