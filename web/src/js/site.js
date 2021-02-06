$(function() {
  
  $('[data-toggle="tooltip"]').tooltip();
  
  $('form.update').on('submit', function(e) {
    
    e.preventDefault();
    
    var $this = $(this);
        
    $.ajax({
      url: $this.attr('action'),
      data: $this.serializeArray(),
      method: $this.attr('method'),
    });
    
  });
  
  $('.sortable').each(function() {
    
    var $form = $(this).parents('form');
            
    Sortable.create(this, {
      group: 'people',
      onChange: function(e) {
                
        $(e.item).find('input').attr('name', $(e.to).data('name'));
        
        var color = $(e.to).data('color');
        if (color) {
        
          $(e.item).css('border-left-color', color);
        
        }
        
        if ($(e.to).children('li').length === 0) {
          $(e.to).addClass('empty');
        } else {
          $(e.to).removeClass('empty');
        }
        
        if ($(e.from).children('li').length === 0) {
          $(e.from).addClass('empty');
        } else {
          $(e.from).removeClass('empty');
        }
        
        $form.trigger('submit');
        
      }
    });
    
  });
  
});