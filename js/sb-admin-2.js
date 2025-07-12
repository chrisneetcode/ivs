"use strict";

// Sidebar toggle
document.querySelectorAll("#sidebarToggle, #sidebarToggleTop").forEach(btn => {
  btn.addEventListener("click", () => {
    document.body.classList.toggle("sidebar-toggled");
    const sidebar = document.querySelector(".sidebar");
    if (sidebar) {
      sidebar.classList.toggle("toggled");
      if (sidebar.classList.contains("toggled")) {
        sidebar.querySelectorAll(".collapse").forEach(collapse => {
          if (typeof bootstrap !== 'undefined') {
            const bsCollapse = bootstrap.Collapse.getOrCreateInstance(collapse);
            bsCollapse.hide();
          }
        });
      }
    }
  });
});

// Responsive behavior on resize
window.addEventListener("resize", () => {
  if (window.innerWidth < 768) {
    document.querySelectorAll('.sidebar .collapse').forEach(collapse => {
      if (typeof bootstrap !== 'undefined') {
        const bsCollapse = bootstrap.Collapse.getOrCreateInstance(collapse);
        bsCollapse.hide();
      }
    });
  }

  if (window.innerWidth < 480 && !document.querySelector(".sidebar").classList.contains("toggled")) {
    document.body.classList.add("sidebar-toggled");
    document.querySelector(".sidebar").classList.add("toggled");
    document.querySelectorAll('.sidebar .collapse').forEach(collapse => {
      if (typeof bootstrap !== 'undefined') {
        const bsCollapse = bootstrap.Collapse.getOrCreateInstance(collapse);
        bsCollapse.hide();
      }
    });
  }
});

// Scroll to Top button behavior
document.addEventListener("scroll", () => {
  const scrollBtn = document.querySelector('.scroll-to-top');
  if (scrollBtn) {
    scrollBtn.style.display = window.scrollY > 100 ? 'inline' : 'none';
  }
});

// Smooth scroll (native) for scroll-to-top
document.querySelectorAll('a.scroll-to-top').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({ behavior: 'smooth' });
    }
  });
});

// Optional: prevent sidebar from scrolling when fixed-nav
const fixedNavSidebar = document.querySelector('body.fixed-nav .sidebar');
if (fixedNavSidebar && window.innerWidth > 768) {
  fixedNavSidebar.addEventListener('wheel', (e) => {
    e.preventDefault();
    fixedNavSidebar.scrollTop += e.deltaY < 0 ? -30 : 30;
  }, { passive: false });
}
