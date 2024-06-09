document.addEventListener("DOMContentLoaded", function(){
    document.querySelectorAll('.sidebar .nav-link').forEach(function(element){
      
      element.addEventListener('click', function (e) {
  
        let nextEl = element.nextElementSibling;
  
        if (nextEl && nextEl.classList.contains('submenu')) {
            e.preventDefault();
            
            if (nextEl.classList.contains('show')) {
                nextEl.classList.remove('show');
            } else {
                // Hide any other open submenu
                document.querySelectorAll('.submenu.show').forEach(function(submenu){
                    submenu.classList.remove('show');
                });
                
                nextEl.classList.add('show');
            }
        }
      });
    });
});

document.addEventListener("DOMContentLoaded", function(){
  // Function to check if an element is a child of another element
  function isDescendant(parent, child) {
      let node = child.parentNode;
      while (node !== null) {
          if (node === parent) {
              return true;
          }
          node = node.parentNode;
      }
      return false;
  }

  // Function to close the dropdown menu
  function closeDropdownMenu() {
      document.querySelectorAll('.dropdown-menu.show').forEach(function(menu){
          menu.classList.remove('show');
      });

      document.querySelectorAll('.dropdown-toggle').forEach(function(toggle){
          toggle.setAttribute('data-dropdown-state', 'closed');
      });
  }

  document.querySelectorAll('.dropdown-toggle').forEach(function(toggle){
      toggle.addEventListener('click', function (e) {
          e.preventDefault();

          let dropdownMenu = this.querySelector('.dropdown-menu');
          let toggleRect = this.getBoundingClientRect();
          let toggleHeight = toggleRect.height;

          // Toggle the 'show' class on the dropdown menu
          if (this.getAttribute('data-dropdown-state') === 'closed') {
              dropdownMenu.classList.add('show');
              this.setAttribute('data-dropdown-state', 'open');
          } else {
              dropdownMenu.classList.remove('show');
              this.setAttribute('data-dropdown-state', 'closed');
          }

          // Position the dropdown menu above the toggle if there's not enough space below
          let windowHeight = window.innerHeight;
          let spaceBelowToggle = windowHeight - toggleRect.bottom;
          let spaceAboveToggle = toggleRect.top;
          if (spaceBelowToggle < dropdownMenu.offsetHeight && spaceAboveToggle >= dropdownMenu.offsetHeight) {
              dropdownMenu.style.top = "-" + dropdownMenu.offsetHeight + "px";
          } else {
              dropdownMenu.style.top = toggleHeight + "px";
          }
      });
  });

  // Close dropdown menu when clicking outside of it
  document.body.addEventListener('click', function(e) {
      document.querySelectorAll('.dropdown-toggle').forEach(function(toggle){
          let dropdownMenu = toggle.querySelector('.dropdown-menu');
          if (!isDescendant(toggle, e.target) && !isDescendant(dropdownMenu, e.target)) {
              closeDropdownMenu();
          }
      });
  });
});


// Active class add remove
$(document).ready(function() {
    $('.nav-link').click(function() {
        // Remove 'active' class from all nav-items
        $('.nav-item').removeClass('active');

        // Add 'active' class to the parent nav-item of the clicked nav-link
        $(this).parent().addClass('active');
    });
});