jQuery(window).scroll(function () {
  var scroll = jQuery(window).scrollTop();
  if (scroll >= 5) {
    jQuery('#site-header').addClass('scrolled');
  } else {
    jQuery('#site-header').removeClass('scrolled');
  }
  if (jQuery(window).scrollTop() + jQuery(window).height() > jQuery(document).height() - 100) {
    jQuery('#site-footer').addClass('bottom');
  } else {
    jQuery('#site-footer').removeClass('bottom');
  }
});

document.addEventListener('DOMContentLoaded', function () {
  /**************************
   * Accordion
   */

  const accordionItems = document.querySelectorAll('.accordion-item');

  accordionItems.forEach((item) => {
    const header = item.querySelector('.accordion-header');
    const content = item.querySelector('.accordion-content');

    header.addEventListener('click', () => {
      content.classList.toggle('active');
      header.classList.toggle('active');
    });
  });

  /**************************
   * Category Filter
   */

  const currentUrl = window.location.href.split('?')[0];
  const categoryInput = document.querySelectorAll('.program-category');
  const currentCategory = new URL(window.location.href).searchParams.get('category');

  categoryInput.forEach((select) => {
    currentCategory ? select.value = currentCategory : select.selectedIndex = 0;
    select.addEventListener('change', function () {
      const category = select.value;
      if (category) {
        const url = `${currentUrl}?category=${category}#tabs`;
        window.location.href = url;
      } else {
        window.location.href = currentUrl;
      }
    });
  });
});
