document.addEventListener("DOMContentLoaded", function(){
    document.querySelectorAll('.sidebar .nav-list-item-link').forEach(function(element){
      
      element.addEventListener('click', function (e) {
  
        let nextEl = element.nextElementSibling;
  
        if (nextEl && nextEl.classList.contains('submenu-list')) {
            e.preventDefault();
            
            if (nextEl.classList.contains('show')) {
                nextEl.classList.remove('show');
            } else {
                // Hide any other open submenu
                document.querySelectorAll('.submenu-list.show').forEach(function(submenu){
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


$(document).ready(function() {
    $('.sidebar .nav-list-item-link').on('click', function() {
        // Remove active class from all nav-list-item
        $('.sidebar .nav-list-item').removeClass('active');
        
        // Add active class to the clicked item's parent li
        $(this).parent('.nav-list-item').addClass('active');
        
        // Optional: Prevent default action if the clicked item has a submenu
        if ($(this).next('.submenu-list').length > 0) {
            event.preventDefault();
        }
    });

    $('.submenu-list-item-link').on('click', function(e) {
        e.stopPropagation(); // Stop event from bubbling up to parent nav-list-item-link
        
        // Remove active class from all nav-list-item
        $('.sidebar .nav-list-item').removeClass('active');
        
        // Add active class to the closest parent nav-list-item
        $(this).closest('.nav-list-item').addClass('active');
    });
});

 $(document).ready(function(){
    function toggleOffcanvas() {
        if ($(window).width() <= 767) {
            $('#offcanvasScrolling').removeClass('show');
        } else {
            $('#offcanvasScrolling').addClass('show');
        }
    }

    // Initially toggle based on window width
    toggleOffcanvas();

    // Attach resize event listener to dynamically toggle
    $(window).resize(function() {
        toggleOffcanvas();
    });

    // Toggle offcanvas scrolling on sidebarToggle click
    $('#sidebarToggle').on('click', function() {
        $('#offcanvasScrolling').toggleClass('show');
    });
});

