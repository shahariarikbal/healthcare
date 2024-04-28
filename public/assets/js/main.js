document.addEventListener("DOMContentLoaded", function(){
    document.querySelectorAll('.sidebar .nav-link').forEach(function(element){
      
      element.addEventListener('click', function (e) {
  
        let nextEl = element.nextElementSibling;
        let parentEl  = element.parentElement;	
  
          if(nextEl) {
              e.preventDefault();	
              let mycollapse = new bootstrap.Collapse(nextEl);
              
              if(nextEl.classList.contains('show')){
                mycollapse.hide();
              } else {
                mycollapse.show();
                var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                if(opened_submenu){
                new bootstrap.Collapse(opened_submenu);
                }
              }
          }
      });
    })
  });


  $(document).ready(function() {
    $('#example').DataTable({
      "columnDefs": [
        { "orderable": false, "targets": 5 }
      ],
      language: {
        'paginate': {
          'previous': '<span class="bi bi-chevron-left"></span>',
          'next': '<span class="bi bi-chevron-right"></span>'
        },
        "lengthMenu": 'Display <select class="form-control input-sm">'+
        '<option value="10">10</option>'+
        '<option value="20">20</option>'+
        '<option value="30">30</option>'+
        '<option value="40">40</option>'+
        '<option value="50">50</option>'+
        '<option value="-1">All</option>'+
        '</select> results'
      }
    })  
} );