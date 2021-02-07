$(function() {
  
  $('[data-toggle="tooltip"]').tooltip();
  
  $('form.update').on('submit', function(e) {
    
    e.preventDefault();
    
    var $this = $(this);
        
    $.ajax({
      url: $this.attr('action'),
      data: $this.serializeArray(),
      method: $this.attr('method')
    });
    
  });
  
  $('.badge').on('update.state', function() {
    
    var $badge = $(this),
        count = $badge.text().split('/'),
        state = 'badge badge-';
     
    if (count.length === 2) {
      
      var n = parseInt(count[0]),
          m = parseInt(count[1]);
      
      console.log(n, m);
      
      if (n === m) {
        state += 'success';
      } else if (n > m) {
        state += 'danger';
      } else if (n === 0) {
        state += 'secondary';
      } else {
        state += 'info';
      }
      
      $badge.attr('class', state);
      
    }
    
  });
  
  $('.sortable').on('update.counter', function() {
    
    var $ul = $(this),
        n = $ul.children('li').length,
        count = $ul.data('count'),
        $count = $('span[data-count="'+count+'"]'),
        $badge = $count.parent('span');
        
    $count.text(n);
    
    $badge.trigger('update.state');
    
  }).trigger('update.counter');
  
  $('.sortable').each(function() {
    
    var $form = $(this).parents('form');
            
    Sortable.create(this, {
      group: 'people',
      onChange: function(e) {
                
        var $to = $(e.to),
            $from = $(e.from),
            $item = $(e.item),
            color = $to.data('color');
    
        $item.find('input').attr('name', $to.data('name'));
        
        if (color) {
          $item.css('border-left-color', color);
        }
        
        if ($to.children('li').length === 0) {
          $to.addClass('empty');
        } else {
          $to.removeClass('empty');
        }
        
        if ($from.children('li').length === 0) {
          $from.addClass('empty');
        } else {
          $from.removeClass('empty');
        }
        
        $to.trigger('update.counter');
        $from.trigger('update.counter'),
        
        $form.trigger('submit');
        
      }
    });
    
  });
  
  $(document).on('click', 'a[rel="ajax"]', function(e) {
        
    e.preventDefault();
    
    var $btn = $(this);
    
    $.get($btn.attr('href'), function(response) {
      
      if (response) {
        
        $btn.parents('li').remove();
        
        $btn.parents('ul').trigger('update.counter');
        
      }
      
    });
    
  });
  
});