 $(document).on('click', '.sidebar li a', function (e) {
      var $this = $(this);
      var checkElement = $this.next();
      if ((checkElement.is('.treeview-menu')) && (checkElement.is(':visible'))) {
        checkElement.slideUp(500, function () {
          checkElement.removeClass('menu-open');
        });
        checkElement.parent("li").removeClass("active");
      }
      else if ((checkElement.is('.treeview-menu')) && (!checkElement.is(':visible'))) {
        var parent = $this.parents('ul').first();
        var ul = parent.find('ul:visible').slideUp(500);
        ul.removeClass('menu-open');
        var parent_li = $this.parent("li");
        checkElement.slideDown(500, function () {
          checkElement.addClass('menu-open');
          parent.find('li.active').removeClass('active');
          parent_li.addClass('active');
        });
      }
      if (checkElement.is('.treeview-menu')) {
        e.preventDefault();
      }
    });

 $(document).ready(function(){
  $('body').find('input[type=checkbox]').iCheck({ checkboxClass: 'icheckbox_minimal' });
  $('body').find('input[type=radio]').iCheck({ radioClass: 'iradio_minimal' });
});
  
