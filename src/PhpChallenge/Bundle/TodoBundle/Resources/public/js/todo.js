$(document).ready(function() {

  $('#todolist').on('click', 'a', function(event) {
    var el = $(event.target);
    var id = el.parent('li').find('input[type="checkbox"]').attr('id');
    $.ajax({
      url: 'api/list/item/' + id + '.json',
      type: 'DELETE',
      success: function() {
        el.parent('li').remove();
      },
      error: function() {
        $('#flash_message').html('could not delete item');
      },
      beforeSend: function(xhr) {
        $('#flash_message').html('');
        xhr.setRequestHeader('X-AUTH-TOKEN', apiToken);
      }
    });
  });

  $('#todolist').on('click', 'span', function(event) {
    var el = $(event.target);
    el.html('<input type="text" class="update_item" value="'+el.html()+'" />');
    el.find('input').focus();
    el.on('focusout', function(event) {
      var id = el.parent('li').find('input[type="checkbox"]').attr('id');
      if (!id) {
        return;
      }
      el.html(el.find('input').val());

      $.ajax({
        url: 'api/list/item/'+id+'.json',
        type: 'PUT',
        dataType: 'json',
        contentType: "application/json",
        data: JSON.stringify({
          description: el.text(),
          status: el.parent('li').find('input[type="checkbox"]').checked ? 'completed' : 'active'
        }),
        error: function() {
          var errorMessage = 'An error occurred trying to update the item';
          $('#flash_message').html(errorMessage);
        },
        beforeSend: function(xhr) {
          $('#flash_message').html('');
          xhr.setRequestHeader('X-AUTH-TOKEN', apiToken);
        }
      });
    });
  });

  $('#todolist').on('click', 'input:checkbox', function(event) {
    var id = event.target.id;

    $.ajax({
      url: 'api/list/item/'+id+'.json',
      type: 'PUT',
      dataType: 'json',
      contentType: "application/json",
      data: JSON.stringify({
        description: $('#item-'+id+ ' span').text(),
        status: event.target.checked ? 'completed' : 'active'
      }),
      error: function() {
        var errorMessage = 'An error occurred trying to update the item';
        $('#flash_message').html(errorMessage);
      },
      beforeSend: function(xhr) {
        $('#flash_message').html('');
        xhr.setRequestHeader('X-AUTH-TOKEN', apiToken);
      }
    });
  });

  $('#create_button').click(function() {
    $.ajax({
      url: 'api/list/item.json',
      type: 'POST',
      dataType: 'json',
      contentType: "application/json",
      data: JSON.stringify({
        description: $('#create_item').val(),
        status: 'active'
      }),
      success: function(data) {
        var items = [];

        items.push('<li id="item-' + data.id + '" class="'+data.status+'">' +
          '<span class="description">' + data.description + '</span>' +
          '<input type="checkbox" id="'+data.id+'" class="toggle-status" '+(data.status == "completed" ? "checked" : "")+'  />' +
          '<a href="#">[X]</a>' +
          '</li>');

        $('#todolist').append( items.join(''));
        $('#create_item').val('');
      },
      error: function() {
        $('#flash_message').html('could not create todo item');
      },
      beforeSend: function(xhr) {
        $('#flash_message').html('');
        xhr.setRequestHeader('X-AUTH-TOKEN', apiToken);
      }
    });
  });

  $.ajax({
    url: 'api/list.json',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      var items = [];

      $.each(data.items, function(key, val) {
        items.push('<li id="item-' + val.id + '" class="'+val.status+'">' +
          '<span class="description">' + val.description + '</span>' +
          '<input type="checkbox" id="'+val.id+'" class="toggle-status" '+(val.status == "completed" ? "checked" : "")+'  />' +
          '<a href="#" class="delete_item">[X]</a>' +
          '</li>');
      });

      $('#todolist').append( items.join(''));
    },
    error: function() {
      $('#flash_message').html('an error occurred');
    },
    beforeSend: function(xhr) {
      $('#flash_message').html('');
      xhr.setRequestHeader('X-AUTH-TOKEN', apiToken);
    }
  });
});
